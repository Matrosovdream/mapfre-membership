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
                <tr>
                    <th scope="row">Diaria - $0.50</th>
                    <td>$0.50</td>
                    <td>Completed</td>
                    <td>25/03/2024</td>
                </tr>
            </tbody>
        </table>

        <nav aria-label="Page navigation example ">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>

    </div>

  </div>
</div>



<style>

    .entry-title {
        display: none!important;
    }

</style>