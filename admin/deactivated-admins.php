<?php
 include "admin_nav.php";
include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Administrators</span> <span style="font-size: 15px;">/Deactivated Administrators</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
          <?php
           include "dashboard_tabs.php";
          ?>
    <div class="row">
      <div class="col-md-4">
      <a href="admins.php" class="btn btn-primary btn-md active" role="button" aria-pressed="true" ><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
      <div class="col-md-8">
      <h6 class="offset-2">Total Number: <?php echo $deactivatedAdminsCount; ?></h6>
    </div>
    </div><br>
    <table id="deactivatedAdminsEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="25%">Name</th>
      <th scope="col" width="14%">Contact Number</th>
      <th scope="col" width="14%">Email Address</th>
      <th scope="col"width="22%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;    
        foreach($deactivatedAdminsList as $row){
         $count++;
         $id = $row['id'];
         $name =$row['first_name'].' '.$row['other_name'].' '.$row['last_name'];
         $location = $row['physical_address'];
         $number = $row['phone_number'];
         $email = $row['email_address'];
      ?>
    <tr>
     <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td  class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="number<?php echo $count; ?>"><?php echo $number; ?></td>
      <td class="editable" id="email<?php echo $count; ?>"><?php echo $email; ?></td>
       <td> <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-success btn-sm active restoreDeactivatedAdmin" role="button" aria-pressed="true" >Reactivate</button>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteDeactivatedAdmin" role="button" aria-pressed="true" ><i class="fa fa-user-times"></i>Delete</button>
     </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>


  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 