
$(document).ready(function(){

	var url = $(location).attr('href');
    var segment = url.split('/');
    var page = segment[5];

    var page_front = segment[4];
    var argument = segment[5];
    var argument2 = segment[6];
	var total_item = total_item_by_sub_category(argument);
    console.log(page_front);

    if(page_front=='home.html' ||page_front=='product' || page_front==''){
    	$('#price-range').addClass('hide');
    }

   /*
	* front view
   */
   if(page_front=='categorys'){
   		get_product_by_sub_category(argument, 0, 0, 0);
   		pagination(argument, 0 , 0, 6, total_item_by_sub_category(argument), get_product_by_sub_category);


	   	$.ajax({
	   		url: baseurl+'product/price_range/'+argument,
	   		type: 'GET',
	   		dataType: 'json',
	   		success: function(data){
	   			//console.log(data);
	   			$("#price_range").ionRangeSlider({
					type: "double",
				    min: data.min,
				    max: data.max,
				    grid: true
				});
	   		}

	   });

	   	var price_range = $("#price_range");

	   price_range.on("change", function () {
	    	var $this = $(this),
	        value = $this.prop("value").split(";");
	       
	       	get_product_by_sub_category(argument,value[0], value[1], 0);
	   		pagination(argument,value[0], value[1], 6, total_item_by_sub_category(argument), get_product_by_sub_category);

		});
   }

   if(page_front=='category'){
   		get_product_by_category(argument, 0, 0, 0);
		pagination(argument, 0, 0, 6, total_item_by_category(argument), get_product_by_category);
		$.ajax({
		   		url: baseurl+'product/price_range_category/'+argument,
		   		type: 'GET',
		   		dataType: 'json',
		   		success: function(data){
		   			//console.log(data);
		   			$("#price_range").ionRangeSlider({
						type: "double",
					    min: data.min,
					    max: data.max,
					    grid: true
					});
		   		}

		   });

		$("#price_range").on("change", function () {
		    	var $this = $(this),
		        value = $this.prop("value").split(";");
		       
		       	get_product_by_category(argument,value[0], value[1], 0);
		   		pagination(argument,value[0], value[1], 6, total_item_by_category(argument), get_product_by_category);

		});
   }
    
	

	/*
	* Change password
	*/
	$(document).on('submit', '#form-password', function (evt) {
		evt.preventDefault();
		show_spinner('form');
		$.post($(this).attr('action'), $(this).serialize(), function(data){
			if(data.result==1){
				$('#password-modal').modal('hide');
				notification('info', 'Password has been changed successful!');
			}else{
				notification('error', 'No')
			}
			hide_spinner('form');
		}, 'json');
	});

	/*
	* Get sub-category
	*/

	$(document).on('change', '#category', function(){
		var category_id = $('select#category option:selected').attr('value');
		var url = baseurl+'vendor/product/get_sub_category/'+category_id;
		$('.sub_c').removeClass('hidden');
		$.get(url, function(data){
			var sub_category = $('#sub_category');
			sub_category.empty();
			sub_category.append('<option value="">---Select Sub Category---</option>');

			$.each(data, function(key, val){
				sub_category.append('<option value="' + val['subCategoryID'] + '">' + val['subCategoryName'] + '</option>');
			});
		}, 'json');
		
	});

	/*
	* get data for product 
	*/
	if(page==='product'){
		$('#dataTables-product').dataTable({
            "columnDefs": [
                {"width": "10%", "targets": 1},
                
               {"width": "25%", "targets": 4},
                
            ],
            "order": [[ 0, "desc" ]]
        });
		loadDataTable();
	}
	if(page==='order'){
		$('#dataTables-order').dataTable({
            "columnDefs": [
                //{"width": "10%", "targets": 1},
                {"width": "25%", "targets": 4},
               
                
            ],
            "order": [[ 0, "desc" ]]
        });
		loadOrderDataTable();
	}

	if(page==='option'){
		loadOptionDataTable();
	}

	if(page==='store'){
		loadStoreDataTable();
	}
	if(page==='products'){
		$('#dataTables-products').dataTable({
            "columnDefs": [
                {"width": "10%", "targets": 1},
                {"width": "10%", "targets": 4},
               {"width": "25%", "targets": 5},
                
            ]
        });
		loadProductDataTable();
	}
	if(page==='customer'){
		$('#dataTables-customer').dataTable({
            "columnDefs": [
            {"width": "8%", "targets": 0},
                {"width": "20%", "targets": 1},
                {"width": "15%", "targets": 3},
                {"width": "10%", "targets": 4},
               {"width": "25%", "targets": 5},
                
            ]
        });
		loadCustomerDataTable();
	}
	if(page==='orders'){
		$('#dataTables-orders').dataTable({
            "columnDefs": [
            {"width": "8%", "targets": 0},
                {"width": "20%", "targets": 1},
                {"width": "15%", "targets": 3},
                {"width": "10%", "targets": 4},
               {"width": "25%", "targets": 5},
                
            ]
        });
		loadOrdersDataTable() ;
	}
	if(page==='slide'){
		$('#dataTables-slide').dataTable({
            "columnDefs": [
                {"width": "10%", "targets": 1},
                {"width": "25%", "targets": 4},
       
                
            ]
        });
		loadSlideDataTable();
	}
	if(page==='category'){
		loadCategoryDataTable();
	}



	


	/*
	* update product info
	*/
	$(document).on('submit', '#form-profile', function (evt) {
		evt.preventDefault();
		show_spinner('form');
		$.post($(this).attr('action'), $(this).serialize(), function(data){

			if(data.result==1){
				$('#profile-modal').modal('hide');

				notification('info', 'User Information has been changed successful!');

			}else{
				notification('error', 'No')
			}
			hide_spinner('form');
			location.reload();
		}, 'json');
	});


	/*
	* The following code is used in front veiw
	*/
	//get product variant ,used in product detail page
	if(page_front=='product'){
		var variant_id = $('#product-options').val();
		var option_value = $('#product-options option:selected').text();
		var url = baseurl+'vendor/variants/get_variant_by_variant_id/'+variant_id;
		$.get(url, function(data){
			$('span.price-new').html('$'+data['price']);
			$('input[name="price"]').val(data['price']);

			$('input[name="item_qty"]').val(data['qty']);

			//in stock or off stock
			if(data['qty']>0){
				$('.stock').addClass('label-success').removeClass('label-warning').html('in stcok');
				$('.btn-cart').removeClass('disabled');
			}else{
				$('.stock').addClass('label-warning').removeClass('label-success').html('out of stcok');
				$('.btn-cart').addClass('disabled');
			}
			
		}, 'json');

		var opt = $('#product-options option[value="'+variant_id+'"]').text();
		if(opt==" "){
			$("#variant-exist").addClass('hidden');
		}
		//add variant id into input field for using in cart section
		$('input[name="item_id"]').val(variant_id);
		//add option value into input field for using in cart section
		$('input[name="option_value"]').val(option_value);


		$(document).on('change', '#product-options', function(){
			var variant_id = $('select#product-options option:selected').attr('value');
			var option_value = $('#product-options option:selected').text();
		
			var url = baseurl+'vendor/variants/get_variant_by_variant_id/'+variant_id;
			//add variant id into input field for using in cart section
			$('input[name="item_id"]').val(variant_id);
			//add option value into input field for using in cart section
			$('input[name="option_value"]').val(option_value);

			$.get(url, function(data){
				$('span.price-new').html('$'+data['price']);
				//console.log();
				$('input[name="price"]').val(data['price']);

				$('input[name="item_qty"]').val(data['qty']);

				//in stock or off stock
				if(data['qty']>0){
					$('.stock').addClass('label-success').removeClass('label-warning').html('in stcok');
					$('.btn-cart').removeClass('disabled');
				}else{
					$('.stock').addClass('label-warning').removeClass('label-success').html('out of stcok');
					$('.btn-cart').addClass('disabled');
				}

			}, 'json');

			//to clear max item
			var maxVal= $('#item_qty').val();
			$('#input-quantity').removeClass('validate[required,custom[integer],max['+maxVal+'], min[1]]');
		});

		//compare qty instock and price input by customer
		
		
		$(document).on('keypress', '#input-quantity', function(){
			/*var item_qty = $('#item_qty').val();
			var qty_input = $('#input-quantity').val();
			console.log(item_qty);*/

			/*if(qty_input>item_qty){
				alert('No');
			}else{
				alert('yes');
			}*/
			
			var maxVal=1;
			var input_qty =1;

			maxVal= $('#item_qty').val();

			input_qty = $('#input-quantity');

			input_qty.addClass('validate[required,custom[integer],max['+maxVal+'], min[1]]');
			
			
			//input_qty.removeClass('validate[required,custom[integer],max['+maxVal+'], min[1]]');
		});

		//to clear max item
		$(document).on('click', '#input-quantity', function(){
			var maxVal= $('#item_qty').val();
			$('#input-quantity').removeClass('validate[required,custom[integer],max['+maxVal+'], min[1]]');
			//alert(maxVal);

		});

	}


	/*
	* shopping cart
	*/
	//add item to cart
	$('#form-cart').submit(function(e){
		e.preventDefault();
			//use this code to prevend from submit when it invalid
		  if(!$("#form-cart").validationEngine('validate')){
         	return false;
          }

		$.ajax({
			url: baseurl+"cart/add",
			type: "POST",
			dataType: "json",
			data: $(this).serialize(),
			success: function(data){
				console.log(data);
				if(data.result==1){
					//alert("ok");
					$('#cart-total').html(data.count_item + " item(s)");

					msg('Item has been added to cart', 'info');
				}else{
					alert("no");
				}
				//console.log(data);
			}
			
		});
	});

	//update cart

	$('#form-shopping-cart').submit(function(e){
		e.preventDefault();

		$.ajax({
			url: baseurl+"cart/update",
			type: "POST",
			dataType: "json",
			data: $(this).serialize(),
			success: function(data){
				if(data.result==1){
					//alert("ok");
					cal_sub_total();
					total();

					$('#cart-total').html(data.count_item + " item(s)");


					//msg('Item has been updated!', 'info');
					
				}else{
					alert("no");
				}
				//console.log(data);
			}
			
		});
	});

	//remove item from cart
	$('.item_remove').on('click', function(e){

		var id = $(this).attr('id').split('_');
		var id2 = $(this).attr('id');
		var id = id[1];
		
		$.ajax({
			url: baseurl+"cart/remove/"+id,
			type: "POST",
			dataType: "json",
			data: $(this).serialize(),
			success: function(data){

				if(data.result==1){
					cal_sub_total();
					total();
					$('#'+id2).closest('tr').addClass('hidden');
					

				$('#cart-total').html(data.count_item + " item(s)");


					msg('Item has been deleted from cart!', 'info');

					$path = baseurl+"home/shopping_cart.html";
					window.location = $path;
				}else{
					alert("no");
				}
				//console.log(data);
			},								
		});	
	});



	$('.btn-wishlist').on('click', function(){
		var $id = $(this).attr('id');

		$.ajax({
			url: baseurl+"wishlist/add/"+$id,
			type: "POST",
			dataType: "json",
			success: function(data){
				if(data.result==1){

					msg('Item has been added to wishlist', 'info');
				}else{
					msg('Please log in', 'error');
				}
				//console.log(data);
			},				
		});				
	});

	/*
	* Confirm delete item in wishlist
	*/
	
	$(document).on("click",".del-wishlist", function(e){
		var id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this item?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"wishlist/delete/"+id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});

	/*var test = $('#qty_1').attr('item');
	console.log(test);
*/
/*	var max= 5
	for(var i=1; i<3; i++ ){
		var variant_id = $('#qty_'+i).attr('item');
		var qty = $('#qty_'+i).val();
		
		check_qty(qty, variant_id, i);
		
	}*/
	$(document).on('click', '.btn-update', function(){
		$('.btn-order').removeClass('disabled');
		var $n = $('#count_item').val();
		for(var i=1; i<=$n; i++ ){
			var variant_id = $('#qty_'+i).attr('item');
			var qty = $('#qty_'+i).val();
			
			check_qty(qty, variant_id, i);
			
		}
	});
	
	//Calculate sub total
	cal_sub_total();
	total();

	var num_item = $('#count_item').val();
	$('#cart-total').html(num_item + " item(s)");

	var shop_name = $('input[name="shop_name"]').val();
	//console.log(shop_name);

});//end document
/************************************************************************************************/

