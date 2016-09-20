<script>
jQuery(document).ready(function(){
        // binds form submission and fields to the validation engine
        jQuery("#formular").validationEngine('attach',{promptPosition : "centerRight", scroll: false});
});
</script>
<div class="container">
    <br>
    <br>
    <div class="col-lg-12 " style="max-width:400px;float:none;margin:11px auto;">
        <div class="tab-content bg" style="padding:10px;">
            <div class="tab-pane fade active in" id="home">
                <div class="row">
                    <div class="col-md-12" style="padding: 19px 29px 29px;">
                    <?php
      //flash messages
          if($this->session->flashdata('flash_message'))
          {
        if($this->session->flashdata('flash_message') == 'send_success')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Thanks!</strong> your password has been send to your email !!';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Sorry!</strong> Send message Error';
          echo '</div>';          
        }
      }
      ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>