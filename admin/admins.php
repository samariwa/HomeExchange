<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Administrators</span></h1>
            <h6 class="text-gray-600" style="margin-left: 500px;">Time: <span id="time"></span></h6>

          </div>
        <?php
           include "dashboard_tabs.php";
          ?>
    <div class="row">
      <div class="col-md-3">
      <a data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-success btn-md active" role="button" aria-pressed="true"><i class="fa fa-plus-circle"></i>&ensp;New Administrator</a>
      <!-- Modal -->
      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">New Administrator</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <div class="row">
                 <input type="text" name="firstname" id= "firstname" class="form-control col-md-9" style="padding:15px;margin-left: 60px" required  placeholder="First Name...">
                  </div><br>
                  <div class="row">
                 <input type="text" name="othername" id= "othername" class="form-control col-md-9" style="padding:15px;margin-left: 60px" required  placeholder="Other Name...">
                  </div><br>
                  <div class="row">
                 <input type="text" name="lastname" id= "lastname" class="form-control col-md-9" style="padding:15px;margin-left: 60px" required  placeholder="Last Name...">
                  </div><br>
                 <div class="row">
                 <input type="text" name="email" id= "email" class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Email Address...">
                  </div><br>
                 <div class="row">
                 <input type="text" name="mobile" id= "mobile"class="form-control col-md-9" required style="padding:15px;margin-left: 60px" placeholder="Contact Number...">
                  </div><br>
                  <input type="hidden" name="where" id= "where"  value="admin">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 50px" id="addAdmin">Add Admin</button>
            </form>
            </div>
          </div>
        </div>
      </div>
       </div>
       <div class="col-md-4">

      <h6 class="offset-5">Total Number: <?php echo $activeAdminsCount; ?></h6>
      </div>
      <div class="col-md-5">
      <a href="deactivated-admins.php" class="btn btn-dark btn-md active offset-6" role="button" aria-pressed="true" >Deactivated Admins</a>
      </div>
    </div><br>
    <table id="adminsEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="25%">Name</th>
      <th scope="col" width="14%">Contact Number</th>
      <th scope="col" width="8%">Email Address</th>
      <th scope="col"width="22%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($activeAdminsList as $row){
         $count++;
         $id = $row['id'];
         $name =$row['first_name'].' '.$row['other_name'].' '.$row['last_name'];
         $number = $row['phone_number'];
         $email = $row['email_address'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td  class="uneditable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="number<?php echo $count; ?>"><?php echo $number; ?></td>
      <td class="editable" id="email<?php echo $count; ?>"><?php echo $email; ?></td>
       <td>&emsp;&emsp;
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-dark btn-sm active blacklistAdmin" role="button" aria-pressed="true" >Deactivate</button>
       <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteAdmin" role="button" aria-pressed="true" ><i class="fa fa-user-times"></i>Delete</button></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 