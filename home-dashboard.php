<?php
  include('header.php');
  $home = new Home();
  $requests = new HomeExchangeRequest();
  $this_home = mysqli_query($connection,$home->fetchHomeDetails($_GET['id']))or die($connection->error);
  $result = mysqli_fetch_array($this_home);
  $availability_details = mysqli_query($connection,$home->fetchAvailabilityDetails($_GET['id']))or die($connection->error);
  $availability_result = mysqli_fetch_array($availability_details);
  $request_details = mysqli_query($connection,$requests->getExchangeRequests($_GET['id']))or die($connection->error);
  $request_result = mysqli_fetch_array($request_details);
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
              <?php echo $message; ?>
            </div>

            <!-- banner-section start -->
            <section class="banner-section bg-img3 d-flex align-items-center" style="background-image:url('assets/images/homes/<?php echo $result['home_image'] ?>');background-repeat: no-repeat;background-size: 100%;">
                <div class="banner-content-area" >
                    <div class="container">
                        <div class="banner-content">
                           
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-section end -->
            <?php if($result['user_id'] != $customer_id){ ?>
            <section class="catagory-section homepage-stats">
                <div class="container col-12 p-lg-0 row">
                    <div class="col-10">
                        <div class="col-12 row">          
                                <div class="col-5 ml-5">
                                    <h2><?php echo $result['name'] ?></h2>
                                </div>
                                <?php
                                if($availability_result == TRUE)
                                   {
                                ?>
                                <div class="col-5 ml-5">
                                    <h6><a class="wish-link"
                                    href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/home-dashboard.php?action=add_wishlist&id='.$_GET['id'] ?>">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path
                                        <?php
                                        $item_in_wishlist = '';
                                        $product_in_wishlist = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='$customer_id' AND home_id = '".$_GET['id']."'");
                                        $product_wishlist_result = mysqli_fetch_array($product_in_wishlist);
                                        if ( $product_wishlist_result == true) {
                                            $item_in_wishlist = true;
                                            $item_in_wishlist_id = $product_wishlist_result['home_id'];
                                        }
                                        else{
                                            $item_in_wishlist = false;
                                        }
                                        if($item_in_wishlist == true){
                                        ?>
                                        style="fill: red;"
                                        <?php
                                         }
                                        ?>
                                    d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
                                
                                    </a> Add to Wishlist</h6>
                                </div>
                                <?php
                                   }
                                ?>
                        </div>
                        <br>
                        <div class=" col-12 row">
                            <div class="col-5 ml-5">
                                    <h6>Kenya > <?php echo $result['county'].' > '.$result['subcounty'] ?></h6>
                            </div>
                            <div class="col-5 ml-5">
                                <div class="row">
                                <h6>Ratings   <?php rate($result['average_rating']) ?></h6>  
                                <div class="home-owner-contact ml-5">
                                        <a href="#" data-toggle="modal" data-target="#exampleModalScrollableratehome">Rate Home</a>
                                        <div class="modal fade" id="exampleModalScrollableratehome" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Rate Home</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body modal-body-star">
                                                    <form method="POST">
                                                    <div class="star-widget mr-5">
                                                    <input type="radio" name="rate-home" id="home-rate-5" value="5">
                                                    <label for="home-rate-5" class="fas fa-star"></label>
                                                    <input type="radio" name="rate-home" id="home-rate-4" value="4">
                                                    <label for="home-rate-4" class="fas fa-star"></label>
                                                    <input type="radio" name="rate-home" id="home-rate-3" value="3">
                                                    <label for="home-rate-3" class="fas fa-star"></label>
                                                    <input type="radio" name="rate-home" id="home-rate-2" value="2">
                                                    <label for="home-rate-2" class="fas fa-star"></label>
                                                    <input type="radio" name="rate-home" id="home-rate-1" value="1">
                                                    <label for="home-rate-1" class="fas fa-star"></label>  
                                                    </div>
                                                        <input type="hidden" name="home_id" id="home_id"  value="<?php echo $_GET['id']?>">
                                                        <input type="hidden" name="rater_id" id="rater_id"  value="<?php echo $customer_id ?>">
                                                    </div>
                                                    </form>
                                                    <div class="modal-footer">
                                                    <button class="btn btn-danger" role="button" aria-pressed="true"  style="margin-right: 50px" id="rate_home">Rate</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                </div> 
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php
                                $from = date('d F', strtotime($availability_result['availability_start_date']));
                                $to = date('d F Y', strtotime($availability_result['availability_end_date']));
                        ?>
                        <div class="col-12 row">
                            <div class="col-5 ml-5">
                                    <p><b>Next Availability: <?php echo $from; ?> - <?php echo $to; ?></b></p>
                            </div>
                            <div class="col-5">
                            <?php if($result['user_id'] != $customer_id){ ?>
                                <div class="make-reservation ml-5">
                                    <a href="#">Make Reservation</a>
                                </div>
                                <?php } ?>
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
                                <h6 class="card-subtitle mb-2"><?php echo $result['first_name'].' '.$result['last_name']; ?></h6>
                                <br>
                                <h6 class="card-subtitle mb-2"><?php echo $request_result['sum'] ?> Exchanges</h6>
                                <br>
                                <h6 class="card-subtitle mb-2">Ratings <?php rate($availability_result['owner_rating']) ?></h6>
                                <br>
                                <div class="text-center">
                                    <div class="home-owner-contact mb-2">
                                            <a href="#" data-toggle="modal" data-target="#exampleModalScrollablerateowner">Rate Home Owner</a>
                                            <div class="modal fade" id="exampleModalScrollablerateowner" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Rate Home Owner</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body modal-body-star">
                                                    <form method="POST">
                                                        <div class="star-widget mr-5"> 
                                                        <input type="radio" name="rate-home-owner" id="home-owner-rate-5" value="5">
                                                        <label for="home-owner-rate-5" class="fas fa-star"></label>
                                                        <input type="radio" name="rate-home-owner" id="home-owner-rate-4" value="4">
                                                        <label for="home-owner-rate-4" class="fas fa-star"></label>
                                                        <input type="radio" name="rate-home-owner" id="home-owner-rate-3" value="3">
                                                        <label for="home-owner-rate-3" class="fas fa-star"></label>
                                                        <input type="radio" name="rate-home-owner" id="home-owner-rate-2" value="2">
                                                        <label for="home-owner-rate-2" class="fas fa-star"></label>
                                                        <input type="radio" name="rate-home-owner" id="home-owner-rate-1" value="1">
                                                        <label for="home-owner-rate-1" class="fas fa-star"></label> 
                                                        </div>
                                                        <input type="hidden" name="home_owner_id" id="home_owner_id"  value="<?php echo $result['owner_id']?>">
                                                        <input type="hidden" name="rater_id" id="rater_id"  value="<?php echo $customer_id ?>">
                                                        </div>   
                                                    </form>
                                                    <div class="modal-footer">
                                                    <button class="btn btn-danger" role="button" aria-pressed="true"  style="margin-right: 50px" id="rate_home_owner">Rate</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <br>
                                <h6 class="card-subtitle mb-2 text-center"><i class="fas fa-phone"></i> <?php echo $availability_result['phone_number'] ?></h6>
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
            <?php } else{ ?>
                <section class="catagory-section homepage-stats">
                <div class="container col-12 p-lg-0 row">
                    <div class="col-10">
                        <div class="col-12 row">          
                                <div class="col-5 ml-5">
                                    <h2><?php echo $result['name'] ?></h2>
                                </div>
                        </div>
                        <br>
                        <div class=" col-12 row">
                            <div class="col-5 ml-5">
                                    <h6>Kenya > <?php echo $result['county'].' > '.$result['subcounty'] ?></h6>
                            </div>
                            <div class="col-5 ml-5">
                                <h6>Ratings   <?php rate($result['average_rating']) ?></h6>
                            </div>
                        </div>
                        <br>
                        <?php
                                $from = date('d F', strtotime($availability_result['availability_start_date']));
                                $to = date('d F Y', strtotime($availability_result['availability_end_date']));
                        ?>
                        <div class="col-12 row">
                            <div class="col-5 ml-5">
                                     <?php
                                        if($availability_result == TRUE)
                                        {
                                    ?>
                                    <p><b>Next Availability: <?php echo $from; ?> - <?php echo $to; ?></b></p>
                                    <?php
                                        }
                                    ?>
                            </div>
                            <div class="col-5">
                            <?php if($result['user_id'] != $customer_id){ ?>
                                <div class="make-reservation ml-5">
                                    <a href="#">Make Reservation</a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <br>
                        <hr>
                    </div>
                    <div class="col-2">
                        <div class="card home-owner-card ml-n5 mt-n5" style="width: 18rem;height: 28rem;" id="home-owner-card">
                        <div class="text-center">
                            <br>
                            <h5 class="card-title">Control Panel</h5>
                            <br>
                                    <div class="home-owner-contact">
                                        <a href="#" data-toggle="modal" data-target="#exampleModalScrollableHome">Edit Home Details</a>
                                        <div class="modal fade" id="exampleModalScrollableHome" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Home Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                <label for="home_name" style="margin-left: 60px;">Name:</label>    
                                                <input type="text" name="home_name" id="home_name" class="form-control col-md-9" style="padding:15px;margin-left: 60px" required value="<?php echo $result['name'] ?>" placeholder="Name">
                                                </div><br>
                                                <div class="row">
                                                <label for="home_description" style="margin-left: 60px;">Description:</label>
                                                <textarea id="home_description" class="form-control col-md-9" style="padding:15px;margin-left: 60px" name="home_description"><?php echo $result['description'] ?></textarea>
                                                </div><br>
                                                <input type="hidden" name="home_id" id="home_id" value="<?php echo $_GET['id'] ?>">
                                            </div>
                                            <div class="modal-footer">
                                            <button class="btn btn-danger" role="button" aria-pressed="true"  style="margin-right: 50px" id="edit_home">Edit Home</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <?php
                                        if($availability_result == TRUE)
                                        {          
                                    ?>
                                    <br>
                                    <input type="hidden" name="availability_id" id="availability_id"  value="<?php echo $availability_result['availability_id'] ?>">
                                    <input type="hidden" name="home_id" id="home_id"  value="<?php echo $_GET['id'] ?>">
                                    <div class="home-owner-contact">
                                        <a href="#" data-toggle="modal" data-target="#exampleModalScrollableAvailability">Edit Availability</a>
                                        <div class="modal fade" id="exampleModalScrollableAvailability" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Home Availability</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                <label for="start_date" style="margin-left: 60px;">Start Date:</label>    
                                                <input type="date" name="start_date" id="start_date" value="<?php echo $availability_result['availability_start_date'] ?>" class="form-control col-md-9" style="padding:15px;margin-left: 60px" required  placeholder="Start Date...">
                                                </div><br>
                                                <div class="row">
                                                <label for="end_date" style="margin-left: 60px;">End Date:</label>
                                                    <input type="date" name="end_date" id="end_date" value="<?php echo $availability_result['availability_end_date'] ?>" class="form-control col-md-9"  style="padding:15px;margin-left: 60px" required placeholder="End Date...">
                                                </div><br> 
                                                <div class="row">
                                                <label for="extra_details" style="margin-left: 60px;">Extra Details:</label>
                                                <textarea id="extra-details" class="form-control col-md-9" style="padding:15px;margin-left: 60px" name="extra-details"><?php echo $availability_result['extra_details'] ?></textarea>
                                                </div><br>
                                                <input type="hidden" name="availability_id" id="availability_id"  value="<?php echo$availability_result['availability_id']?>">
                                            </div>
                                            <div class="modal-footer">
                                            <button class="btn btn-danger" role="button" aria-pressed="true"  style="margin-right: 50px" id="edit_availability">Edit Availability</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <br><br>
                                    <div class="home-owner-contact">
                                        <a href="#" id="cancel-availability">Cancel Availability</a>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <br><br>
                                    <div class="home-owner-contact">
                                        <a href="#" id="delete-home">Remove Home</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>  
                      
            </section>
             <?php } ?>
            <section class="catagory-section  mt-n5">
                <div class="container col-12 p-lg-0 home-dash-features row">
                   <div class="col-2 text-center">
                        <i class="fas fa-home fa-3x" style="color: #BDBBBB;"></i>
                        <h6>House</h6>
                   </div>
                   <div class="col-2 text-center">
                       <h2>3</h2>
                        <h6>Tier</h6>
                   </div>
                   <div class="col-2 text-center">
                       <h2>3</h2>
                        <h6>Bedrooms</h6>
                   </div>
                   <div class="col-2 text-center">
                       <h2>2</h2>
                        <h6>Bathrooms</h6>
                   </div>
                   <div class="col-2 text-center">
                       <h2>5</h2>
                        <h6>Occupancy</h6>
                   </div>
                   <div class="col-2 text-center">
                       <h2>80</h2>
                        <h6>m sq</h6>
                   </div>
                </div>
                <hr>
            </section>

            <section class="catagory-section  home-dash-facilities mt-n5">
                <div class="container p-lg-0 " style="margin-top:-100px">
                <div class="section-heading">
                        <h4 class="heading-title" style="background-color:white;color: #BDBBBB;"><span class="heading-circle green"></span> Description</h4>
                    </div>
                    <p><?php echo $result['description'] ?></p>
                </div>
            </section>

            <section class="catagory-section  home-dash-facilities mt-n5">
                <div class="container p-lg-0 ">
                <div class="section-heading">
                        <h4 class="heading-title" style="background-color:white;color: #BDBBBB;"><span class="heading-circle green"></span> Features</h4>
                    </div>
                   <br>
                   <div class="row">
                      <span class="badge badge-pill home-feature-badge ml-4 mt-2">Security</span>
                      <span class="badge badge-pill home-feature-badge ml-4 mt-2">Kids Friendly</span>
                      <span class="badge badge-pill home-feature-badge ml-4 mt-2">Smokers Allowed</span>
                      <span class="badge badge-pill home-feature-badge ml-4 mt-2">Pets Allowed</span>
                      <span class="badge badge-pill home-feature-badge ml-4 mt-2">Home Workers</span>
                      <span class="badge badge-pill home-feature-badge ml-4 mt-2">TV</span>
                      <span class="badge badge-pill home-feature-badge ml-4 mt-2">WiFi</span>
                      <span class="badge badge-pill home-feature-badge ml-4 mt-2">Air Con.</span>
                   </div>
                </div>
            </section>
            
            <section class="catagory-section  home-dash-facilities mt-n5">
                <div class="container p-lg-0 ">
                <div class="section-heading">
                        <h4 class="heading-title" style="background-color:white;color: #BDBBBB;"><span class="heading-circle green"></span> Images</h4>
                    </div>
                   <br>
                   <div class="row" id="home-image-section">
                       <?php
                           $home_images = mysqli_query($connection,$home->fetchHomeImages($_GET['id']))or die($connection->error);
                           $images_result = mysqli_fetch_array($home_images);
                           if($images_result == true){
                               foreach($home_images as $row){
                       ?>

                       <div class="dashboard-images">
                            <img src="assets/images/homes/<?php echo $row['url']?>" width="350px" height="350px" class="ml-2 mt-2" alt="home-image">
                            <?php if($result['user_id'] == $customer_id){ ?>
                            <a href="#" class="btn remove-images-btn" id="<?php echo $row['id']?>">Remove</a>
                            <?php
                            }
                            ?>
                       </div>
                      <?php
                               }
                           }
                           else{
                             ?>
                          <h4 class="ml-5">No image has been added</h4>
                             <?php
                           }
                      if($result['user_id'] == $customer_id){ ?>
                      <form method="POST" id="images-form" class="ml-5 mt-5">
                        <input type="file" id="home-dashboard-image" class="home-dashboard-image" name="upload" onchange="displayname(this,$(this))"/>
                        <label for="home-dashboard-image" class="home-dashboard-image">
                            <i class="fas fa-file-image"></i>&emsp;Add an image
                        </label>
                        <input type="hidden" name="home_id" id="home_id"  value="<?php echo $_GET['id'] ?>">
                        <input type="hidden" name="where" id="where"  value="home-images">
                      </form>
                      <?php
                      }
                      ?>
                   </div>
                </div>
            </section>
             <?php
             $home_comments = mysqli_query($connection,$home->fetchHomeComments($_GET['id']))or die($connection->error);
             $comments_count = mysqli_num_rows($home_comments);
             ?>
            <section class="catagory-section  mt-n5">
            <div class="container p-lg-0">
                <div class="comment-section pt--70 pb--40" id="comments-section">
                <h5 class="comment-title mb--30"><i class="far fa-comment-alt"></i> <?php echo $comments_count; ?> Comment<?php if($comments_count != 1){?>s<?php } ?></h5>

                <div class="comment-list">
                <?php
                    
                    foreach($home_comments as $row){
                    $commenter = $row['commenter'];
                    $words = explode(" ", $commenter);
                    $acronym = "";
                    foreach ($words as $w) {
                    $acronym .= $w[0];
                    } 
                ?>
                    <div class="comment-item">
                        <div class="comment-author d-flex flex-wrap">
                            <div class="author-image">
                                <?php echo $acronym; ?>
                            </div>
                            <div class="author-name-info">
                                <h6 class="name" id="commenter"><?php echo $commenter; ?></h6>
                                <p class="publish-date">Posted on <?php echo date('d F Y', strtotime($row['Created_at'])); ?></p>
                            </div>
                        </div>
                        <div class="comment-content">
                            <?php echo $row['comment']; ?>
                        </div>

                        </div>

                    </div>
                <?php
                     }
                ?>
                <div class="comment-input">
                         
                </div>
                <input type='hidden' class='token' id='token' name='token'>
                <input type='hidden' class='home_id' id='home_id' name='home_id' value="<?php echo $_GET['id'] ?>">
                <input type='hidden' class='commenter_id' id='commenter_id' name='commenter_id' value="<?php echo $customer_id ?>">
                <?php
                if($result['user_id'] != $customer_id){ ?>
                <button class="btn btn-danger" role="button" aria-pressed="true" style="margin-right: 50px;float: right" id="add_comment">Add Comment</button>
                <?php
                }
                ?>
                </div>
            </div>
            </div>
        </section>

<?php
    include('footer.php');
?>