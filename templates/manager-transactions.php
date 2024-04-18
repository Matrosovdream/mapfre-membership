<div class="container personal-area">
  <div class="row">
    
    <div class="col-md-2">
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/manager-menu.php' ); ?>
    </div>
    
    <div class="col-md-10">
        
      <h4>Transactions</h4>


      <div class="row">
        
        <!-- Left Block -->
        <div class="col-md-6 left-column">
              <ul class="list-inline">
                  <li class="list-inline-item">
                    <a href="<?php echo remove_query_arg( array("status", "pg") ); ?>">
                      Todos 
                      <?php /* ?>(<?php echo $result['total_count']; ?>)<?php */ ?>
                    </a>
                  </li>
                  <li class="list-inline-item">|</li>
                  <li class="list-inline-item">
                    <a href="<?php echo add_query_arg( array('status' => "success") ); ?>">
                      Succesful (<?php echo $success_count; ?>)
                    </a>
                  </li>
                  <li class="list-inline-item">|</li>
                  <li class="list-inline-item">
                    <a href="<?php echo add_query_arg( array('status' => "failed") ); ?>">
                      Failed (<?php echo $failed_count; ?>)
                    </a>
                  </li>
              </ul>
          </div>

          <!-- Right Block -->
          <div class="col-md-6">
              <form class="form-inline justify-content-end">

                  <div class="row">

                    <div class="col" align="right">
                      <input type="text" class="form-control mb-2 mr-sm-2" name="q" value="<?php echo $_GET['q']; ?>" placeholder="Search">
                    </div>

                    <!--
                    <div class="col">
                      <select class="form-control mb-2 mr-sm-2">
                          <option selected>Filter 1</option>
                      </select>
                    </div>
                    -->

                    <div class="col" align="left">
                      <button type="submit" class="btn btn-primary mb-2 mr-2">Find</button>
                    </div>

                    <div class="col">
                      <a 
                        href="<?php echo add_query_arg( array('action' => "export-transactions") ); ?>"
                        class="btn btn-secondary mb-2"
                        >
                        Export
                      </a>
                    </div>

                  </div>

              </form>
          </div>
      </div>


      <table class="cart" id="user-payments">
          <thead>
              <tr>
                  <th scope="col">Transaction ID</th>
                  <th scope="col">Payment method</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Plan ID</th>
                  <th scope="col">Status</th>
                  <th scope="col">Date</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach( $list as $user ) { ?>

              <?php
              $udata = get_userdata( $user['user_id'] );
              ?>

              <tr>
                  <td><?php echo $user['transaction_id']; ?></td>
                  <!--<td><?php echo $user['meta']['first_name']; ?> <?php echo $user['meta']['last_name']; ?></td>-->
                  <td><?php echo $user['payment_method']; ?></td>
                  <td><?php echo $user['amount']; ?>$</td>
                  <td><?php echo $user['plan_id']; ?></td>
                  <td><?php echo $user['status']; ?></td>
                  <td><?php echo date( 'd/m/Y', strtotime($user['created_at']) ) ?></td>
              </tr>
            <?php } ?>
          </tbody>
      </table>

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

      <!--
      <nav aria-label="Page navigation example ">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
      -->

    </div>

  </div>
</div>



<style>

    .entry-title {
        display: none!important;
    }

</style>