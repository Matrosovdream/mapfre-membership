<div class="container personal-area">
  <div class="row">
    
    <div class="col-md-2">
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user-menu.php' ); ?>
    </div>
    
    <div class="col-md-10">
      
      <h4>My transactions</h4>
      
      <table class="cart" id="user-payments">
            <thead>
                <tr>
                    <th scope="col">Subscription</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach( $list as $user ) { ?>
                <tr>
                    <th scope="row"><?php echo $user['plan_id']; ?></th>
                    <td><?php echo $user['amount']; ?>$</td>
                    <td><?php echo $user['status']; ?></td>
                    <td><?php echo date( 'd/m/Y', strtotime($user['created_at']) ) ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>

        <div class="mb-3">
          <div class="row">
              <div class="col text-left">
                  <p></p>
              </div>
              <div class="col text-end">
              <?php
              echo paginate_links( array(
                'base' => add_query_arg( 'pg', '%#%' ),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => ceil($result['total_count'] / $result['posts_per_page']),
                'current' => $result['current_page']
              ));
              ?>
              </div>
          </div>
      </div>

    </div>

  </div>
</div>



<style>

    .entry-title {
        display: none!important;
    }

</style>