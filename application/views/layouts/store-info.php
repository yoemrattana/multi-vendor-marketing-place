<!-- Sidebar Starts -->
			<div class="col-md-3">
			<!-- Categories Links Starts -->
				<h3 class="side-heading">Store Location</h3>
				<div class="list-group categories">
			
					<?php echo $map['js']; ?>

					<?php echo $map['html']; ?>
				</div> 
			<!-- Categories Links Ends -->

			<!-- Special Products Starts -->
				<h3 class="side-heading">Store Contact</h3>
				<ul class="side-products-list">
					<p><strong> Phone: </strong> <?php echo $user->phone ?></p>
					<p><strong> Email: </strong><?php echo $user->email ?></p>
					<p><strong> Address: </strong> <?php echo $user->address ?></p>
				</ul>
			<!-- Special Products Ends -->
	
			
			</div>
		<!-- Sidebar Ends -->		

		<!-- Primary Content Starts -->
			<div class="col-md-9">