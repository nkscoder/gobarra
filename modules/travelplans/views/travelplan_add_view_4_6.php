<?php $this->load->view('header');?>
<div class="subnavbar hidden-xs">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
      <li class="active"><a href="<?php echo base_url();?>travelplans/planschedul"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="<?php echo base_url();?>timelinepost/timeline"><i class="icon_clock_alt"></i><span>Timeline</span> </a> </li>
        <li><a href="<?php echo base_url();?>admin_products/add"><i class="icon_folder-add_alt"></i><span>Add Product</span> </a></li>
        <li><a href="<?php echo base_url();?>admin_products"><i class="glyphicon glyphicon-list"></i><span>My Products</span></a></li>
        <li><a href="<?php echo base_url(); ?>messages/display_name"><i class="icon_mail_alt"></i><span> My Inbox</span> </a> </li>
		<li><a href="<?php echo base_url(); ?>enquiry"><i class="fa fa-flask "></i><span>My Enquiry</span> </a> </li>
        <li><a href="<?php echo base_url();?>user/profile"><i class="fa fa-user"></i><span>My Profile</span> </a> </li>
		<li><a href="<?php echo base_url();?>user/ChangePassword"><i class="fa fa-unlock"></i><span>Change Password</span> </a> </li>    
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
 <!-- Page Content -->
    <div class="page-content ">
    <div class="container">
    <div class="row">			
     <!-- full Content -->
	<?php  if($this->session->flashdata('item')) {
		$message= $this->session->flashdata('item'); ?>
		<div class="<?php echo $message['class'];?>" id="addplan" role="alert">				
	<?php  echo $message['message'];?></div>
	<?php } ?>				
	<div class="col-md-12 ">
	<div class="col-lg-8 topdashboardForm">
	<div class="col-lg-12">  <h3>Add Your Travel Details</h3></div>
<?php echo form_open_multipart('travelplans/planschedul','id="form"'); ?>				 
		<div class="form-group col-lg-3 col-xs-6 something"><label class="size">Leaving from</label> 
			<div class="fixArea ui-widget"> 
				  <input class="form-control" name="travel_from" id="travelFrom" autocomplete="off" type="text" placeholder="Select Origin" required> 
			</div>
		</div> 
	 
		<div class="form-group col-lg-3 col-xs-6 something"><label class="size">Going to</label>
			<div class="fixArea ui-widget"> 
				  <input class="form-control" name="travel_to" type="text" id="travelTo" autocomplete="off" placeholder="Select Destination" required> 
			</div>
		</div>
	  
		<div class="form-group col-lg-3 col-xs-6 something"><label class="size">Departure Date</label> 
			<div class="fixArea">
				<input type="text" name="from_date" class="form-control" placeholder="Select Date" id="datetimepicker1" >
			</div>
		 </div> 
	  
		<div class="form-group col-lg-3 col-xs-6 something"><label class="size">Return Date</label>
			<div class="fixArea">
				<input type="text" class="form-control " placeholder="Select Date" name="to_date" id="datetimepicker" >
			 </div>
		</div>	<div class="form-group col-lg-12 col-xs-12 something"><label class="size">Travel Description </label>
			<div class="fixArea">
				<textarea class="form-control myform" maxlength="1000" placeholder="Your Description" id="description1" name="description"></textarea>
			 </div>
			<div class="clearfix">
				<p class="prodnote" id="counter"></p>
			</div>
		</div>
		 <div class="form-group col-lg-12 col-xs-12 something">
		<div class="fixArea">
			<button title="Add Plan" name="submit" class="btn btn-md btn-primary" type="submit">Add Plan</button> 
		</div>
		</div> 	
