<?php $this->load->view('includes/header'); ?>  

 <div id="content">
  
  <div class="breadcrumb">
  
  <?php echo anchor('adminzone/dashbord','Home'); ?>
 &raquo; <?php echo anchor('adminzone/candidate_file','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?>
 
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">&nbsp;</div>
      
    </div>
   
  
     <div class="content">
   
       
	    <?php echo validation_message();?>
        <?php echo error_message(); ?>
     
     
       <?php echo form_open_multipart(current_url_query_string());?>  

	<table width="90%"  class="tableList" align="center">
		<tr>
			<th colspan="2" align="center" > </th>
		</tr>
		<tr class="trOdd">
			<td width="253" height="26"> Candidate Name : <span class="required">*</span></td>
			<td width="597">
		<input type="text" name="candidate_name" size="40" value="<?php echo set_value('candidate_name',$res->candidate_name);?>"></td>
		</tr>
		<tr class="trOdd">
			<td width="253" height="26"> Candidate Email : <span class="required">*</span></td>
			<td width="597"><input type="text" name="email_id" size="40" value="<?php echo set_value('email_id',$res->email_id);?>"></td>
		</tr>
		<tr class="trOdd">
			<td width="100" height="26"> Contact No. : <span class="required">*</span></td>
			<td width="597"><input type="text" name="contact" size="40" value="<?php echo set_value('contact',$res->contact);?>"></td>
		</tr>
		<tr class="trOdd">
			<td width="100" height="26"> Gender : <span class="required">*</span></td>
			<td width="50"><input type="checkbox" name="gender" size="20" value="male">Male
			<input type="checkbox" name="gender" size="20" value="female">Female</td>
		</tr>
		<tr class="trOdd">
			<td width="253" height="26"> Designation : <span class="required">*</span></td>
			<td width="597"><input type="text" name="designation" size="40" value="<?php echo set_value('designation',$res->designation);?>"></td>
		</tr>
		<tr class="trOdd">
			<td width="253" height="26"> Candidate Experience : <span class="required">*</span></td>
			<td width="597"><input type="text" name="experience" size="40" value="<?php echo set_value('experience',$res->experience);?>"></td>
		</tr>
		<tr class="trOdd">
			<td width="253" height="26">Salary : <span class="required">*</span></td>
			<td width="597"><input type="text" name="salary" size="40" value="<?php echo set_value('salary',$res->salary);?>"></td>
		</tr>
		<!--<tr class="trOdd">
			<td width="253" height="26"> Current Educaton : <span class="required">*</span></td>
			<td width="597"><input type="text" name="current_education" size="40" value="<?php //echo set_value('current_education',$res->current_education);?>"></td>
		</tr>-->
		<tr class="trOdd">
			<td width="253" height="26"> City : <span class="required">*</span></td>
			<td width="597"><input type="text" name="city" size="40" value="<?php echo set_value('city',$res->city);?>"></td>
		</tr>
		<tr class="trOdd">
			<td width="253" height="26"> State : <span class="required">*</span></td>
			<td width="597"><input type="text" name="state" size="40" value="<?php echo set_value('state',$res->state);?>"></td>
		</tr>
		<tr class="trOdd">
			<td width="253" height="26"> Created Date : <span class="required">*</span></td>
			<td width="72%" align="left"><input name="created_date" class="start_date1" type="text" style="padding:2px; width:133px;" value="<?php echo set_value('created_date',$res->created_date);?>"><a href="#" class="created_date"><img src="<?php echo base_url();?>assets/developers/images/cal0.png" width="16" height="16" alt=""></a></td>
		</tr>
        <tr class="trOdd">
			<td width="253" height="26"> Modified Date : <span class="required">*</span></td>
			<td width="72%" align="left"><input name="modified_date" class="end_date1" type="text" style="padding:2px; width:133px;" value="<?php echo set_value('modified_date',$res->modified_date);?>"><a href="#" class="modified_date"><img src="<?php echo base_url();?>assets/developers/images/cal0.png" width="16" height="16" alt=""></a></td>
		</tr>
		<tr class="trOdd">
			<td align="left">&nbsp;</td>
			<td align="left"><input type="submit" name="sub" value="Update" class="button2" />
							 <input type="hidden" name="id" value="<?php echo $res->candidate_id;?>" />
							 <input type="hidden" name="action" value="add" /></td>
		</tr>
	</table>
<?php echo form_close(); ?>
  </div>
</div>
<?php 
$default_date = '2013-01-01';
$posted_start_date = $this->input->post('created_date');
?>
<script type="text/javascript">
  $(document).ready(function(){
	$('.btn_sbt2').live('click',function(e){
		e.preventDefault();
		$start_date = $('.start_date1:eq(0)').val();
		$end_date = $('.end_date1:eq(0)').val();
		$start_date = $start_date=='From' ? '' : $start_date;
		$end_date = $end_date=='To' ? '' : $end_date;
		$(':hidden[name="keyword2"]','#myform').val($('input[type="text"][name="keyword2"]').val());
		$(':hidden[name="created_date"]','#myform').val($start_date);
		$(':hidden[name="modified_date"]','#myform').val($end_date);
		$("#myform").submit();
	});
	$('.created_date,.modified_date').live('click',function(e){
	  e.preventDefault();
	  cls = $(this).hasClass('created_date') ? 'start_date1' : 'end_date1';
	  $('.'+cls+':eq(0)').focus();
	});
	$( ".start_date1").live('focus',function(){
			$(this).datepicker({
			showOn: "focus",
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			defaultDate: 'y',
			buttonText:'',
			minDate:'<?php echo $default_date;?>' ,
			maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
			yearRange: "c-100:c+100",
			buttonImageOnly: true,
			onSelect: function(dateText, inst) {
						  $('.start_date1').val(dateText);
						  $( ".end_date1").datepicker("option",{
							minDate:dateText ,
							maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
						});

					  }
		});
	});
	$( ".end_date1").live('focus',function(){
			$(this).datepicker({
					  showOn: "focus",
					  dateFormat: 'yy-mm-dd',
					  changeMonth: true,
					  changeYear: true,
					  defaultDate: 'y',
					  buttonText:'',
					  minDate:'<?php echo $posted_start_date!='' ? $posted_start_date :  $default_date;?>' ,
					  maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
					  yearRange: "c-100:c+100",
					  buttonImageOnly: true,
					  onSelect: function(dateText, inst) {
						$('.end_date1').val(dateText);
					  }
				  });
	  });
	  
  });
</script>
<?php $this->load->view('includes/footer'); ?>