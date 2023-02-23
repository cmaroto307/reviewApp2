@extends('layouts.app')

@section('modalContent')
    <div class="container">
        <div class="row">
            <div class="col-12 contact contact-us-two border-review-form">
                <form method="POST" action="{{ url('review') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="nombre">Name:</label>
                        <input id="nombre" name="nombre" type="text" class="input-md input-rounded form-control" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="tipo">Type:</label>
                        <select id="tipo" name="tipo" class="input-md input-rounded form-control" style="height: 40px;" required>
                            <option value="" selected disabled hidden>Select type</option>
                            @foreach($types as $index => $type)
                                <option value="{{ $index }}" <?php if(old('tipo') == $index) echo 'selected' ?>>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="review">Review:</label>
                        <textarea id="review" name="review" class="form-control" rows="4" required>{{ old('review') }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="thumbnail">Thumbnail:</label>
                        <input id="thumbnail" name="thumbnail" type="file" accept="image/jpeg image/png" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="images">Images:</label>
                        <input id="images" name="images[]" type="file" accept="image/jpeg image/png" multiple>
                    </div>
                    
                    <div class="form-group mt30 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="button button-md button-block button-grad-stellar bg-ff4530">Publish Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection