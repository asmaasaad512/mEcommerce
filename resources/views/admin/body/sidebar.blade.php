<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Admin</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">

					<li>
					<a href="{{url('admin/dashobard') }}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Brand</div>
					</a>
					<ul>
						<li> <a href="{{url('all/brand') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
						</li>
						<li> <a href="{{url('add/brand') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand </a>
						</li>
						 
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Category</div>
					</a>
					<ul>
						<li> <a href="{{url('all/category') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
						</li>
						<li> <a href="{{ url('add/category') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
						</li>
						 
					</ul>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">SubCategory</div>
					</a>
					<ul>
						<li> <a href="{{ url('all/subcategory') }}"><i class="bx bx-right-arrow-alt"></i>All SubCategory</a>
						</li>
						<li> <a href="{{url('add/subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add SubCategory</a>
						</li>
						 
					</ul>
				</li>


				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Product Manage</div>
					</a>
					<ul>
						<li> <a href="{{url('all/product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
						</li>
						<li> <a href="{{url('add/product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
						</li>
						 
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Slider Manage</div>
					</a>
					<ul>
						<li> <a href="{{url('all/slider') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
						</li>
						<li> <a href="{{url('add/slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
						</li>
						 
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Banner Manage</div>
					</a>
					<ul>
						<li> <a href="{{url('all/banner') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
						</li>
						<li> <a href="{{url('add/banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
						</li>
						 
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Coupon System</div>
					</a>
					<ul>
						<li> <a href="{{url('all/coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
						</li>
						<li> <a href="{{url('add/coupon') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
						</li>
						 
					</ul>
				</li>
				
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Shipping Area </div>
					</a>
					<ul>
						<li> <a href="{{url('all/division') }}"><i class="bx bx-right-arrow-alt"></i>All Division</a>
						</li>
						<li> <a href="{{url('all/district') }}"><i class="bx bx-right-arrow-alt"></i>All District</a>
						</li>

						<li> <a href="{{url('all/state') }}"><i class="bx bx-right-arrow-alt"></i>All State</a>
						</li>
						 
					</ul>
				</li>
			
				<li class="menu-label">UI Elements</li>
			
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Vendor Manage </div>
					</a>
					<ul>
						<li> <a href="{{url('inactive/vendor') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
						</li>
						<li> <a href="{{url('active/vendor') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
						</li>
						 
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Order Manage </div>
					</a>
					<ul>
						<li> <a href="{{url('pending/order') }}"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
						</li>
						<li> <a href="{{ url('admin/confirmed/order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed Order</a>
						</li>
						<li> <a href="{{url('admin/processing/order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
						</li>
						<li> <a href="{{ url('admin/delivered/order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Order</a>
						</li>

					 
						 
					</ul>
				</li>



				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Return Order </div>
					</a>
					<ul>
						<li> <a href="{{url('return/request') }}"><i class="bx bx-right-arrow-alt"></i>Return Request</a>
						</li>
						<li> <a href="{{url('complete/return/request') }}"><i class="bx bx-right-arrow-alt"></i>Complete Request</a>
						</li> 
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Reports Manage</div>
					</a>
					<ul>
						<li> <a href="{{ url('report/view') }}"><i class="bx bx-right-arrow-alt"></i>Report View</a>
						</li>

							<li> <a href="{{ url('order/by/user') }}"><i class="bx bx-right-arrow-alt"></i>Order By User</a>
						</li>
						 
						 
					</ul>
				</li>



	<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">User Manage</div>
					</a>
					<ul>
						<li> <a href="{{ url('all-user') }}"><i class="bx bx-right-arrow-alt"></i>All User</a>
						</li>

							<li> <a href="{{ url('all-vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Vendor</a>
						</li>
						 
						 
					</ul>
				</li>



				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Blog Manage</div>
					</a>
					<ul>
						<li> <a href="{{ url('admin/blog/category') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Categroy</a>
						</li>

							<li> <a href="{{ url('admin/blog/post') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Post</a>
						</li>
						 
						 
					</ul>
				</li>


	<li>
		<a href="javascript:;" class="has-arrow">
			<div class="parent-icon"><i class="bx bx-category"></i>
			</div>
			<div class="menu-title">Review Manage</div>
		</a>
		<ul>
			<li> <a href="{{ url('pending/review') }}"><i class="bx bx-right-arrow-alt"></i>Pending Review</a>
			</li>

				<li> <a href="{{ url('publish/review') }}"><i class="bx bx-right-arrow-alt"></i>Publish Review</a>
			</li>
			 
			 
		</ul>
	</li>
 
				 
				<li>
		<a href="javascript:;" class="has-arrow">
			<div class="parent-icon"><i class="bx bx-category"></i>
			</div>
			<div class="menu-title">Setting Manage</div>
		</a>
		<ul>
			<li> <a href="{{ url('site/setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
			</li>

				<li> <a href="{{ url('seo/setting') }}"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
			</li>
			 
			 
		</ul>
	</li>
			 


	<li>
		<a href="javascript:;" class="has-arrow">
			<div class="parent-icon"><i class="bx bx-category"></i>
			</div>
			<div class="menu-title">Stock Manage</div>
		</a>
		<ul>
			<li> <a href="{{ url('product/stock') }}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
			</li>

				 
			 
			 
		</ul>
	</li>


				 
	<li class="menu-label">Charts & Maps</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-line-chart"></i>
						</div>
						<div class="menu-title">Charts</div>
					</a>
					<ul>
						<li> <a href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
						</li>
						<li> <a href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
						</li>
						<li> <a href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
						</li>
					</ul>
				</li>
				 
		 
			  
				<li>
					<a href=" " target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>