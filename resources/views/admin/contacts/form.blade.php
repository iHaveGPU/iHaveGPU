@csrf
<div class="grid sm:grid-cols-2 gap-4">
  <div>
    <label class="block text-sm text-gray-600">Group</label>
    <select name="group" class="border rounded w-full px-3 py-2" required>
      @php $g = old('group', $contact->group ?? 'general'); @endphp
      @foreach(['general','social','sales','marketing'] as $opt)
        <option value="{{ $opt }}" @selected($g===$opt)>{{ $opt }}</option>
      @endforeach
    </select>
  </div>
  <div>
    <label class="block text-sm text-gray-600">Type</label>
    @php $t = old('type', $contact->type ?? 'text'); @endphp
    <select name="type" class="border rounded w-full px-3 py-2" required>
      @foreach(['text','email','phone','link','line'] as $opt)
        <option value="{{ $opt }}" @selected($t===$opt)>{{ $opt }}</option>
      @endforeach
    </select>
  </div>
  <div class="sm:col-span-2">
    <label class="block text-sm text-gray-600">Label</label>
    <input type="text" name="label" value="{{ old('label', $contact->label ?? '') }}" class="border rounded w-full px-3 py-2" required>
  </div>
  <div class="sm:col-span-2">
    <label class="block text-sm text-gray-600">Value</label>
    <input type="text" name="value" value="{{ old('value', $contact->value ?? '') }}" class="border rounded w-full px-3 py-2">
    <p class="text-xs text-gray-500 mt-1">ใส่อีเมล / เบอร์ / ไอดี / ลิงก์ ตามประเภท</p>
  </div>
  <div>
    <label class="block text-sm text-gray-600">Sort order</label>
    <input type="number" name="sort_order" value="{{ old('sort_order', $contact->sort_order ?? 0) }}" class="border rounded w-full px-3 py-2">
  </div>
  <div class="flex items-center gap-2 mt-6">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', ($contact->is_active ?? true)))>
    <span>Active</span>
  </div>
</div>

<div class="mt-6 flex gap-3">
  <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
  <a href="{{ route('manage.contacts.index') }}" class="px-4 py-2 border rounded">Cancel</a>
</div>
