<?php
include 'admin/db_connect.php';
?>
<!-- <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }
    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style> -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="./images/carousel1.jpg">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="./images/carousel2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="./images/carousel3.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<?php
$cid = isset($_GET['category_id']) ? $_GET['category_id'] : 'all'; // Corrected: Default to 'all' if not set
?>

<div class="bids-title" style="width: 100%; margin-top: 50px !important; margin-bottom: 75px !important">
    <h2 class="home-bids-title" style="color: #3b5d50; text-align: center; font-family: Poppins, Sans-serif; font-size: 50px; position: relative; text-shadow: 0px 0px 40px #000000; text-transform: uppercase;">Our Glasses Products</h2>
</div>
<div class="untree_co-section product-section before-footer-section">
    <div class="container-home">
        <div class="row">
            <div class="col-md-3">
                <main>
                    <div class="card-body">
                        <ul class="list-group" id="cat-list">
                            <li class="list-group-item" data-id="all" data-href="index.php?page=home&category_id=all">All</li>
                            <?php
                            $cat = $conn->query("SELECT * FROM categories ORDER BY name ASC");
                            while ($row = $cat->fetch_assoc()) :
                                $cat_arr[$row['id']] = $row['name'];
                            ?>
                                <li class="list-group-item" data-id="<?php echo $row['id'] ?>" data-href="index.php?page=home&category_id=<?php echo $row['id'] ?>">
                                    <?php echo ucwords($row['name']) ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </main>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $where = ""; // Initialize empty where condition
                            if ($cid != 'all') { // Corrected: Apply filtering condition only if $cid is not 'all'
                                $where = " WHERE category_id = $cid ";
                            }
                            $cat = $conn->query("SELECT * FROM products $where ORDER BY name ASC"); // Corrected: Include $where in the query
                            if ($cat->num_rows <= 0) {
                                echo "<center><h4><i>No Available Product.</i></h4></center>";
                            }
                            while ($row = $cat->fetch_assoc()) :
                            ?>
                                <div class="col-sm-4">
                                    <div class="card" style="box-shadow: 0px 7px 29px 0px rgb(0 0 0 / 26%); border-radius: 20px; text-align: center; padding: 0px !important;">
                                        <div class="float-right align-top bid-tag">
                                            <span class="badge badge-pill badge-primary text-white" style="font-size: 12px;">
                                                <?php echo number_format($row['regular_price']) ?> €
                                            </span>
                                        </div>
                                        <img src="admin/assets/uploads/<?php echo $row['img_fname'] ?>" class="card-img-top" alt="..." style="border-top-left-radius: 20px; border-top-right-radius: 20px; height: 200px !important; object-fit: cover;">
                                        <div class="float-right align-top d-flex">
                                            <!-- <span class="badge badge-pill badge-warning text-white"><i class="fa fa-hourglass-half"></i> -->
                                            <!-- <?php echo date("M d,Y h:i A", strtotime($row['bid_end_datetime'])) ?></span> -->
                                        </div>
                                        <div class="card-body prod-item" style="padding: 20px;">
                                            <p style="font-weight: bolder; color: #000;"><?php echo $row['name'] ?></p>
                                            <p style="font-weight: bolder; color: #000;"><small><?php echo $cat_arr[$row['category_id']] ?></small></p>
                                            <p class="truncate"><?php echo $row['description'] ?></p>
                                            <button class="btn btn-primary btn-sm view_prod" type="button" data-id="<?php echo $row['id'] ?>">View</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#cat-list li').click(function() {
        location.href = $(this).attr('data-href')
    });
    $('#cat-list li').each(function() {
        var id = '<?php echo $cid ?>'; // Corrected: Properly initialize id with $cid
        if (id == $(this).attr('data-id')) {
            $(this).addClass('active')
        }
    });
    $('.view_prod').click(function() {
        uni_modal_right('View Product', 'view_prod.php?id=' + $(this).attr('data-id'))
    });
</script>
