@extends('dashboard::layouts.app')
@section('content')
    <!-- dataTable starts -->
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product <small class="text-muted">List</small></h4>
                        <a href="">
                            <button type="button" class="btn btn-lg btn-primary btn-block" style="border-radius:10px;" title="Upload CSV">
                                <span class="sr-only">Upload CSV</span><i class="fa fa-save"></i> Import
                            </button>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="">
                                <table class="table zero-configuration" id='productTable'>
                                    {{-- <a href="{{route('cd-admin.createproduct')}}" class="link">Create New</a> --}}
                                    <thead>
                                        <tr>
                                            <th><i class=""></i> SN</th>
                                            <th><i class="fa fa-calendar"></i> Product Name</th>
                                            <th><i class="fa fa-calendar"></i> Price</th>
                                            <th><i class="fa fa-info"></i>  Image</th>
                                            {{-- <th><i class="fa fa-info"></i>  Status</th> --}}
                                            <th><i class="fa fa-cog"></i> Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>

                                        @if(count($products) > 0)
                                        @foreach ($products as $product)
                                        <input type="hidden" name="id" id="id" value="{{$product['id']}}">
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $product['name'] }}</td>
                                                <td>{{ $product['price'] }}</td>
                                                @if($product['image_link']!=null)
                                                    <td><img src="{{ $product['image_link'] }}"
                                                        alt="productImage" style="border-radius: 50%;" width="50"
                                                        height="50"></td>
                                                @else
                                                <td><img src="{{ asset('uploads/images/product/' . $product['image']) }}"
                                                    alt="productImage" style="border-radius: 50%;" width="50"
                                                    height="50"></td>
                                                @endif
                                                <td class="row">
                                                    <a href="{{ route('cd-admin.showproduct', [$product['slug']]) }}"><button
                                                            type="button"
                                                            class="btn btn-icon btn-primary mr-1 waves-effect waves-light"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-original-title="View product"><i
                                                                class="feather icon-eye"></i></button></a>

                                                    <form action="{{ route('cd-admin.editproduct') }}"
                                                    method="get">
                                                    <input type="hidden" name="product" value="{{ $product["slug"] }}">
                                                    <button type="submit"
                                                        class="btn btn-icon btn-primary mr-1 waves-effect waves-light"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Edit">
                                                        <i class="feather icon-edit"></i></button>
                                                    </form>
                                                    
                                                    <form action="{{ route('cd-admin.deleteproduct', [$product['slug']]) }}"
                                                        method="get">
                                                        @csrf

                                                        <button type="submit"
                                                            class="btn btn-icon btn-danger waves-effect waves-light"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item')">
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

                                    </tbody> --}}
                                    <tfoot>
                                        <tr>
                                            <th><i class=""></i> SN</th>
                                            <th><i class="fa fa-calendar"></i> Product Name</th>
                                            <th><i class="fa fa-calendar"></i> Price</th>
                                            <th><i class="fa fa-info"></i>  Image</th>
                                            {{-- <th><i class="fa fa-info"></i>  Status</th> --}}
                                            <th><i class="fa fa-cog"></i> Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class='dataTables_paginate paging_simple_numbers'>
                    {{ $products->links() }}
                </div> --}}
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#producTable").on('change','.change_status',function(e){
                    e.preventDefault();
                    var id = $(this).data("id");
                    var me = this;
                    $.ajax({
                            url: "/cd-admin/product-changestatus",
                            type: 'GET',
                            data: {
                                'id': id,
                            },
                            success: function(result) {
                                if(result.id==null){
                                    toastr.error('Failed to Update Status');
                                }
                                else{
                                toastr.success('Status Updated successfully');
                                if(result.status =="0"){
                                    $(me).removeClass('btn-success').addClass("btn-danger");
                                }
                                else{
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
