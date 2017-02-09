var flag;
$(document).ready(function(){
	/*
	* Set notification message
	*/
	if(flag=="0"){
		//alert(message);
		msg(message, 'error');
	}

	if(flag=="1"){
		//alert(message);
		msg(message, 'info');
	}
	//msg('message', 'info');
});


/*
* Notification my own
*/

function msg(textmsg, type){
	var zBox = document.createElement("div");
	document.body.appendChild(zBox);
	$(zBox).attr('id','zmessage');
    //$(zBox).attr('class', 'message');
    $(zBox).addClass('message '+type);
		$(zBox).css({
			'position':'fixed',
			'top':'5em',
			'right': '5em',
	      	'text-align': 'center',
	     	'z-index': '100',
		});
    
    $('div#zmessage').html(textmsg);
    
	setTimeout(function(){ $(zBox).remove(); }, 3500);
	
}