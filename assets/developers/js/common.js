function validcheckstatus(name,action,text)
{
	var chObj	=	document.getElementsByName(name);
	var result	=	false;	
	for(var i=0;i<chObj.length;i++){
	
		if(chObj[i].checked){
		  result=true;
		  break;
		}
	}
 
	if(!result){
		 alert("Please select atleast one "+text+" to "+action+".");
		 return false;
	}else if(action=='delete'){
			 if(!confirm("Are you sure you want to delete this.")){
			   return false;
			 }else{
				return true;
			 }
	}else{
		return true;
	}
}



function increment(id)
{ 

var obj = document.getElementById(id);
var max_qty ;
max_qty = document.getElementById('aval_qty').value;

			var val=obj.value;	
			if( parseInt(val)< max_qty ) {
				
			   obj.value=(+val + 1);
			   
			}else{
				
				alert("Maximum available quantity  is "+max_qty+".You can not add  more then available Quantity.");
			 	
			}
			
		return false;
			
}
function decrement(id)
{ 
   var obj = document.getElementById(id);
	var val=obj.value
	if(val==1 || val <1)
		val=1;
	else
	  val=(val - 1);
		
	obj.value=val || 1;
	return false;
}


function show_dialogbox()
{
	$("#dialog_overlay").fadeIn(100);
	$("#dialog_box").fadeIn(100);
}
function hide_dialogbox()
{
	$("#dialog_overlay").fadeOut(100);
	$("#dialog_box").fadeOut(100);
}

function showloader(id)
{
	$("#"+id).after("<span id='"+id+"_loader'><img src='"+site_url+"/assets/developers/images/loader.gif'/></span>");
}


function hideloader(id)
{
	$("#"+id+"_loader").remove();
}
												
												
function load_more(base_uri,more_container,formid)
{	
  showloader(more_container);
  $("#more_loader_link"+more_container).remove();
   if(formid!='0')
   {
	   form_data=$('#'+formid).serialize();
   }
   else
   {
	   form_data=null;
   }
  $.post
	  (
		  base_uri,
		  form_data,
		  function(data)
		  { 
		  
		  
			 var dom = $(data);
			
			dom.filter('script').each(function(){
			$.globalEval(this.text || this.textContent || this.innerHTML || '');
			});
			
			var currdata = $( data ).find('#'+more_container).html(); $('#'+more_container).append(currdata);
			hideloader(more_container);
		  }
	  );
}


 



function join_newsletter()
{
	var form = $("#chk_newsletter");	
	showloader('newsletter_loder');
	$("#chk_newsletter").attr('disabled', true);		
	$.post(site_url+"pages/join_newsletter",
		  $(form).serialize(),		   
		   function(data){
			
			     $("#my_newsletter_msg").html(data);				
				 $(".btn").attr('disabled', false);				 
			     hideloader('newsletter_loder');
				 $('input').val('');					 
			   });
	
	return false;
	
}


$(document).ready(function() {
	
	
	
	$(':checkbox.ckblsp').click(function()
    {
	 
		$(':input','#ship_container').val('');
		
		if($(this).attr('checked'))
		{
			$('#ship_container').hide();
			
		}else{
			
			$('#ship_container').show();
				
		}	
	}); 
	
	
	
	
	
	var showChar = 50;
	var ellipsestext = "...";
	var moretext = "read more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreelipses red">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink red">'+moretext+'</a></span>';

			$(this).html(html);
		}

	});	
	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});


/*-------Support Form Enquiry Post Jquery Form ----*/
   function form_support_enq_jquery()
   {
	  
		$(".required").hide();
		
		var hasError 		= false;
		var regexLetter 	=  /\b[A-Za-z\s]+\b$/;
		var emailReg 		= /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var nameVal 		= $('#subscriber_name').val();
		var emailaddressVal = $('#subscriber_email').val();
		var vrfli_codeVal 	= $('#verification_code').val();

		if(nameVal == '') 
		{
			$('#subscriber_name').after('<span class="required">Please enter your name.</span>');
			hasError = true;
		}
		if((nameVal)!="")
		{
			if(!regexLetter.test(nameVal))
			{
				$('#subscriber_name').after('<span class="required">Please enter valid name.</span>');
				hasError = true;
			}
		}
		
		if(emailaddressVal == '') 
		{
			$('#subscriber_email').after('<span class="required">Please enter your email address.</span>');
			hasError = true;
		}
		else if(!emailReg.test(emailaddressVal))
		{
			$('#subscriber_email').after('<span class="required">Enter a valid email address</span>');
			hasError = true;
		}
		
		if(vrfli_codeVal == '') 
		{
			$('#verification_error').after('<span class="required">Please enter varification code.</span>');
			hasError = true;
		}
		
		if(hasError == true) { return false; }
		else
		{
			$("#enq_loader").show();
			$('#enq_loader').html('<img src="'+site_url+'assets/developers/images/loader.gif"/>');
		
        	sup_email = $('input[name="subscriber_email"]').val();
			sup_name = $('input[name="subscriber_name"]').val();
			sup_code = $('input[name="verification_code"]').val();
			sup_subscribe = $('input[name="subscribe_active"]').val();
			
			url= site_url+'pages/subscribe_newsletter';
			$.post(url,{email:sup_email,name:sup_name,varification_code:sup_code,subscribe:sup_subscribe},
		    function(data){
			     $("#support_form_error").html('<span class="required">'+data+'</span>');
				 $("#enq_loader").hide();
				 if(data=='Word verification code is invalid.')
				 {
					 $("#verification_code").val('');
					 $("#verification_code").focus();
					 document.getElementById('captchaimage').src=site_url+'captcha/normal';
				 }
				 else
				 {
					 document.getElementById('captchaimage').src=site_url+'captcha/normal';
					 $("#subscriber_name").val('');
					 $("#subscriber_email").val('');
					 $("#verification_code").val('');
				 }
			   });
		}
return false;
 }
/*------- End Support Form Enquiry Jquery Form ----*/ 


function Check_Bill_Ship(chk)
{
	if(chk.is_same.checked==true)
	{
		chk.shipping_name.value        = chk.billing_name.value;
		chk.shipping_phone.value       = chk.billing_phone.value;	
		chk.shipping_address.value 	   = chk.billing_address.value;
		chk.shipping_city.value    	   = chk.billing_city.value;
		chk.shipping_state.value   	   = chk.billing_state.value;	
		//chk.ship_email.value 	   = chk.bill_email.value;
			 
		//chk.ship_fax.value       = chk.bill_fax.value ;
		
		chk.shipping_country.value 	   = chk.billing_country.options[chk.billing_country.selectedIndex].value;
		chk.shipping_zipcode.value   = chk.billing_zipcode.value;	
	} 
	
	if(chk.is_same.checked==false)
	{
		chk.shipping_name.value= '';
		chk.shipping_phone.value= '';
		chk.shipping_address.value= '';
		chk.shipping_city.value='';	
		chk.shipping_state.value= '';
		//chk.ship_email.value='';
		
		//chk.ship_fax.value= '';
		
		chk.shipping_country.value=chk.shipping_country.options[0].value;
		chk.shipping_zipcode.value= '';		
	} 
	
}