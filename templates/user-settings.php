<?php
// Login form
//echo wp_login_form($args);
?>


<div class="container personal-area">
  <div class="row">
    
    <div class="col-md-2">
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user-menu.php' ); ?>
    </div>
    
    <div class="col-md-10">
        
      <h4>My settings</h4>

      <?php echo do_shortcode('[cxc_change_pwd_form]'); ?>

    </div>

  </div>
</div>



<style>

    .entry-title {
        display: none!important;
    }

</style>