<?php $this->load->view('header'); ?>
    <!-- Navigation -->  
<div class="subnavbar hidden-xs">
        <div class="clearfix"></div>
        <!-- /subnavbar-inner -->
    </div>       
	<div class="page-content ">
        <div class="container"> 
            <div class="row">
			 <!-- left Sidebar Content -->
               <?php //$this->load->view('left_ads'); ?>			
				<div class="col-sm-12 col-xs-12 col-md-12 content">                 
				<div class="cmsPagesArea ">		 
						<h2><?php echo $content['page_name'];?></h2>
						   
						<?php echo $content['page_description'];?> 		
						<div class="clearfix"></div> 
				</div>			 
            </div>
        </div>        
    </div>
 </div>
   <?php $this->load->view('footer'); ?>