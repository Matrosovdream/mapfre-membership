<?php
// Login form
echo wp_login_form($args);
?>


<div class="container personal-area">
  <div class="row">
    
    <div class="col-md-2">
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user-menu.php' ); ?>
    </div>
    
    <div class="col-md-10">
        
      <h4>My settings</h4>

      <form>
          <!-- Name field -->
          <div class="form-group">
              <label for="nameInput">Name</label>
              <input type of="text" class="form-control" id="nameInput" placeholder="Enter your name">
          </div>
          
          <!-- Password field -->
          <div class="form-group">
              <label for="passwordInput">Password</label>
              <input type="password" class="form-control" id="passwordInput" placeholder="Password">
          </div>

          <br/>
          
          <!-- Submit button -->
          <button type="submit" class="btn btn-primary">Save</button>
      </form>

    </div>

  </div>
</div>



<style>

    .entry-title {
        display: none!important;
    }

</style>