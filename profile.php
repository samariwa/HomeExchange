<?php
include('header.php');
$profile_details = mysqli_query($connection,"SELECT first_name,other_name,last_name,email_address,physical_address,phone_number FROM users where email_address = '$logged_in_email' ")or die($connection->error);
$result = mysqli_fetch_array($profile_details);
$firstname = $result['first_name'];
$othername = $result['other_name'];
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
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>My Profile</li>
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
                        <li><a  href="my-homes.php#dashboard-nav">My Homes</a></li>
                        <li><a  href="my-exchanges.php#dashboard-nav">My Exchanges</a></li>
                        <li><a class="active" href="profile.php#dashboard-nav"><i class="far fa-user"></i>My Profile</a></li>
                        <li><a href="wishlist.php#dashboard-nav"><i class="far fa-heart"></i>My Wish List</a></li>
                    </ul>
                </div>

                <div class="container">
                    <div class="dashboard-body">
                        <div class="profile">
                            <h5 class="title">Your Profile <span title="Edit Profile" id="edit" class="edit" data-toggle="modal" data-target="#edit-form1"><i class="fas fa-edit" onclick="OpenSignUpForm()"></i></span></h5>

                            <ul class="list-profile-info list-unstyled">
                                <li>
                                    <span class="title">Your Name</span>
                                    <span class="desc"><?php echo $firstname.' '.$othername.' '.$lastname; ?></span>
                                </li>
                                <li>
                                    <span class="title">Email</span>
                                    <span class="desc"><?php echo $email; ?></span>
                                </li>
                                <li>
                                    <span class="title">Mobile</span>
                                    <span class="desc"><?php echo $mobile; ?></span>
                                </li>
                                <li>
                                    <span class="title">Physical Address</span>
                                    <span class="desc"><?php echo $location; ?>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </section>
            <section id="login-area" class="login-area">
        <div onclick="CloseSignUpForm()" class="overlay"></div>
        <div class="login-body-wrapper">
            <div class="login-body">
                <div class="close-icon" onclick="CloseSignUpForm()">
                    <i class="fas fa-times"></i>
                </div>
                <div class="login-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="login-content">
                    <form method="POST" class="login-form">
                        <input type="text" name="firstname" id="firstname" placeholder="First Name" value="<?php echo $firstname; ?>">
                        <input type="text" name="othername" id="othername" placeholder="Other Name" value="<?php echo $othername; ?>">
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>">
                        <input type="email" name="email" id="email" placeholder="Email Address" value="<?php echo $email; ?>">
                        <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" value="<?php echo $mobile; ?>">
                        <input type="text" name="location" id="location" placeholder="Physical Address" value="<?php echo $location; ?>">
                        <input type="hidden" id="old_email" name="old_email" value="<?php echo $email; ?>">
                        <input type="hidden" name="where" id= "where"  value="customerProfile">
                        <input type="hidden" class="profile_token" id="token" name="token">
                        <button type="submit" class="submit editProfile">Save Changes</button>
                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </section>
            <!-- dashboard-section end -->
<?php
    include('footer.php');
?>