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
				<h4 class="card-title">List of Bids</h4>
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
								<th class="">Name</th>
								<th class="">Product</th>
								<th class="">Amount</th>
								<th class="">Status</th>
								<th class="">Details</th>
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
							$books = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id ");
							while ($row = $books->fetch_assoc()) :
								$get = $conn->query("SELECT * FROM bids where product_id = {$row['product_id']} order by bid_amount desc limit 1 ");
								$uid = $get->num_rows > 0 ? $get->fetch_array()['user_id'] : 0;
							?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p> <b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										<p> <b><?php echo ucwords($row['uname']) ?></b></p>
									</td>
									<td class="text-right">
										<p> <b><?php echo number_format($row['bid_amount'], 2) ?></b></p>
									</td>
									<td class="text-center">
										<?php if ($row['status'] == 1) : ?>
											<?php if (strtotime(date('Y-m-d H:i')) < strtotime($row['bdt'])) : ?>
												<span class="badge badge-secondary">Bidding Stage</span>
											<?php else : ?>
												<?php if ($uid == $row['user_id']) : ?>
													<span class="badge badge-success">Wins in Bidding</span>
												<?php else : ?>
													<span class="badge badge-secondary">Loose in Bidding</span>
												<?php endif; ?>
											<?php endif; ?>
										<?php elseif ($row['status'] == 2) : ?>
											<span class="badge badge-primary">Confirmed</span>
										<?php else : ?>
											<span class="badge badge-danger">Canceled</span>
										<?php endif; ?>
									</td>
									<td>
										<button class="btn btn-primary btn-sm view_user" type="button" data-id='<?php echo $row['user_id'] ?>'>View Buyer Details</button>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>
		<!-- Table Panel -->
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
		font-weight: bolder;
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

	.badge-success {
		background-color: #f9bf29 !important;
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

	$('.view_user').click(function() {
		uni_modal("<i class'fa fa-card-id'></i> Buyer Details", "view_udet.php?id=" + $(this).attr('data-id'))

	})
	$('#new_book').click(function() {
		uni_modal("New Book", "manage_booking.php", "mid-large")

	})
	$('.edit_book').click(function() {
		uni_modal("Manage Book Details", "manage_booking.php?id=" + $(this).attr('data-id'), "mid-large")

	})
	$('.delete_book').click(function() {
		_conf("Are you sure to delete this book?", "delete_book", [$(this).attr('data-id')])
	})

	function delete_book($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_book',
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