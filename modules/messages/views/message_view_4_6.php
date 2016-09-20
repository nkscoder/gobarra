<?php $this->load->view('header'); ?>
<div class="subnavbar hidden-xs">
<div class="subnavbar-inner">
  <div class="container">
    <ul class="mainnav">
	<li><a href="<?php echo base_url();?>travelplans/planschedul"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
	<li><a href="<?php echo base_url();?>timelinepost/timeline"><i class="icon_clock_alt"></i><span>Timeline</span> </a> </li>
	<li><a href="<?php echo base_url();?>admin_products/add"><i class="icon_folder-add_alt"></i><span>Add Product</span> </a></li>
	<li><a href="<?php echo base_url();?>admin_products"><i class="glyphicon glyphicon-list"></i><span>My Products</span></a></li>
	<li class="active"><a href="<?php echo base_url(); ?>messages/display_name"><i class="icon_mail_alt"></i><span> My Inbox</span> </a> </li>
	<li><a href="<?php echo base_url(); ?>enquiry/display_name"><i class="fa fa-flask "></i><span>My Enquiry</span> </a> </li>
	<li ><a href="<?php echo base_url();?>user/profile"><i class="fa fa-user"></i><span>My Profile</span> </a> </li>
	<li><a href="<?php echo base_url();?>user/ChangePassword"><i class="fa fa-unlock"></i><span>Change Password</span> </a> </li>		
	</ul>
   </div>
