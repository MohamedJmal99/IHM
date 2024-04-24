<?php include('db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Produits</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Ajout de DataTables -->
  <!--<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">-->
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
  <div class="container">
    <div class="row mt-4 mb-4">
      <div class="col-md-6">
        <h4 class="card-title">Products List</h4>
      </div>
      <div class="col-md-6 text-right">
        <div class="text-right mb-3">
          <a class="btn btn-secondary me-2" href="index.php?page=manage_product" id="new_product">
            <i class="fa fa-plus"></i> Add product
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-condensed table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">Id</th>
                  <th class="">Img</th>
                  <th class="category-column">Category</th> <!-- Add class for Category column -->
                  <th class="product-column">Product</th>
                  <th class="other-info-column">Other Info</th> <!-- Add class for Other Info column -->
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $cat = array();
                $cat[] = '';
                $qry = $conn->query("SELECT * FROM categories ");
                while ($row = $qry->fetch_assoc()) {
                  $cat[$row['id']] = $row['name'];
                }
                $products = $conn->query("SELECT * FROM products order by name asc ");
                while ($row = $products->fetch_assoc()) :
                  $get = $conn->query("SELECT * FROM bids where product_id = {$row['id']} order by bid_amount desc limit 1 ");
                  $bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0;
                  $tbid = $conn->query("SELECT distinct(user_id) FROM bids where product_id = {$row['id']} ")->num_rows;
                ?>
                  <tr data-id='<?php echo $row['id'] ?>'>
                    <td class="text-center"><?php echo $i++ ?></td>
                    <td class="">
                      <div class="row justify-content-center">
                        <img src="<?php echo 'assets/uploads/' . $row['img_fname'] ?>" alt="">
                      </div>
                    </td>
                    <td>
                      <p> <b><?php echo ucwords($cat[$row['category_id']]) ?></b></p>
                    </td>
                    <td class="">
                      <p>Name: <b><?php echo ucwords($row['name']) ?></b></p>
                      <p><small>Description: <b><?php echo $row['description'] ?></b></small></p>
                    </td>
                    <td>
                      <p><small>Regular Price: <b><?php echo number_format($row['regular_price'], 2) ?></b></small></p>
                      <p><small>Start Price: <b><?php echo number_format($row['start_bid'], 2) ?></b></small></p>
                      <p><small>End Date/Time: <b><?php echo date("M d,Y h:i A", strtotime($row['bid_end_datetime'])) ?></b></small></p>
                      <p><small>Highest Bid: <b class="highest_bid"><?php echo number_format($bid, 2) ?></b></small></p>
                      <p><small>Total Bids: <b class="total_bid"><?php echo $tbid ?> user/s</b></small></p>
                    </td>
                    <td class="text-center" style="min-width: 150px;">
                      <button class="btn btn-sm btn-outline-primary edit_product" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
                      <button class="btn btn-sm btn-outline-danger delete_product" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    /* Light gray background */
  }

  .card {
    border: none;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    /* White background */

  }

  .card-title {
    color: #3b5d50;
    /* Couleur du titre */
    font-weight: bold;
  }

  .card-header {
    background-color: #3b5d50;
    /* Dark green header */
    color: #fff;
    /* White text */
    font-weight: bold;
  }

  .btn-primary,
  .btn-primary:hover,
  .btn-primary:focus {
    background-color: #3b5d50;
    /* Dark green button */
    border-color: #3b5d50;
    /* Dark green border */
  }

  .btn.btn-secondary {
    color: #2f2f2f;
    background: #f9bf29;
    border-color: #f9bf29;
  }

  .btn.btn-secondary:hover {
    background: #f8b810;
    border-color: #f8b810;
  }

  .table {
    border-radius: 10px;
    overflow: hidden;
  }

  .table th,
  .table td {
    border: none;
  }

  .table th {
    background-color: #3b5d50;
    /* Dark green header */
    color: #fff;
    /* White text */
    /*color: #f9bf29;*/
    font-weight: bold;
    text-align: center;
  }

  .table td {
    text-align: center;
  }

  .btn-primary:hover {
    background-color: #2e4c40;
    color: #f9bf29;
  }

  .btn {
    border-radius: 30px;
    /* Coins arrondis pour les boutons */
  }

  td {
    vertical-align: middle !important;
  }

  td p {
    margin: unset
  }

  table td img {
    max-width: 100px;
    max-height: 150px;
  }

  img {
    max-width: 100px;
    max-height: 150px;
  }

  .p {
    padding-left: calc(100% - 60%);
    font-size: larger;
    font-weight: bolder;
  }

  .btn-outline-primary {
    color: #3b5d50;
    /* Dark green text */
    border-color: #3b5d50;
    /* Dark green border */
  }

  .btn-outline-primary:hover,
  .btn-outline-primary:focus,
  .btn-outline-primary:active {
    background-color: #3b5d50 !important;
    /* Dark green background */
    color: #fff !important;
    border-color: #3b5d50 !important;
  }

  .btn-outline-primary:focus,
  .btn-outline-primary:active {
    outline: none !important;
    /* Remove default focus outline */
    box-shadow: 0 0 0 0.2rem rgba(59, 93, 80, 0.5) !important;
    /* Dark green focus shadow */
  }

  /* Add this CSS to adjust column widths */
  .table th.category-column {
    width: 100px;
    /* Adjust the width of the Category column as needed */
  }

  .table th.other-info-column {
    width: 300px;
    /* Adjust the width of the Other Info column as needed */
  }
  .table th.product-column {
    width: 300px;
    /* Adjust the width of the Other Info column as needed */
  }
  .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #f9bf29 !important;
    border-color: #f9bf29 !important;
}
.page-link{
  color: #3b5d50!important;
}
.a{
	color:#3b5d50!important;
}
</style>
<script>
  $(document).ready(function() {
    $('table').dataTable()
  })

  $('.view_product').click(function() {
    uni_modal("product Details", "view_product.php?id=" + $(this).attr('data-id'), 'mid-large')

  })
  $('.edit_product').click(function() {
    location.href = "index.php?page=manage_product&id=" + $(this).attr('data-id')

  })
  $('.delete_product').click(function() {
    _conf("Are you sure to delete this product?", "delete_product", [$(this).attr('data-id')])
  })

  function delete_product($id) {
    start_load()
    $.ajax({
      url: 'ajax.php?action=delete_product',
      method: 'POST',
      data: {
        id: $id
      },
      success: function(resp) {
        if (resp == 1) {
          alert_toast("Data successfully deleted", 'success')
          setTimeout(function() {
            location.reload()
          }, 1500)

        }
      }
    })
  }
</script>