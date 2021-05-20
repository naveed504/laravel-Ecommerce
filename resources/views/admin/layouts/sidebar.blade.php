<aside class="main-sidebar">
            <!-- sidebar -->
            <div class="sidebar">
                <!-- sidebar menu -->
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="index.html"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                  <span class="pull-right-container">
                  </span>
                  </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i><span>Prodcts</span>
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/addproduct-form') }}">Add Product</a></li>
                            <li><a href="{{ url('view-products')}} ">List Product</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-basket"></i><span>Categories</span>
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('addcategory-form') }}">Add Category</a></li>
                            <li><a href="{{ url('view-categories')}} ">List Category</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i><span>Pages</span>
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('banner') }}">Home Banner</a></li>
                            <li><a href="{{ url('showbanners')}}">List Banners</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i><span>Coupons</span>
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('add-coupon') }}">Add Coupon</a></li>
                            <li><a href="{{ url('view-coupon') }}">List Coupon</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="">
                            <i class="fa fa-shopping-bag"></i><span>Orders</span>
                            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                  </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('view-orders')}}">Orders</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar -->
        </aside>