</div>
</div>
	<!-- Page Content -->
	<div class="page-content ">
        <div class="container">
            <div class="row">
                <!-- full Content -->              			
				<div class="col-md-12 ">
				 <div class="col-lg-12 topdashboardForm">
				 <h3>My Inbox</h3>
				 <div id="no-more-tables col-lg-12">
				<!--mail inbox start-->
				<div class="mobile-nav hidden-md hidden-sm hidden-lg">
				<div class="menu-btn" id="menu-btn pull-left">					
				<div></div>
				<span></span>
				<span></span>
				<span></span> 
				</div>
		<span class="pull-left nameheading">Member Name List</span>
		<span class="clearfix"> </span>							
		<div class="responsive-menu">
		<?php if(is_array($res) && !empty($res)) { 
		foreach($res as $val) {
		if($val['profile_image'] !='') {
			$userImage =base_url()."uploaded_files/profile_img/".$val['profile_image'];									
		} else {
			$userImage =base_url()."uploaded_files/def_user/index.jpg";
		}
			$this->load->model('user/Users_model');
			$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
			$logUserId =$User_Arr[0]['user_id']; ?>
		<ul>
		<?php if($val['sender_id'] == $logUserId) { ?>
		<li>
		<div class="user-head">				
		<?php $query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $val[reciever_id]"); 
			$qury_result= $query->result_array();
		foreach($qury_result as $keyVal => $Myvalue ){ 
		if($Myvalue['profile_image'] !='') {
			$MyImage =base_url()."uploaded_files/profile_img/".$Myvalue['profile_image'];									
		} else {
			$MyImage =base_url()."uploaded_files/def_user/index.jpg";
		} ?>
		<a href="javascript:void(0);" class="inbox-avatar" onclick="return messageById('<?php echo $val['reciever_id']; ?>','<?php echo $val['sender_id']; ?>')">
		<img src="<?php echo $MyImage ;?>" alt="" width="40px" height="40px"></a>
		<div class="user-name ">
		<h5><a href="javascript:void(0);" onclick="return messageById('<?php echo $val['reciever_id']; ?>','<?php echo $val['sender_id']; ?>')"><?php echo $Myvalue['first_name'].'&nbsp;'.$Myvalue['last_name']; ?></a></h5>                           
		</div> 
		<?php } ?>
	  </div> 						 
	  </li>
	  <?php } else { ?>			
	   <li>							  
		<div class="user-head">
		<a href="javascript:void(0);" class="inbox-avatar" onclick="return messageById('<?php echo $val['sender_id']; ?>','<?php echo $val['reciever_id']; ?>')">
		<img src="<?php echo $userImage ;?>" alt="" width="40px" height="40px"></a>
		<div class="user-name active">
		<h5><a href="javascript:void(0);" onclick="return messageById('<?php echo $val['sender_id']; ?>','<?php echo $val['reciever_id']; ?>')"><?php echo $val['first_name'].'&nbsp;'.$val['last_name']; ?></a></h5>                              
		</div> 		  
		</div>  
		</li>
	</ul>
		<?php }} } else { 
		echo "Member List Empty";
		} ?>	
	</div>
	</div>					
    <div class="mail-box ">
	<aside class="sm-side col-lg-4 hidden-xs"> 
	<?php if(is_array($res) && !empty($res)){
		foreach($res as $val) {
		if($val['profile_image'] !='') {
			$userImage =base_url()."uploaded_files/profile_img/".$val['profile_image'];									
		} else {
			$userImage =base_url()."uploaded_files/def_user/index.jpg";
		}
			$this->load->model('user/Users_model');
			$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
			$logUserId =$User_Arr[0]['user_id']; 
		if($val['sender_id'] == $logUserId) { ?>
	<div class="user-head">
	 <?php $query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $val[reciever_id]"); 
		$qury_result= $query->result_array();
		foreach($qury_result as $keyVal => $Myvalue ) {
		if($Myvalue['profile_image'] !='') {
			$MyImage =base_url()."uploaded_files/profile_img/".$Myvalue['profile_image'];									
		} else {
			$MyImage =base_url()."uploaded_files/def_user/index.jpg";
		} ?>
	<a href="javascript:void(0)" class="inbox-avatar" onclick="return messageById('<?php echo $val['reciever_id']; ?>','<?php echo $val['sender_id'] ; ?>')">
	<img src="<?php echo $MyImage; ?>" alt=""></a> 
	<div class="user-name">
	<h5><a href="javascript:void(0)" onclick="return messageById('<?php echo $val['reciever_id']; ?>','<?php echo $val['sender_id'] ; ?>')"><?php echo $Myvalue['first_name'].'&nbsp;'.$Myvalue['last_name'];?></a></h5>                            
	</div> 
	<?php } ?>
	</div> 
	<?php } else  { ?>				  
	<div class="user-head ">					   
	<a href="javascript:void(0)" class="inbox-avatar" onclick="return messageById('<?php echo $val['sender_id']; ?>','<?php echo $val['reciever_id'] ; ?>')">
	<img src="<?php echo $userImage; ?>" alt=""></a>
	<div class="user-name">
	<h5><a href="javascript:void(0)" onclick="return messageById('<?php echo $val['sender_id']; ?>','<?php echo $val['reciever_id'] ; ?>')"><?php echo $val['first_name'].'&nbsp;'.$val['last_name'];?></a></h5>	
	</div>	
	</div> 				  
	<?php } } }else{
		echo "Member List Empty "; } ?>
    </aside>
    <aside class="lg-side col-lg-6"> 
    <div class="inbox-body" id="messageBox">
				<!--loop-->
	<?php
	if(is_array($result) && !empty($result) ) {
		$receiverID = $this->uri->segment(3);
		$this->load->model('user/Users_model');
		$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
		$senderID =$User_Arr[0]['user_id']; ?>
	<div class="bg leftDetailsSecBottom ">
		<?php $query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $receiverID"); 
			$qury_result= $query->result_array();							
		foreach($qury_result as $keyVal => $Myvalue ) { ?> 
		<h3>Message To <a href="<?php echo base_url();?>home/timelinepost/<?php echo $Myvalue['user_id']; ?>"><strong class="mssg-name"> <?php echo $Myvalue['first_name']."&nbsp;".$Myvalue['last_name']; ?></strong></a></h3>
		<?php }?>
		<form id="replyMessage" enctype="multipart/form-data" name="imaguploading" role="form">
		<div class="form-group uploadIcon">
		<div class="media-body uploadAndText"> 	
		<textarea name="message" id="message" title="Write Your Message" placeholder="Write Your Message" class="form-control"></textarea>
		<img class="uploadSection" onclick="document.getElementById('image').click(); return false" src="<?php echo theme_url();?>img/camera.png"> 
		<input class="hidden" type="file" id="image" name="image" onchange="readURL(this);">
		<input name="sender_id" type="hidden" value="<?php echo $senderID ;?>" />
		<input name="reciever_id" type="hidden" value="<?php echo $receiverID ;?>"  />		
		</div>
		</div>
		<div class="preview">
		<div id="upload-file-container">
		<img id="blah" src="" alt="" style="height: auto !important; max-width: 200px; width:auto;"/>	
		<a id="remove" href="javascript:void(0)" onclick="removeImagePreview('')" >
		<span class="glyphicon glyphicon-remove" id="cross" aria-hidden="true" style="display:none"></span></a>
		<span class="add_pdt_img_nc"></span>
		<div class="clearfix"></div>
		</div>
		</div>
		<button onclick="return insertMessage()" class="btn btn-default" type="button">Send Reply</button>
		</form>
		</div>					 
		<form action="" method="post" id="messagedelete" >
	  <div class="mail-option">
	 <div class="chk-all">
	 <input type="checkbox" class="mail-checkbox mail-group-checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);">
	 <div class="btn-group">
	<a class="btn mini all" href="#" data-toggle="dropdown">&nbsp;&nbsp;All</a> 
	</div>
	</div>
	<div class="btn-group hidden-phone">
	<input type="hidden" name="sender_id" value="<?php echo $senderID ;?>">
	<input type="hidden" name="reciever_id" value="<?php echo $receiverID ;?>"  />
	<button type="button" class="pull-right btn btn-success10" onclick="return DeletetMessage()">Delete</button>								
	</div>  
	</div>
	<div class="actTimeArea" > 
	<?php
		foreach($result as $key=>$value){ 						
		if($value['profile_image'] !='') {
			$MyImage =base_url()."uploaded_files/profile_img/".$value['profile_image'];									
		} else {
			$MyImage =base_url()."uploaded_files/def_user/index.jpg";
	} ?> 
	<div class="act-time" id="messagemain<?php echo $value['sender_id'] ;?>"> 
	<div class="activity-body act-in">
	<span class="arrow"></span>
	<div class="text">
	<input type="checkbox" value="<?php echo $value['message_id']; ?>" name="arr_ids[]" class="checkbox1">
	<input type="hidden" name="userid<?php echo $value['message_id']; ?>" value="<?php echo $value['user_id'];?>">
	<p class="attribution">										   
	<img src="<?php echo $MyImage; ?>" alt="" width="30px" height="30px">
	<a href="<?php echo base_url();?>home/timelinepost/<?php echo $value['user_id']; ?>">
	<?php echo $value['first_name']." ".$value['last_name'];?></a>
	<em> 
	<?php $created_time = $value['msg_add_date'];		
		date_default_timezone_set('Asia/Calcutta'); //Change as per your default time
        $str = strtotime($created_time);
        $today = strtotime(date('Y-m-d H:i:s'));
        // It returns the time difference in Seconds...
        $time_differnce = $today-$str;
        // To Calculate the time difference in Years...
        $years = 60*60*24*365;
        // To Calculate the time difference in Months...
        $months = 60*60*24*30;
        // To Calculate the time difference in Days...
        $days = 60*60*24;
        // To Calculate the time difference in Hours...
        $hours = 60*60;
        // To Calculate the time difference in Minutes...
        $minutes = 60;
        if(intval($time_differnce/$years) > 1) {
            echo intval($time_differnce/$years)." years ago";
        }else if(intval($time_differnce/$years) > 0) {
            echo intval($time_differnce/$years)." year ago";
        }else if(intval($time_differnce/$months) > 1) {
            echo intval($time_differnce/$months)." months ago";
        }else if(intval(($time_differnce/$months)) > 0) {
            echo intval(($time_differnce/$months))." month ago";
        }else if(intval(($time_differnce/$days)) > 1) {
            echo intval(($time_differnce/$days))." days ago";
        }else if (intval(($time_differnce/$days)) > 0) {
            echo intval(($time_differnce/$days))." day ago";
        }else if (intval(($time_differnce/$hours)) > 1) {
            echo intval(($time_differnce/$hours))." hours ago";
        }else if (intval(($time_differnce/$hours)) > 0) {
            echo intval(($time_differnce/$hours))." hour ago";
        }else if (intval(($time_differnce/$minutes)) > 1) {
            echo intval(($time_differnce/$minutes))." minutes ago";
        }else if (intval(($time_differnce/$minutes)) > 0) {
            echo intval(($time_differnce/$minutes))." minute ago";
        }else if (intval(($time_differnce)) > 1) {
            echo intval(($time_differnce))." seconds ago";
        }else {
            echo "few seconds ago";
        }?>
		</em>
		</p>
	  <p><?php 
	  if($value['message_image'] =='') { ?>
	  <p><?php echo $value['message'];?> </p>
	  <?php } else{ ?></p>
		<?php  echo $value['message']; 
		$Image =base_url()."uploaded_files/message_image/".$value['message_image'];
		?>	
		<div class="preview">
		<span><p><a><img class="group2" href="<?php echo $Image; ?>" src="<?php echo $Image; ?>" width="40%"></a></p></span>
		</div>
	<?php } ?>										
	</div>
	</div>
	<div class="notify-arrow-email notify-arrow-blue-email left"></div>
	</div>	
	<?php } ?>					  
	</div>
	</form>
	<?php } else { ?>
	<div class="actTimeArea"> 
	 <div class="act-time hidden-xs">                                      
		<div class="activity-body act-in">
		<span class="arrow"></span>
		<div class="text">									  
		<p class="attribution"><a href="javascript:void(0)">Click Left To See Message </a></p>
		</div>
		</div>
	<!-- 	<div class="notify-arrow-email notify-arrow-blue-email left"></div> -->
	  </div>									
	</div>		 
	<?php } ?>
  <!--loop-->
	</div>
    </aside>			  
    </div>
    <!--mail inbox end-->			
	</div>
	</div>
	</div> 
	<!-- full Content-->
    </div>
	<!-- /.container -->
    </div>
	</div>
	<!-- Page Content -->
