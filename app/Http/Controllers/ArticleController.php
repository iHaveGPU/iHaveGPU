<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // GET /articles  (เฉพาะเผยแพร่แล้ว)
    public function index(Request $request)
    {
        $q = Article::query()->published()->with('author')->latest('published_at');

        if ($search = $request->string('q')->toString()) {
            $q->where(function ($qq) use ($search) {
                $qq->where('title', 'like', "%{$search}%")
                   ->orWhere('excerpt', 'like', "%{$search}%")
                   ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $articles = $q->paginate(12)->withQueryString();

        return view('articles.index', compact('articles'));
    }

    // GET /articles/{article:slug}
    public function show(Article $article)
    {
        abort_unless($article->is_published && $article->published_at?->lte(now()), 404);

        return view('articles.show', compact('article'));
    }
}
