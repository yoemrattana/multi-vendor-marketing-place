
var flag;
$(document).ready(function(){
	var url = $(location).attr('href');
    var segment = url.split('/');
    var page = segment[5];
    var id = segment[7];
	/*
	* Set notification message
	*/
	if(flag=="0"){
		//alert(message);
		Lobibox.notify('error', {
   			 msg: message
		});
	}

	if(flag=="1"){
		//alert(message);
		Lobibox.notify('info', {
   			 msg: message
		});
	}

	/*
	* Confirm delete image
	*/
	//$('a.remove-product-image').click(function(){
	$(document).on("click","a.remove-product-image", function(e){
		var $image_id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this user?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"vendor/image/delete/"+$image_id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});
	/*
	* Confirm delete product
	*/
	
	$(document).on("click","a.del-product", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this product?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"vendor/product/delete/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});

	/*
	* Confirm delete option
	*/
	
	$(document).on("click","a.del-option", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this data?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"vendor/option/delete/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});


	/*
	* Confirm delete order
	*/
	
	$(document).on("click","a.del", function(e){
		var $order_id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this order?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"vendor/order/delete/"+$order_id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});

	/*
	* Confirm delete option value
	*/
	
	$(document).on("click","a.del_ov", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this data?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		$(wrapper).on("click",".remove_old_field", function(e){ //user click on remove text
				        e.preventDefault(); $(this).parent('div').remove(); x--;
				    })
					$path = baseurl+"vendor/option_value/delete/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});

	/*
	* Confirm delete store
	*/
	
	$(document).on("click","a.del-store", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this store?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"admin/store/delete/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});

	/*
	* Confirm delete product **admin**
	*/
	
	$(document).on("click","a.del-pro", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this product?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"admin/products/delete/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});

	/*
	* Confirm delete cumstomer **admin**
	*/
	
	$(document).on("click","a.del-customer", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this customer?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"admin/customer/delete/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});

	/*
	* Confirm delete slide **admin**
	*/
	
	$(document).on("click","a.del-slide", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this slide image?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		//$this.load(function(){
                		//Do something when content is loaded
            		//});
					//var t = $(this).parent('div').attr('id');
					$path = baseurl+"admin/slide/delete/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});
	//confirm delete sub category
	$(document).on("click","a.del_sub_cat", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this data?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		$(wrapper).on("click",".remove_old_field", function(e){ //user click on remove text
				        e.preventDefault(); $(this).parent('div').remove(); x--;
				    })
					$path = baseurl+"admin/category/delete_sub_category/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});
	//confirm delete category
	$(document).on("click","a.del-category", function(e){
		var $id = $(this).attr('id');
		Lobibox.confirm({
    		msg: "Are you sure you want to delete this data?",
    		callback: function ($this, type, ev) {
       		 	if (type === 'yes'){
            		$(wrapper).on("click",".remove_old_field", function(e){ //user click on remove text
				        e.preventDefault(); $(this).parent('div').remove(); x--;
				    })
					$path = baseurl+"admin/category/delete_category/"+$id;
					window.location = $path;
					//alert($t);
       			}
    		}
		});
	});
	
	/*
	* bootstrap switch
	*/

	$("input.switch").bootstrapSwitch({
	    onText: 'On',
	    offText: 'Off',
	    size: 'mini',
	    state: false
	});

	
//$('#category').chosen();
	$(document).on('switchChange.bootstrapSwitch', 'input.switch', function (event, state) {
	    if(state===true){
	    	$("#color-picker").append(fields);
	    	//color_picker("#color");
	    	//$('#option-value-1').chosen();
	    	option(1);
	    	add_field(1);	
	    	option_value(1);
	    	
	    }else{
	    	$(".fields").remove();
	    }
	});
	/*
	* Option value 
	*/

/*	$(document).on('change', '.option_1', function(){
		alert('Hello');
	});
*/


	/*
	* bootstrap switch used in update product section
	*/
	$("input.switch-on").bootstrapSwitch({
	    onText: 'On',
	    offText: 'Off',
	    size: 'mini',
	    state: true
	});

	$(document).on('switchChange.bootstrapSwitch', 'input.switch-on', function (event, state) {
	    if(state===true){
	    	$(".fields:parent").removeClass('hide');
	    	//$("#color-picker").append(fields);
	    	//color_picker("#color");
	    	//add_field();	

	    }else{
	    	$(".fields:parent").addClass('hide');
	    }
	});

	/*
	* get color by product id
	*/

/*	var url = baseurl+"vendor/color/get_by_product_id/"+id;
	$.get(url, function(data){
		var html='';
		var i= 1;
		var x =[];
		$.each(data, function(key, val){
			//html += '<button class="btn btn-primary add_field">Add More Fields</button>';
			html += '<div><input type="text" class="color-picker" id="color_'+i+'" value="'+val['colorName']+'"><a href="#" id="del_'+val['colorID']+'" class="remove_field">×</a></div>';
			x[key] = i;
			i++;			
		});		
		$('.fields').append(html);
		var z=0;
		for(var y=0 ; y <= x.length; y++){
			color_picker("#color_"+x[y]);
			z=y; //the last number of y was assigned to z
		}
		add_field(y);	
	}, 'json');*/



	/*
	* delete color from database
	*/
/*	
	$(document).on("click","a.remove_field", function(e){ //user click on remove text
        //e.preventDefault(); 
        //$(this).parent('div').remove(); x--;
        //alert("hello");
        $id = $(this).attr('id').split('_');
        $id = $id[1];
        var url = baseurl+"vendor/color/delete"+$id;

      	Lobibox.confirm({
		    msg: "Are you sure you want to delete this user?",
		    callback: function ($this, type, ev) {
	           
		    }
		});
    });
*/

	//add_field();		
	//color_picker("#color_13");
	/*
	* Color picker
	*/

	/*var fields = '<div class="fields">'
				+ '<button class="btn btn-primary add_field">Add More Color</button>'
				+ '<div><input class="color-picker" id="color" name="colors[]" type="text"></div>'
				+ '</div>';*/

	var fields = '<div class="fields">'
				+ '<div class="field">'
				//+ '<a href="#" class="pull-right" data-toggle="modal" data-target="#option-modal">Add Option</a>'
				+ '<button class="btn btn-sm btn-primary add_field">Add another option </button>'
				+'<p>Option name <span class="o-value">Option values</span></p> '
				+ '<div><select class="option_1" id="" name="colors[]" ></select> <span id="value-1"></span> </div> '
				+ '</div>'
				+ '</div>';


	//$('.option-value').chosen(); 

//modal edit status of order in vendor
$('#status-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  //modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('input[name="order_id"]').val(recipient)
});

//modal edit status of order in vendor
$('#status-product-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  //modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('input[name="product_id"]').val(recipient)
});

//modal edit status of store in admin
$('#status-store-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  //modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('input[name="user_id"]').val(recipient)
});

//modal edit status of customer in admin
$('#status-user-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  //modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('input[name="user_id"]').val(recipient)
});
//modal edit status of slide in admin
$('#status-slide-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  //modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('input[name="slide_id"]').val(recipient)
});

//modal edit status of category in admin
$('#status-category-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  //modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('input[name="category_id"]').val(recipient)
});



});//document

function getLatLng(lat, lng){
	var url = baseurl+'vendor/setting/update'
	$.post(url, 
		{'lat':lat, 'lng':lng}
	)
	.done(function(data){
		Lobibox.notify('info', {
   			 msg: "Your map has been updated successful!"
		});
	});
}
var centreGot = false;

function add_field(x){
	var max_fields      = 2; //maximum input field allowed
    var fields          = $(".fields"); //Fields
    var add_button      = $(".add_field"); //Add button

    //var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault(); //undo event
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(fields).append('<div><select class="option_'+x+'" id="" name="colors[]" type="text"></select> <span id="value-'+x+'"></span><a href="#" class="remove_field"><i class="fa fa-minus-circle" style="color:red;"></i></a></div>'); //add input box
            /*var color_id = $("#color_"+x);
            color_picker(color_id);*/
            option(x);
            option_value(x);

        }
    });
    
    $(fields).on("click","a.remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parent('div').remove(); x--;
    });
}

