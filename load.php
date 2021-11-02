<?php
require('config.php');
require_once "queries.php";
include "functions.php";
session_start();
if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == TRUE) {
        $customer = mysqli_query($connection,"SELECT id FROM users  WHERE email_address='".$_SESSION['email']."'");
        $customer_row = mysqli_fetch_array($customer);
    }
}
if( $_POST['where'] == 'filter' )
{
    $filterList = "SELECT homes.id as home_id, first_name, last_name, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details,availability_start_date,availability_end_date,home_availability_status,extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id INNER JOIN home_availability ON home_availability.home_id = homes.id INNER JOIN home_features ON homes.id = home_features.home_id WHERE home_status = '1'";
    if(isset($_POST['minimum_rating'],$_POST['minimum_rating']))
    {
        $filterList .= "AND homes.average_rating BETWEEN '".$_POST['minimum_rating']."' AND '".$_POST['maximum_rating']."'";
    }
    if(isset($_POST['county']))
    {
        $county_filter = implode("','", $_POST['county']);
        $filterList .= "AND county IN ('".$county_filter."')";
    }
    if(isset($_POST['features']))
    {
        $features_data = json_decode(stripslashes($_POST['features']));
        $feature_subquery = '';
        foreach($features_data as $feature){
        $feature_subquery .= " AND ".$feature."= '1'";
        }
        $filterList .= $feature_subquery;
    }
    $filterResult = mysqli_query($connection, $filterList)or die($connection->error);
    $filterrowcount = mysqli_num_rows($filterResult);
    $output = '';
    if($filterrowcount > 0)
    {
        foreach($filterResult as $row)
        {
            $output .= '
            <div class="col-sm-6 col-xl-4" id="'.$row['home_id'].'">
            <div class="product-item ';
            if($row['home_availability_status'] == 0 ){ 
                $output .= ' reserved ';
             }
             $output .= '" id="'.$row['home_id'].'">
                <div class="product-thumb">
                    <!--you can add this onclick to anchor tag below when necessary-->
                        <!--onclick="openModal()"-->
                    <a  href="home-dashboard.php?id='.$row['home_id'].'" class="modalOpen" id="'.$row['home_id'].'"><img src="assets/images/homes/'.$row['home_image'].'" alt="home"></a>
                    ';
                    $start_date = strtotime($row['availability_start_date']);
                        $current_date = time();
                        $diff_date = round(($start_date - $current_date) / (60 * 60 * 24));
                        if($diff_date <= 10)
                        {
                            if($diff_date == 1){
                    
                                $output .= '<span class="batch sale">Tomorrow</span>';
                    
                            }
                            elseif($diff_date > 1){
                    
                                $output .= '<span class="batch sale">In '.$diff_date. ' days</span>';
                            }
                            elseif($diff_date == 0){
                        
                                $output .= '<span class="batch sale">Today</span>';
                        
                            }
                        }
                        $item_in_wishlist = '';
                        $item_in_wishlist_id = '';
                        $home_in_wishlist = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='".$customer_row['id']."' AND home_id = '".$row['home_id']."'");
                        $home_wishlist_result = mysqli_fetch_array($home_in_wishlist);
                        if ( $home_wishlist_result == true) {
                            $item_in_wishlist = true;
                            $item_in_wishlist_id = $home_wishlist_result["home_id"];
                        }
                        else{
                            $item_in_wishlist = false;
                        }
                               if($item_in_wishlist == true){
                                $output .= '<a class="wish-link"
                                href="'.$protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/homes-list.php?action=add_wishlist&id='.$row['home_id']. '">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path style="fill:red;" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>';
                            
                               }
                               if($item_in_wishlist == false){
                                $output .= '<a class="wish-link"
                                href="'.$protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/homes-list.php?action=add_wishlist&id='.$row['home_id']. '">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>';
                               }
                               $output .= '
                    </a>
                </div>
                <div class="product-content">
                    <a href="home-dashboard.php?id='.$row['home_id'].'" class="cata" id="itemCategory'.$row['home_id'].'">Tier'.$row['home_tier'].'</a>
                    <h6><a href="home-dashboard.php?id='.$row['home_id'].'" class="product-title">'.$row['name'].'</a></h6>
                    <p class="quantity">'.$row['county'].'</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="price">Ratings</div>'.rateFilter($row['average_rating']);
             $output .= '</div>
                    </div>
                </div>
            </div>
        </div>';
        }
    }
    else{
        $output = '
                <h3 class="mt-5 ml-5" style="color:#FD5555;">Home not found</h3>
        ';
    }
    echo $output;
}
elseif( $_POST['where'] == 'pagination' )
{
    $records_per_page = 9;
    $page = '';
    $output = '<div class="row align-items-center">';
    if(isset($_POST['page']))
    {
        $page = $_POST['page'];
    }
    else
    {
      $page = 1;
    }
    $start_from = ((int)$page - 1) * $records_per_page;
    $query = "SELECT * FROM blogs ORDER BY id ASC LIMIT $start_from,$records_per_page";
    $pageResult = mysqli_query($connection, $query)or die($connection->error);
    foreach($pageResult as $row){
        $id = $row['id'];
        $title = $row['title'];
        $blog = $row['blog'];
        $image = $row['image'];
        $Date = $row['Created_at'];
        $date = date( 'F d, Y', strtotime($Date));
        $Blog='';
        if(strlen($blog)<=100)
        {
          $Blog = $blog;
        }
        else
        {
          $Blog=substr($blog,0,100) . '...';
        }
        $comments = mysqli_query($connection,"SELECT * FROM comments WHERE blog_id = '$id' AND belongs_to = 'blog'")or die($connection->error);
        $comments_count = mysqli_num_rows($comments); 
        $output .= '<div class="col-md-6 col-lg-4 mb--30">
            <div class="post-item">
                <div class="post-thumb">
                    <a href="blog-single.php?id='.$id.'"><img src="assets/images/blog/'.$image.'" alt="thumb"></a>
                </div>
                <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                        <li>
                            <span class="icon"><i class="far fa-clock"></i></span>
                            <span class="meta-content">'.$date.'</span>
                        </li>
                        <li>
                            <span class="icon"><i class="far fa-comment-alt"></i></span>
                            
                            <a href="blog-single.php?id='.$id.'#comments-section" class="meta-link">'.$comments_count.' Comment';
                            if($comments_count != 1){ 
                            $output .= 's';  
                            }
                            $output .= '</a>
                        </li>
                    </ul>
                    <h4 class="title mb-3">'.$title.'</h4>
                    <h5 class="title mb-3"><a href="blog-single.php?id='.$id.'">'.$Blog.'</a></h5>
                    <a href="blog-single.php" class="blog-btn">Read More</a>
                </div>
            </div>
        </div>';
            }
        $blogsrowcount = mysqli_num_rows($blogsList);
        $total_pages = ceil($blogsrowcount / $records_per_page);
        $prev = (int)$page - 1;
        $next = (int)$page + 1;
        $output .= '<div class="col-12 pt--30">
            <ul class="pagination justify-content-center justify-content-lg-start">
                <li><a class="d-flex pagination_link" href="#" id="'.$prev.'><i class="icon fas fa-angle-left"></i><span class="text">';
                if($page != 1){
                $output .= 'Prev';
                }
                $output .= '</span></a></li>';
               for($i=1; $i<=$total_pages; $i++){
                $output .= '<li class="d-none d-md-block"><a class="pagination_link';
                if( $page == $i ){
                    $output .= ' active'; 
                }
                $output .= '" href="#" id="'.$i.'">'.$i.'</a></li>
                ';
               }
                $output .= '<li><a class="d-flex pagination_link" href="#" id="'.$next.'"><span class="text">';
                 if($page != $total_pages){
                $output .= 'Next</span><i class="icon fas fa-angle-right"></i>';
                 }

                $output .= '
                </a></li>
            </ul>
        </div>
        </div>
        ';
        echo $output;
}
 ?>
