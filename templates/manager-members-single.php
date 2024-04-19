<div class="container personal-area">
  <div class="row">
    
    <div class="col-md-2">
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/manager-menu.php' ); ?>
    </div>
    
    <div class="col-md-10">


        <div class="mb-3">
            <div class="row">
                <div class="col text-left">
                    <a href="/manager/members/">
                        Back
                    </a>
                </div>
                <div class="col text-left">
                    <?php /* ?>
                    <p class="card-text">
                        Estátus 
                    </p>
                    <h5 class="card-title">
                    <?php if( $userdata['meta']['subscription_status'] == 'active' ) { ?>
                        <span class="badge bg-success">Active</span> 
                    <?php } else { ?>
                        <span class="badge bg-fail">Expired</span> 
                    <?php } ?>
                    </h5>
                    <?php */ ?>
                </div>
            </div>
        </div>
        
        <h4>
            Membre #<?php echo $_GET['id']; ?> 
            <?php if( $userdata['meta']['subscription_status'] == 'active' ) { ?>
                <span class="badge bg-success">Active</span> 
            <?php } else { ?>
                <span class="badge bg-warning">Expired</span> 
            <?php } ?>
        </h4>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        <h5 class="card-title">
                            <?php echo $userdata['meta']['first_name']; ?> <?php echo $userdata['meta']['last_name']; ?>
                        </h5>
                        <p class="card-text">
                            Email: 
                            <a href="mailto:<?php echo $userdata['email']; ?>">
                                <?php echo $userdata['email']; ?>
                            </a>
                        </p>
                    </div>
                    <div class="col text-center">
                        <p class="card-text">Membrecía</p>
                        <p><b><?php echo $userdata['meta']['sub_type']; ?></b></p>
                    </div>
                    <div class="col text-center">
                        <p class="card-text">Fecha Inscripción</p>
                        <p><b><?php echo date( 'd/m/Y', strtotime($registered) ) ?></b></p>
                    </div>
                    <div class="col text-center">
                        <p class="card-text">Número de Carnet</p>
                        <p><b><?php echo $userdata['meta']['policy_number']; ?></b></p>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <h4>Transactions</h4>

        <div class="row">
            <div class="col-md-6 left-column">
                <form class="form-inline justify-content-end">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                    <div class="row">
                        <div class="col" align="right">
                            <input type="text" class="form-control mb-2 mr-sm-2" name="search" value="<?php echo $_GET['search']; ?>" placeholder="Search">
                        </div>

                        <div class="col" align="left">
                            <button type="submit" class="btn btn-primary mb-2 mr-2">Find</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="cart" id="user-payments">
            <thead>
                <tr>
                    <th scope="col">Número Transacción</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Estátus</th>
                    <th scope="col">Deuda Acumulada</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $transactions['results'] as $user ) { ?>

                <?php
                $udata = get_userdata( $user['user_id'] );
                ?>

                <tr>
                    <td><?php echo $user['transaction_id']; ?></td>
                    <td><?php echo date( 'd/m/Y', strtotime($user['created_at']) ) ?></td>
                    <td><?php echo $user['amount']; ?>$</td>
                    <td><?php echo $user['status']; ?></td>
                    <td><?php echo $accumulated; ?></td>                    
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