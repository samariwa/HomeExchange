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
                                <li>Add Home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->
            <div id="actionAlert">
              <?php //echo $message; ?>
            </div>

            <section class="skewed form-step active" id="wrapper">
                 <div class="layer bottom" style="background-image:url('assets/images/add-home/home-add-icon.png'); background-repeat: no-repeat;background-size: 110%; ">
                     <div class="content-wrap">
                         <div class="content-body">

                         </div>
                     </div>
                 </div>
                 <div class="layer top">
                     <div class="content-wrap">
                     <div class="container p-lg-0">
                 <!-- start of home type page-->
                    <div class="home-type-page">
                        <div class="row">
                        <div class="col-12">
                            <div class="section-heading ml-5">
                                <h4 class="heading-title"><span class="heading-circle green"></span> What's your home like?</h4>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <div class="section-wrapper ml-5">
                        <h6>Home Type</h6>
                        <div class="row">
                            <label class="radio_item">
                            <input type="radio" name="home_type" class="checkbox">
                            <div class="option_inner house">
                                <div class="tickmark"></div>
                                <div class="icon"><i class="fas fa-home fa-2x"></i></div>
                                <div class="name">House</div>
                            </div>
                            </label>
                            <label class="radio_item ml-5">
                            <input type="radio" name="home_type" class="checkbox">
                            <div class="option_inner apartment">
                                <div class="tickmark"></div>
                                <div class="icon"><i class="fas fa-building fa-2x"></i></div>
                                <div class="name">Apartment</div>
                            </div>
                            </label>
                        </div>
                        <br><br>
                        <h6>Residence Type</h6>
                        <div class="row">
                            <label class="radio_item">
                            <input type="radio" name="residence_type" class="checkbox">
                            <div class="option_inner primary">
                                <div class="tickmark"></div>
                                <div class="icon"><h2>1</h2></div>
                                <div class="name">Primary</div>
                            </div>
                            </label>
                            <label class="radio_item ml-5">
                            <input type="radio" name="residence_type" class="checkbox">
                            <div class="option_inner secondary">
                                <div class="tickmark"></div>
                                <div class="icon"><h2>2</h2></div>
                                <div class="name">Secondary</div>
                            </div>
                            </label>
                        </div>
                       <br><br>
                        <div class="next">
                                <a href="#">Next</a>
                        </div>
                    </div>
                     </div>
                        </div>
                       <br>
                    </div>
                    </div> 
                    <!-- end of home type page-->
                    
                </div> 
                     </div>
                 </div>
            </section>

             <section class="skewed form-step" id="wrapper">
                 <div class="layer bottom" style="background-image:url('assets/images/add-home/home-add-icon.png'); background-repeat: no-repeat;background-size: 110%; ">
                     <div class="content-wrap">
                         <div class="content-body">

                         </div>
                     </div>
                 </div>
                 <div class="layer top">
                     <div class="content-wrap">
                     <div class="container p-lg-0">      
                    <!-- start of location page-->
                   <div class="location-page">
                        <div class="row">
                        <div class="col-12">
                            <div class="section-heading ml-5">
                                <h4 class="heading-title"><span class="heading-circle green"></span> Where is your home located?</h4>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <div class="section-wrapper ml-5">
                            <h6>County</h6>
                            <div class="col-7">
                                <input type="text" class="form-control" style="font-family:Arial, FontAwesome" id="county" name="county" placeholder="&#xF002; Search..." required>
                            </div>
                            <br><br>
                            <h6>Sub-County</h6>
                            <div class="col-7">
                                <input type="text" class="form-control" style="font-family:Arial, FontAwesome" id="county" name="subcounty" placeholder="&#xF002; Search..." disabled required>
                            </div>
                            <br><br>
                           <div class="row">
                            <div class="prev">
                                 <a href="#">Previous</a>
                           </div>
                           <div class="next">
                                 <a href="#">Next</a>
                           </div>
                            </div>
                          </div>
                           </div>
                        </div>
                       <br>
                    </div> 
                    <!-- end of location page-->

                </div> 
                     </div>
                 </div>
            </section>
            

            <section class="skewed form-step" id="wrapper">
                 <div class="layer bottom" style="background-image:url('assets/images/add-home/home-add-icon.png'); background-repeat: no-repeat;background-size: 110%; ">
                     <div class="content-wrap">
                         <div class="content-body">

                         </div>
                     </div>
                 </div>
                 <div class="layer top">
                     <div class="content-wrap">
                     <div class="container p-lg-0">
                     <!-- start of size page-->
                   <div class="size-page">    
                   <div class="row">
                        <div class="col-12">
                            <div class="section-heading ml-5">
                                <h4 class="heading-title"><span class="heading-circle green"></span> What's the size of your home?</h4>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <div class="section-wrapper ml-5">
                            <h6>Surface Area (m sq.)</h6>
                            <div class="col-7">
                                <input type="number" min="1" class="form-control"  id="area" name="area" placeholder="78">
                            </div>
                            <br><br>
                            <div class="row">
                            <i class="fas fa-door-open fa-2x ml-5" style="color: #BDBBBB;"></i>
                            <h6 class="ml-5">Bedrooms</h6>
                            <button class="btn">
                                   <i id="bedroomsDownQuantity" onclick="" class='fa fa-minus-circle ml-5' style="color:#FD5555;font-size:30px"></i>
                                </button>
                                <h3 class="ml-5"><span name="bedrooms" id="bedrooms">1</span></h3>
                               <button class="btn">
                                   <i id="bedroomsUpQuantity" onclick="" class='fa fa-plus-circle ml-5' style="color:#FD5555;font-size:30px"></i>
                               </button>
                            </div>
                            <br><br>
                            <div class="row">
                            <i class="fas fa-bath fa-2x ml-5" style="color: #BDBBBB;"></i>
                            <h6 class="ml-5">Bathrooms</h6>
                            <button class="btn">
                                   <i id="bathroomsDownQuantity" onclick="" class='fa fa-minus-circle ml-5' style="color:#FD5555;font-size:30px"></i>
                                </button>
                                <h3 class="ml-5"><span name="bathrooms" id="bathrooms">1</span></h3>
                               <button class="btn">
                                   <i id="bathroomsUpQuantity" onclick="" class='fa fa-plus-circle ml-5' style="color:#FD5555;font-size:30px"></i>
                               </button>
                            </div>
                            <br><br>
                            <div class="row">
                            <i class="fas fa-users fa-2x ml-5" style="color: #BDBBBB;"></i>
                            <h6 class="ml-5">Occupancy</h6>
                            <button class="btn">
                                   <i id="occupancyDownQuantity" onclick="" class='fa fa-minus-circle ml-5' style="color:#FD5555;font-size:30px"></i>
                                </button>
                                <h3 class="ml-5"><span name="occupancy" id="occupancy">1</span></h3>
                               <button class="btn">
                                   <i id="occupancyUpQuantity" onclick="" class='fa fa-plus-circle ml-5' style="color:#FD5555;font-size:30px"></i>
                               </button>
                            </div> 
                             <br><br>
                            <div class="row">
                            <div class="prev ml-4">
                                 <a href="#">Previous</a>
                           </div>
                           <div class="next">
                                 <a href="#">Next</a>
                           </div>
                            </div>
                             </div>
                           </div>
                        </div>
                       <br>
                    </div>
                    </div>
                    
                    <!-- end of size page-->
                </div> 
                     </div>
                 </div>
            </section>


            <section class="skewed form-step" id="wrapper">
                 <div class="layer bottom" style="background-image:url('assets/images/add-home/home-add-icon.png'); background-repeat: no-repeat;background-size: 110%; ">
                     <div class="content-wrap">
                         <div class="content-body">

                         </div>
                     </div>
                 </div>
                 <div class="layer top">
                     <div class="content-wrap">
                     <div class="container p-lg-0">

                     <!-- start of features page-->
                    <div class="features-page">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-heading ml-5">
                                <h4 class="heading-title"><span class="heading-circle green"></span> What facilities does your home have?</h4>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <div class="row">
                        <label class="radio_item ml-5">
                        <input type="checkbox" name="swimming" id="swimming" class="checkbox">
                        <div class="option_inner swimming">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fas fa-swimming-pool fa-2x"></i></div>
                            <div class="name">Swimming Pool</div>
                        </div>
                        </label>
                        <label class="radio_item">
                        <input type="checkbox" name="wifi" id="wifi" class="checkbox">
                        <div class="option_inner wifi">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fas fa-wifi fa-2x"></i></div>
                            <div class="name">WiFi</div>
                        </div>
                        </label>
                        <label class="radio_item">
                        <input type="checkbox" name="tv" id="tv" class="checkbox">
                        <div class="option_inner tv">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fas fa-tv fa-2x"></i></div>
                            <div class="name">TV</div>
                        </div>
                        </label>
                        <label class="radio_item">
                        <input type="checkbox" name="workers" id="workers" class="checkbox">
                        <div class="option_inner workers">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fas fa-user-friends fa-2x"></i></div>
                            <div class="name">Home Workers</div>
                        </div>
                        </label>
                     </div>                             
                     <div class="row">
                     <label class="radio_item ml-5">
                        <input type="checkbox" name="wheelchair" id="wheelchair" class="checkbox">
                        <div class="option_inner wheelchair">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fab fa-accessible-icon"></i></div>
                            <div class="name">Wheelchair Accessible</div>
                        </div>
                        </label>
                        <label class="radio_item">
                        <input type="checkbox" name="garden" id="garden" class="checkbox">
                        <div class="option_inner garden">
                            <div class="tickmark"></div>
                            <div class="icon"><h2>G</h2></div>
                            <div class="name">Garden</div>
                        </div>
                        </label>
                        <label class="radio_item">
                        <input type="checkbox" name="parking" id="parking" class="checkbox">
                        <div class="option_inner parking">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fas fa-parking fa-2x"></i></div>
                            <div class="name">Private Parking</div>
                        </div>
                        </label>
                        <label class="radio_item">
                        <input type="checkbox" name="gym" id="gym" class="checkbox">
                        <div class="option_inner gym">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fas fa-dumbbell fa-2x"></i></div>
                            <div class="name">Private Gym</div>
                        </div>
                        </label>
                     </div>
                     <div class="row">
                     <label class="radio_item ml-5">
                        <input type="checkbox" name="kids" id="kids" class="checkbox">
                        <div class="option_inner kids">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fas fa-child fa-2x"></i></div>
                            <div class="name">Kids Friendly</div>
                        </div>
                        </label>
                        <label class="radio_item">
                        <input type="checkbox" name="security" id="security" class="checkbox">
                        <div class="option_inner security">
                            <div class="tickmark"></div>
                            <div class="icon"><i class="fas fa-shield-alt fa-2x"></i></div>
                            <div class="name">Security</div>
                        </div>
                        </label>
                        <label class="radio_item">
                        <input type="checkbox" name="ac" id="ac" class="checkbox">
                        <div class="option_inner ac">
                            <div class="tickmark"></div>
                            <div class="icon"><h2>AC</h2></div>
                            <div class="name">Air Con.</div>
                        </div>
                        </label>
                     </div>
                     <br>
                     <div class="row">
                           <div class="col-6">
                               <div class="ios-switch ml-5">
                                <label><h6>Pets Allowed?</h6></label>
                                    <div class="switch-body">
                                        <div class="toggle">

                                        </div>
                                    </div>
                                    <input type="checkbox" name="pets">
                                </div>
                           </div>
                           <div class="col-6">
                               <div class="ios-switch ml-n5">
                                <label><h6>Smokers Allowed?</h6></label>
                                    <div class="switch-body">
                                        <div class="toggle">

                                        </div>
                                    </div>
                                    <input type="checkbox" name="smokers">
                                </div>
                           </div>
                     </div>     
                    
                    <div class="row">
                    <div class="prev ml-5">
                            <a href="#">Previous</a>
                    </div>
                    <div class="next">
                            <a href="#">Next</a>
                    </div>
                    </div>
                     </div>
                           </div>
                        </div>
                       <br>
                    </div>
                    </div>
                    <!-- end of features page-->
                </div> 
                     </div>
                 </div>
            </section>


            <section class="skewed form-step" id="wrapper">
                 <div class="layer bottom" style="background-image:url('assets/images/add-home/home-add-icon.png'); background-repeat: no-repeat;background-size: 110%; ">
                     <div class="content-wrap">
                         <div class="content-body">

                         </div>
                     </div>
                 </div>
                 <div class="layer top">
                     <div class="content-wrap">
                     <div class="container p-lg-0">

                    <!-- start of description page-->
                  <div class="description-page">
                     <div class="row">
                        <div class="col-12">
                            <div class="section-heading ml-5">
                                <h4 class="heading-title"><span class="heading-circle green"></span> Give a good description of your home</h4>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <div class="section-wrapper ml-5">
                            <h6>Title</h6>
                            <div class="col-8">
                                <input type="text" class="form-control"  id="title" name="title" placeholder="Christine's Spectacular Beach House" required>
                            </div>
                            <br>
                            <h6>Description</h6>
                            <div class="col-8">
                            <textarea id="description" class="form-control" name="description" rows="8" cols="30" required></textarea>
                            </div>
                            <br>
                            <h6>Insert an image of your house</h6>
                            <div class="col-6">
                            <input type="file" class="form-control" id="house-image" name="house-image" required>
                            </div>
                           </div> 
                            <br><br>
                            <div class="row">
                            <div class="col-6">
                            <div class="prev ml-5">
                                 <a href="#">Previous</a>
                           </div>
                            </div>
                            <div class="col-6">
                           <div class="submit">
                                 <input type="submit" value="Complete" style="background-color: #FD5555;" class="btn btn-danger rounded-pill ml-3"/>
                           </div>
                           </div>
                            </div>
                       </div>
                           </div>
                        </div>
                       <br>
                    </div>
                    </div>
                <!-- end of description page-->
                </div> 
                     </div>
                 </div>
            </section>
    
<?php
    include('footer.php');
?>