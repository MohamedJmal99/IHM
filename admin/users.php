<?php

?>

<!--<div class="container-fluid">

	<div class="row">
		<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
		</div>
	</div>
	<br>-->
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
        <h4 class="card-title">Users List</h4>
      </div>
      <div class="col-md-6 text-right">
        <div class="text-right mb-3">
          <a class="btn btn-secondary me-2" id="new_user" >
            <i class="fa fa-plus"></i> Add User
          </a>
        </div>
      </div>
    </div>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Name</th>
							<th scope="col">Username</th>
							<th scope="col">Type</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include 'db_connect.php';
						$type = array("", "Admin", "Staff", "Alumnus/Alumna");
						$users = $conn->query("SELECT * FROM users order by name asc");
						$i = 1;
						while ($row = $users->fetch_assoc()) :
						?>
							<tr>
								<td class="text-center">
									<?php echo $i++ ?>
								</td>
								<td>
									<?php echo ucwords($row['name']) ?>
								</td>

								<td>
									<?php echo $row['username'] ?>
								</td>
								<td>
									<?php echo $type[$row['type']] ?>
								</td>
								<td class="text-center" style="min-width: 150px;">
                      <button class="btn btn-sm btn-outline-primary edit_user" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
                      <button class="btn btn-sm btn-outline-danger delete_user" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                    </td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
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
	$('table').dataTable();
	$('#new_user').click(function() {
		uni_modal('New User', 'manage_user.php')
	})
	$('.edit_user').click(function() {
		uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'))
	})
	$('.delete_user').click(function() {
		_conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
	})

	function delete_user($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_user',
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