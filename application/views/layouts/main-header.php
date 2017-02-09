	<!-- Main Header Starts -->
		<div class="main-header">
			<div class="container">
				<div class="row">
				<!-- Search Starts -->
					<!-- <div class="col-md-3">
						<div id="search">
							<div class="input-group">

							  <input type="text" class="form-control input-lg" placeholder="Search">
							  <span class="input-group-btn">
								<button class="btn btn-lg" type="button">
									<i class="fa fa-search"></i>
								</button>
							  </span>
							</div>
						</div>	
					</div> -->

<!-- <div class="col-md-3">
<div id="search">
        <div class="form-group">
           
            <div class="input-group">

             <div class="input-group-btn bs-dropdown-to-select-group">
                    <button type="button" class="btn btn-default dropdown-toggle as-is bs-dropdown-to-select" data-toggle="dropdown"> <span class="" data-bind="bs-drp-sel-label">Select...</span>

                        <input class="" name="selected_value" data-bind="bs-drp-sel-value" value="" type="hidden"> <span class="caret"></span>
					<span class="sr-only">Toggle Dropdown</span>

                    </button>
                    <ul class="dropdown-menu" role="menu" style="">
                        <li data-value="1"><a class="" href="#">Store</a>
                        </li>
                        <li data-value="2"><a class="" href="#">Two</a>
                        </li>
                        <li data-value="3"><a class="" href="#">Three</a>
                        </li>
                    </ul>
  
                </div>

                <input value="" class="form-control input-lg" name="text" type="text">
               
  
    </div>   
  </div>
      </div>
     </div> -->

    <div class="col-md-3">
<!--     <div id="search"> -->
	<form method="post" action="<?php echo base_url() ?>home/search">
        <div class="input-group my-group"> 
        <div id="k1">
        	<select id="lunch" name="type" class="selectpicker form-control search-type input-lg" data-live-search="true" title="Please select a lunch ...">
                        <option value="product">Product</option>
                        <option value="store">Store</option>
                       
            </select> 
        </div>  
        <div id="kk"> 
            <input type="text" class="form-control input-lg" name="keywords" placeholder="Search">
        </div>   
      
    </form>    
        </div>
        <!-- /input-group -->
        </div>
<!--     </div>
 -->

     


				<!-- Search Ends -->
				<!-- Logo Starts -->
					<div class="col-md-6">
						<div id="logo">
							<a href="<?php echo base_url() ?>"><img src="<?php echo base_url()?>assets/images/logo.png" title="Spice Shoppe" alt="Spice Shoppe" class="img-responsive" /></a>
						</div>
					</div>
					<input type="hidden" id="count_item" value="<?php echo count($this->cart->contents()) ?>">
				<!-- Logo Starts -->				
				<!-- Shopping Cart Starts -->
					<div class="col-md-3">
						<div id="cart" class="btn-group btn-block">
							<button type="button" data-toggle="dropdown" class="btn btn-block btn-lg dropdown-toggle">
								<i class="fa fa-shopping-cart"></i>
								<span class="hidden-md">Cart:</span> 
								<span id="cart-total"></span>

								<!-- <i class="fa fa-caret-down"></i> -->
							</button>
							<!-- <ul class="dropdown-menu pull-right">
								<li>
									<table class="table hcart">
										<tr>
											<td class="text-center">
												<a href="product.html">
													<img src="images/product-images/hcart-thumb1.jpg" alt="image" title="image" class="img-thumbnail img-responsive" />
												</a>
											</td>
											<td class="text-left">
												<a href="product-full.html">
													Seeds
												</a>
											</td>
											<td class="text-right">x 1</td>
											<td class="text-right">$120.68</td>
											<td class="text-center">
												<a href="#">
													<i class="fa fa-times"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class="text-center">
												<a href="product.html">
													<img src="images/product-images/hcart-thumb2.jpg" alt="image" title="image" class="img-thumbnail img-responsive" />
												</a>
											</td>
											<td class="text-left">
												<a href="product-full.html">
													Organic
												</a>
											</td>
											<td class="text-right">x 2</td>
											<td class="text-right">$240.00</td>
											<td class="text-center">
												<a href="#">
													<i class="fa fa-times"></i>
												</a>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-bordered total">
										<tbody>
											<tr>
												<td class="text-right"><strong>Sub-Total</strong></td>
												<td class="text-left">$1,101.00</td>
											</tr>
											<tr>
												<td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
												<td class="text-left">$4.00</td>
											</tr>
											<tr>
												<td class="text-right"><strong>VAT (17.5%)</strong></td>
												<td class="text-left">$192.68</td>
											</tr>
											<tr>
												<td class="text-right"><strong>Total</strong></td>
												<td class="text-left">$1,297.68</td>
											</tr>
										</tbody>
									</table>
									<p class="text-right btn-block1">
										<a href="cart.html">
											View Cart
										</a>
										<a href="#">
											Checkout
										</a>
									</p>
								</li>									
							</ul> -->
						</div>
					</div>
				<!-- Shopping Cart Ends -->
				</div>
			</div>
		</div>
	<!-- Main Header Ends -->

