@extends('dashboard::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                <div class="card">
                    <div class="card-header bg-info">
                        <h6 class="text-white">Create Category</h6>
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route('cd-admin.store_category') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Category Name </label>
                                <input type="text" name="name" class="form-control" autocomplete="off"
                                    value="{{ old('name') }}" id="my-editor" required />
                                @error('name')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" autocomplete="off" required />
                                @error('image')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Multiple Images</label>
                                <input multiple type="file" name="multipleImages[]" class="form-control"
                                    autocomplete="off" value="{{ old('multipleImages') }}" />
                                @error('multipleImages')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-right">Tag:</label>
                                <div class="col-lg-8">
                                    
                                <select class="js-example-basic-multiple form-control"  name="tags[]" multiple="multiple">
                                    @foreach($tags as $tag)
                                    <option value="{{ $tag['id'] }}">{{ $tag['tag'] }}</option>
                                    @endforeach
                                </select>
                                    @error('tag')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">Feature Option</label>
                                <div class="col-9 col-form-label">
                                    <div class="col-lg-8">
                                        <div class="checkbox-list">
                                            <label class="checkbox">
                                                <input type="checkbox" id="checkbox_2" name="feature" value="1">
                                                <span></span>
                                                Feature
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>

<script>
    CKEDITOR.replace('my-editor', options);
</script>
