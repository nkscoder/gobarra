function getState(id){
                        //alert(id.value);
                        var country_id = id.value;
                        $.ajax({
                            url:'<?php echo site_url('user/getState');?>',
                            type:'post',
                            data:{country_id : country_id},
                            success: function(data){
                               // alert(data);
                               $('#cities').html(data);
                           },
                           error:function(){
                            alert('Something Went Wrong');
                        }
                    });
                    }