<?php
 include('header.php');
$profile_details = mysqli_query($connection,"SELECT first_name,last_name,email_address,physical_address,phone_number FROM users where email_address = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['first_name'];
$lastname = $result['last_name'];
$mobile = $result['phone_number'];
$email = $result['email_address'];
$location = $result['physical_address'];
$owner_id = mysqli_query($connection,"SELECT home_owners.id as id FROM users INNER JOIN home_owners ON users.id = home_owners.user_id where email_address = '$logged_in_email' ")or die($connection->error);
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
                                <li>My Homes</li>
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
                        <li><a class="active" href="my-homes.php#dashboard-nav">My Homes</a></li>
                        <li><a  href="my-exchanges.php#dashboard-nav">My Exchanges</a></li>
                        <li><a href="profile.php#dashboard-nav"><i class="far fa-user"></i>My Profile</a></li>
                        <li><a href="wishlist.php#dashboard-nav"><i class="far fa-heart"></i>My Wish List</a></li>
                    </ul>
                </div>

                <div class="container">
                    <div class="dashboard-body bg-color-white p-4 p-md-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="order-head mb-3">
                                    <h5 class="offset-2">My Homes</h5>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="orders-container offset-2">
                                <?php
                                $ownership_result = mysqli_fetch_array($owner_id);
                                if($ownership_result == FALSE)
                                {
                                ?>
                                  <p style="text-align:center"><i><b>You have not added any home yet.</b></i></p>
                                <?php
                                    }
                                    else{
                                        $home = new Home();
                                        $my_homes = mysqli_query($connection,$home->getUserHomes( $ownership_result['id']))or die($connection->error);
                                    foreach($my_homes as $row){
                                    ?>
                                    <div class="order-item">
                                        <table class="table table-responsive1">
                                            <thead>
                                                <tr>
                                                    <th class="px-3"><?php echo $row ['name']; ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="px-3 py-4">
                                                        <div>
                                                        <a href="home-dashboard.php"><img src="assets/images/homes/<?php echo $row['home_image']; ?>" alt="product"></a>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        
                                                    </td>
                                                    <td class="text-right pr-5">
                                                        <div >
                                                            <h6 class="order-number">Home#<?php echo $row ['id']?></h6>
                                                            <p class="tier">Tier:<?php echo $row ['home_tier']; ?></p>
                                                            <p class="rating">Rating: <?php rate($row ['average_rating'])  ?></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3">
                                                        <div>
                                                            <a data-toggle="modal" data-target="#exampleModalScrollable<?php echo $row ['id']?>" role="button" aria-pressed="true">Add Availability</a>
                                                            <div class="modal fade" id="exampleModalScrollable<?php echo $row ['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Home Availability</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                    <label for="start_date" style="margin-left: 60px;">Start Date:</label>    
                                                                    <input type="date" min="<?php echo date('Y-m-d'); ?>" name="start_date" id="start_date<?php echo $row ['id']?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" required  placeholder="Start Date...">
                                                                    </div><br>
                                                                    <div class="row">
                                                                    <label for="end_date" style="margin-left: 60px;">End Date:</label>
                                                                        <input type="date" min="<?php echo date('Y-m-d'); ?>" name="end_date" id="end_date<?php echo $row ['id']?>" class="form-control col-md-9"  style="padding:15px;margin-left: 60px" required placeholder="End Date...">
                                                                    </div><br> 
                                                                    <div class="row">
                                                                    <label for="extra_details" style="margin-left: 60px;">Extra Details:</label>
                                                                    <textarea id="extra-details<?php echo $row ['id']?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" name="extra-details"></textarea>
                                                                    </div><br>
                                                                    <input type="hidden" name="home_id" id="home_id<?php echo $row ['id']?>"  value="<?php echo $row ['id']?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button class="btn btn-danger addAvailabilityDetails" role="button" aria-pressed="true" data_id="<?php echo $row ['id']?>" style="margin-right: 50px" id="<?php echo $row ['id'] ?>">Add Availability</button>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right px-4" colspan="2">
                                                        <div>
                                                            <a class="view-details" href="home-dashboard.php?id=<?php echo $row ['id']?>">View Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                    }
                                }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- dashboard-section end -->
 <?php
  include('footer.php');
?>