<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Customer Feedback</span></h1>
            <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>
         <?php
           include "dashboard_tabs.php";
          ?>
         <div class="row">
      <div class="col-md-7">   
      <h6 class="offset-9">Total Number: <?php echo $feedbackCount; ?></h6>
    </div>
     <div class="col-md-5">   
        
    </div><br> 
    <?php
        foreach($feedbackList as $row){
      ?>
      <div class="jumbotron">
        <h5 class="display-5">Feedback#: <?php echo $row['id']; ?></h5>
        <h4>Customer</h4>
        <p class="lead"><?php echo $row['first_name'].' '.$row['last_name']; ?></p>
        <hr class="my-4">
        <h4>Message</h4>
        <p><?php echo $row['message']; ?></p>
        </div>  
    <?php
        }
    ?>

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 