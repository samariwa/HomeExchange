<?php
  include('header.php');
$profile_details = mysqli_query($connection,"SELECT first_name,last_name,email_address,physical_address,phone_number FROM users where email_address = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['first_name'];
$lastname = $result['last_name'];
$mobile = $result['phone_number'];
$email = $result['email_address'];
$location = $result['physical_address'];
?>
            <!-- page-header-section start -->
            <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-start">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li><span>/</span></li>
                                <li>Wishlist</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->
          <?php  //echo $message;  ?>
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
                        <li><a  href="my-homes.php#dashboard-nav">My Homes</a></li>
                        <li><a  href="my-exchanges.php#dashboard-nav">My Exchanges</a></li>
                        <li><a href="profile.php#dashboard-nav"><i class="far fa-user"></i>My Profile</a></li>
                        <li><a class="active" href="wishlist.php#dashboard-nav"><i class="far fa-heart"></i>My Wish List</a></li>
                    </ul>
                </div>

                <div class="container">
                    <div class="dashboard-body wishlist">
                        <div class="wishlist-header">
                            <h6>My Wish List</h6>
                        </div>
                        <div class="wish-list-container">
                        <?php
                        $total = 0;
                        $wishlist_checker = mysqli_query($connection,"SELECT h.id AS id,h.name as Name,home_image,h.address as address,h.home_tier as tier FROM `wishlist` inner join homes h on wishlist.home_id = h.id WHERE wishlist.customer_id='$customer_id';");
                        $wishlist_count = mysqli_num_rows($wishlist_checker);
                        foreach($wishlist_checker as $row)
                       {
                        ?>
                            <div class="wishlist-item product-item d-flex align-items-center <?php if($row['Quantity'] < $row['Restock_Level'] ){ ?>stock-out<?php }?>">
                                <span class="close-item"><a href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/wishlist.php?action=wishlist_delete&id='.$row["id"] ?>" class="ml-5 text-danger">Remove <i class="fas fa-times"></i></a></span>
                                <div class="thumb">
                                <?php if($row["Discount"] > 0){?><span class="batch sale">Sale</span><?php } ?>
                                    <a onclick="openModal()"><img src="assets/images/homes/<?php echo $row["home_image"]; ?>" width="200px" height="170px" alt="products"></a>
                                </div>
                                <div class="product-content">
                                    <a href="product-detail.php" class="product-title"><?php echo $row["Name"]; ?></a>
                                    <div class="product-cart-info">
                                    <?php echo $row["address"]; ?>
                                    </div>
                                    <div class="product-price">
                                    <?php if($row['Discount'] > 0){ ?> <del>Ksh<?php echo number_format($row["Price"],2); ?> /unit</del> <br><?php }?>
                                       Ksh<?php echo number_format($row["Price"] - $row["Discount"],2); ?> /unit
                                    </div>
                                    <div class="cart-btn-toggle">
                                    <button type="submit" class="cart-btn" name="cart_button">
                                        <span ><i class="fas fa-eye"></i> View</span>
                                    </button>

                                    </div>           
                                </div>
                            </div>
                    <?php     
                    }
                    ?>
                        </div>
                    </div>
                        <a <?php if($wishlist_count == 0){?> href="#" <?php } else{ ?>href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/wishlist.php?action=wishlist-clear' ?>" <?php } ?>  style=" background-color: #df4759;color: white;display: block;text-align: center;padding: 10px 30px;border-radius: 5px;margin-top: 10px;">Clear Wishlist</a>
                </div>
            </section>
            <!-- dashboard-section end -->
<?php
  include('footer.php');
?>