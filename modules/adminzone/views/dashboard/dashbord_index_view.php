<?php $this->load->view('includes/header'); ?>   
<div id="content">
    <div style="display: inline-block; width: 100%; margin-bottom: 15px; clear: both;">
     <div style="float: left; width: 75%;">
        <div style="background: #666464; color: #FFF; border-bottom: 1px solid #303030; padding: 5px; font-size: 14px; font-weight: bold;">Easy Navigation   </div>
        <div style="background:#f8f8f8; border: 1px solid #d9d9d9; padding: 8px; float:left">		 
	
         <?php $this->load->view('dashboard/admin_welcome_view'); ?>  
        </div>
      </div>
      <div style="float: right; width: 24%;">
        <div style="background: #666464; color: #FFF; border-bottom: 1px solid #303030;">
          <div style="width: 100%; display: inline-block;">
            <div style="float: left; font-size: 14px; font-weight: bold; padding: 7px 0px 0px 5px; line-height: 12px;">Statistics</div>
            <div style="float: right; font-size: 12px; padding: 2px 2px 0px 0px;"> </div>
          </div>
        </div>
        <div style="background:#f8f8f8; border: 1px solid #d9d9d9; padding: 10px; height: 49%;">
          <div id="report" style=" margin: auto;">
          
          <table width="100%" border="0" cellspacing="5" cellpadding="0">
          
             <tr>
                <td>Total Users : <?php echo $total_users; ?></td>
                <td><a href="<?php echo base_url();?>adminzone/users">View </a></td>
              </tr>           
              <!--<tr>
                <td>Total Adoption Remain : <?php //echo  $total_order; ?></td>
                <td><a href="<?php //echo base_url();?>adminzone/adopt_herds/">View </a></td>
              </tr>-->
              
        </table>

          <br /> 
           <br />
            <!--<a href="<?php //echo base_url();?>adminzone/orders/"></a>--><br /><br />
            <br /><br />
            <br /><br />
          </div>
        </div>
      </div>
            
    </div>
    <div>
     
  </div>
</div>

<?php $this->load->view('includes/footer'); ?>