<?php $this->load->view('footer'); ?>
<script>
	$(document).ready(function(){
			$("group2").colorbox({rel:'group2', transition:"none", width:"75%", height:"75%"});		
		});		
		function messageById(senderID,receiverID) {
		var data = "senderID="+senderID+ "&receiverID="+receiverID;		
			$.ajax({
				url:"<?php echo site_url('messages/showMessages'); ?>",
				type:"POST",
				data:data,
				success:function(output){
							$('#messageBox').html(output);
						}
				});	
		}
		
		function insertMessage() {
			var str = $('#message').val();
			function trim(str) {
			return str.replace(/^\s+|\s+$/g,"");
			}
			if ((str =='')&& ($('#image').val()=='')) {
				$('#message').val('');
				alert ("please enter message or image");
				return false;
				} else {
			var data = new FormData($('#replyMessage')[0]);
			$.ajax({
				type: "POST",               
				processData: false, // important
				contentType: false, // important
				data: data,
				url: "<?php echo site_url('messages/insertMessages');?>",
				dataType : 'html',  
				success: function(output){
					$('#messageBox').html(output);							
				}
			}); 
			}
		}
		
		function readURL(input) {
			$('#cross').show();
            if (input.files && input.files[0]) {
				var reader = new FileReader();
					$('#blah').css("display", "block");
					reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
		
		function DeletetMessage(){
		var r = confirm("Are You Sure you want to Delete");
		if (r === false) {
				return false;
			}else{
		var data = new FormData($('#messagedelete')[0]);					
			$.ajax({
				type: "POST",
				processData: false, // important
				contentType: false, // important
				data: data,
				url: "<?php echo site_url('messages/deleteMessages');?>",
				dataType : 'html',  
				success: function(output){
						$('#messageBox').html(output);							
				}
			});	
		}		
	}	
	
		function removeImagePreview() {
			$('#blah').attr('src','');
			$('#blah').css("display", "none");	
			$('#cross').hide();
		}
		
		$(document).ready(function() { 
		$('#upload-file-container input').click(function() { 
		if($('#replyMessage img').val() != "") {
		} else{			
		$('#replyMessage a.hidden').removeClass('hidden')
		}
	  });
	});		
		</script>