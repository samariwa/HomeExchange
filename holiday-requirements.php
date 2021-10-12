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
                <div class="container p-lg-0">
                    <div class="row">
                        <div class="col-9">
                            <div class="section-heading">
                                <h4 class="heading-title"><span class="heading-circle green"></span> Help us get the home for you</h4>
                            </div>
                        </div>
                        <div class="col-3">
                                <h6>Exchange Points: 274</h6>
                        </div>
                    </div> 
                    <br>
                    <div class="section-wrapper">
                        <div class="row">
                            <h6>Where are you visiting?</h6>
                            <div class="col-4">
                                <input type="text" class="form-control" id="location" placeholder="Mombasa">
                            </div>
                        </div>
                       <br>
                       <div class="row">
                            <h6>How many people are accompanying you?</h6>
                            <button class="btn">
                                   <i id="peopleDownQuantity" onclick="" class='fa fa-minus-circle' style="color:#FD5555;font-size:20px"></i>
                                </button>
                                <h4><span name="people_no" id="people_no">0</span></h4>
                               <button class="btn">
                                   <i id="peopleUpQuantity" onclick="" class='fa fa-plus-circle' style="color:#FD5555;font-size:20px"></i>
                               </button>
                        </div>
                       <br>
                       <div class="row">
                            <h6>What duration do you plan to stay there?</h6>
                            <h6 class="ml-3">From:</h6>
                            <div class="col-3">
                                <input type="date" class="form-control" id="date">
                            </div>
                            <h6>To:</h6>
                            <div class="col-3">
                                <input type="date" class="form-control" id="date">
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
                                    <input type="checkbox" name="kids">
                                </div>
                           </div>
                           <div class="col-6">
                               <div class="row" style="align-items: center;">
                               <h6>If yes, how many?</h6>
                               <button class="btn">
                                   <i id="kidsDownQuantity" onclick="" class='fa fa-minus-circle' style="color:#FD5555;font-size:20px"></i>
                                </button>
                                <h4><span name="kids_no" id="kids_no">0</span></h4>
                               <button class="btn">
                                   <i id="kidsUpQuantity" onclick="" class='fa fa-plus-circle' style="color:#FD5555;font-size:20px"></i>
                               </button>
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
                    <input type="checkbox" class="checkbox">
                    <div class="option_inner swimming">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-swimming-pool fa-2x"></i></div>
                        <div class="name">Swimming Pool</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" class="checkbox">
                    <div class="option_inner wifi">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-wifi fa-2x"></i></div>
                        <div class="name">WiFi</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" class="checkbox">
                    <div class="option_inner tv">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-tv fa-2x"></i></div>
                        <div class="name">TV</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" class="checkbox">
                    <div class="option_inner smokers">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-smoking fa-2x"></i></div>
                        <div class="name">Smokers Friendly</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" class="checkbox">
                    <div class="option_inner wheelchair">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fab fa-accessible-icon"></i></div>
                        <div class="name">Wheelchair Accessible</div>
                    </div>
                    </label>
                    </div>
                    <div class="row">
                    <label class="option_item">
                    <input type="checkbox" class="checkbox">
                    <div class="option_inner parking">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-parking fa-2x"></i></div>
                        <div class="name">Private Parking</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" class="checkbox">
                    <div class="option_inner security">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-shield-alt fa-2x"></i></div>
                        <div class="name">Security</div>
                    </div>
                    </label>
                    <label class="option_item">
                    <input type="checkbox" class="checkbox">
                    <div class="option_inner gym">
                        <div class="tickmark"></div>
                        <div class="icon"><i class="fas fa-dumbbell fa-2x"></i></div>
                        <div class="name">Private Gym</div>
                    </div>
                    </label>
                    </div> 
                </div>
                <div class="container p-lg-0">
                  <h6>Kindly list any other requirements you have</h6>
                  <textarea id="extra-requirements" class="form-control" name="extra-requirements" rows="4" cols="50"></textarea>
                </div>
            </section>
            <!-- category section end -->

    
<?php
    include('footer.php');
?>