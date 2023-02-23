@extends('layouts.app')

@section('modalContent')
    <div class="container">
        <div class="row">
            <div class="col-12 contact contact-us-two border-review-form">
                <form method="POST" action="{{ url('review/' . $review->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group col-md-12">
                        <label for="nombre">Name:</label>
                        <input id="nombre" name="nombre" type="text" class="input-md input-rounded form-control" value="{{ old('nombre', $review->nombre) }}" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="tipo">Type:</label>
                        <select id="tipo" name="tipo" class="input-md input-rounded form-control" style="height: 40px;" required>
                            @foreach($types as $index => $type)
                                <option value="{{ $index }}" <?php if($review->tipo == $index) echo 'selected' ?>>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="review">Review:</label>
                        <textarea id="review" name="review" class="form-control" rows="4" required>{{ old('review', $review->review) }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="thumbnail">Thumbnail:</label>
                        <input id="thumbnail" name="thumbnail" type="file" accept="image/jpeg image/png">
                        <div class="img-responsive center-block shop-item-img-list-view" 
                            style="margin: 10px; background-image: url('data:image/jpeg;base64,{{ $review->thumbnail }}');
                                   background-size:cover;"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="images">Images:</label>
                        <input id="images" name="images[]" type="file" accept="image/jpeg image/png" multiple>
                        @foreach($review->images as $image)
                            <div class="img-responsive center-block shop-item-img-list-view" 
                            style="margin: 10px; background-image: url('{{ asset('storage/images/' . $image->name) }}');
                                   background-size:cover;">
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="form-group mt30 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="button button-md button-block button-grad-stellar bg-ff4530">Publish Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection