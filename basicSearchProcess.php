<?php

require "connection.php";

$searchText = $_POST["st"];
$searchSelect = $_POST["ss"];

$pageno = $_POST["page"];

$results_per_page = 5;


if (!empty($searchText) && $searchSelect == 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchText . "%'");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchText . "%' LIMIT  $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} else if ($searchSelect != 0 && empty($searchText)) {
    $products = Database::search("SELECT * FROM `product` WHERE `category_id`='".$searchSelect."' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `category_id`='".$searchSelect."' LIMIT  $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (!empty($searchText) && $searchSelect != 0) {
    $products = Database::search("SELECT * FROM `product` WHERE `category_id`='".$searchSelect."' AND `title` LIKE '%" . $searchText . "%' ");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `category_id`='".$searchSelect."' AND `title` LIKE '%" . $searchText . "%' LIMIT  $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} else {
    $spn=0;
}

if ($spn >= 1) {
?>
    <div class="row ms-2 border border-primary mx-lg-2 ps-lg-5">
        <?php
        while ($row = $selectedproducts->fetch_assoc()) {


            $pid = $row["id"];
            $title = $row["title"];
            $price = $row["price"];
            $qty = $row["qty"];

        ?>
            <div class="card mt-2 mb-2 col-6 col-lg-2 ms-lg-4">
                <?php
                $img = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $row["id"] . "'");
                $n1 = $img->num_rows;
                if ($n1 >= 1) {
                    $rowi = $img->fetch_assoc();
                    $image = $rowi["code"];
                }
                ?>
                <img src="<?php echo $image; ?>" class="card-img-top cardtopimg" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $title; ?></h5>
                    <span class="card-text text-primary">RS.<?php echo $price; ?>.00</span>
                    <br />
                    <span class="card-text text-warning">In Stock</span>
                    <input class="form-control mb-2" type="number" value="<?php echo $qty; ?>" />
                    <a href='<?php echo "singleProductView.php?id=" . $pid; ?>' class="btn btn-success col-8 mb-1 ">Buy Now</a>
                    <a href="#" class="btn btn-secondary col-3 ms-2  mb-1" onclick='addToWatchlist(<?php echo $pid; ?>);'><i class="bi bi-heart-fill"></i></a>
                    <a href="#" class="btn btn-danger col-12">Add To Cart</a>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="col-12 mb-3 mt-3">
            <div class="pagination d-flex justify-content-center">
            <?php
            if ($pageno != 1) {
            ?>
                <button class=" btn btn-secondary" onclick="basicSearch(<?php echo $pageno - 1; ?>);">&laquo;</button>
                <?php
            }

            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
                ?>
                    <button class="ms-1 btn btn-dark active" onclick="basicSearch(<?php echo $page; ?>);"><?php echo $page; ?></button>
                <?php
                } else {
                ?>
                    <button class="ms-1 btn btn-secondary" onclick="basicSearch(<?php echo $page; ?>);"><?php echo $page; ?></button>
            <?php
                }
            }
            ?>
            <?php
            if ($pageno < $number_of_pages) {
            ?>
                <button class="ms-1 btn btn-secondary" onclick="basicSearch(<?php echo $pageno + 1; ?>);">&raquo;</button>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
<?php
} else {
?>
<div class="row">
    <h5 class="form-label text-center text-danger">No Products according to your search...</h5>
    <button class="btn btn-warning mx-auto col-3" onclick="gotoback();">Back</button>
</div>
    
    
<?php
}

?>