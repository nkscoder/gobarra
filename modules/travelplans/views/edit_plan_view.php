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
				<?php echo form_open_multipart(current_url_query_string(),'id="form"');?> 
                <div class="col-md-12 ">
				 <div class="col-lg-12 topdashboardForm">				 
								 <div class="col-lg-12">  <h3>Update Your Travel Details</h3></div>
								<div class="form-group col-lg-3 col-xs-6 something"><label class="size">Leaving from</label> 
									<div class="fixArea ui-widget"> 
										  <input class="form-control" name="travel_from" id="travelFrom" autocomplete="off" value="<?php echo set_value('travel_from',$res['travel_from']);?>" type="text" placeholder="Select Origin"> 
									</div>
								</div> 						
								<div class="form-group col-lg-3 col-xs-6 something"><label class="size">Going to</label>
									<div class="fixArea ui-widget"> 
										  <input class="form-control" name="travel_to" type="text" id="travelTo" autocomplete="off" value="<?php echo set_value('travel_to',$res['travel_to']);?>" placeholder="Select Destination"> 
									</div>
								</div>								
								<div class="form-group col-lg-3 col-xs-6 something"><label class="size">Departure Date</label> 
									<div class="fixArea">
										<input type="text" name="to_date" class="form-control datetimepicker" value="<?php echo set_value('from_date',$res['from_date']);?>" placeholder="Select Date" id="datetimepicker1" >
									</div>
								 </div> 
							  
								<div class="form-group col-lg-3 col-xs-6 something"><label class="size">Return Date</label>
									<div class="fixArea">
										<input type="text" class="form-control datetimepicker" placeholder="Select Date" name="from_date" value="<?php echo set_value('to_date',$res['to_date']);?>" id="datetimepicker" >
									 </div>
								</div>	<div class="form-group col-lg-12 col-xs-12 something"><label class="size">Travel Description </label>
									<div class="fixArea">
										<textarea class="form-control myform" id="description1" name="description" maxlength="1000"><?php echo set_value('description',$res['description']);?></textarea>
									 </div>
								</div>
								 <div class="form-group col-lg-12 col-xs-12 something">
								<div class="fixArea">									
									<button title="Update Plan" name="submit" class="btn btn-md btn-primary" type="submit">Update Plan</button> 
								</div>
								</div> 								
								</div> 

                </div>
				<?php echo form_close(); ?>							
                <!-- full Content-->
            </div>
            <!-- /.container -->
        </div>
        <!-- Page Content -->
<?php $this->load->view('footer');?>
  <script>
  /* form validation */
	var frmvalidator = new Validator("form");					 
		frmvalidator.addValidation("description1","req","Please Enter Your Post");
		frmvalidator.addValidation("description1","maxlen=1000");
 /* google api searching */
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('travelFrom',{types: ['(cities)'],region:['(country)']}));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
            });
        });
	/* google api searching */
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('travelTo',{types: ['(cities)'],region:['(country)']}));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
            });
        });
    </script> 