//check qty in shopping cart page
function check_qty(qty, variant_id, i){
	$.ajax({
		url: baseurl+'cart/check_qty/'+qty+'/'+variant_id,
		type: 'get',
		dataType:'json',
		success: function(data){
			if(data==1){
				$('#qty_'+i).removeClass('has_error');
				//$('.btn-order').removeClass('disabled');
			}else{
				$('#qty_'+i).addClass('has_error');
				$('.btn-order').addClass('disabled');
				msg('Over quantity', 'error');
			}
		}
	});
}

/*
* Get product data
*/
function loadDataTable() {
    show_spinner('#dataTables-product');
    var oTable = $('#dataTables-product').dataTable();
    $.ajax({
        url: baseurl + 'vendor/product/get_by_user_id',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2'],
                    data[i]['3'],
                    data[i]['4']
              
                ]);
            }
            hide_spinner('#dataTables-product');
        }
        
    });
}

function loadOrderDataTable(){
	show_spinner('#dataTables-order');
    var oTable = $('#dataTables-order').dataTable();
    $.ajax({
        url: baseurl + 'vendor/order/get_all',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2'],
                    data[i]['3'],
                    data[i]['4'],
                    data[i]['5']
              
                ]);
            }
            hide_spinner('#dataTables-order');
        }
        
    });
}

