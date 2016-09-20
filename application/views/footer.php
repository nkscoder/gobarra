 <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline">
                     <li>
                        <a href="<?php echo base_url();?>pages/aboutgobarra">About</a>
                    </li>            
                    <li>
                        <a href="<?php echo base_url();?>pages/contact">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>pages/privacyandpolicy">Privacy & Policy  </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>pages/termsandconditions">Terms & Condition</a>
                    </li>      
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; gobarra.com 2015. All Rights Reserved</p>
                </div>
				<div class="col-lg-6 visible-lg visible-md">
				<div class="sicons">
                  <ul class="pull-right">
				<li><a href=""><i class="fa fa-facebook"></i></a></li>
				<!--<li><a href="http://twitter.com/"><i class="fa fa-twitter"></i></a></li>-->
				<li><a href=""><i class="fa fa-google-plus"></i></a></li>
				</ul>
				</div>
                </div>
            </div>
        </div>
    </footer>
	<!-- jQuery -->
    <script src="<?php echo theme_url();?>js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <!--<script src="<?php echo theme_url();?>js/bootstrap.js"></script>-->
	<script src="<?php echo theme_url();?>js/bootstrap.min.js"></script>
	    <!--  jQuery UI!  -->
	<script src="<?php echo theme_url();?>js/easy-responsive-tabs.js"></script>
    <script src="<?php echo theme_url();?>js/jquery-ui.js"></script>
	<script src="<?php echo theme_url();?>js/fileinput.js"></script>	
	<script type="text/javascript" src="<?php echo theme_url();?>js/bootstrap-filestyle.js"></script>
	<script src="<?php echo theme_url();?>js/chosen.jquery.js"></script>
	<script src="<?php echo theme_url();?>js/jquery.colorbox.js"></script>
	<script src="<?php echo theme_url();?>js/jquery.datetimepicker.js"></script>
	<script src="<?php echo theme_url();?>js/jquery.datetimepicker.min.js"></script>
	<script src="<?php echo theme_url();?>js/jquery.datetimepicker.full.min.js"></script>	
	<script type="text/javascript" language="JavaScript"  src="<?php echo theme_url(); ?>js/gen_validatorv4.js" xml:space="preserve"></script>
	<!--  Custom -->
    <script src="<?php echo theme_url();?>js/custom.js"></script>
	<script src="<?php echo theme_url();?>js/jquery.introLoader.pack.min.js"></script>
	<script src="<?php echo theme_url();?>js/helpers/jquery.easing.1.3.js"></script>
	<script src="<?php echo theme_url();?>js/helpers/spin.min.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
	<script>	
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements				
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', transition:"none", width:"75%", height:"75%"});				
				//Example of preserving a JavaScript event for inline calls.				
			});		
	
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
 $(document).ready(function () {

    $("#travel_from").datepicker({
        dateFormat: "dd-M-yy",
        //minDate: 0,
        onSelect: function (date) {
            var date2 = $('#travel_from').datepicker('getDate');
            date2.setDate(date2.getDate());
           // $('#datetimepicker').datepicker('setDate', date2);
            //sets minDate to dt1 date + 1
            $('#travel_to').datepicker('option', 'minDate', date2);
        }
    });
    $('#travel_to').datepicker({
        dateFormat: "dd-M-yy",
        onClose: function () {
            var dt1 = $('#travel_from').datepicker('getDate');
            var dt2 = $('#travel_to').datepicker('getDate');
            //check to prevent a user from entering a date below date of dt1
            if (dt2 <= dt1) {
                var minDate = $('#travel_to').datepicker('option', 'minDate');
                $('#travel_to').datepicker('setDate', minDate);
            }
        }
    });
});

var characters = 1000;
		$('#counter').append("You have <strong>"+characters+"</strong> characters remaining");
		$('#description1').keyup(function(){
			if($(this).val().length > characters){
			$(this).val($(this).val().substr(0, characters));
			}
		var remaining = characters -  $(this).val().length;
		$('#counter').html("You have <strong>"+remaining+"</strong> characters remaining");
		if(remaining <= 10)
		{
			$('#counter').css("color","red");
		}
		else
		{
			$('#counter').css("color","black");
		}
		}); 

		$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
		$("#success-alert").alert('close');
});		
$(document).ready(function() {
    $("#element").introLoader();
});
</script>
	</body>
</html>