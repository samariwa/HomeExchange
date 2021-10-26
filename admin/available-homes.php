<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Available Homes</span></h1>
            <h6 class="text-gray-600" style="margin-left: 430px;">Time: <span id="time"></span></h6>
             <button class="btn btn-light btn-md active printAvailableHomes mr-3" role="button" aria-pressed="true" ><i class="fa fa-print"></i>&ensp;Print</button>
          </div>
        <?php
           include "dashboard_tabs.php";
          ?>
    <div class="row">
      <div class="col-md-3">
   
       </div>
       <div class="col-md-5">
      <h6 class="offset-5">Total Number: <?php echo $availableHomesCount; ?></h6>
      </div>
      <div class="col-md-4">
     
      </div>
    </div><br>
    <table id="availableHomesEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Home Owner</th>
      <th scope="col" width="14%">Home Name</th>
      <th scope="col" width="10%">Location</th>
      <th scope="col" width="17%">Start Date</th>
      <th scope="col" width="17%">End Date</th>
      <th scope="col"width="14%">Availability Extra Details</th>
      <th scope="col"width="22%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($availableHomesList as $row){
         $count++;
         $id = $row['home_id'];
         $owner_name = $row['first_name'].' '.$row['last_name'];
         $name = $row['name'];
        $location = $row['county'].', '.$row['subcounty'];
        $start_date = $row['availability_start_date'];
        $end_date = $row['availability_end_date'];
        $extra_details = $row['extra_details'];
      ?>
    <tr>
      <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td  class="uneditable" id="owner<?php echo $count; ?>"><?php echo $owner_name; ?></td>
      <td class="editable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="location<?php echo $count; ?>"><?php echo $location; ?></td>
      <td class="editable" id="start_date<?php echo $count; ?>"><?php echo $start_date; ?></td>
      <td class="uneditable"id="end_date<?php echo $count; ?>"><?php echo $end_date; ?></td>
      <td class="editable"id="extra_details<?php echo $count; ?>"><?php echo $extra_details; ?></td>
       <td>
       <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active cancelAvailability" role="button" aria-pressed="true" ><i class="fa fa-times"></i> Cancel</button></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 