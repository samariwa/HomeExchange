<?php
  include('header.php');
  //$my_orders = mysqli_query($connection,"SELECT order_status.id as status_id,order_status.status as status,DATE(orders.Delivery_time) as order_date FROM order_status INNER JOIN orders ON orders.Status_id = order_status.id INNER JOIN customers ON orders.Customer_id = customers.id where orders.Customer_id = '$customer_id' GROUP BY order_status.id ORDER BY order_status.Created_at DESC LIMIT 1")or die($connection->error);
  //$value = mysqli_fetch_array($my_orders);
  //$order_details = mysqli_query($connection,"SELECT SUM(orders.Quantity * (stock.Price - stock.Discount))as sum FROM orders INNER JOIN stock on orders.Stock_id = stock.id where orders.Status_id = '".$value['status_id']."' ")or die($connection->error);
  //$row = mysqli_fetch_array($order_details);
?> 
           <!-- page-header-section start -->
           <div class="page-header-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between justify-content-md-end">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Dashboard</a></li>
                                <li><span>/</span></li>
                                <li>Reservation Success</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- Product order success section start -->
            <section class="product-order-success-section section-ptb">
                <div class="container">
                    <div class="product-order-success-container">
                        <div class="product-order-success">
                            <div class="iconimage">
                                <img src="assets/images/checkicon.png" alt="icon">
                            </div>
                            <h2>Request sent successfully.</h2>
                            <p>Please wait for a response from the owner. We shall notify you as soon as possible.</p>
                        </div>
                        <div class="order-description">
                            <h5>Would you like to share with us about your experience on the platfrom?</h5>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <a href="#" data-toggle="modal" data-target="#exampleModalScrollable" role="button" aria-pressed="true" class="btn btn-outline-danger yes-feedback offset-9 rounded-pill">Yes</a>
                                    <form method="POST"> 
                                    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Customer Feedback</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body"> 
                                            <div class="row">
                                            <label for="feedback-message" style="margin-left: 60px;">Feedback:</label>
                                            <textarea id="feedback-message" class="form-control col-md-9" style="padding:15px;margin-left: 60px" name="feedback-message" required></textarea>
                                            </div><br>
                                            <input type="hidden" name="customer_id" id="customer_id"  value="<?php echo $customer_id; ?>">
                                        </div>
                                        <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger sendFeedback" role="button" aria-pressed="true" style="margin-right: 50px" id="sendFeedback">Send Feedback</button>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                   </form>
                                </div>
                                <div class="col-6">
                                     <a href="homes-list.php" class="btn btn-outline-danger no-feedback rounded-pill">Not now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Product order success section end -->
<?php
    include('footer.php');
?>