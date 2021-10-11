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
                                <li>Homes List</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->
            <div id="actionAlert">
              <?php //echo $message; ?>
            </div>
            <!-- page-content -->
            <section class="page-content section-ptb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 sidebar order-lg-first">
                            <div class="widget widget-head">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Filter</h6>
                                    <a href="product-list.php" id="clear_filter">Clear All</a>
                                </div>
                            </div>
                            <div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Filter by:</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget01" role="button" aria-expanded="false" aria-controls="scatagory-widget01">Categories<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget01">
                                    <ul class="catagory-menu collapse show" id="catagory-main">   
                                        <li><a class="collapsed"  data-toggle="collapse" href="#catagory-widget-s1" role="button" aria-expanded="false" aria-controls="catagory-widget-s1">Location<span class="plus-minus"></span></a>
                                            <ul class="catagory-submenu collapse" id="catagory-widget-s1">

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="2" value="erfer">
                                                    <span class="checkbox" value="refre<?php //echo $row2['Name']; ?>"></span>
                                                    <span class="label">Nairobi<?php //echo $row2['Name']; ?></span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="2" value="erfer">
                                                    <span class="checkbox" value="refre<?php //echo $row2['Name']; ?>"></span>
                                                    <span class="label">Mombasa<?php //echo $row2['Name']; ?></span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="2" value="erfer">
                                                    <span class="checkbox" value="refre<?php //echo $row2['Name']; ?>"></span>
                                                    <span class="label">Nanyuki<?php //echo $row2['Name']; ?></span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="2" value="erfer">
                                                    <span class="checkbox" value="refre<?php //echo $row2['Name']; ?>"></span>
                                                    <span class="label">Narok<?php //echo $row2['Name']; ?></span>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>

                                    <ul class="catagory-menu collapse show" id="catagory-main">   
                                        <li><a class="collapsed"  data-toggle="collapse" href="#catagory-widget-s2" role="button" aria-expanded="false" aria-controls="catagory-widget-s2">Home Features<span class="plus-minus"></span></a>
                                            <ul class="catagory-submenu collapse" id="catagory-widget-s2">

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="2" value="erfer">
                                                    <span class="checkbox" value="refre<?php //echo $row2['Name']; ?>"></span>
                                                    <span class="label">Swimming Pool<?php //echo $row2['Name']; ?></span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="2" value="erfer">
                                                    <span class="checkbox" value="refre<?php //echo $row2['Name']; ?>"></span>
                                                    <span class="label">Security<?php //echo $row2['Name']; ?></span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="2" value="erfer">
                                                    <span class="checkbox" value="refre<?php //echo $row2['Name']; ?>"></span>
                                                    <span class="label">Private Garden<?php //echo $row2['Name']; ?></span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="category_selector" id="2" value="erfer">
                                                    <span class="checkbox" value="refre<?php //echo $row2['Name']; ?>"></span>
                                                    <span class="label">Private Gym<?php //echo $row2['Name']; ?></span>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Filter by ratings</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget02" role="button" aria-expanded="false" aria-controls="scatagory-widget02">Filter by ratings<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget02">
                                    <div class="range-slider">
                                        <input type="text" class="js-range-slider" value="" />
                                        <input type="hidden" id="hidden_minimum_price" value="0"/>
                                        <input type="hidden" id="hidden_maximum_price" value="5"/>
                                        <input type="hidden" class="organization_name" value="<?php echo $organization; ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-9 order-lg-last">
                            <div class="row product-list">
                            <?php
                               // foreach($stockList as $row){
                            ?> 
                                <div class="col-sm-6 col-xl-4" id="kjgj">
                                    <div class="product-item <?php //if($row['Quantity'] < $row['Restock_Level'] ){ ?> cancelled <?php //}?>" id="<?php //echo $row['Name']; ?>">
                                        <div class="product-thumb">
                                            <a  class="modalOpen" id="<?php echo $row['id']; ?>"><img src="assets/images/homes/home2.jpeg" alt="product"></a> 

                                            <a class="wish-link"
                                            href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/Home-list.php?action=add_wishlist&id='.$row['id'] ?>">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path
                                                    <?php
                                                      // if($item_in_wishlist == true){
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
                                            <a href="home-dashboard.php" class="cata" id="itemCategory<?php //echo $row['id']; ?>">Tier 1</a>
                                            <h6><a href="home-dashboard.php" class="product-title">YYY's Home</a></h6>
                                            <p class="quantity">Nanyuki</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">Ratings</div><?php rate(5); ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <?php
                             //   }  
                                ?>


                                 <div class="col-sm-6 col-xl-4" id="kjgj">
                                 <div class="product-item ">

                                    <div class="product-thumb">
                                            <!--you can add this onclick to anchor tag below when necessary-->
                                            <!--onclick="openModal()"-->
                                            <a ><img src="assets/images/homes/home1.jpeg" alt="product"></a>
                                            <span class="batch sale">In 2 days</span>
                                            <a class="wish-link"
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
                                <!--<div class="col-12 text-center mt-4">
                                    <button class="loadMore">Load More</button>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- page-content -->
<?php
    include('footer.php');
?>