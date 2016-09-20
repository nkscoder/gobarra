

   <link href="<?php echo theme_url();?>emoji/css/bootstrap.min.css" rel="stylesheet">
   <link href="<?php echo theme_url();?>emoji/css/cover.css" rel="stylesheet">

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

   <!-- Begin emoji-picker Stylesheets -->
   <link href="<?php echo theme_url();?>emoji/lib/css/nanoscroller.css" rel="stylesheet">
   <link href="<?php echo theme_url();?>emoji/lib/css/emoji.css" rel="stylesheet">

   <!-- End emoji-picker Stylesheets -->



   <!--....................................................................................-->
   <!--<div class="site-wrapper">

       <div class="site-wrapper-inner">
           <div class="cover-container">

               <div class="inner cover">
                   <p class="lead emoji-picker-container">
                       <input type="email" class="form-control" placeholder="Input field" data-emojiable="true">
                   </p>
               </div>

           </div>

       </div>
   </div>-->
   <!--............................................................................................-->

   <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

   <!-- Begin emoji-picker JavaScript -->
   <script src="<?php echo theme_url();?>emoji/lib/js/nanoscroller.min.js"></script>
   <script src="<?php echo theme_url();?>emoji/lib/js/tether.min.js"></script>
   <script src="<?php echo theme_url();?>emoji/lib/js/config.js"></script>
   <script src="<?php echo theme_url();?>emoji/lib/js/util.js"></script>
   <script src="<?php echo theme_url();?>emoji/lib/js/jquery.emojiarea.js"></script>
   <script src="<?php echo theme_url();?>emoji/lib/js/emoji-picker.js"></script>
   <!-- End emoji-picker JavaScript -->

   <script>
       $(function() {
           // Initializes and creates emoji set from sprite sheet
           window.emojiPicker = new EmojiPicker({
               emojiable_selector: '[data-emojiable=true]',
               assetsPath: 'lib/img/',
               popupButtonClasses: 'fa fa-smile-o'
           });
           // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
           // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
           // It can be called as many times as necessary; previously converted input fields will not be converted again
           window.emojiPicker.discover();
       });
   </script>