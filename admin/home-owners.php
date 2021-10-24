<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Homes</span></h1>
            <h6 class="text-gray-600" style="margin-left: 500px;">Time: <span id="time"></span></h6>
             <button class="btn btn-light btn-md active printCustomers mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
        <?php
           include "dashboard_tabs.php";
          ?>
    <div class="row">
      <div class="col-md-3">
      <a href="customers.php" class="btn btn-primary btn-md active" role="button" aria-pressed="true" ><i class="fa fa-arrow-left"></i>&ensp;Back</a>
       </div>
       <div class="col-md-5">
      <h6 class="offset-5">Total Number: <?php echo $homeOwnersCount; ?></h6>
      </div>
      <div class="col-md-4">
      
      </div>
    </div><br>
    <table id="customersEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="8%">Phone Number</th>
      <th scope="col"width="10%">Email Address</th>
      <th scope="col" width="13%">Average Rating</th>
      <th scope="col" width="17%">Exchange Points</th>
       <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
      <th scope="col"width="22%"></th>
      <?php
        }
        ?>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($homeOwnersList as $row){
        $count++;
        $id = $row['id'];
        $name = $row['first_name'].' '.$row['last_name'];
        $phone_number = $row['phone_number'];
        $email_address = $row['email_address'];
        $exchange_points = $row['exchange_points'];
        $average_rating = $row['email_address'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td  class="editable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="number<?php echo $count; ?>"><?php echo $phone_number; ?></td>
      <td class="editable" id="email<?php echo $count; ?>"><?php echo $email_address; ?></td>
      <td class="editable" id="rating<?php echo $count; ?>"><?php echo $average_rating; ?></td>
      <td class="editable" id="points<?php echo $count; ?>"><?php echo $exchange_points; ?></td>
        <?php
       if ($view == 'Software' || $view == 'Director' || $view == 'CEO') {

        ?>
       <td>&emsp;&emsp;
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active blacklistCustomer" role="button" aria-pressed="true" >Blacklist</button>
       <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteCustomer" role="button" aria-pressed="true" ><i class="fa fa-user-times"></i>Delete</button></td>
        <?php
        }
        ?>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 