function loadOptionDataTable(){
	show_spinner('#dataTables-option');
    var oTable = $('#dataTables-option').dataTable();
    $.ajax({
        url: baseurl + 'vendor/option/get_all_option',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2']
                ]);
            }
            hide_spinner('#dataTables-option');
        }
        
    });
}

function loadStoreDataTable(){
	show_spinner('#dataTables-store');
    var oTable = $('#dataTables-store').dataTable();
    $.ajax({
        url: baseurl + 'admin/store/get_all_store',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2'],
                    data[i]['3'],
                    data[i]['4']
                ]);
            }
            hide_spinner('#dataTables-store');
        }
        
    });
}

function loadProductDataTable() {
    show_spinner('#dataTables-products');
    var oTable = $('#dataTables-products').dataTable();
    $.ajax({
        url: baseurl + 'admin/products/get_all_product',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2'],
                    data[i]['3'],
                    data[i]['4'],
                    data[i]['5']
              
                ]);
            }
            hide_spinner('#dataTables-products');
        }
        
    });
}

function loadCustomerDataTable() {
    show_spinner('#dataTables-customer');
    var oTable = $('#dataTables-customer').dataTable();
    $.ajax({
        url: baseurl + 'admin/customer/get_all_customer',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2'],
                    data[i]['3'],
                    data[i]['4'],
                    data[i]['5'],
                    //data[i]['6']
              
                ]);
            }
            hide_spinner('#dataTables-customer');
        }
        
    });
}
//load order in admin
function loadOrdersDataTable() {
    show_spinner('#dataTables-orders');
    var oTable = $('#dataTables-orders').dataTable();
    $.ajax({
        url: baseurl + 'admin/orders/get_all_order',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2'],
                    data[i]['3'],
                    data[i]['4'],
                    data[i]['5'],
                    //data[i]['6']
              
                ]);
            }
            hide_spinner('#dataTables-orders');
        }
        
    });
}
//load slide in admin
function loadSlideDataTable() {
    show_spinner('#dataTables-slide');
    var oTable = $('#dataTables-slide').dataTable();
    $.ajax({
        url: baseurl + 'admin/slide/get_all_slide',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2'],
                    data[i]['3'],
                    data[i]['4']
                   
              
                ]);
            }
            hide_spinner('#dataTables-slide');
        }
        
    });
}

