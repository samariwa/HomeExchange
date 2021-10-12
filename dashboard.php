<?php
include('header.php');
//echo $message;
?>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card" style="border-radius:3%;border-bottom: 3px solid #FD5555;">
                            <a href="add-home.php">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 mt-4">
                                            <i class="fas fa-home fa-4x ml-4" style="color:#FD5555"></i>
                                        </div>
                                        <div class="col-sm-9">
                                            <h5 class="card-title" style="color:#FD5555">ADD HOME</h5>
                                            <p class="card-text">To make an exchange add a home...Lorem ipsum dolor sit amet consectetur </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card" style="border-radius:3%;border-bottom: 3px solid #FD5555;">
                            <a href="holiday-requirements.php">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 mt-4">
                                            <i class="fas fa-exchange-alt fa-4x ml-4" style="color:#FD5555"></i>
                                        </div>
                                        <div class="col-sm-9">
                                            <h5 class="card-title" style="color:#FD5555">SWAP HOLIDAY HOME</h5>
                                            <p class="card-text">Make a holiday home swap for free or get a home using exchange points...</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="container">
                <div class="section-heading">
                    <h4 class="heading-title"><span class="heading-circle green"></span> Our top destinations</h4>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        <a href="#" ><div class="top-destination-text">Mombasa</div><img src="assets/images/destinations/mombasa.jpeg" style="border-radius:10%" alt="mombasa"></a>
                    </div>
                    <div class="col-lg-4">
                        <a href="#"><div class="top-destination-text">Narok</div><img src="assets/images/destinations/narok.jpeg" style="border-radius:10%" alt="narok"></a>
                    </div>
                    <div class="col-lg-4">
                        <a href="#"><div class="top-destination-text">Nanyuki</div><img src="assets/images/destinations/nanyuki.jpeg" style="border-radius:10%" alt="nanyuki"></a>
                    </div>
                </div>
            </div>

            <!-- featured product-section start -->
            <section class="trending-product-section">
                <div class="container">
                    <div class="section-heading">
                        <h4 class="heading-title"><span class="heading-circle"></span> Available homes you might like</h4>
                    </div>

                    <div class="section-wrapper">
                        <!-- Add Arrows -->
                        <div class="slider-btn-group">
                            <div class="slider-btn-prev trending-slider-prev">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 443.52 443.52" style="enable-background:new 0 0 443.52 443.52;" xml:space="preserve"><g><path d="M143.492,221.863L336.226,29.129c6.663-6.664,6.663-17.468,0-24.132c-6.665-6.662-17.468-6.662-24.132,0l-204.8,204.8
                        c-6.662,6.664-6.662,17.468,0,24.132l204.8,204.8c6.78,6.548,17.584,6.36,24.132-0.42c6.387-6.614,6.387-17.099,0-23.712
                        L143.492,221.863z"/></g></svg>
                            </div>
                            <div class="slider-btn-next trending-slider-next">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002;" xml:space="preserve"><g><path d="M388.425,241.951L151.609,5.79c-7.759-7.733-20.321-7.72-28.067,0.04c-7.74,7.759-7.72,20.328,0.04,28.067l222.72,222.105
                        L123.574,478.106c-7.759,7.74-7.779,20.301-0.04,28.061c3.883,3.89,8.97,5.835,14.057,5.835c5.074,0,10.141-1.932,14.017-5.795
                        l236.817-236.155c3.737-3.718,5.834-8.778,5.834-14.05S392.156,245.676,388.425,241.951z"/></g></svg>
                            </div>
                        </div>
                        <div class="mlr-20">
                            <div class="trending-product-container">
                                <div class="swiper-wrapper">
                               <div class="swiper-slide">
                                        <div class="product-item ">

                                            <div class="product-thumb">
                                                <!--you can add this onclick to anchor tag below when necessary-->
                                                <!--onclick="openModal()"-->
                                                <a ><img src="assets/images/homes/home1.jpeg" alt="product"></a>
                                                <span class="batch sale">In 2 days</span>
                                            <a class="wish-link"
                                            href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/index.php?action=add_wishlist&id='.$row['id'] ?>">
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
                                               
                                            </a>
                                            </div>
                                            <div class="product-content">
                                            <a href="home-dashboard.php" class="cata">Tier 3</a>
                                            <h6><a href="home-dashboard.php" class="product-title">XXX's Home</a></h6>
                                            <p class="quantity">Likoni</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                            <div class="price">Ratings</div><?php rate(3); ?>                        
                                            </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center pt-3">
                                <a href="homes-list.php" class="more-product-btn">More Homes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- featured product-section end -->
<?php
include('footer.php');
?>