<?php echo form_close(); ?>
						
								<!--Travel Paln Listing Start From Here-->
	<?php if( is_array($results) && !empty($results) ) {
			echo form_open("travelplans/planschedul",'id="data_form"'); ?>				
		<div class="mail-option travelplan selectbox-move">
		<div class="chk-all">
			<input type="checkbox" class="mail-checkbox mail-group-checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" title="Select All"> 
			<div class="btn-group">
			<a class="btn mini all" href="#" data-toggle="dropdown">&nbsp;&nbsp;All</a> 
		</div>
		</div>
		<div class="btn-group hidden-phone">
			<a class="btn mini blue" href="#" data-toggle="dropdown">More<i class="fa fa-angle-down "></i></a>
		<ul class="dropdown-menu">
			<li> <button class="ProductsButton" name="status_action" type="submit" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');" >Delete</button> </li>
			<li><button class="ProductsButton" name="status_action" type="submit"  value="Activate" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');" >Publish</button> </li>
			<li><button class="ProductsButton" name="status_action" type="submit" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');" >Un-Publish</button></li>
		</ul>
		</div> 
		</div>
		<div class="clearfix"></div>
	<div class="col-md-12 ">
	<div class="rowPOst mytimeline">
		<?php
			$name = $userData[0]['first_name']."&nbsp;".$userData[0]['last_name'] ;
		foreach($results as $catKey=>$pageVal) { ?>	
	<div class="partnerResult">			
		<?php if($userData[0]['profile_image'] !='') {
                  
                                $img=substr($userData[0]['profile_image'],0,5);

                               

                                if($img=='https'){
                                  
                                    $img=$userData[0]['profile_image'];
                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$userData[0]['profile_image'];
                                   
                                }

				/*$img =base_url()."uploaded_files/profile_img/".$userData[0]['profile_image'];*/
			} else{
				$img =base_url()."uploaded_files/def_user/index.jpg";
			} ?>
		<div class="partnerPhoto">
		<a href="<?php echo base_url();?>home/timelinepost/<?php echo $pageVal['user_id']; ?>"><img src="<?php echo $img ; ?>" width="75px" height="75px"></a>
		</div>
			
		<div class="partnerInfo">
		<div class="partnerName">						
		<a href="<?php echo base_url();?>home/timelinepost/<?php echo $pageVal['user_id']; ?>"><?php echo $name ; ?></a>
		Is Traveling From 
		<?php $from = $pageVal['travel_from']; echo $from; ?>To <?php echo $from = $pageVal['travel_to']; ?></div>
		<div class="partnerDate">
			<?php 	$originalDate = $pageVal['from_date'];
					$newDate = date("d F y", strtotime($originalDate)); 
					echo $newDate ; ?>			
		<div class="endDate"> To <?php 
			$originalDate = $pageVal['to_date'];
			$newDate = date("d F y", strtotime($originalDate));
			echo $newDate ; ?>	</div>
		</div>					
		<div class="partnerInterests">
		<span class="show-read-more"> <?php echo $pageVal['description'];?></span>
						   <!-- Trigger the modal with a button --> 						 
		</div>
		<div class="row">
		<div class="adjest1 pull-right col-xs-12" align="right">							
		<a href="<?php echo base_url();?>travelplans/editPlan/<?php echo $pageVal['travel_id']; ?>">
		<i class="fa fa-pencil-square-o" title="Edit"></i></a> |
		<?php echo ($pageVal['status']=='1')?'<i class="fa fa-eye" title="Publish"></i>':'<i class="fa fa-eye-slash" title="Un-Publish"></i>';?>|
		<input name="arr_ids[]" value="<?php echo $pageVal['travel_id'];?>" class="mail-checkbox mail-group-checkbox" title="Select" type="checkbox">
		</div>
		</div>
		</div>
		</div>
	<?php } ?>
	</div>								
	</div> 
	<?php form_close(); }
		else{ echo "<center><strong> No record(s) found !</strong></center>" ; } ?>
	</div><!-- end row 8-->
					
<div class="col-sm-4 mycol-md-4">
<div class="bg leftDetailsSec">
	<div class="right_coloumn_box">
	<div class="right-column-heading center-header-new">
		<h3 class="btn btn-md btn-primary" style="width: 292px; margin-left: -20px; margin-top: -28px;">Frequently Visited Destinations!</h3>
	</div>
	<div class="card__content">
	<h1 class="card__title">My favourite</h1>
	<div class="card__news">
	<marquee behavior="scroll" direction="down" scrolldelay="300" onmouseover="this.stop();" onmouseout="this.start();">
	  <?php $this->load->model('travelplans/travelplans_model');											  
	  if(!empty($plan)) {
	  foreach($plan as $travelplan) {
	  $travl_frm = $travelplan->travel_from;
	  $travl_to  = $travelplan->travel_to; 
	  ?>
		<div class="item mywidth">
			<a href="#">
				<div class="container-fluid rightpost myborder">
					<div class="travel-right-top">
						<div class="pull-left" style="width:100%">																												
						   <i class="fa fa-paper-plane colorred pull-left fa-2x"></i>
							<?php echo $travl_frm ;?>																													
							<i class="fa fa-arrow-right colorred ">&nbsp <?php echo $travl_to; ?> </i><br />
						   <span><?php echo $name; ?></span>
						</div>
						<div style="margin-left: 36px">On : <?php echo $travelplan->from_date; ?></div>                                                                
					</div>
				</div>
			</a>
		</div>
		<?php } } ?>											
	</marquee>
	</div>
