@extends('dashboard::layouts.app')
@section('content')
    <!-- dataTable starts -->
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category Trash<small class="text-muted">List</small></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="">
                                <table class="table zero-configuration" id='categorytable'>
                                    <a href="{{ route('cd-admin.view_categories') }}" class="link btn btn-primary">Go to Categories
                                        </a>
                                    <thead>
                                        <tr>
                                            <th><i class=""></i> SN</th>
                                            <th><i class="fa fa-calendar"></i> Category Name</th>
                                            <th><i class="fa fa-info"></i> Image</th>
                                            <th><i class="fa fa-info"></i> Status</th>
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
                                                    <td>
                                                        @if ($category['status'] == 'active')
                                                            <select style="width:120px;" value="{{ $category['status'] }}"
                                                                data-id="{{ base64_encode($category['id']) }}"
                                                                class="status form-control btn-success change_status"
                                                                name="status">
                                                                <option value="active" class="btn-success" selected="true">
                                                                    Active</option>
                                                                <option value="inactive" class="btn-danger">Inactive
                                                                </option>
                                                            </select>
                                                        @else
                                                            <select style="width:120px;" value="{{ $category['status'] }}"
                                                                data-id="{{ base64_encode($category['id']) }}"
                                                                class="status form-control btn-danger change_status"
                                                                name="status">
                                                                <option value="active" class="btn-success">Active</option>
                                                                <option value="inactive" class="btn-danger" selected="true">
                                                                    Inactive</option>
                                                            </select>
                                                        @endif
                                                    </td>
                                                    <td class="row">
                                                        <form
                                                            action="{{ route('cd-admin.force_delete_category', [$category['slug']]) }}"
                                                            method="get">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-icon btn-danger waves-effect waves-light"
                                                                data-toggle="tooltip" data-placement="top" title="delete"
                                                                data-original-title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this item')">
                                                                <i class="feather icon-trash">Delete</i></button>
                                                        </form>

                                                        <form
                                                            action="{{ route('cd-admin.restore_category', [$category['slug']]) }}"
                                                            method="get">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-icon btn-success waves-effect waves-light"
                                                                data-toggle="tooltip" data-placement="top" title="delete"
                                                                data-original-title="Delete"
                                                                onclick="return confirm('Are you sure you want to restore this item')">
                                                                <i class="feather icon-trash">Restore</i></button>
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
                                            <th><i class="fa fa-info"></i> Status</th>
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

        <script>
            $(document).ready(function() {
                $("#categorytable").on('change', '.change_status', function(e) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var me = this;
                    $.ajax({
                        url: "/cd-admin/changestatus",
                        type: 'GET',
                        data: {
                            'id': id,
                        },
                        success: function(result) {
                            if (result.id == null) {
                                toastr.error('Failed to Update Status');
                            } else {
                                toastr.success('Status Updated successfully');
                                if (result.status == "inactive") {
                                    $(me).removeClass('btn-success').addClass("btn-danger");
                                } else {
                                    $(me).removeClass('btn-danger').addClass("btn-success");
                                }
                            }

                        },
                    });


                })
            })
        </script>

    </section>
    <!--/ Zero configuration table -->
    <!-- dataTable ends -->
@endsection
