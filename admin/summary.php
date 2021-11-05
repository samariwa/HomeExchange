<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

 <!-- Begin Page Content -->
        <div class="container-fluid"> 

  <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Summary</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

         <?php
           include "dashboard_tabs.php";
          ?>

          <br>
        <?php 
        $yesterday = date( 'l, F d, Y', strtotime("yesterday"));
        $week_ago = date('l, F d', strtotime('-7 days'));
        $newsubscribers = mysqli_fetch_array($subscribersWk4);
        $newexchanges = mysqli_fetch_array($exchangesWk4);
        $newsignups = mysqli_fetch_array($signupsWk4);
        $newhomes = mysqli_fetch_array($newHomesWk4);
        $newhomeowners = mysqli_fetch_array($newHomeOwnersWk4);
        $newlyavailable = mysqli_fetch_array($availabilitiesWk4);
        $newrequests = mysqli_fetch_array($requestsWk4);
        ?>
        <div class="row" style="margin-left: 50px;"><h5>Summary for week <?php echo '('.$week_ago.' - '. $yesterday.')'; ?></h5> </div><br>
        <div class="row" style="margin-left: 50px;">
            <h6>Total of newly registered customers: <?php echo $newsignups['sum']; ?></h6>
        </div><br>
        <div class="row" style="margin-left: 50px;">
            <h6>Total of newly registered homes: <?php echo $newhomes['sum']; ?></h6>
        </div><br>
        <div class="row" style="margin-left: 50px;">
            <h6>Total number of new home owners: <?php echo $newhomeowners['sum']; ?></h6>
        </div><br>
        <div class="row" style="margin-left: 50px;">
            <h6>Total number of homes listed available: <?php echo $newlyavailable['sum']; ?></h6>
        </div><br>
        <div class="row" style="margin-left: 50px;">
            <h6>Total number of exchange requests made: <?php echo $newrequests['sum'];; ?></h6>
        </div><br>
        <div class="row" style="margin-left: 50px;">
            <h6>Total number of exchanges made: <?php echo $newexchanges['sum']; ?></h6>
        </div><br>
        <div class="row" style="margin-left: 50px;">
            <h6>Total of new newletter subscribers: <?php echo $newsubscribers['sum']; ?></h6>
        </div><br>
        
        

  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 
         