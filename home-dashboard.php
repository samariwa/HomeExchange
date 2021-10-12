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
                                <li>Home Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->
            <div id="actionAlert">
              <?php //echo $message; ?>
            </div>

            <!-- banner-section start -->
            <section class="banner-section bg-img3 d-flex align-items-center" style="background-image:url('assets/images/homes/home1.jpeg');background-repeat: no-repeat;background-size: 100%;">
                <div class="banner-content-area" >
                    <div class="container">
                        <div class="banner-content">
                           
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-section end -->
           
            <section class="catagory-section homepage-stats">
                <div class="container col-12 p-lg-0 row">
                    <div class="col-10">
                        <div class="col-12 row">          
                                <div class="col-5 ml-5">
                                    <h2>XXX's Home</h2>
                                </div>
                                <div class="col-5 ml-5">
                                    <h6><a class="wish-link"
                                    href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/index.php?action=add_wishlist&id='.$row['id'] ?>">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path
                                        <?php
                                        //if($item_in_wishlist == true){
                                            //fill with red
                                        ?>
                                        style="fill:;"
                                        <?php
                                        // }
                                        ?>
                                    d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                
                                    </a> Add to Wishlist</h6>
                                </div>
                        </div>
                        <br>
                        <div class=" col-12 row">
                            <div class="col-5 ml-5">
                                    <h6>Kenya > Mombasa > Likoni</h6>
                            </div>
                            <div class="col-5 ml-5">
                                <h6>Ratings   <?php rate(3) ?></h6>
                            </div>
                        </div>
                        <br>
                        <div class="col-12 row">
                            <div class="col-5 ml-5">
                                    <h6>Next Availability: 12 Dec - 22 Dec 2021</h6>
                            </div>
                            <div class="col-5">
                                <div class="make-reservation ml-5">
                                    <a href="#">Make Reservation</a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                    </div>
                    <div class="col-2">
                        <div class="card home-owner-card ml-n5 mt-n5" style="width: 18rem;height: 28rem;">
                            <div class="card-body">
                                <h5 class="card-title">Home Owner</h5>
                                <br>
                                <h6 class="card-subtitle mb-2">XXX Name</h6>
                                <br><br>
                                <h6 class="card-subtitle mb-2">12 Exchanges</h6>
                                <br><br>
                                <h6 class="card-subtitle mb-2">Ratings <?php rate(4) ?></h6>
                                <br><br>
                                <h6 class="card-subtitle mb-2 text-center"><i class="fas fa-phone"></i> 07XX XXX XXX</h6>
                                <br>
                                <div class="text-center">
                                    <div class="home-owner-contact">
                                        <a href="tel:<?php echo $contact_number; ?>">Contact</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                      
            </section>

            <section class="catagory-section  mt-n5">
                <div class="container col-12 p-lg-0 home-dash-features row">
                   <div class="col-3 text-center">
                        <i class="fas fa-home fa-3x" style="color: #BDBBBB;"></i>
                        <h6>House</h6>
                   </div>
                   <div class="col-3 text-center">
                       <h2>3</h2>
                        <h6>Bedrooms</h6>
                   </div>
                   <div class="col-3 text-center">
                       <h2>5</h2>
                        <h6>Occupancy</h6>
                   </div>
                   <div class="col-3 text-center">
                       <h2>80</h2>
                        <h6>m sq</h6>
                   </div>
                </div>
            </section>

             <!-- category section start -->
<?php
    include('footer.php');
?>