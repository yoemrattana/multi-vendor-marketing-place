
<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>EzyBuy</title>
	
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Google Web Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Oswald:400,700,300" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400" rel="stylesheet" type="text/css">
	
	<!-- CSS Files -->
	<link href="<?php echo base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/custom-front.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/responsive.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet">

	<link href="<?php echo base_url() ?>assets/css/lobibox.min.css" rel="stylesheet">

	  <!--Form Validation  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/validationEngine.jquery.css" />
	
	<!-- ion sliderRange -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/rangeSlider/css/normalize.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/rangeSlider/css/ion.rangeSlider.css" />
	<link href="<?php echo base_url() ?>assets/rangeSlider/css/ion.rangeSlider.skinModern.css" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="js/ie8-responsive-file-warning.js"></script>
	<![endif]-->
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/fav-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/fav-114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/fav-72.png">
	<link rel="apple-touch-icon-precomposed" href="images/fav-57.png">
	<link rel="shortcut icon" href="images/fav.png">
	
</head>
<body>
<!-- Header Section Starts -->
	<header id="header-area">
	<!-- Header Top Starts -->
		<div class="header-top">
			<div class="container">
				<div class="row">
				<!-- Header Links Starts -->
					<div class="col-sm-8 col-xs-12">
						<div class="header-links">
							<ul class="nav navbar-nav pull-left">
								<li>
									<a href="<?php echo base_url() ?>home.html">
										<i class="fa fa-home hidden-lg hidden-md" title="Home"></i>
										<span class="hidden-sm hidden-xs">
											Home
										</span>
									</a>
								</li>
								<?php if($this->session->userdata('logged_in')):?>
								<li>
									<a href="<?php echo base_url() ?>wishlist/index.html">	
										<i class="fa fa-heart hidden-lg hidden-md" title="Wish List"></i>
										<span class="hidden-sm hidden-xs">
											Wish List
										</span>
									</a>
								</li>
								
								<li>
									<a href="<?php echo base_url() ?>my_account.html">
										<i class="fa fa-user hidden-lg hidden-md" title="My Account"></i>
										<span class="hidden-sm hidden-xs">
											My Account
										</span>
									</a>
								</li>
								<?php endif ?>
								<li>
									<a href="<?php echo base_url() ?>home/shopping_cart.html">
										<i class="fa fa-shopping-cart hidden-lg hidden-md" title="Shopping Cart"></i>
										<span class="hidden-sm hidden-xs">
											Shopping Cart
										</span>
									</a>
								</li>
								
								<?php if($this->session->userdata('logged_in')!=true): ?>
								<li>
									<a href="<?php echo base_url() ?>home/register.html">
										<i class="fa fa-unlock hidden-lg hidden-md" title="Register"></i>
										<span class="hidden-sm hidden-xs">
											Register
										</span>
									</a>
								</li>
								
								<li>
									<a href="<?php echo base_url() ?>home/login.html">
										<i class="fa fa-lock hidden-lg hidden-md" title="Login"></i>
										<span class="hidden-sm hidden-xs">
											Login
										</span>
									</a>
								</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				<!-- Header Links Ends -->
				<!-- Currency & Languages Starts -->
					<div class="col-sm-4 col-xs-12">
						<div class="pull-right">
						
						<?php if($this->session->userdata('logged_in')) :?>
							<div class="btn-group">
								<button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
									<?php echo $this->session->userdata('email'); ?>
									<i class="fa fa-caret-down"></i>
								</button>
								<ul class="pull-right dropdown-menu">
									<li>
										<a tabindex="-1" href="<?php echo base_url() ?>auth/logout/3"><span class="glyphicon glyphicon-log-out"></span> Log out</a>
									</li>
							
								</ul>
							</div>
						<?php endif ?>
						
						</div>
					</div>
				<!-- Currency & Languages Ends -->
				</div>
			</div>
		</div>
	<!-- Header Top Ends -->