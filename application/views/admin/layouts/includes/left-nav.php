<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <!-- <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span> -->
                            </div>
                            
                        </li> 
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="dashboard") {echo "active";} ?>" href="<?php echo base_url() ?>admin/dashboard/index"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="store") {echo "active";} ?>" href="<?php echo base_url() ?>admin/store/index"><i class="fa fa-bank fa-fw"></i> Stores</a>
                           
                        </li>
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="products") {echo "active";} ?>" href="<?php echo base_url() ?>admin/products/index"><i class="fa fa-product-hunt fa-fw"></i> Products</a>
                        </li>
                         <li>
                            <a class="<?php if($this->uri->segment(2)=="category") {echo "active";} ?>" href="<?php echo base_url() ?>admin/category/index"><i class="fa fa-table fa-fw"></i> Categories</a>
                        </li>
                         <li>
                            <a class="<?php if($this->uri->segment(2)=="orders") {echo "active";} ?>" href="<?php echo base_url() ?>admin/orders/index"><i class="fa fa-cart-plus fa-fw"></i> Orders</a>
                        </li>
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="customer") {echo "active";} ?>" href="<?php echo base_url() ?>admin/customer/index"><i class="fa fa-users fa-fw"></i> Customer</a>
                        </li>
                        <li>
                           
                            <a href="<?php echo base_url() ?>admin/slide/index"><i class="fa fa-file-image-o fa-fw"></i>Slider Image</a>
                      
                        </li>
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="profile") {echo "active";} ?>" href="<?php echo base_url() ?>admin/profile/index"><i class="fa fa-user fa-fw"></i> Manage My Profile</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
