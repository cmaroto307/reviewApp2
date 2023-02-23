@extends('layouts.app')

@section('modalContent')
	<div class="blog-post-leave-comment">
        <h5><i class="fa fa-comment mt25 mb10"></i> Edit Comment</h5>
        <form method="POST" action="{{ url('comment/' . $comment->id) }}">
			@csrf
			@method('put')
            <textarea name="text" class="blog-leave-comment-textarea" required>{{ old('text', $comment->text) }}</textarea>
            <label for="stars">Stars:</label>
            <select name="stars" class="form-control" style="height: 40px;" required>
            	@foreach($stars as $index)
                    <option value="{{ $index }}" <?php if($comment->stars == $index) echo 'selected' ?>>{{ $index }}</option>
                @endforeach
            </select>
            <button class="button button-pasific button-sm center-block mt20 mb25">Post Comment</button>                            
        </form>
    </div>
@endsection