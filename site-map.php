<?php
include('neutral-header.php');
?>
                                <li><span>/</span></li>
                                <li>Site Map</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-header-section end -->



            <!-- about section start -->
            <section class="about-section section-ptb">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <h3>Learn More</h3>
                                <ul>
                                    <li><a href="index.php#how-it-works">How it works</a></li>
                                    <li><a href="index.php#home-tier-system">Home Tier system</a></li>
                                    <li><a href="index.php#exchange-points-system">Exchange points system</a></li>
                                    <li><a href="faq.php">FAQs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-lg-12 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <h3>Homes List</h3>
                                <div class="row">
                                    <?php
                                        foreach($categoriesList as $row){
                                            $stockmenu = mysqli_query($connection,"SELECT id, Name from stock where Category_id = '".$row['id']."'")or die($connection->error);                                        
                                    ?>
                                    <div class="col-3">
                                        <h5><?php echo $row['Category_Name']; ?></h5>
                                        <ul>
                                            <?php
                                                foreach($stockmenu as $row2){   
                                            ?>
                                            <li><a href="product-list.php#<?php echo $row2['Name']; ?>"><?php echo $row2['Name']; ?></a></li>
                                            <?php
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-lg-12 order-lg-last pr-xl-5">
                            <div class="about-content mb-4 mb-lg-0 pr-lg-5">
                                <h3>Contact Us</h3>
                                <ul>
                                    <li><a href="contact.php">Contact Us</a></li>
                                    <li><a href="#">Facebook</a></li>
                                    <li><a href="#">Twitter</a></li>
                                    <li><a href="#">Instagram</a></li>
                                    <li><a href="#">YouTube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                </div>
            </section>


<?php
include('footer.php');
?>