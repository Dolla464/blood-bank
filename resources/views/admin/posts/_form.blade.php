<div class="row">
    <div class="col-sm-12  m-auto">
        <div class="form-group">
            <img src="{{ isset($post) && $post->photo ? asset('img/posts/' . $post->photo) : '' }}" alt="Photo"
                id="photoPreview" class="img-fluid rounded shadow-sm d-block mx-auto mb-3 w-50"
                style="{{ isset($post) && $post->photo ? 'max-height:300px;' : 'display:none !important;' }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter post title..."
                value="{{ old('title', $post->title ?? '') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" name="content" rows="3" placeholder="Enter the content ...">{{ old('content', $post->content ?? '') }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="photo">
            <label class="custom-file-label" for="customFile">Choose file</label>
            @error('photo')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-footer mt-2">
            <button type="submit" class="btn btn-primary save-btn">
                {{ isset($post) ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>
