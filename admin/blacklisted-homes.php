<?php
 include "admin_nav.php";
include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Homes </span> <span style="font-size: 15px;">/Blacklisted Homes</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
          <?php
           include "dashboard_tabs.php";
          ?>
    <div class="row">
      <div class="col-md-4">
      <a href="homes.php" class="btn btn-primary btn-md active" role="button" aria-pressed="true" ><i class="fa fa-arrow-left"></i>&ensp;Back</a>
      </div>
      <div class="col-md-8">
      <h6 class="offset-2">Total Number: <?php echo $deactivatedHomesCount; ?></h6>
    </div>
    </div><br>
    <table id="blacklistedHomesEditable" class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
    <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Home Owner</th>
      <th scope="col" width="10%">Name</th>
      <th scope="col" width="17%">Location</th>
      <th scope="col" width="8%">Rating</th>
      <th scope="col"width="6%">Tier</th>
      <th scope="col"width="14%">Extra Details</th>
      <th scope="col"width="22%"></th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($deactivatedHomesList as $row){
         $count++;
         $id = $row['home_id'];
         $owner_name = $row['first_name'].' '.$row['last_name'];
         $name = $row['name'];
        $location = $row['county'].', '.$row['subcounty'];
        $rating = $row['average_rating'];
        $tier = $row['home_tier'];
        $extra_details = $row['home_extra_details'];
      ?>
    <tr>
    <th scope="row" class="uneditable" id="id<?php echo $count; ?>"><?php echo $id; ?></th>
      <td  class="editable" id="owner_name<?php echo $count; ?>"><?php echo $owner_name; ?></td>
      <td class="editable" id="name<?php echo $count; ?>"><?php echo $name; ?></td>
      <td class="editable" id="location<?php echo $count; ?>"><?php echo $location; ?></td>
      <td class="editable" id="rating<?php echo $count; ?>"><?php echo $rating; ?></td>
      <td class="uneditable"id="tier<?php echo $count; ?>"><?php echo $tier; ?></td>
      <td class="editable"id="extra<?php echo $count; ?>"><?php echo $extra_details; ?></td>
       <td> <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-success btn-sm active restoreHome" role="button" aria-pressed="true" >Restore</button>
         <button id="<?php echo $id; ?>" data_id="<?php echo $id; ?>" class="btn btn-danger btn-sm active deleteBlacklistedHome" role="button" aria-pressed="true" ><i class="fa fa-trash"></i>Delete</button>
     </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>


  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 