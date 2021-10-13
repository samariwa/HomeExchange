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

                <div class="container">
                    <?php
                   /* foreach($my_orders as $row){
                        $order_details = mysqli_query($connection,"SELECT SUM(orders.Quantity * (stock.Price - stock.Discount))as sum,COUNT(orders.Status_id) as count FROM orders INNER JOIN stock on orders.Stock_id = stock.id where orders.Status_id = '".$row ['status_id']."' ")or die($connection->error);
                        $value = mysqli_fetch_array($order_details);
                        $orders = mysqli_query($connection,"SELECT stock.Name as name,stock.image as image,stock.Discount as discount,stock.Price as price,inventory_units.Name as unit,orders.Quantity as quantity,order_status.delivery_fee as delivery_fee,order_status.status as status FROM order_status INNER JOIN orders ON orders.Status_id = order_status.id INNER JOIN stock ON orders.Stock_id = stock.id INNER JOIN inventory_units ON stock.Unit_id = inventory_units.id where order_status.id = '".$row['status_id']."' ORDER BY order_status.Created_at DESC")or die($connection->error);
                   */
                        ?>
                    <div class="track-order-item bg-color-white">
                        <div class="track-order-head">
                            <h6>View Exchange</h6>
                        </div>
                        <div class="d-flex justify-content-between track-number-link align-items-center">
                            <div>
                                <h6 class="order-number">Exchange#<?php //echo $row ['status_id']?></h6>
                                <p class="date"><?php //echo date('d.m.Y',strtotime($row ['order_date'])); ?></p>
                                <p class="price"> <?php //echo number_format($value['sum'],2); ?></p>
                            </div>
                            <div>
                                <a href="order-details.php?id=<?php echo $row ['status_id']?>" class="order-btn">Exchange Details</a>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="order-details-head">
                                <h6>Exchange Details</h6>
                            </div>
                            <div class="order-details-container d-none d-md-block">
                            <?php
                                $total_cost = 0;
                                $total_discount = 0;
                                /*foreach($orders as $row2){
                                $total_discount += $row2['discount'];
                                $total_cost += $row2['price'];*/
                            ?>
                                <div class="order-details-item d-sm-flex flex-wrap text-center text-sm-left align-items-center justify-content-between">
                                    <div class="thumb d-sm-flex flex-wrap align-items-center">
                                        <a><img src="assets/images/products/<?php //echo $row2['image']; ?>" height="110" width="130" alt="products"></a>
                                        <div class="product-content">
                                            <a class="product-title"><?php //echo $row2['name']; ?></a>
                                        </div>
                                    </div>
                                    
                                    <div class="product-content pl-0">
                                        <div class="product-cart-info">
                                            <?php //echo $row2['quantity']; ?> <?php //echo $row2['unit']; ?>
                                        </div>
                                    </div>
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            <?php //if($row2['discount'] > 0){ ?><del> <?php //echo number_format($row2['price'],2); ?></del><?php //} ?><span class="ml-4"> <?php //echo number_format(($row2['price']-$row2['discount']),2); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                              //  }
                                ?>

                            </div>
                            <div class="order-details-container-mobile d-md-none">
                            <?php
                                $total_cost = 0;
                                $total_discount = 0;
                              /*  foreach($orders as $row2){
                                $total_discount += $row2['discount'];
                                $total_cost += $row2['price'];*/
                            ?>
                                <div class="cart-product-item">
                                    <div class="row align-items-center">
                                        <div class="col-5 p-0">
                                            <div class="thumb">
                                                <a ><img src="assets/images/homes/<?php //echo $row2['image']; ?>" height="110" width="130" alt="home"></a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="product-content">
                                                <a  onclick="openModal()" class="product-title"><?php //echo $row2['name']; ?></a>
                                                <div class="product-cart-info">
                                                     <?php //echo $row2['quantity']; ?> <?php //echo $row2['unit']; ?>
                                                </div>
                                                <div class="product-price">
                                                    <?php //if($row2['discount'] > 0){ ?><del> <?php //echo number_format($row2['price'],2); ?></del><?php //} ?><span class="ml-4"> <?php //echo number_format(($row2['price']-$row2['discount']),2); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                             //   }
                                ?>
                            </div>
                        </div>
                        <div class="track-order-info">
                            <ul class="to-list">
                            <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Previous Exchange Points Balance</span>
                                    <span class="desc"> <?php //echo number_format($row2['delivery_fee'],2); ?></span>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Exchange Points Used</span>
                                    <span class="desc"> <?php //echo number_format($total_discount,2); ?></span>
                                </li>
                                <li class="inc-vat d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Exchange Points Balance</span>
                                    <span class="desc"> <?php //echo number_format($row ['sum'],2); ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="delevary-time">
                            <p>Points Transaction Date - <?php echo date('l, F d, Y',strtotime($row ['order_date'])); ?></p>
                        </div>
                        <div class="track-order-footer">
                            <p>Helpline - <a href="tel:<?php echo $contact_number; ?>">Call Us</a></p>
                        </div>
                    </div>
                    <?php
                  //  }
                    ?>

                </div>
            </section>
            <!-- dashboard-section end -->
<?php
  include('footer.php');
?>