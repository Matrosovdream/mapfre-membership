<div class="container personal-area">
  <div class="row">
    
    <div class="col-md-2">
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/manager-menu.php' ); ?>
    </div>
    
    <div class="col-md-10">
        
      <h4>Members</h4>


      <div class="row">
          <!-- Left Block -->
          <div class="col-md-6 left-column">
              <ul class="list-inline">
                  <li class="list-inline-item">
                    <a href="<?php echo remove_query_arg( array('membertype') ); ?>">
                      Todos
                    </a>
                  </li>
                  <li class="list-inline-item">|</li>
                  <li class="list-inline-item">
                    <a href="<?php echo add_query_arg( array('membertype' => "active") ); ?>">
                      Activada (<?php echo $active_count; ?>)
                    </a>
                  </li>
                  <li class="list-inline-item">|</li>
                  <li class="list-inline-item">
                    <a href="<?php echo add_query_arg( array('membertype' => "inactive") ); ?>">
                      Caducado (<?php echo $inactive_count; ?>)
                    </a>
                  </li>
              </ul>
          </div>

          <!-- Right Block -->
          <div class="col-md-6 right-column">
              <form class="form-inline justify-content-end">

                  <div class="row">

                    <div class="col" align="right">
                      <input type="text" class="form-control mb-2 mr-sm-2" name="search" value="<?php echo $_GET['search']; ?>" placeholder="Search">
                    </div>

                    <!--
                    <div class="col" align="right">
                      <select class="form-select mb-4 mr-sm-4">
                          <option selected>Filter 1</option>
                      </select>
                    </div>
                    -->

                    <div class="col" align="left">
                      <button type="submit" class="btn btn-primary mb-2 mr-2">Find</button>
                    </div>

                    <div class="col" align="right">
                      <a 
                        href="<?php echo add_query_arg( array('action' => "export-members") ); ?>"
                        class="btn btn-secondary mb-2"
                        >
                        Export
                      </a>
                      <!--<button type="button" class="btn btn-secondary mb-2">Export</button>-->
                    </div>

                  </div>

              </form>
          </div>
      </div>


      <table class="cart" id="user-payments">
          <thead>
              <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Email</th>
                  <!--<th scope="col">Date</th>-->
                  <th scope="col">Status</th>
                  <th scope="col">Number</th>
                  <th>Paid sum</th>
                  <th>Deuda Acumulada</th>
                  <th scope="col"></th>
              </tr>
          </thead>
          <tbody>
              <?php foreach( $members as $user ) { ?>

                <?php
                $udata = get_userdata( $user['ID'] );
                $registered = $udata->user_registered;  
                ?>

                <tr>
                    <td><?php echo $user['ID']; ?></td>
                    <td><?php echo $user['meta']['first_name']; ?> <?php echo $user['meta']['last_name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <!--<td><?php echo date( 'd/m/Y', strtotime($registered) ) ?></td>-->
                    <td> <?php echo get_user_meta( $user['ID'], 'subscription_status', true ); ?> </td>
                    <td> <?php echo get_user_meta( $user['ID'], 'policy_number', true ); ?> </td>
                    <td>  
                      <?php echo $user['transactions_sum']; ?>$
                    </td>
                    <td><?php echo $user['debt']; ?>$</td>
                    <td>
                      <a href="?id=<?php echo $user['ID']; ?>" class="button">View</a>
                    </td>
                </tr>
              <?php } ?>
          </tbody>
      </table>

      <div class="mb-3">
          <div class="row">
              <div class="col text-left">
                  <p>Total paid: <?php echo $stats['total_paid']; ?>$</p>
              </div>
              <div class="col text-end">
                <?php
                  echo paginate_links( array(
                    'base' => add_query_arg( 'pg', '%#%' ),
                    'format' => '',
                    'prev_text' => __('&laquo;'),
                    'next_text' => __('&raquo;'),
                    'total' => ceil($pagination['total'] / $pagination['items_per_page']),
                    'current' => $pagination['current_page']
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