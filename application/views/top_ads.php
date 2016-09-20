 <!-- Header --> 
    <div class="intro-header visible-lg visible-md">
        <div class="container ">
<?php $query=$this->db->query("SELECT * FROM tbl_top_list WHERE status='1'limit 1 ");
	if($query->num_rows()>0)
	{
		$res1=$query->result_array();
?>
            <div class="row">
                <div class="col-lg-12">				
                  <div class="bg topbanner">
				  <?php  foreach($res1 as $val)
					{
						$img1=substr($val['image'],0,5);



						if($img1=='https'){

							$img1=$val['image'];
						}else{
							$img1=base_url().'uploaded_files/profile_img/'.$val['image'];

						}
					/*$img1=base_url().'uploaded_files/top_list/'.$val['image'];*/
				?>
					<a href="<?php echo $val['url'];?>" class="responsive-img"><img src="<?php echo $img1;?>"></a> 					
				<?php } ?>
				</div>				
                </div>
            </div>
	<?php } ?>
        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->