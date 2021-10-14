<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Customers</span></h1>
            <h6 class="text-gray-600" style="margin-left: 500px;">Time: <span id="time"></span></h6>
             <button class="btn btn-light btn-md active printCustomers mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
        <?php
           include "dashboard_tabs.php";
          ?>
    <div class="row">
      <div class="col-md-3">

       </div>
       <div class="col-md-5">
      <?php
        $customersrowcount = mysqli_num_rows($activeCustomersList);
      ?>
      <h6 class="offset-5">Total Number: <?php echo $customersrowcount; ?></h6>
      </div>
      <div class="col-md-4">
      <a href="blacklisted.php" class="btn btn-dark btn-md active offset-5" role="button" aria-pressed="true" >Blacklisted Customers</a>
      </div>
    </div><br>
    <table id="customersEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="10%">Physical Address</th>
      <th scope="col" width="17%">Contact Number</th>
      <th scope="col" width="8%">Email Address</th>
      <th scope="col"width="10%">Exchange Points</th>
      <th scope="col"width="22%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($activeCustomersList as $row){
         $count++;
         $id = $row['id'];
         $name =$row['first_name'].' '.$row['other_name'].' '.$row['last_name'];
         $location = $row['physical_address'];
         $number = $row['phone_number'];
         $email = $row['email_address'];
         $points = $row['exchange_points'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td  class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="location<?php echo $count; ?>"><?php echo $location; ?></td>
      <td class="editable" id="number<?php echo $count; ?>"><?php echo $number; ?></td>
      <td class="editable" id="email<?php echo $count; ?>"><?php echo $email; ?></td>
      <td class="uneditable"id="points<?php echo $count; ?>"><?php echo $points; ?></td>
       <td>&emsp;&emsp;
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active blacklistCustomer" role="button" aria-pressed="true" >Blacklist</button>
       <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteCustomer" role="button" aria-pressed="true" ><i class="fa fa-user-times"></i>Delete</button></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 