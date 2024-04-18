<div class="container personal-area">
  <div class="row">
    
    <div class="col-md-2">
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user-menu.php' ); ?>
    </div>
    
    <div class="col-md-10">
      
      <h4>
        My subscription 
        <?php if( $userdata['subscription_status'] == 'active' ) { ?>
          <span class="badge bg-success">Active</span> 
        <?php } else { ?>
          <span class="badge bg-fail">Active</span> 
        <?php } ?>
      </h4>

      <br/>

      <p class="text-left">Some text here</p>

      <div class="form-group">
        <a id="cancel-sub" class="btn btn-warning" href="<?php echo $cancel_url; ?>">Cancel</a>
      </div>

    </div>

  </div>
</div>



<style>

    .entry-title {
        display: none!important;
    }

</style>