//load category in admin
function loadCategoryDataTable() {
    show_spinner('#dataTables-category');
    var oTable = $('#dataTables-category').dataTable();
    $.ajax({
        url: baseurl + 'admin/category/get_all_category',
        type: 'get',
        dataType: 'json',
        success: function (data) {

            oTable.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                //oTable.fnAddData(item['id']);
                oTable.fnAddData([
                    data[i]['0'],
                    data[i]['1'],
                    data[i]['2'],
                    data[i]['3']
                ]);
            }
            hide_spinner('#dataTables-category');
        }
        
    });
}

function view_cart(){
	$.ajax({
		url: baseurl+"home/kk",
		type: "GET",
		dataType: "json",
		success: function(data){
			var cart = $('#cart_content');
			cart.html(data);
		}
	});
}

function cal_sub_total(){
	$i = 1;
	$n = $('#count_item').val();
	for($i; $i<=$n ; $i++){
		//console.log($i);
		var price = $('#qty_'+$i).val();
		var qty = $('#price_'+$i).val();
		var sub_total = price*qty;
		var sub_total_v = $('#sub_total_'+$i);
		$('input[name="sub_total_'+$i+'"]').val(sub_total);
		sub_total_v.html('$'+sub_total);
	}
}

function total(){
	$i = 1;
	$n = $('#count_item').val();
	var total = 0;
	for($i; $i<=$n ; $i++){
		var sub_total = parseFloat($('input[name="sub_total_'+$i+'"]').val());
		total = total + sub_total;	
	}
	var total_v = $('#total');
	total_v.html('$'+total);
}

