<div class="container personal-area">
  <div class="row">
    
    <div class="col-md-2">
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/manager-menu.php' ); ?>
    </div>
    
    <div class="col-md-10">
        
        <h4>
            Member #<?php echo $_GET['id']; ?> 
            <?php if( $userdata['meta']['subscription_status'] == 'active' ) { ?>
                <span class="badge bg-success">Active</span> 
            <?php } else { ?>
                <span class="badge bg-fail">Expired</span> 
            <?php } ?>
        </h4>

        <br/>
        <table class="cart" id="user-payments">
          <thead>
              <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Appelido</th>
                  <th scope="col">Email</th>
                  <th scope="col">Nivel de Membrecía</th>
                  <th scope="col">Inscripción Comienza</th>
                  <th>número de carnet</th>
              </tr>
          </thead>
          <tbody>
            <td><?php echo $userdata['meta']['first_name']; ?></td>
            <td><?php echo $userdata['meta']['last_name']; ?></td>
            <td><?php echo $userdata['email']; ?></td>
            <td><?php echo $userdata['meta']['sub_type']; ?></td>
            <td><?php echo date( 'd/m/Y', strtotime($registered) ) ?></td>
            <td><?php echo $userdata['meta']['policy_number']; ?></td>
        </tbody>  
        </table>

        <br/>
        <h4>Transactions</h4>

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
                <?php foreach( $transactions['results'] as $user ) { ?>

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


      <?php /* ?>
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
                    <td>
                      <a href="?id=<?php echo $user['ID']; ?>" class="button">View</a>
                    </td>
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
        'total' => ceil($pagination['total'] / $pagination['items_per_page']),
        'current' => $pagination['current_page']
      ));
      ?>

    </div>
    <?php */ ?>

  </div>
</div>



<style>

    .entry-title {
        display: none!important;
    }

</style>