//Denamic field for add option

$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input class="option_field validate[required]" type="text" name="option_value[]"/><a href="#" class="remove_field"><i class="fa fa-minus-circle" style="color:red;"></i></a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

//Denamic field for add sub category
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_sub_category"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input class="option_field validate[required]" type="text" name="new_sub_category[]"/><a href="#" class="remove_field"><i class="fa fa-minus-circle" style="color:red;"></i></a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});


	/*
	* insert option and option value
	*/
	$(document).on('submit', '#form-option-type' , function(e){
	//$('#form-option-type').submit(function(e){
		e.preventDefault();

		$.ajax({
			url: baseurl+"vendor/option/add",
			type: "POST",
			dataType: "json",
			data: $(this).serialize(),
			success: function(data){
				if(data.result==1){
				
					$('#option-modal').modal('hide');
					notification('info', 'Option has been inserted successful!');
					
				}else{
					notification('error', 'Error!');
				}
				//console.log(data);
			}
			
		});
	});
	

/*function color_picker(id){
	$(id).ColorPickerSliders({
		size: 'sm',
	    placement: 'bottom',
	    swatches: true,
	    hsvpanel: true
	});
}*/

/*
* Product option
*/
function option(x){

	$.ajax({
		url: baseurl+'vendor/option/get_option_by_shop_id',
		type: 'get',
		dataType: 'json',
		success: function(data){
			var html = "";
			if(data==""){
				html += '<p>Your store does not have option.</p>';
				html += '<a href="#" data-toggle="modal" data-target="#option-modal">Add Option</a>';

				$('.fields').html(html);
				$('.field').addClass('hidden');


			}else{
				$('.field').removeClass('hidden');

				var option = $('.option_'+x);
				option.empty();
				option.append('<option value="">---Select Option---</option>');

				$.each(data, function(key, val){
					
					option.append('<option value="' + val['optionTypeID'] + '">' + val['optionTypeName'] + '</option>');
				});
			}
			
		}
	});
}


