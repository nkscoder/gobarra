<?php $this->load->view('includes/header'); ?>
  <div id="content">
  
  <div class="breadcrumb">
  
       <?php echo anchor('adminzone/dashbord','Home'); ?> &raquo; <?php echo $heading_title; ?> </a>   
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
    </div>
      
     <div class="content">   
     
     <?php if (isset($error)): ?>
            <?php echo $error; ?>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success') == TRUE): ?>
                <?php echo $this->session->flashdata('success'); ?>
            <?php endif; ?>      
   <?php //echo form_open_multipart("adminzone/candidate_file/uploads_candidate",'id="data_form"');?>
     
    <table class="list" width="100%" id="my_data">
     
        <tbody>
          
          <tr>
            <td width="57%" style="text-align: center;"><br />
              <br />
              <span style="color:#F00">*</span> Import Excel File:
              <form method="post" action="<?php echo base_url() ?>adminzone/csv/importcsv" enctype="multipart/form-data">
                    <input type="file" name="userfile" ><br><br>
                    <input type="submit" name="submit" value="UPLOAD" >
                </form>
                </td>
          </tr>
        </tbody>
      
      </table>
  <?php echo form_close();?> 
   
  </div>
</div>
<?php $this->load->view('includes/footer'); ?>