<div id="printableArea">
    <div  class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    		
    			<h2><?php echo $order->shopName; ?></h2><h3 class="pull-right">INVOICE</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Customer:</strong><br>
    					<?php echo $customer->firstname." ".$customer->lastname; ?><br>
    					Phone number:<?php echo $customer->phone; ?><br>
    					Address:<?php echo $customer->address; ?><br>
    					
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				Order date: <?php echo date("d/m/Y", strtotime($order->orderDate)) ?> </br>
    				Invoice#: <?php echo $order->orderID; ?>
    			</div>
    		</div>


    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<?php foreach($order_detail as $item): ?>
	    							<tr>
	    								<td><?php echo $item->productTitle ." "; ?><?php echo ($item->opt1)? "(". $item->opt1.")": ""; ?><?php echo ($item->opt2 AND $item->opt1)?"(".$item->opt1 ."/". $item->opt2.")":"" ?></td>
	    								<td class="text-center">$<?php echo $item->price; ?></td>
	    								<td class="text-center"><?php echo $item->qty; ?></td>
	    								<td class="text-right">$<?php echo $item->qty*$item->price; ?></td>
	    							</tr>
    							<?php endforeach; ?>

               
    							<?php 
    								$total = 0;
    								for($i=0; $i<count($order_detail); $i++){
    									$total = $total + $order_detail[$i]->price*$order_detail[$i]->qty ;

    								}
    							
    							 ?>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">$<?php echo $total; ?></td>
    							</tr> 


    						</tbody>
    					</table>
    				</div>

    			</div>
    		</div><!-- end panel -->
            

    	</div>
    </div>

</div>
</div>
<button class="btn btn-primary" onclick="printDiv('printableArea')">Print</button>