function option_value(x){
	var option_i = '.option_'+x;
	$(document).on('change', option_i, function(){
		
		var option_id = $('select'+option_i+' option:selected').attr('value');

		var url = baseurl+'vendor/option_value/get_by_option_id/'+option_id;
		$('#value-'+x).html('<select class="option-value"  id="option-value-'+x+'" name="option_value[]"></select>');
		$.get(url, function(data){
			var option_value = $('#option-value-'+x);
			option_value.empty();

			option_value.append('<option value="">---Select option value---</option>');
			
			$.each(data, function(key, val){
				option_value.append('<option value="' + val['optionValueID'] + '">' + val['optionValueName'] + '</option>');
			});

			//$('#option-value-'+x).chosen();
		}, 'json');



	});
}

$("#owl-product1").owlCarousel({
		autoPlay: false, //Set AutoPlay to 3 seconds
		items : 3,
		stopOnHover : true,
		navigation : true, // Show next and prev buttons
		pagination : false,
		navigationText : ["<span class='glyphicon glyphicon-chevron-left'></span>","<span class='glyphicon glyphicon-chevron-right'></span>"]
	});

/*<div><input id="color_'+x+'" class="color-picker form-control" type="text"/><a href="#" class="remove_field">×</a></div>*/

/*'<div class="input-group"><input id="color_'+x+'" type="text" class="form-control"><span class="input-group-btn"> <button class="btn btn-default" type="button">Go!</button></span></div>'*/

/*
* Print invoice
*/

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
