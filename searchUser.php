<?php
require "connection.php";

if (isset($_GET["s"])) {
    $text = $_GET["s"];

    if (!empty($text)) {
        $userrs = Database::search("SELECT * FROM `user` WHERE `email` LIKE '%" . $text . "%'");
        $unum = $userrs->num_rows;
?>
        <div style="margin-bottom:200px;">
            <?php

            $l = "0";
            for ($n = 0; $n < $unum; $n++) {
                $l = $l + 1;
                $row = $userrs->fetch_assoc();

            ?>
                <div class="col-12 mb-2">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                            <span class="fs-5 fw-bold text-white"><?php echo $l ?></span>
                        </div>
                        <?php
                        $userimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $row["email"] . "'");
                        $usimnum=$userimg->num_rows;
                        $usimg = $userimg->fetch_assoc();
                        ?>
                       <div class="col-2 bg-light d-none d-lg-block text-center">
                                <?php
                                if ($usimnum == 1) {
                                ?>
                                    <img src="<?php echo $usimg["code"]; ?>" style="height: 70px; " />
                                <?php
                                } else {
                                ?>
                                    <img src="resources/demoProfileImg.jpg" style="height: 70px; " />
                                <?php
                                }
                                ?>
                            </div>
                        <div class="col-3 bg-primary pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-5 fw-bold text-white"><?php echo $row["email"]; ?></span>
                        </div>
                        <div class="col-6 col-lg-2 bg-light pt-2 pb-2 ">
                            <span class="fs-5 fw-bold"><?php echo $row["fname"] . " " . $row["lname"]; ?></span>
                        </div>
                        <div class="col-1 bg-primary pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-5 fw-bold text-white"><?php echo $row["mobile"]; ?></span>
                        </div>
                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-5 fw-bold"><?php
                                                        $regd = $row["register_date"];
                                                        $splitregd = explode(" ", $regd);
                                                        echo $splitregd[0];
                                                        ?></span>
                        </div>
                        <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                            <?php
                            $st = $row["status_id"];
                            if ($st == "1") {
                            ?>
                                <button class="btn btn-danger" onclick="blockuser('<?php echo $row['email']; ?>')">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-success" onclick="blockuser('<?php echo $row['email']; ?>')">Unblock</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
<?php
    } else {
        echo "no";
    }
}



?>