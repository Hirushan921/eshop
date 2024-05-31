<?php

require "connection.php";

$k = $_POST["k"];
$c = $_POST["c"];
$b = $_POST["b"];
$m = $_POST["m"];
$con = $_POST["con"];
$clr = $_POST["clr"];
$pf = $_POST["pf"];
$pt = $_POST["pt"];
$sort = $_POST["sort"];


$results_per_page = 4;

$pageno = $_POST["page"];

if (!empty($k) && $c == 0 && $b == 0 && $m == 0 && $con == 0 && $clr == 0 && empty($pf) && empty($pt) && $sort == 0) {  // only_search
    $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE'%" . $k . "%'");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (!empty($k) && $c != 0 && $b == 0 && $m == 0 && $con == 0 && $clr == 0 && empty($pf) && empty($pt) && $sort == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE'%" . $k . "%' AND `category_id`='" . $c . "' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' AND `category_id`='" . $c . "' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (!empty($k) && $c == 0 && $b == 0 && $m == 0 && $con != 0 && $clr == 0 && empty($pf) && empty($pt) && $sort == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE'%" . $k . "%' AND `condition_id`='" . $con . "' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' AND `condition_id`='" . $con . "' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (!empty($k) && $c == 0 && $b == 0 && $m == 0 && $con == 0 && $clr != 0 && empty($pf) && empty($pt) && $sort == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE'%" . $k . "%' AND `color_id`='" . $clr . "' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' AND `color_id`='" . $clr . "' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (empty($k) && $c != 0 && $b == 0 && $m == 0 && $con == 0 && $clr == 0 && empty($pf) && empty($pt) && $sort == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (empty($k) && $c == 0 && $b == 0 && $m == 0 && $con != 0 && $clr == 0 && empty($pf) && empty($pt) && $sort == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `condition_id`='" . $con . "' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `condition_id`='" . $con . "' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (empty($k) && $c == 0 && $b == 0 && $m == 0 && $con == 0 && $clr != 0 && empty($pf) && empty($pt) && $sort == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `color_id`='" . $clr . "' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `color_id`='" . $clr . "' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (!empty($k) && $c == 0 && $b == 0 && $m == 0 && $con == 0 && $clr == 0 && !empty($pf) && !empty($pt) && $sort == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE'%" . $k . "%' AND `price` BETWEEN '" . $pf . "' AND '" . $pt . "' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' AND `price` BETWEEN '" . $pf . "' AND '" . $pt . "'  LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (empty($k) && $c != 0 && $b == 0 && $m == 0 && $con == 0 && $clr == 0 && !empty($pf) && !empty($pt) && $sort == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' AND `price` BETWEEN '" . $pf . "' AND '" . $pt . "' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' AND `price` BETWEEN '" . $pf . "' AND '" . $pt . "' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (empty($k) && $c != 0 && $b == 0 && $m == 0 && $con == 0 && $clr == 0 && empty($pf) && empty($pt) && $sort != 0) {
   if($sort==1){
    $products = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ORDER BY `price` ASC ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ORDER BY `price` ASC LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
   }elseif($sort==2){
    $products = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ORDER BY `price` DESC ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ORDER BY `price` DESC LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
   }elseif($sort==3){
    $products = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ORDER BY `qty` ASC ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ORDER BY `qty` ASC LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
   }elseif($sort==4){
    $products = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ORDER BY `qty` DESC ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c . "' ORDER BY `qty` DESC LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
   }
} elseif (!empty($k) && $c == 0 && $b == 0 && $m == 0 && $con == 0 && $clr == 0 && empty($pf) && empty($pt) && $sort != 0) {
    if($sort==1){
        $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' ORDER BY `price` ASC ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' ORDER BY `price` ASC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
       }elseif($sort==2){
     $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' ORDER BY `price` DESC ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' ORDER BY `price` DESC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
       }elseif($sort==3){
        $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' ORDER BY `qty` ASC ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' ORDER BY `qty` ASC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
       }elseif($sort==4){
        $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' ORDER BY `qty` DESC ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' ORDER BY `qty` DESC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
       }
} else {
    $spn = 0;
    $number_of_pages = 0;
}

// $spn = $selectedproducts->num_rows;
?>
<div class="row">
    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">
            <?php
            for ($x = 0; $x < $spn; $x++) {
                $pro = $selectedproducts->fetch_assoc();
            ?>

                <div class="card col-6 mb-3 mt-3">
                    <div class="row g-0">
                        <div class="col-md-4 mt-4">
                            <?php
                            $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pro["id"] . "'");
                            $in = $imgrs->num_rows;
                            $arr;
                            for ($z = 0; $z < $in; $z++) {
                                $ir = $imgrs->fetch_assoc();
                                $arr[$z] = $ir["code"];
                            }
                            ?>
                                <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start" />
                        
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $pro["title"]; ?></h5>
                                <span class="card-text fw-bold text-primary">Rs. <?php echo $pro["price"]; ?>.00</span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $pro["qty"]; ?>Items Left</span>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-8 offset-lg-2 mt-1">
                                            <a href="#" class="btn btn-success d-grid">Buy Now</a>
                                        </div>
                                        <div class="col-12 col-lg-8 offset-lg-2 mt-1 ">
                                            <a href="#" class="btn btn-danger d-grid">Add to Cart</a>
                                        </div>
                                    </div>
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

    <!-- pagination -->
    <div class="col-12 mb-3 mt-3">
        <div class="pagination d-flex justify-content-center">
            <?php
            if ($pageno != 1) {
            ?>
                <button class=" btn btn-secondary" onclick="advancedSearch(<?php echo $pageno - 1; ?>);">&laquo;</button>
                <?php
            }

            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
                ?>
                    <button class="ms-1 btn btn-dark active" onclick="advancedSearch(<?php echo $page; ?>);"><?php echo $page; ?></button>
                <?php
                } else {
                ?>
                    <button class="ms-1 btn btn-secondary" onclick="advancedSearch(<?php echo $page; ?>);"><?php echo $page; ?></button>
            <?php
                }
            }
            ?>
            <?php
            if ($pageno < $number_of_pages) {
            ?>
                <button class="ms-1 btn btn-secondary" onclick="advancedSearch(<?php echo $pageno + 1; ?>);">&raquo;</button>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- pagination -->

</div>
<!-- product -->














<script src="script.js"></script>