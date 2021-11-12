<?php
 include "admin_nav.php";
 include('../queries.php');
 ?> 

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <span style="font-size: 18px;">/Analytics</span></h1>
           <h6 class="h6 mb-0 text-gray-600 mr-3">Time: <span id="time"></span></h6>
          </div>

           <?php
       include "dashboard_tabs.php";

        ?>
 
<br>
<h4>Home Feature Numbers</h4>
    <table  class="table table-striped table-hover paginate" style="display:block;overflow-y:scroll;text-align: center;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="20%">Feature</th>
      <th width="15%"></th>
      <th width="15%"></th>
      <th scope="col" width="20%">Number of homes</th>
      <th width="15%"></th>
      <th width="5%"></th>
      <th width="13%">Percentage</th>     
    </tr>
  </thead>
  <tbody >
    <?php
         $rowHomesNumber = $row['sid'];
         $name = $row['sname'];
        $sum1 = $row['sum1'];
        $sum2 = $row['sum2'];
        $sum3 = $row['sum3'];
        $sum4 = $row['sum4'];
        $sum5 = $row['sum5'];
      ?>
    <tr>
      <th scope="row">Swimming Pool</th>
      <td></td>
      <td></td>
      <td><?php echo $swimming_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($swimming_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>   
    </tr>
    <tr>
      <th scope="row">Houses</th>
      <td></td>
      <td></td>
      <td><?php echo $houses_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($houses_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Apartments</th>
      <td></td>
      <td></td>
      <td><?php echo $apartments_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($apartments_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Primarily owned</th>
      <td></td>
      <td></td>
      <td><?php echo $primary_ownership_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($primary_ownership_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Secondarily owned</th>
      <td></td>
      <td></td>
      <td><?php echo $secondary_ownership_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($secondary_ownership_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">TV</th>
      <td></td>
      <td></td>
      <td><?php echo $tv_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($tv_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">WiFi</th>
      <td></td>
      <td></td>
      <td><?php echo $wifi_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($wifi_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Air Con.</th>
      <td></td>
      <td></td>
      <td><?php echo $ac_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($ac_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Private Gym</th>
      <td></td>
      <td></td>
      <td><?php echo $gym_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($gym_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Wheelchair Accessible</th>
      <td></td>
      <td></td>
      <td><?php echo $wheelchair_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($wheelchair_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Pets Allowed</th>
      <td></td>
      <td></td>
      <td><?php echo $pets_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($pets_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Kids Friendly</th>
      <td></td>
      <td></td>
      <td><?php echo $kids_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($kids_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Parking</th>
      <td></td>
      <td></td>
      <td><?php echo $parking_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($parking_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Security Guard</th>
      <td></td>
      <td></td>
      <td><?php echo $security_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($security_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Private Garden</th>
      <td></td>
      <td></td>
      <td><?php echo $garden_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($garden_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Home Workers</th>
      <td></td>
      <td></td>
      <td><?php echo $workers_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($workers_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
    <tr>
      <th scope="row">Smokers Allowed</th>
      <td></td>
      <td></td>
      <td><?php echo $smokers_no['sum']; ?></td>
      <td ></td>
      <td></td>
      <td><?php echo number_format((float)($smokers_no['sum']/$homes_no['sum']) * 100,2,'.','').'%'; ?></td>
    </tr>
  </tbody>
</table>
<br>

<div class="row">
  <div class="col-md-6">
    <h4>Home Exchange Monthly Comparison</h4>
  </div>
  <div class="col-md-6">
    <h4>Home Registration</h4>
  </div>
</div>
<div class="row">
  <div id="piechart" style="width: 420px; height: 400px;"></div>   
<div id="barchart_values" style="width: 500px; height: 400px;"></div>
</div>
<br>
<div class="row">
  <div id="piechart2" style="width: 420px; height: 400px;"></div>   
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <h4>Tier Numbers</h4>
  </div>
  <div class="col-md-6">
    <h4>Top 5 counties</h4>
  </div>
</div>
<div class="row">
    <div id="tiersChart" style="width: 430px; height: 400px;"></div>
    <div id="countiesChart" style="width: 600px; height: 400px;"></div>    
</div>  
<br>
<div class="row">
  <div class="col-md-6">
    <h4>Customer Type Comparison</h4>
  </div>
 <div id="customerTypeChart" style="width: 1100px; height: 500px"></div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <h4>Total Sign ups</h4>
  </div>
 <div id="curve_chart" style="width: 1100px; height: 500px"></div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <h4>Profit / Loss</h4>
  </div>
</div>
<div class="row">
    <div id="profitchart" style="width: 1200px; height: 600px;"></div>   
</div>  
  <!-- Scroll to Top Button-->
  <?php include "admin_footer.php" ?> 