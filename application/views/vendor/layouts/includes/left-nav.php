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
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="dashboard") {echo "active";} ?>" href="<?php echo base_url() ?>vendor/dashboard/index"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="product") {echo "active";} ?>" href="<?php echo base_url() ?>vendor/product/index"><i class="fa fa-table fa-fw"></i> My Products <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>vendor/product/index">Product List</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>vendor/option/index">Product option</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="order") {echo "active";} ?>" href="<?php echo base_url() ?>vendor/order/index"><i class="fa fa-table fa-fw"></i> Orders</a>
                        </li>
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="setting") {echo "active";} ?>" href="<?php echo base_url() ?>vendor/setting/index"><i class="fa fa-cog fa-fw"></i> Settings</a>
                        </li>
                        <li>
                            <a class="<?php if($this->uri->segment(2)=="profile") {echo "active";} ?>" href="<?php echo base_url() ?>vendor/profile/index"><i class="fa fa-user fa-fw"></i> Manage My Profile</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
