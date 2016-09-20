<?php $this->load->view('header');?>
<div class="subnavbar hidden-xs">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
		<li><a href="<?php echo base_url();?>travelplans/planschedul"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="<?php echo base_url();?>timelinepost/timeline"><i class="icon_clock_alt"></i><span>Timeline</span> </a> </li>
        <li ><a href="<?php echo base_url();?>admin_products/add"><i class="icon_folder-add_alt"></i><span>Add Product</span> </a></li>
        <li class="active"><a href="<?php echo base_url();?>admin_products"><i class="glyphicon glyphicon-list"></i><span>My Products</span></a></li>
         <li><a href="<?php echo base_url(); ?>messages/display_name"><i class="icon_mail_alt"></i><span> My Inbox</span> </a> </li>
		<li><a href="<?php echo base_url(); ?>enquiry"><i class="fa fa-flask "></i> <span>My Enquiry</span> </a> </li>
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
               <!-- full Content -->
                
				 <?php echo form_open_multipart(current_url_query_string(),'id="form"');?> 
				 <div id="no-more-tables col-lg-12">
					<?php 
				 if($this->session->flashdata('item'))
				 {
					 $message= $this->session->flashdata('item');
					 ?>
					 <div class="success" id="editproduct" role="alert">				
				<?php 
				echo $message['message'];?></div>
					 <?php
				 }
				 ?>
				 <div class="col-lg-12 topdashboardForm">
								 <div class="col-lg-12">  <h3>Update Product</h3></div>
								
								<div class="form-group col-lg-4 col-sm-4 something">
                    <label class="size">Country Name</label>
                    <div class="fixArea">
                        <input data-placeholder="Inter a Country..." name="country_name" value="<?php echo set_value('country_id',$res['country_id']);?>" class="textfield2 ui-autocomplete-input form-control" id="country_id" >
                    </div>
                </div>

				<div class="form-group col-lg-4 col-sm-4 something">
                <label class="size">City Name</label>
                <div class="fixArea" >
				 <input type="text" name="city_name" id="city_id" class="form-control"  value="<?php echo set_value('city_id',$res['city_id']);?>">
                </div>
                </div>
				<div class="form-group col-lg-4 col-sm-4 something"><label class="size">Product Name</label> 
					<div class="fixArea">
						<input type="text" name="product_name" id="product_name" maxlength="255" value="<?php echo set_value('product_name',$res['product_name']);?>" class="textfield2 ui-autocomplete-input form-control">
					</div>
				 </div> 
				  
						<div class="form-group col-lg-12 col-xs-12 something"><label class="size">Description</label>
						<div class="fixArea">
							<textarea class="form-control" maxlength="1000" id="description" name="description" rows="6"><?php echo set_value('description',$res['description']);?></textarea>
						 <div class="clearfix"><strong>Max Char limit 1000</strong></div>
						 </div>
					</div>	
					<div class="form-group col-lg-12 col-xs-12">	
					<?php
					if($res['img1']!='')
					{
					 $target_path = base_url()."uploaded_files/product_image1/".$res['img1'];
					}
					else
					{
					  $target_path= base_url()."uploaded_files/def_user/dummy.png";
					}
					?>
					<?php
					if($res['img2']!='')
					{
					 $target_path1 = base_url()."uploaded_files/product_image2/".$res['img2'];
					}
					else
					{
					  $target_path1= base_url()."uploaded_files/def_user/dummy.png";
					}
					?> <div class="row"><div class="col-xs-6"> 
				<!-- 	<label class="control-label">Uploaded Image1</label><label class="control-label equal">Uploaded Image2</label></div></div><br> -->
					<!-- <div class="row"><div class="col-xs-6"> --><figure> <img src="<?php echo $target_path;?>" alt="" width="150px" height="150px"><figcaption class="control-label ">Uploaded Image1</figcaption></figure></div><!-- </div> -->								 
					<!-- <div class="col-xs-6"> --><div class="col-xs-6"> <figure> <img src="<?php echo $target_path1;?>" alt="" width="150px" height="150px"><figcaption class="control-label ">Uploaded Image2</figcaption></figure></div><!-- </div></div> -->
					</div>
					</div>
					<br>
					<div class="form-group col-lg-12 col-xs-12">
					
					   <label class="control-label">Upload Your Imges</label> 
						<input placeholder="image1" id="input-1" name="img1" type="file" class="file">
						<input placeholder="image2" id="input-2" name="img2" type="file" class="file">
				   </div>								
					 <div class="form-group col-lg-12 col-xs-12 something">
					<div class="fixArea">
						<button title="Click To Search" name="submit" class="btn btn-md btn-primary" type="submit">Update Products</button> 
					</div>
					</div> 								
		</div> 

                
                </div>
			 
				<?php echo form_close(); ?>
				
                <!-- full Content-->
 
            <!-- /.container -->

        </div>

</div>
        <!-- Page Content -->
<?php $this->load->view('footer');?>	
<script  type="text/javascript">
					 $(document).ready(function(){
					 setTimeout(function(){
					  $("#editproduct").fadeOut("slow", function () {
					  $("#editproduct").remove();
						  }); }, 2000);
						  
						   var frmvalidator = new Validator("form");
					 frmvalidator.addValidation("country","req","Please Select Your Country Name");
					 frmvalidator.addValidation("cities","dontselect=0","Please Select Your City Name");
					 frmvalidator.addValidation("product_name","req","Please Enter Your Product Name");
					 frmvalidator.addValidation("product_name","maxlen=120",
							"Max length for Product Name is 120");
					 });
					 </script>
					        <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('country_id'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;              
            });
        });
    </script>
      <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('city_id'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;              
            });
        });
    </script> 