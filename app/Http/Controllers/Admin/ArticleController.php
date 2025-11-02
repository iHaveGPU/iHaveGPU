<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // GET /manage/articles
    public function index(Request $request)
    {
        $q = Article::query()->with('author')->latest();

        if ($search = $request->string('q')->toString()) {
            $q->where(function ($qq) use ($search) {
                $qq->where('title', 'like', "%{$search}%")
                   ->orWhere('excerpt', 'like', "%{$search}%")
                   ->orWhere('body', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->string('status')->toString();
            $status === 'published'
                ? $q->published()
                : $q->where('is_published', false);
        }

        $articles = $q->paginate(12)->withQueryString();

        return view('admin.articles.index', compact('articles'));
    }

    // GET /manage/articles/create
    public function create()
    {
        return view('admin.articles.create');
    }

    // POST /manage/articles
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required','string','max:255'],
            'slug'         => ['nullable','string','max:255','alpha_dash', Rule::unique('articles','slug')],
            'excerpt'      => ['nullable','string','max:500'],
            'body'         => ['required','string'],
            'cover_image'  => ['nullable','image','max:2048'], // 2MB
            'is_published' => ['required','boolean'],          // มาจาก hidden+checkbox
            'published_at' => ['nullable','date'],
        ]);

        // slug อัตโนมัติ + กันซ้ำ
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['slug'] = $this->uniqueSlug($data['slug']);

        // อัปโหลดรูป
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                ->store('articles', 'public');
        }

        $data['author_id'] = $request->user()->id;

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        if (!$data['is_published']) {
            $data['published_at'] = null;
        }

        Article::create($data);

        return redirect()
            ->route('manage.articles.index')
            ->with('success', 'Article created.');
    }

    // GET /manage/articles/{article}/edit
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    // PUT/PATCH /manage/articles/{article}
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title'        => ['required','string','max:255'],
            'slug'         => ['nullable','string','max:255','alpha_dash', Rule::unique('articles','slug')->ignore($article->id)],
            'excerpt'      => ['nullable','string','max:500'],
            'body'         => ['required','string'],
            'cover_image'  => ['nullable','image','max:2048'],
            'is_published' => ['required','boolean'], // hidden+checkbox ช่วยให้ key นี้ส่งมาเสมอ
            'published_at' => ['nullable','date'],
        ]);

        $data['slug'] = $data['slug']
            ? $this->uniqueSlug($data['slug'], $article->id)
            : $this->uniqueSlug(Str::slug($data['title']), $article->id);

        if ($request->hasFile('cover_image')) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('articles', 'public');
        }

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        if (!$data['is_published']) {
            $data['published_at'] = null;
        }

        $article->update($data);

        return redirect()
            ->route('manage.articles.index')
            ->with('success', 'Article updated.');
    }

    // DELETE /manage/articles/{article}
    public function destroy(Article $article)
    {
        if ($article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
        }
        $article->delete();

        return back()->with('success', 'Article deleted.');
    }

    // ทำให้ slug ไม่ซ้ำ
    private function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = Str::slug($base) ?: 'article';
        $original = $slug;
        $i = 1;

        while (
            Article::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id','!=',$ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
