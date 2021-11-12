<?php
    include('header.php');
    $profile_details = mysqli_query($connection,"SELECT first_name,last_name,email_address,physical_address,phone_number FROM users where email_address = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['first_name'];
$lastname = $result['last_name'];
$mobile = $result['phone_number'];
$email = $result['email_address'];
$location = $result['physical_address'];
//$my_orders = mysqli_query($connection,"SELECT order_status.id as status_id,order_status.status as status,DATE(orders.Delivery_time) as order_date FROM order_status INNER JOIN orders ON orders.Status_id = order_status.id INNER JOIN customers ON orders.Customer_id = customers.id where orders.Customer_id = '$customer_id' GROUP BY order_status.id ORDER BY order_status.Created_at DESC")or die($connection->error);
?>
            <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-start">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li><span>/</span></li>
                                <li>My Exchanges</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->


            <!-- admin-page start -->
            <section class="admin-page-section d-flex align-items-center" style="background-image: url('assets/images/admin/dashboard-wallpaper.jpeg'); background-size: cover;">
                <div class="aps-wrapper w-100">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-start">
                            <div class="admin-content-area">
                                <div class="admin-thumb">
                                    <img src="assets/images/admin/thumbnail-avatar.png" alt="">
                                    <a href="#" class="image-change-option"><i class="fas fa-camera"></i></a>
                                </div>
                                <div class="admin-content">
                                    <h4 class="name"><?php echo $firstname.' '.$lastname; ?></h4>
                                    <p class="desc"><?php echo $email; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- admin-page end -->


            <!-- dashboard-section start -->
            <section id="dashboard-nav" class="dashboard-section">
            <div class="container">
                    <ul class="dashbord-nav d-lg-flex flex-wrap align-items-center justify-content-between">
                        <li><a href="my-homes.php#dashboard-nav">My Homes</a></li>
                        <li><a class="active" href="my-exchanges.php#dashboard-nav">My Exchanges</a></li>
                        <li><a href="profile.php#dashboard-nav"><i class="far fa-user"></i>My Profile</a></li>
                        <li><a href="wishlist.php#dashboard-nav"><i class="far fa-heart"></i>My Wish List</a></li>
                    </ul>
                </div>

                <div id="my-exchanges-section" class="container">
                    <?php
                    $request = new HomeExchangeRequest();
                    $my_requests = mysqli_query($connection,$request->GetUserExchanges($customer_id))or die($connection->error);
                    foreach($my_requests as $row){
                     ?>
                    <div class="track-order-item bg-color-white">
                        <div class="track-order-head">
                            <?php
                                if($row['request_response'] == 1)
                                {
                                    ?>
                                    <span class="badge badge-pill badge-success request-status-badge ml-4 mt-1">Complete</span>
                                    <?php
                                }
                                elseif($row['request_response'] == 0)
                                {
                                    ?>
                                    <span class="badge badge-pill badge-warning request-status-badge ml-4 mt-1">Pending</span>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="d-flex justify-content-between track-number-link align-items-center">
                            <div>
                                <h6 class="order-number">Exchange# <?php echo $row ['request_id']?></h6>
                                <p class="date">Exchange Period: <?php echo date('d.m.Y',strtotime($row ['exchange_start_date'])); ?> - <?php echo date('d.m.Y',strtotime($row ['exchange_end_date'])); ?></p>
                                <p class="price">Home used for exchange: <?php echo $row['name']; ?></p>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="order-details-head">
                                <h6>Exchange Details</h6>
                            </div>
                            <div class="order-details-container d-none d-md-block">
                            <?php
                                $other_party_details = mysqli_query($connection,$request->GetOtherPartyExchangeDetails($row['requester_home_id']))or die($connection->error); 
                                $row2 = mysqli_fetch_array($other_party_details);
                            ?>
                                <div class="order-details-item d-sm-flex flex-wrap text-center text-sm-left align-items-center justify-content-between">
                                    <div class="thumb d-sm-flex flex-wrap align-items-center">
                                        <a><img src="assets/images/homes/<?php echo $row2['image']; ?>" height="110" width="130" alt="home"></a>
                                        <div class="product-content">
                                            <a class="product-title"><?php echo $row2['name']; ?></a>
                                        </div>
                                    </div>
                                    
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            Tier <?php echo $row2['tier']; ?> 
                                        </div>
                                    </div>
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            <span class="ml-4"> <?php echo $row2['county'].', '.$row2['subcounty']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                              //  }
                                ?>

                            </div>

                        </div>
                        <div class="track-order-info">
                            <ul class="to-list">
                            <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title"><b>Home Owner:</b></span>
                                    <span class="desc"> <?php echo $row2['first_name'].' '.$row2['last_name']; ?></span>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title"><b>Owner Contact:</b></span>
                                    <span class="desc"> <?php echo $row2['phone_number']; ?></span>
                                </li>
                                <li class="inc-vat d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Exchange Points Transacted</span>
                                    <span class="desc"> <?php if(ExchangePoints($row2["tier"], $unit_of_exchange, $row["tier"]) > 0) {echo '+ ';}echo ExchangePoints($row2["tier"], $unit_of_exchange, $row["tier"]).' pts'; ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="delevary-time">
                            <p>Request Date - <?php echo date('l, F d, Y',strtotime($row['request_date'])); ?></p>
                        </div>
                        <div class="track-order-footer">
                            <p>Helpline - <a href="tel:<?php echo $contact_number; ?>">Call Us</a></p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    $requested_by_me = mysqli_query($connection,$request->GetMyRequests($customer_id))or die($connection->error);
                    foreach($requested_by_me as $row){
                     ?>
                    <div class="track-order-item bg-color-white">
                        <div class="track-order-head">
                        <?php
                                if($row['request_response'] == 1)
                                {
                                    ?>
                                    <span class="badge badge-pill badge-success request-status-badge ml-4 mt-1">Complete</span>
                                    <?php
                                }
                                elseif($row['request_response'] == 0)
                                {
                                    ?>
                                    <span class="badge badge-pill badge-warning request-status-badge ml-4 mt-1">Pending</span>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="d-flex justify-content-between track-number-link align-items-center">
                            <div>
                                <h6 class="order-number">Exchange# <?php echo $row ['request_id']?></h6>
                                <p class="date">Exchange Period: <?php echo date('d.m.Y',strtotime($row ['exchange_start_date'])); ?> - <?php echo date('d.m.Y',strtotime($row ['exchange_end_date'])); ?></p>
                                <p class="price">Home used for exchange: <?php echo $row['name']; ?></p>
                            </div>
                            <div>
                                <?php
                                 if($row['request_response'] == 0)
                                 {
                                ?>
                                <a href="#" id="<?php echo $row['request_id']; ?>" class="order-btn cancel-request">Cancel Request</a>
                                <?php
                                 }
                                ?>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="order-details-head">
                                <h6>Exchange Details</h6>
                            </div>
                            <div class="order-details-container d-none d-md-block">
                            <?php
                                $requests_other_party_details = mysqli_query($connection,$request->GetMyRequestsOtherUserDetails($row['request_id']))or die($connection->error); 
                                $row2 = mysqli_fetch_array($requests_other_party_details);
                            ?>
                                <div class="order-details-item d-sm-flex flex-wrap text-center text-sm-left align-items-center justify-content-between">
                                    <div class="thumb d-sm-flex flex-wrap align-items-center">
                                        <a><img src="assets/images/homes/<?php echo $row2['image']; ?>" height="110" width="130" alt="home"></a>
                                        <div class="product-content">
                                            <a class="product-title"><?php echo $row2['name']; ?></a>
                                        </div>
                                    </div>
                                    
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            Tier <?php echo $row2['tier']; ?> 
                                        </div>
                                    </div>
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            <span class="ml-4"> <?php echo $row2['county'].', '.$row2['subcounty']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                              //  }
                                ?>

                            </div>

                        </div>
                        <div class="track-order-info">
                            <ul class="to-list">
                            <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title"><b>Home Owner:</b></span>
                                    <span class="desc"> <?php echo $row2['first_name'].' '.$row2['last_name']; ?></span>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title"><b>Owner Contact:</b></span>
                                    <span class="desc"> <?php echo $row2['phone_number']; ?></span>
                                </li>
                                <li class="inc-vat d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Exchange Points Transacted</span>
                                    <span class="desc"> <?php if(ExchangePoints($row2["tier"], $unit_of_exchange, $row["tier"]) > 0) {echo '+ ';}echo ExchangePoints($row2["tier"], $unit_of_exchange, $row["tier"]).' pts'; ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="delevary-time">
                            <p>Request Date - <?php echo date('l, F d, Y',strtotime($row2['request_date'])); ?></p>
                        </div>
                        <div class="track-order-footer">
                            <p>Helpline - <a href="tel:<?php echo $contact_number; ?>">Call Us</a></p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                </div>
            </section>
            <!-- dashboard-section end -->
<?php
  include('footer.php');
?>