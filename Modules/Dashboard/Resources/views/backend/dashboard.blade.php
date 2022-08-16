@extends('dashboard::layouts.app')
@section('content')
<!-- // Order section start-->
<section id="dashboard-analytics">
	<div class="row">
		<div class="col-12">
			<div style="height: 500px;overflow: hidden">
				<img src="{{url('images/suraj1.jpg')}}" alt="" class="img-fluid" style="height: 100%; width:100%; object-fit:contain;">
			</div>
		</div>
	</div>
</section>
<!-- // Order section end-->



<!-- Statistics card section start -->
<section id="statistics-card">
	<div class="row">
		<div class="col-lg-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-header d-flex align-items-start pb-0">
					<div>
						<h2 class="text-bold-700 mb-0">{{ $cus_count }}</h2>
						<p>Customers</p>
					</div>
					<div class="avatar bg-rgba-primary p-50 m-0">
						<div class="avatar-content">
							<i class="feather icon-user text-primary font-medium-5"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-header d-flex align-items-start pb-0">
					<div>
						<h2 class="text-bold-700 mb-0">{{ $cate_count }}</h2>
						<p>Category</p>
					</div>
					<div class="avatar bg-rgba-warning p-50 m-0">
						<div class="avatar-content">
							<i class="feather icon-check-square text-warning font-medium-5"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

	{{-- <div class="row">
		<div class="col-lg-8 col-md-6 col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="mb-0"><i class="feather icon-square"></i> New Orders</h4>
				</div>
				<div class="card-content">
					<div class="table-responsive mt-1">
						<table class="table table-hover-animation mb-0">
							<thead>
								<tr>
									<th>Order No</th>
									<th>Date</th>
									<th>Order Status</th>
									<th>Total Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
								<tr>
									<td>#879985</td>
									<td>0000-00-00</td>
									<td>
										<div class="chip chip-warning">
											<div class="chip-body">
												<div class="chip-text">on hold</div>
											</div>
										</div>
									</td>
									<td class="product-price">Rs. 5500/-</td>
									<td class="product-action">
										<button type="button" class="btn btn-icon btn-primary mr-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="feather icon-eye"></i></button>
										<button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="feather icon-trash"></i></button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-6 col-12">
			<!-- Timeline Starts -->
			<section id="timeline-card">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title"><i class="feather icon-users"></i> New Users</h4>
					</div>
					<div class="card-content">
						<div class="card-body">
							<ul class="activity-timeline timeline-left list-unstyled">
								<li>
									<div class="timeline-icon bg-success">
										<i class="feather icon-user font-medium-2"></i>
									</div>
									<div class="timeline-info">
										<p class="font-weight-bold">John Doe</p>
										<span>johndoe@gmail.com</span>
									</div>
									<small class="">Registered Date: 0000-00-00</small>
								</li>
								<li>
									<div class="timeline-icon bg-success">
										<i class="feather icon-user font-medium-2"></i>
									</div>
									<div class="timeline-info">
										<p class="font-weight-bold">Melissa Doe</p>
										<span>melissadoe@gmail.com</span>
									</div>
									<small class="">Registered Date: 0000-00-00</small>
								</li>
								<li>
									<div class="timeline-icon bg-success">
										<i class="feather icon-user font-medium-2"></i>
									</div>
									<div class="timeline-info">
										<p class="font-weight-bold">John Doe</p>
										<span>johndoe@gmail.com</span>
									</div>
									<small class="">Registered Date: 0000-00-00</small>
								</li>
								<li>
									<div class="timeline-icon bg-success">
										<i class="feather icon-user font-medium-2"></i>
									</div>
									<div class="timeline-info">
										<p class="font-weight-bold">Melissa Doe</p>
										<span>melissandoe@gmail.com</span>
									</div>
									<small class="">Registered Date: 0000-00-00</small>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!-- Timeline Ends -->
		</div>
	</div> --}}
</section>
<!-- // Statistics Card section end-->



@endsection