function show_spinner(load_where){
    $(load_where).loader('show','<i class="fa fa-2x fa-spinner fa-pulse"></i>');
}

function hide_spinner(load_where){
	$(load_where).loader('hide');
}

function notification(type, message){
	Lobibox.notify(type, {
	    size: 'large',
		position: 'bottom left',
		msg: message
	});
}


function pagination(argument, from, to, item_per_page, total_items, func) {

    var pages = Math.ceil(total_items / item_per_page);

    $('#page-selection').bootpag({
        total: pages,
        page: 1,
        maxVisible: 5
    }).on("page", function (event, num) {
        //$("#content-discount").html( get_all_discounts(num)); // some ajax content loading...
        console.log(num);
        var position = (num - 1) * item_per_page;
        func(argument, from, to, position);

    });
}

function get_product_by_sub_category(argument, from, to, offset){
	//var count_product = 0;
	$.ajax({
		url: baseurl + 'product/get_product_by_sub_category_slug/'+argument+'/'+from+'/'+to+'/'+offset,
		type: "GET",
		dataType: "json",
		success: function(data){
			$('#test').html(data.product);
			//console.log(data.product);
			//console.log(data.count_product);
			//count_product = data.count_product;
		}
		
	});
}

function total_item_by_sub_category(argument){
	var count_product = 0;
	$.ajax({
		url: baseurl + 'product/get_product_by_sub_category_slug/'+argument+'/'+0+'/'+0+'/'+0,
		type: "GET",
		dataType: "json",
		async: false,
		success: function(data){
			count_product = data.count_product;
		}
		
	});
	return count_product;
}

function get_product_by_category(argument, from, to, offset){
	//var count_product = 0;
	$.ajax({
		url: baseurl + 'product/get_product_by_category_slug/'+argument+'/'+from+'/'+to+'/'+offset,
		type: "GET",
		dataType: "json",
		success: function(data){
			$('.product-content').html(data.product);
			//console.log(data.product);
			//console.log(data.count_product);
			//count_product = data.count_product;
		}
		
	});
}

function total_item_by_category(argument){
	var count_product = 0;
	$.ajax({
		url: baseurl + 'product/get_product_by_category_slug/'+argument+'/'+0+'/'+0+'/'+0,
		type: "GET",
		dataType: "json",
		async: false,
		success: function(data){
			count_product = data.count_product;
		}
		
	});
	return count_product;
}

/*$("#price_range").ionRangeSlider({
	type: "double",
    min: 1000000,
    max: 2000000,
    grid: true
});*/