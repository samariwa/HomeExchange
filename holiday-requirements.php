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
                                <li>Holiday Requirements</li>
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
                                <h4 class="heading-title"><span class="heading-circle green"></span> Help us get the home for you</h4>
                            </div>
                        </div>
                        <div class="col-3">
                                <h6>Exchange Points: <?php echo $exchangePoints; ?></h6>
                        </div>
                    </div> 
                    <br>
                    <div class="section-wrapper">
                        <div class="row">
                            <h6>Where are you visiting?</h6>
                            <div class="col-4">
                                <input type="text" class="form-control" style="font-family:Arial, FontAwesome" name="county_search" id="county_search" placeholder="&#xF002; County..." required>
                                <div class="col-7" style="position: absolute;z-index: 4;">
                                    <div class="list-group" id="county_list" >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" style="font-family:Arial, FontAwesome" name="subcounty_search" id="subcounty_search" placeholder="&#xF002; Sub-County..." disabled required>
                                <div class="col-12" style="position: absolute;z-index: 4;">
                                    <div class="list-group" id="subcounty_list" >
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                       <br>
                       <div class="row">
                            <h6>How many people are accompanying you?</h6>
                                   <i id="peopleDownQuantity" onclick="increase_decrease_btn('decrease', '#people_no')" class='fa fa-minus-circle ml-2' style="color:#FD5555;font-size:20px"></i>
                                    <h4 class="ml-2"><span name="people_no" id="people_no">0</span></h4>
                                   <i id="peopleUpQuantity" onclick="increase_decrease_btn('increase', '#people_no')" class='fa fa-plus-circle ml-2' style="color:#FD5555;font-size:20px"></i>
                        </div>
                       <br>
                       <div class="row">
                            <h6>What duration do you plan to stay there?</h6>
                            <h6 class="ml-3">From:</h6>
                            <div class="col-3">
                                <input type="date" class="form-control" id="start_date" required>
                            </div>
                            <h6>To:</h6>
                            <div class="col-3">
                                <input type="date" class="form-control" id="end_date" required>
                            </div>
                        </div>
                       <br>
                       <div class="row">
                           <div class="col-4">
                               <div class="ios-switch">
                                <label><h6>Are you bringing along kids?</h6></label>
                                    <div class="switch-body">
                                        <div class="toggle">

                                        </div>
                                    </div>
                                    <input type="checkbox" class="kids_coming" id="kids_coming" name="kids_coming">
                                </div>
                           </div>
                           <div class="col-6">
                               <div class="row">
                               <h6>If yes, how many?</h6>
                                   <i id="kidsDownQuantity" onclick="increase_decrease_btn_kids('decrease', '#kids_no')" class='fa fa-minus-circle ml-2' style="color:#FD5555;font-size:20px"></i>
                                    <h4 class="ml-2"><span name="kids_no" id="kids_no">0</span></h4>
                                   <i id="kidsUpQuantity" onclick="increase_decrease_btn_kids('increase', '#kids_no')" class='fa fa-plus-circle ml-2' style="color:#FD5555;font-size:20px"></i>
                               </div>
                           </div>
                        </div>
                       <br>
                    </div>
                </div>
                <div class="container p-lg-0">
                    <h5>Kindly select facilities you would like to have in the home</h5>
                    <div class="row">
                    <label class="option_item">
                    <input type="checkbox" name="swimming" class="checkbox">
                    <div class="option_inner swimming">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-swimming-pool fa-2x"></i></div>
                        <div class="name">Swimming Pool</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="wifi" class="checkbox">
                    <div class="option_inner wifi">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-wifi fa-2x"></i></div>
                        <div class="name">WiFi</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="tv" class="checkbox">
                    <div class="option_inner tv">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-tv fa-2x"></i></div>
                        <div class="name">TV</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="smokers" class="checkbox">
                    <div class="option_inner smokers">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-smoking fa-2x"></i></div>
                        <div class="name">Smokers Friendly</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="wheelchair" class="checkbox">
                    <div class="option_inner wheelchair">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fab fa-accessible-icon"></i></div>
                        <div class="name">Wheelchair Accessible</div>
                    </div>
                    </label>
                    </div>
                    <div class="row">
                    <label class="option_item">
                    <input type="checkbox" name="parking" class="checkbox">
                    <div class="option_inner parking">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-parking fa-2x"></i></div>
                        <div class="name">Private Parking</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="gym" class="checkbox">
                    <div class="option_inner gym">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-dumbbell fa-2x"></i></div>
                        <div class="name">Private Gym</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="kids" class="checkbox">
                    <div class="option_inner kids">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-child fa-2x"></i></div>
                        <div class="name">Kids Friendly</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="garden" class="checkbox">
                    <div class="option_inner garden">
                        <div class="tickmark"></div>
                        <div class="icon"><h2>G</h2></div>
                        <div class="name">Private Garden</div>
                    </div>
                    </label>
                    </div> 
                    <div class="row">
                    <label class="option_item">
                    <input type="checkbox" name="ac" class="checkbox">
                    <div class="option_inner ac">
                        <div class="tickmark"></div>
                        <div class="icon"><h2>AC</h2></div>
                        <div class="name">Air Con.</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="workers" class="checkbox">
                    <div class="option_inner workers">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-user-friends fa-2x"></i></div>
                        <div class="name">Home Workers</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" name="security" class="checkbox">
                    <div class="option_inner security">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-shield-alt fa-2x"></i></div>
                        <div class="name">Security</div>
                    </div>
                    </label>
                    </div>
                </div>
                <br>
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
                <input type="hidden" id="holiday_requirements_expiry" value="<?php echo $holiday_requirements_expiry; ?>" />
                <br>
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                    <input type="submit" value="&#xF002; Search" style="background-color: #FD5555;font-family:Arial, FontAwesome" id="requirements-submit" class="btn btn-danger rounded-pill mr-3"/>
                    </div>
                </div>
                </form>
            </section>
            <!-- category section end -->

    
<?php
    include('footer.php');
?>