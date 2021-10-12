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
                                <li><a href="index.php">Home</a></li>
                                <li><span>/</span></li>
                                <li>Track Order</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->


            <!-- admin-page start -->
            <section class="admin-page-section d-flex align-items-center" style="background-image: url('assets/images/admin/profile-bg.jpg'); background-size: cover;">
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
                    foreach($my_orders as $row){
                        $order_details = mysqli_query($connection,"SELECT SUM(orders.Quantity * (stock.Price - stock.Discount))as sum,COUNT(orders.Status_id) as count FROM orders INNER JOIN stock on orders.Stock_id = stock.id where orders.Status_id = '".$row ['status_id']."' ")or die($connection->error);
                        $value = mysqli_fetch_array($order_details);
                        $orders = mysqli_query($connection,"SELECT stock.Name as name,stock.image as image,stock.Discount as discount,stock.Price as price,inventory_units.Name as unit,orders.Quantity as quantity,order_status.delivery_fee as delivery_fee,order_status.status as status FROM order_status INNER JOIN orders ON orders.Status_id = order_status.id INNER JOIN stock ON orders.Stock_id = stock.id INNER JOIN inventory_units ON stock.Unit_id = inventory_units.id where order_status.id = '".$row['status_id']."' ORDER BY order_status.Created_at DESC")or die($connection->error);
                    ?>
                    <div class="track-order-item bg-color-white">
                        <div class="track-order-head">
                            <h6>Track Order</h6>
                        </div>
                        <div class="d-flex justify-content-between track-number-link align-items-center">
                            <div>
                                <h6 class="order-number">Order#<?php echo $row ['status_id']?></h6>
                                <p class="date"><?php echo date('d.m.Y',strtotime($row ['order_date'])); ?></p>
                                <p class="price">Ksh. <?php echo number_format($value['sum'],2); ?></p>
                            </div>
                            <div>
                                <a href="order-details.php?id=<?php echo $row ['status_id']?>" class="order-btn">Order Details</a>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="order-details-head">
                                <h6>Order Details</h6>
                            </div>
                            <div class="order-details-container d-none d-md-block">
                            <?php
                                $total_cost = 0;
                                $total_discount = 0;
                                foreach($orders as $row2){
                                $total_discount += $row2['discount'];
                                $total_cost += $row2['price'];
                            ?>
                                <div class="order-details-item d-sm-flex flex-wrap text-center text-sm-left align-items-center justify-content-between">
                                    <div class="thumb d-sm-flex flex-wrap align-items-center">
                                        <a><img src="assets/images/products/<?php echo $row2['image']; ?>" height="110" width="130" alt="products"></a>
                                        <div class="product-content">
                                            <a class="product-title"><?php echo $row2['name']; ?></a>
                                        </div>
                                    </div>
                                    
                                    <div class="product-content pl-0">
                                        <div class="product-cart-info">
                                            <?php echo $row2['quantity']; ?> <?php echo $row2['unit']; ?>
                                        </div>
                                    </div>
                                    <div class="product-content pl-0">
                                        <div class="product-price">
                                            <?php if($row2['discount'] > 0){ ?><del>Ksh. <?php echo number_format($row2['price'],2); ?></del><?php } ?><span class="ml-4">Ksh. <?php echo number_format(($row2['price']-$row2['discount']),2); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="order-details-container-mobile d-md-none">
                            <?php
                                $total_cost = 0;
                                $total_discount = 0;
                                foreach($orders as $row2){
                                $total_discount += $row2['discount'];
                                $total_cost += $row2['price'];
                            ?>
                                <div class="cart-product-item">
                                    <div class="row align-items-center">
                                        <div class="col-5 p-0">
                                            <div class="thumb">
                                                <a ><img src="assets/images/products/<?php echo $row2['image']; ?>" height="110" width="130" alt="products"></a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="product-content">
                                                <a  onclick="openModal()" class="product-title"><?php echo $row2['name']; ?></a>
                                                <div class="product-cart-info">
                                                     <?php echo $row2['quantity']; ?> <?php echo $row2['unit']; ?>
                                                </div>
                                                <div class="product-price">
                                                    <?php if($row2['discount'] > 0){ ?><del>Ksh. <?php echo number_format($row2['price'],2); ?></del><?php } ?><span class="ml-4">Ksh. <?php echo number_format(($row2['price']-$row2['discount']),2); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="track-order-info">
                            <ul class="to-list">
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Sub Total</span>
                                    <span class="desc">Ksh. <?php echo number_format($total_cost,2); ?></span>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Delivery Fee</span>
                                    <span class="desc">Ksh. <?php echo number_format($row2['delivery_fee'],2); ?></span>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Discount</span>
                                    <span class="desc">Ksh. <?php echo number_format($total_discount,2); ?></span>
                                </li>
                                <li class="inc-vat d-flex flex-wrap justify-content-between">
                                    <span class="t-title">Total(inc) VAT</span>
                                    <span class="desc">Ksh. <?php echo number_format($value['sum'],2); ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="delevary-time">
                            <p>Delivery Date - <?php echo date('l, F d, Y',strtotime($row ['order_date'])); ?></p>
                        </div>
                        <div class="product-delevary-process">
                            <div class="process-bar">
                                <!--<div class="process-bar-active"></div>-->
                                <div class="process-bar-item-container d-flex justify-content-between align-items-center">
                                    <div class="process-bar-item">
                                        <div class="process-bar-item-inner active">
                                            <span class="check-icon"><i class="fas fa-check-circle"></i></span>
                                            <div class="icon-outer">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 512 512"><path d="M73.4,454.1a16.436,16.436,0,1,0,16.436-16.436A16.454,16.454,0,0,0,73.4,454.1Zm20.872,0a4.436,4.436,0,1,1-4.436-4.436A4.441,4.441,0,0,1,94.267,454.1Z"/><path d="M451.824,30.312A5.977,5.977,0,0,0,446.447,27H176.956a5.977,5.977,0,0,0-5.377,3.312L136.521,101.12A6.061,6.061,0,0,0,135,105.128V317.714A38.974,38.974,0,0,0,116.268,348.2a35.98,35.98,0,0,1-11.165,5.757l-.019-.148A9.594,9.594,0,0,0,95.956,347H33.286a9.6,9.6,0,0,0-9.209,12.171L57.189,478.025A9.572,9.572,0,0,0,66.4,485H132.71a9.523,9.523,0,0,0,9.144-12.307l-8.632-28.3,31.26-19.758a18.147,18.147,0,0,1,13.2-1.694c.18.045.362.083.545.111l55.194,8.535a65.96,65.96,0,0,0,45.592-9.59L387.115,353h95.16A5.725,5.725,0,0,0,488,347.275V107.105a5.977,5.977,0,0,0-.347-4.442ZM318,39H442.722l29.727,60H318Zm-6.3,72.325a5.988,5.988,0,0,0,1.935-.325H354v43H273V111h36.766A5.989,5.989,0,0,0,311.7,111.325ZM68.252,473,36.5,359H94l35,114Zm204.305-60.916a53.924,53.924,0,0,1-37.3,7.743l-54.934-8.546a30.1,30.1,0,0,0-21.828,2.979c-.093.053-.186.1-.277.152l-28.659,18.111L108.663,365.3a48.306,48.306,0,0,0,17.489-9.942,5.535,5.535,0,0,0,2.01-4.258A27.165,27.165,0,0,1,155.486,324h1.874a39.374,39.374,0,0,0,30.462-14.688l23.771-29.256a14.589,14.589,0,0,1,19.522-2.954l.4.239a15.327,15.327,0,0,1,5.2,19.56c-9.5,18.885-23.627,47-23.627,47a6.4,6.4,0,0,0,.255,6.045A6.2,6.2,0,0,0,218.448,353h147.01ZM276,341V283.7l3.969,4.152a6.038,6.038,0,0,0,4.316,1.869,6.1,6.1,0,0,0,4.34-1.8l10.465-10.665L309.419,287.9a6,6,0,0,0,8.613,0l10.328-10.642,10.462,10.665a6.049,6.049,0,0,0,4.333,1.8,5.568,5.568,0,0,0,4.1-1.869L351,283.7V341Zm200,0H363V268.662a5.789,5.789,0,0,0-10.053-4.131l-9.962,10.546L332.6,264.63a5.788,5.788,0,0,0-4.258-1.63h-.016a5.831,5.831,0,0,0-4.29,1.652l-10.3,10.535-10.3-10.492a5.864,5.864,0,0,0-4.29-1.695h-.016a5.845,5.845,0,0,0-4.283,1.63l-10.415,10.532-10.011-10.589A6.028,6.028,0,0,0,264,268.662V341H228.177c4.933-10,13.076-26.225,19.256-38.516a27.5,27.5,0,0,0-9.225-35.027l-.4-.318a26.522,26.522,0,0,0-35.518,5.246l-23.77,29.355A27.408,27.408,0,0,1,157.36,312h-1.874a39.806,39.806,0,0,0-8.486.921V111h37a6,6,0,0,0,0-12H150.954l29.727-60H306V99H224a6,6,0,0,0,0,12h37v48.784A6.172,6.172,0,0,0,266.981,166h93.492c3.313,0,5.527-2.9,5.527-6.216V111H476Z"/><path d="M176,133.763a6,6,0,0,0-6,6v6.3a6,6,0,0,0,12,0v-6.3A6,6,0,0,0,176,133.763Z"/><path d="M176,159.058a6,6,0,0,0-6,6v66a6,6,0,0,0,12,0v-66A6,6,0,0,0,176,159.058Z"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="name">Placed Order</div>
                                    </div>

                                    <div class="process-bar-item">
                                        <div class="process-bar-item-inner <?php if($row['status'] == 'Processed' || $row['status'] == 'Shipped' || $row['status'] == 'Delivered'){ ?>active<?php } ?>">
                                            <span class="check-icon"><i class="fas fa-check-circle"></i></span>
                                            <div class="icon-outer">
                                                <div class="icon">
                                                    
                                                    <svg viewBox="0 -10 511.98895 511" xmlns="http://www.w3.org/2000/svg"><path d="m314.449219 281.679688-9.414063-3.554688-21.003906 63.113281c-.617188 1.832031-1.015625 3.730469-1.183594 5.65625l-10.34375 118.503907c-1.238281 14.199218 9.925782 26.53125 24.34375 26.53125 12.519532 0 23.179688-9.578126 24.285156-22.289063l10.09375-115.601563 22.171876-65.933593c-13.261719 5.710937-28.496094 2.992187-38.949219-6.425781zm0 0"/><path d="m477.226562 163.757812c6.617188-14.984374-.164062-32.496093-15.148437-39.117187-9.171875-4.046875-36.242187-16.003906-48.386719-21.367187-4.699218-2.074219-9.644531-2.832032-14.429687-2.429688 1.839843 6.835938 1.3125 14.039062-1.574219 20.617188l-33.117188 75.453124 21.039063-12.382812 29.34375-43.257812-21.699219 58.582031-64.199218 37.789062c-9.296876 5.46875-12.394532 17.4375-6.925782 26.730469 5.453125 9.265625 17.414063 12.410156 26.734375 6.925781l70.191407-41.3125c3.875-2.28125 6.84375-5.828125 8.40625-10.046875l24.113281-65.101562-8.09375 71.035156c-1.507813 13.261719-13.34375 16.875-15.761719 18.835938l-59.972656 35.300781-4.089844 79.902343c-.195312 3.953126.570312 7.890626 2.234375 11.480469l49.335937 106.394531c5.667969 12.230469 20.179688 17.546876 32.410157 11.878907 12.226562-5.671875 17.546875-20.183594 11.875-32.414063l-46.800781-100.925781 2.667968-53.523437zm0 0"/><path d="m511.988281 63.070312c0 24.25-19.65625 43.90625-43.90625 43.90625s-43.90625-19.65625-43.90625-43.90625c0-24.246093 19.65625-43.90625 43.90625-43.90625s43.90625 19.660157 43.90625 43.90625zm0 0"/><path d="m185.558594 215.691406c40.871094 17.882813 119.074218 51.503906 119.074218 51.503906-6.070312-16.320312.222657-35.136718 15.753907-44.277343l21.480469-12.644531 41.703124-95.011719c3.515626-8.011719-.128906-17.355469-8.140624-20.871094l-114.5625-50.28125c-8.058594-3.535156-17.375.171875-20.871094 8.136719l-62.578125 142.574218c-3.515625 8.011719.128906 17.355469 8.140625 20.871094zm0 0"/><path d="m202 239.960938h-176.304688v-114.71875h165.425782c36.65625-83.261719 34.519531-79.238282 36.574218-82.671876v-29.230468c0-7.09375-5.75-12.84375-12.847656-12.84375h-202c-7.097656-.003906-12.847656 5.75-12.847656 12.84375v421.386718c0 7.09375 5.75 12.84375 12.847656 12.84375h9.960938v16.648438c0 3.527344 2.859375 6.382812 6.382812 6.382812h12.929688c3.527344 0 6.382812-2.855468 6.382812-6.382812v-16.648438h126.417969v16.648438c0 3.527344 2.855469 6.382812 6.378906 6.382812h12.933594c3.523437 0 6.378906-2.855468 6.378906-6.382812v-16.648438h14.234375c7.097656 0 12.847656-5.75 12.847656-12.84375v-183.707031l-25.695312-11.277343zm-176.304688-213.773438h176.304688v73.363281h-176.304688zm176.304688 395.691406h-176.304688v-156.222656h176.304688zm0 0"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="name">Order Processing</div>
                                    </div>

                                    <div class="process-bar-item">
                                        <div class="process-bar-item-inner <?php if($row['status'] == 'Shipped' || $row['status'] == 'Delivered'){ ?>active<?php } ?>">
                                            <span class="check-icon"><i class="fas fa-check-circle"></i></span>
                                            <div class="icon-outer">
                                                <div class="icon">
                                                    
                                                    <svg id="Capa_1" enable-background="new 0 0 512.001 512.001" viewBox="0 0 512.001 512.001" xmlns="http://www.w3.org/2000/svg"><g><path d="m105.527 92.355c-4.143 0-7.5 3.358-7.5 7.5v6.421c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-6.421c0-4.143-3.358-7.5-7.5-7.5z"/><path d="m105.527 122.117c-4.143 0-7.5 3.358-7.5 7.5v6.422c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-6.422c0-4.142-3.358-7.5-7.5-7.5z"/><path d="m74.497 203.571v-6.422c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v6.422c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5z"/><path d="m113.027 203.571v-6.422c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v6.422c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5z"/><path d="m144.057 211.071c4.143 0 7.5-3.358 7.5-7.5v-6.422c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v6.422c0 4.142 3.357 7.5 7.5 7.5z"/><path d="m504.5 450.313c-33.98 0-36.59-22.689-68.474-28.722 8.507-44.711 39.909-83.63 73.549-114.554 2.276-2.092 3.035-5.365 1.913-8.245-1.123-2.88-3.897-4.776-6.988-4.776h-7.256c0-9.636 0-83.329 0-93.172 0-4.142-3.357-7.5-7.5-7.5-45.811 0-143.428 0-170.114 0-4.143 0-7.5 3.358-7.5 7.5v42.836h-56.078v-140.014l121.959-49.26v44.543h-35.028c-4.143 0-7.5 3.358-7.5 7.5v50.336c0 4.142 3.357 7.5 7.5 7.5h24.952c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-17.452v-35.336h70.058v35.336h-22.619c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h30.119c4.143 0 7.5-3.358 7.5-7.5v-50.336c0-4.142-3.357-7.5-7.5-7.5h-35.029v-50.601l19.794-7.995c3.841-1.551 5.697-5.922 4.146-9.763-1.551-3.84-5.921-5.697-9.763-4.146-32.979 13.32-119.929 48.44-151.136 61.044v-7.742c0-6.157-2.375-11.969-6.688-16.364l-23.795-24.247c-3.964-4.039-9.911-5.264-15.147-3.125-5.238 2.141-8.623 7.181-8.623 12.84v60.552l-22.451 9.068c-3.841 1.551-5.697 5.922-4.146 9.763 1.18 2.92 3.989 4.693 6.957 4.693.935 0 1.886-.176 2.806-.548l16.834-6.799v165.555l-21.674-8.912v-106.31c0-8.778-7.142-15.92-15.92-15.92h-13.891v-78.461c0-8.694-7.073-15.767-15.768-15.767h-21.52v-20.582h7.158c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-7.158v-11.132c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v11.131h-7.157c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h7.157v20.582h-21.52c-8.693 0-15.767 7.073-15.767 15.767v78.462h-13.89c-8.778 0-15.92 7.142-15.92 15.92v36.467c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-36.467c0-.507.413-.92.92-.92h117.354c.507 0 .92.413.92.92v100.143l-26.682-10.971c-1.732-.709-3.563-1.069-5.442-1.069h-.001-1.532v-26.802c0-6.761-5.5-12.261-12.261-12.261h-27.357c-6.761 0-12.262 5.5-12.262 12.261v26.802h-33.657v-21.649c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v21.649h-23.43c-2.477 0-4.793 1.223-6.191 3.267-1.397 2.044-1.696 4.646-.798 6.955l34.009 87.345 2.405 6.188c.713 1.847 1.075 3.772 1.075 5.726v46.83c0 6.359 1.231 12.656 3.575 18.529-8.917 6.343-17.599 11.458-34.075 11.458-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5c42.93 0 45.999-30 82.837-30 37.792 0 38.771 30 82.837 30 44.11 0 44.995-30 82.833-30 37.791 0 38.767 30 82.831 30 44.109 0 44.996-30 82.832-30 37.799 0 38.753 30 82.83 30 4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5zm-428.76-290.32v-78.462c0-.423.344-.767.767-.767h58.039c.423 0 .768.344.768.767v78.462zm251.39 134.023v-35.336h70.058v35.336zm85.058-35.337h70.057v35.336h-70.057zm70.056-15h-70.057v-35.336h70.057zm-155.114-35.336h70.058v35.336h-70.058zm-15 50.336v35.336h-56.078v-35.336zm-95.332-207.064 21.859 22.274c1.544 1.573 2.395 3.654 2.395 5.858v214.269h-24.254zm-122.211 188.337h21.88v24.063h-21.88zm38.282 39.064c11.404 4.688 51.011 20.972 67.874 27.904 3.375 1.391 6.934 2.096 10.577 2.096h274.573c-13.964 14.096-25.81 28.283-35.364 42.35h-403.894l-28.166-72.35zm205.969 171.297c-37.799 0-38.754-30-82.831-30-44.153 0-44.942 30-82.833 30-37.803 0-38.756-30-82.837-30-16.416 0-27.246 4.393-35.951 9.694-.904-3.137-1.386-6.395-1.386-9.682v-14.77h251.636c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-251.636v-17.061c0-2.41-.282-4.794-.84-7.13h389.004c-4.821 8.466-8.597 16.432-11.65 24.19h-94.891c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h89.819c-1.398 4.91-2.544 9.841-3.427 14.765-43.456.316-44.555 29.994-82.177 29.994z"/><path d="m122.376 485.45c-9.554 0-11.31-9.803-27.067-9.803-15.768 0-17.487 9.803-27.068 9.803-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5c15.768 0 17.487-9.803 27.068-9.803 9.425 0 11.439 9.803 27.067 9.803 4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5z"/><path d="m283.069 485.45c-9.555 0-11.31-9.803-27.068-9.803-15.806 0-17.449 9.803-27.067 9.803-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5c15.766 0 17.487-9.803 27.067-9.803 9.555 0 11.31 9.803 27.068 9.803 4.143 0 7.5-3.357 7.5-7.5s-3.358-7.5-7.5-7.5z"/><path d="m437.064 485.45c-9.425 0-11.439-9.803-27.067-9.803-15.768 0-17.487 9.803-27.068 9.803-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5c15.768 0 17.487-9.803 27.068-9.803 9.554 0 11.31 9.803 27.067 9.803 4.143 0 7.5-3.357 7.5-7.5s-3.358-7.5-7.5-7.5z"/><path d="m396.253 338.753h13.743c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-13.743c-4.143 0-7.5 3.357-7.5 7.5s3.358 7.5 7.5 7.5z"/></g></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="name">Shipment</div>
                                    </div>

                                    <div class="process-bar-item">
                                        <div class="process-bar-item-inner <?php if($row['status'] == 'Delivered'){ ?>active<?php } ?>">
                                            <span class="check-icon"><i class="fas fa-check-circle"></i></span>
                                            <div class="icon-outer">
                                                <div class="icon">
                                                    
                                                    <svg id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m391.753 197.974c4.142 0 7.5-3.358 7.5-7.5v-6.94h.275c11.894 0 21.57-9.676 21.57-21.57s-9.676-21.57-21.57-21.57h-15.551c-3.623 0-6.57-2.947-6.57-6.57s2.947-6.57 6.57-6.57h27.399c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-12.124v-6.94c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v6.94h-.275c-11.894 0-21.57 9.676-21.57 21.57s9.676 21.57 21.57 21.57h15.551c3.623 0 6.57 2.947 6.57 6.57s-2.947 6.57-6.57 6.57h-27.399c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h12.124v6.94c0 4.142 3.358 7.5 7.5 7.5z"/><path d="m507.22 353.109-69.01-46.642c-3.336-2.256-7.619-2.483-11.176-.594s-5.767 5.564-5.767 9.592v15.505h-37.698v-36.97c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v36.97h-26.051c-5.989 0-10.861 4.872-10.861 10.861v40.554c0 5.989 4.872 10.861 10.861 10.861h26.051v14.333h-90.8c6.533-3.698 11.038-10.461 11.411-18.37.14-2.968-.29-5.863-1.244-8.567 5.663-.319 11.074-2.802 15.004-6.921 4.278-4.484 6.474-10.371 6.182-16.576-.564-11.989-10.603-21.381-22.854-21.381h-9.289c.946-2.694 1.371-5.577 1.232-8.533-.564-11.989-10.603-21.381-22.854-21.381h-7.341v-53.2l17.041 19.753c1.483 1.72 3.577 2.601 5.682 2.601 1.735 0 3.479-.599 4.896-1.821 3.137-2.706 3.485-7.441.78-10.578l-30.22-35.029c-1.425-1.651-3.498-2.601-5.679-2.601s-4.254.949-5.679 2.601l-30.22 35.029c-2.706 3.136-2.357 7.872.78 10.578 3.136 2.706 7.872 2.356 10.578-.78l17.042-19.753v53.201h-66.381l3.33-3.33c4.242-4.242 6.578-9.881 6.578-15.879 0-5.999-2.336-11.638-6.578-15.879-8.726-8.726-22.903-8.756-31.666-.092l-25.835 24.272v-143.47h84.782v46.73c0 7.224 5.877 13.101 13.101 13.101h60.339c7.224 0 13.101-5.877 13.101-13.101v-46.73h31.66c1.506 32.479 23.385 59.718 53.122 69.211v38.316c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-35.154c2.69.288 5.419.444 8.184.444 36.009 0 67.462-25.554 74.789-60.763.844-4.055-1.759-8.026-5.815-8.871-4.052-.845-8.027 1.759-8.871 5.815-5.887 28.287-31.164 48.818-60.104 48.818-33.854 0-61.396-27.542-61.396-61.397 0-33.854 27.542-61.396 61.396-61.396 26.865 0 50.38 17.19 58.515 42.775 1.255 3.948 5.476 6.131 9.42 4.875 3.947-1.255 6.13-5.473 4.875-9.42-10.123-31.839-39.383-53.23-72.81-53.23-38.244 0-70.01 28.249-75.54 64.976h-205.648c-7.224 0-13.101 5.877-13.101 13.102v124.73l-16.777 15.762-15.687 1.004c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h13.152c4.777 0 9.325-1.801 12.806-5.072l6.506-6.113v14.147l-16.777 15.762c-.689.647-1.589 1.004-2.535 1.004h-63.152v-19.728h15c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-16.898c-7.225 0-13.102 5.878-13.102 13.102v29.127 45.027 29.127c0 7.224 5.877 13.101 13.102 13.101h64.725c.951 0 1.847.339 2.457.932 12.632 12.264 29.282 19.018 46.882 19.018h118.222c11.042 0 20.262-7.64 22.392-17.924h102.689c7.224 0 13.102-5.877 13.102-13.102v-16.231h37.698v15.505c0 4.027 2.209 7.703 5.766 9.592 1.603.851 3.352 1.273 5.097 1.272 2.127 0 4.246-.627 6.08-1.866l69.01-46.642c2.993-2.022 4.78-5.386 4.78-8.999-.002-3.613-1.789-6.977-4.782-9zm-238.433-156.805h-56.542v-44.831h56.542zm-23.4 229.199h-118.222c-13.677 0-26.616-5.249-36.433-14.78-3.434-3.333-8.017-5.169-12.905-5.169h-62.827v-64.755h63.152c4.777 0 9.325-1.801 12.806-5.072l57.688-54.196c.057-.054.113-.108.168-.163 2.908-2.907 7.639-2.907 10.545 0 1.409 1.408 2.184 3.281 2.184 5.272s-.775 3.864-2.184 5.272l-16.133 16.133c-2.145 2.145-2.787 5.371-1.626 8.173 1.161 2.803 3.896 4.63 6.929 4.63h106.829c4.156 0 7.686 3.179 7.87 7.086.097 2.069-.631 4.027-2.051 5.516-1.422 1.49-3.338 2.311-5.396 2.311h-83.757c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h114.245c4.156 0 7.687 3.179 7.87 7.086.097 2.069-.631 4.028-2.051 5.517-1.421 1.49-3.338 2.311-5.396 2.311h-114.669c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h94.726c2.058 0 3.975.821 5.396 2.311 1.42 1.488 2.148 3.447 2.051 5.516-.184 3.908-3.714 7.086-7.87 7.086h-94.303c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h73.796c2.054.003 3.967.823 5.387 2.311s2.148 3.447 2.051 5.516c-.184 3.909-3.715 7.088-7.87 7.088zm190.88-24.546v-11.851c0-5.989-4.872-10.861-10.861-10.861h-78.749v-32.275h78.749c5.989 0 10.861-4.872 10.861-10.861v-11.85l57.48 38.849z"/></g></g></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="name">Product Delivery</div>
                                    </div>
                                </div>
                            </div>
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