@extends('dashboard::layouts.app')
@section('content')
    <!-- dataTable starts -->
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category <small class="text-muted">List</small></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="">
                                <table class="table zero-configuration" id='categorytable'>
                                    <a href="{{ route('cd-admin.create_category') }}" class="link">Create
                                        New</a>
                                    <thead>
                                        <tr>
                                            <th><i class=""></i> SN</th>
                                            <th><i class="fa fa-calendar"></i> Category Name</th>
                                            <th><i class="fa fa-info"></i> Image</th>
                                            <th><i class="fa fa-cog"></i> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $category['name'] }}</td>
                                                    <td><img src="{{ asset('uploads/images/categories/' . $category['image']) }}"
                                                            style="border-radius: 50%;" width="50" height="50">
                                                    </td>
                                                    <td class="row">
                                                        <form action="{{ route('cd-admin.edit_category') }}" method="get">
                                                            <input type="hidden" name="category"
                                                                value="{{ $category['slug'] }}">
                                                            <button type="submit"
                                                                class="btn btn-icon btn-primary mr-1 waves-effect waves-light"
                                                                data-toggle="tooltip" data-placement="top" title="edit"
                                                                data-original-title="Edit">
                                                                <i class="feather icon-edit"></i></button>
                                                        </form>

                                                        <form
                                                            action="{{ route('cd-admin.delete_category', [$category['slug']]) }}"
                                                            method="get">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-icon btn-danger waves-effect waves-light"
                                                                data-toggle="tooltip" data-placement="top" title="delete"
                                                                data-original-title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this item')">
                                                                <i class="feather icon-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>Empty</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><i class=""></i> SN</th>
                                            <th><i class="fa fa-calendar"></i> Category Name</th>
                                            <th><i class="fa fa-info"></i> Image</th>
                                            <th><i class="fa fa-cog"></i> Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </section>
    <!--/ Zero configuration table -->
    <!-- dataTable ends -->
@endsection