</div>
</div>

<div class="right_coloumn_box">
	<div class="right-column-heading center-header-new">
		<h3 class="btn btn-md btn-primary" style="width: 250px; margin-left: 0px;">My Snapshot</h3>
	</div>
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<!--<li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
			<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>-->
			<li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
		<div class="item active">
		<a href="<?php echo base_url();?>home/timelinepost/<?php echo $userData[0]['user_id']; ?>">
		<div class="container-fluid rightpost ">
		<div class="travel-right-top">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<div class="member-profile">
		<img src="<?php echo $img ; ?>" />
		<h4><?php echo $name ; ?></h4>
		<em><?php echo $userData[0]['occupation'];?></em>
		<div class="social">
		<a href="#"><i class="fa fa-facebook"></i></a>
		<a href="#"><i class="fa fa-twitter"></i></a>
		<a href="#"><i class="fa fa-linkedin"></i></a>
		</div>
		<a href="<?php echo base_url();?>home/timelinepost/<?php echo $userData[0]['user_id']; ?>">Full Profile</a>
		</div>
		</div>
		</div>
		</div>
				</a>
			</div>
		</div>
		<!--timeline-->
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- full Content-->
            </div>
            <!-- /.container -->
        </div>
    </div>
        <!-- Page Content -->
<?php $this->load->view('footer');?>
<script>
  $(document).ready(function(){
	  var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("travelFrom","req","Please Enter Your Leaving From");
		 frmvalidator.addValidation("travelTo","req","Please Enter Your Going To");
		 frmvalidator.addValidation("datetimepicker1","req","Please Select Your Departure Date");
		 frmvalidator.addValidation("datetimepicker","req","Please Select Your Return Date");					 
		 frmvalidator.addValidation("description1","maxlen=1000");
					 
	setTimeout(function(){
	  $("#addplan").fadeOut("slow", function () {
	  $("#addplan").remove();
		  }); }, 5000);
	 });
	 
 $(document).ready(function () {
    $("#datetimepicker1").datepicker({
        dateFormat: "dd-M-yy",
        minDate: 0,
        onSelect: function (date) {
            var date2 = $('#datetimepicker1').datepicker('getDate');
            date2.setDate(date2.getDate());
           // $('#datetimepicker').datepicker('setDate', date2);
            //sets minDate to dt1 date + 1
            $('#datetimepicker').datepicker('option', 'minDate', date2);
        }
    });
	
    $('#datetimepicker').datepicker({
        dateFormat: "dd-M-yy",
        onClose: function () {
            var dt1 = $('#datetimepicker1').datepicker('getDate');
            var dt2 = $('#datetimepicker').datepicker('getDate');
            //check to prevent a user from entering a date below date of dt1
            if (dt2 <= dt1) {
                var minDate = $('#datetimepicker').datepicker('option', 'minDate');
                $('#datetimepicker').datepicker('setDate', minDate);
				}
			}
		});
	});
	/* google places for country */
	google.maps.event.addDomListener(window, 'load', function () {
		var places = new google.maps.places.Autocomplete(document.getElementById('travelFrom',{types: ['(cities)'],region:['(country)']}));
		google.maps.event.addListener(places, 'place_changed', function () {
			var place = places.getPlace();
			var address = place.formatted_address;              
		});
	});
/* google places for city */
	google.maps.event.addDomListener(window, 'load', function () {
		var places = new google.maps.places.Autocomplete(document.getElementById('travelTo',{types: ['(cities)'],region:['(country)']}));
		google.maps.event.addListener(places, 'place_changed', function () {
			var place = places.getPlace();
			var address = place.formatted_address;
		});
	});
    </script> 