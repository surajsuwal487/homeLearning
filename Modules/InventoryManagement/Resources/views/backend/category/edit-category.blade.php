@extends('dashboard::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                <div class="card">
                    <div class="card-header bg-info">
                        <h6 class="text-white">Eidt Category</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($category->categoryImages as $item)
                                <div class="col-3">
                                    <div class="row">
                                        <form action="{{ route('cd-admin.category.image.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit">X</button>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <img src="{{ asset('uploads/images/categories/' . $item->image) }}"
                                            alt="{{ $item->image }}" height="200px" width="200px">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <form method="post" action="{{ route('cd-admin.update_category') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <div class="form-group">
                                <label>Category Name </label>
                                <input type="text" name="name" class="form-control" autocomplete="off"
                                    value="{{ $category->name }}" required />
                                @error('name')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" autocomplete="off" />
                                <img src="{{ asset('uploads/images/categories/' . $category->image) }}" width="150"
                                    height="150">
                                @error('image')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <div class="form-group">
                                    <label>Multiple Image</label>
                                    <input multiple type="file" name="multipleImages[]" class="form-control"
                                        autocomplete="off" value="{{ old('multipleImages') }}" />
                                    @error('multipleImages')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-right">Tag:</label>
                                <div class="col-lg-8">
                                    <select class="js-example-basic-multiple form-control"  name="tags[]" multiple="multiple">
                                        @foreach($tags as $tag)
                                        <option value="{{ $tag['id'] }}" @if (in_array($tag['id'],$selectedTags)) selected @endif>{{ $tag['tag'] }}</option>
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
                                                <input type="checkbox" id="checkbox_" name="feature" value="1"
                                                    {{ $category->feature == 1 ? 'checked' : '' }}>
                                                <span></span>
                                                Feature
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success">Update</button>
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
