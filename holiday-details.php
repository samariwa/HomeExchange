<?php
  include('header.php');
?> 
            <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-end">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li><span>/</span></li>
                                <li><a href="homes-list.php">Homes List</a></li>
                                <li><span>/</span></li>
                                <li><a href="home-dashboard.php?id=<?php echo $_GET['id']; ?>">Home Dashboard</a></li>
                                <li><span>/</span></li>
                                <li>Holiday Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->
            <div id="actionAlert">
              <?php //echo $message; ?>
            </div>

             <!-- category section start -->
             <section class="catagory-section">
                <form method = "POST">
                <div class="container p-lg-0">
                    <div class="row">
                        <div class="col-9">
                            <div class="section-heading">
                                <h4 class="heading-title"><span class="heading-circle green"></span> A few more details, and you are set!</h4>
                            </div>
                        </div>
                        <div class="col-3">
                                <h6>Exchange Points: <?php echo $exchangePoints; ?></h6>
                        </div>
                    </div> 
                    <br><br>
                    <div class="section-wrapper container p-lg-0">
                       <div class="row">
                            <h6>How many people are accompanying you?</h6>
                                   <i id="peopleDownQuantity" onclick="increase_decrease_btn('decrease', '#people_no')" class='fa fa-minus-circle ml-2' style="color:#FD5555;font-size:20px"></i>
                                    <h4 class="ml-2"><span name="people_no" id="people_no">0</span></h4>
                                   <i id="peopleUpQuantity" onclick="increase_decrease_btn('increase', '#people_no')" class='fa fa-plus-circle ml-2' style="color:#FD5555;font-size:20px"></i>
                        </div>
                       <br><br>
                       <div class="row">
                            <h6>What duration do you plan to stay there?</h6>
                            <h6 class="ml-3">From:</h6>
                            <div class="col-3">
                                <input type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>" id="start_date" required>
                            </div>
                            <h6>To:</h6>
                            <div class="col-3">
                                <input type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>" id="end_date" required>
                            </div>
                        </div>
                       <br>
                    </div>
                </div>
                <br><br>
                <div class="container p-lg-0">
                  <h6>Kindly list any other requirements you have</h6>
                  <textarea id="extra-requirements" class="form-control" name="extra-requirements" rows="4" cols="50"></textarea>
                </div>
                <br>
                <div class="container p-lg-0">
                <h6>Which of your homes would you like to use for the swap?</h6>
                <select type="text" name="exchange_home_id" id="exchange_home_id" class="form-control col-9" required onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                   <option value="" selected="selected" disabled>Swap Home...</option>
                  <?php
                    $home = new Home();
                    $count = 0;
                    $owner_id= mysqli_query($connection,"SELECT id FROM home_owners WHERE user_id = '".$customer_id."'")or die($connection->error);
                    $owner_result = mysqli_fetch_array($owner_id);
                    $myHomes = mysqli_query($connection,$home->getUserHomes($owner_result['id']))or die($connection->error);
                    foreach($myHomes as $row){
                     $count++;
                    $home_id = $row['id'];
                    $home = $row['name'];
                  ?>
                   <option value="<?php echo $home_id; ?>"><?php echo $home; ?></option>
                  <?php
                    }
                  ?>
                 </select>
                </div>
                <br>
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                    <input type="submit" value="Request Home" style="background-color: #FD5555;font-family:Arial, FontAwesome" id="request-submit" class="btn btn-danger rounded-pill mr-3"/>
                    </div>
                </div>
                </form>
            </section>
            <!-- category section end -->

    
<?php
    include('footer.php');
?>