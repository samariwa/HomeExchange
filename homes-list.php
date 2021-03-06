<?php
  include('header.php');
  if(isset($_GET['requirements-search']))
  {
    if($_GET['requirements-search'] == true)
    {
        $cookie = new CookieManager();
        $home = new Home();
        $requirements = $cookie->get('requirements');
        $requirements = json_decode($requirements, true);
        $availableHomesList =  mysqli_query($connection,$home->searchAvailableHomes($requirements['swimming'], $requirements['wifi'], $requirements['tv'], $requirements['ac'], $capacity, $requirements['gym'], $requirements['parking'], $requirements['wheelchair'], $requirements['pets'], $requirements['kids'], $workers, $requirements['security'], $requirements['garden'], $requirements['smokers'], $requirements['county'], $requirements['subcounty'], $requirements['end_date']))or die($connection->error);
        $availableHomesCount =  mysqli_num_rows($availableHomesList);
    }
  }
  if(isset($_GET['location']))
  {
        $home = new Home();
        $availableHomesList =  mysqli_query($connection,$home->fetchHomesInLocation($_GET['location']))or die($connection->error);
        $availableHomesCount =  mysqli_num_rows($availableHomesList);
  }
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
              <?php echo $message; ?>
            </div>
            <!-- page-content -->
            <section class="page-content section-ptb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 sidebar order-lg-first">
                            <div class="widget widget-head">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Filter</h6>
                                    <a href="homes-list.php" id="clear_filter">Clear All</a>
                                </div>
                            </div>
                            <div class="widget">
                                <h4 class="widget-title d-none d-lg-block">Filter by:</h4>
                                <a class="widget-title d-lg-none" data-toggle="collapse" href="#scatagory-widget01" role="button" aria-expanded="false" aria-controls="scatagory-widget01">Categories<i class="fas fa-angle-down"></i></a>

                                <div class="widget-wrapper" id="scatagory-widget01">
                                    <ul class="catagory-menu collapse show" id="catagory-main">   
                                        <li><a class="collapsed"  data-toggle="collapse" href="#catagory-widget-s1" role="button" aria-expanded="false" aria-controls="catagory-widget-s1">County<span class="plus-minus"></span></a>
                                            <ul class="catagory-submenu collapse" id="catagory-widget-s1">
                                            <?php                              
                                                foreach($countyList as $row){
                                            ?>
                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="county_selector" id="<?php echo $row['id']; ?>" value="<?php echo $row['county']; ?>">
                                                    <span class="checkbox" value="<?php echo $row['county']; ?>"></span>
                                                    <span class="label"><?php echo $row['county']; ?></span>
                                                </li>
                                            <?php
                                                }
                                            ?>
                                            </ul>
                                        </li>
                                    </ul>

                                    <ul class="catagory-menu collapse show" id="catagory-main">   
                                        <li><a class="collapsed"  data-toggle="collapse" href="#catagory-widget-s2" role="button" aria-expanded="false" aria-controls="catagory-widget-s2">Home Features<span class="plus-minus"></span></a>
                                            <ul class="catagory-submenu collapse" id="catagory-widget-s2">

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="swimming_pool">
                                                    <span class="checkbox" value="swimming_pool"></span>
                                                    <span class="label">Swimming Pool</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="security_guard">
                                                    <span class="checkbox" value="security_guard"></span>
                                                    <span class="label">Security</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="private_garden">
                                                    <span class="checkbox" value="private_garden"></span>
                                                    <span class="label">Private Garden</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="private_gym">
                                                    <span class="checkbox" value="private_gym"></span>
                                                    <span class="label">Private Gym</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="wheelchair_accessibility">
                                                    <span class="checkbox" value="wheelchair_accessibility"></span>
                                                    <span class="label">Wheelchair Accessible</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="parking">
                                                    <span class="checkbox" value="parking"></span>
                                                    <span class="label">Private Parking</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="wifi">
                                                    <span class="checkbox" value="wifi"></span>
                                                    <span class="label">WiFi</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="tv">
                                                    <span class="checkbox" value="tv"></span>
                                                    <span class="label">TV</span>
                                                </li>
                                                
                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="ac">
                                                    <span class="checkbox" value="ac"></span>
                                                    <span class="label">AC</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="kids_friendly">
                                                    <span class="checkbox" value="kids_friendly"></span>
                                                    <span class="label">Kids Friendly</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="home_workers">
                                                    <span class="checkbox" value="home_workers"></span>
                                                    <span class="label">Home Workers</span>
                                                </li>

                                                <li class="checkbox-item">
                                                    <input type="checkbox" class="feature_selector" id="2" value="smokers_allowed">
                                                    <span class="checkbox" value="smokers_allowed"></span>
                                                    <span class="label">Smokers Allowed</span>
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
                            if($availableHomesCount == 0)
                            {
                             ?>
                             <h3 class="mt-5 ml-5" style="color:#FD5555;"><i class="far fa-frown"></i> Home not found</h3>
                             <?php
                            }
                            else{ 
                                foreach($availableHomesList as $row){
                            ?> 
                                <div class="col-sm-6 col-xl-4" id="<?php echo $row['home_id']; ?>">
                                    <div class="product-item <?php if($row['home_availability_status'] == 2 ){ ?> reserved <?php }?>" id="<?php echo $row['home_id']; ?>">
                                        <div class="product-thumb">
                                            <a  href="home-dashboard.php?id=<?php echo $row['home_id'] ?>" class="modalOpen" id="<?php echo $row['home_id']; ?>"><img src="assets/images/homes/<?php echo $row['home_image']; ?>" alt="home"></a> 
                                           <?php
                                               $item_in_wishlist = '';
                                               $product_in_wishlist = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='$customer_id' AND home_id = '".$row['home_id']."'");
                                               $product_wishlist_result = mysqli_fetch_array($product_in_wishlist);
                                               if ( $product_wishlist_result == true) {
                                                   $item_in_wishlist = true;
                                                   $item_in_wishlist_id = $product_wishlist_result['home_id'];
                                               }
                                               else{
                                                   $item_in_wishlist = false;
                                               }
                                               $start_date = strtotime($row['availability_start_date']);
                                               $end_date = strtotime($row['availability_end_date']);
                                               $current_date = time();
                                               $diff_date = round(($start_date - $current_date) / (60 * 60 * 24));
                                               if($diff_date <= 10)
                                               {
                                                   if($diff_date == 1){
                                           ?>
                                                      <span class="batch sale">Tomorrow</span>
                                           <?php
                                                   }
                                                   elseif($diff_date > 1){
                                           ?>
                                           <span class="batch sale">In <?php echo $diff_date; ?> days</span>
                                           <?php
                                                   }
                                                   elseif($diff_date == 0){
                                                ?>
                                                 <span class="batch sale">Today</span>
                                                <?php
                                                   }
                                                   elseif(($diff_date < 0) && ($end_date > $current_date)){
                                                    ?>
                                                     <span class="batch sale">Available</span>
                                                    <?php
                                                       }
                                               }
                                           ?>
                                            <a class="wish-link"
                                            href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/homes-list.php?action=add_wishlist&id='.$row['home_id'] ?>">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path
                                                    <?php
                                                       if($item_in_wishlist == true){
                                                    ?>
                                                    style="fill:red;"
                                                     <?php
                                                       }
                                                     ?>
                                                d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                               
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <a href="home-dashboard.php?id=<?php echo $row['home_id'] ?>" class="cata" id="itemCategory<?php echo $row['home_id']; ?>">Tier <?php echo $row['home_tier']; ?></a>
                                            <h6><a href="home-dashboard.php?id=<?php echo $row['home_id'] ?>" class="product-title"><?php echo $row['name']; ?></a></h6>
                                            <p class="quantity"><i class="fas fa-map-marker-alt"></i> <?php echo $row['county']; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">Ratings</div><?php  rate($row['average_rating']); ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <?php
                                }  
                               }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- page-content -->
<?php
    include('footer.php');
?>