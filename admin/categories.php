<?php include('db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category Interface</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Ajout de DataTables -->
  <!--<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">-->
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
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
      background-color: #f9bf29;
      /* Dark green button */
      border-color: #f9bf29;
      /* Dark green border */

      color: black;
    }

    .btn-secondary,
    .btn-secondary:hover,
    .btn-secondary:focus {
      background-color: #d9e2ec;
      /* Light blue button */
      border-color: #d9e2ec;
      /* Light blue border */
      color: #333;

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

      color: black;

    }

    .btn-secondary:hover {
      background-color: #c5d4de;
    }

    .p {
      padding-left: 350px;
      padding-top: 40px;
      font-size: larger;
      font-weight: bolder
    }

    .card-title {
      color: #3b5d50;
      /* Couleur du titre */
      font-weight: bold;
      padding-left: calc(100% - 60%);
      padding-top: 40px;

    }

    .btn {
      border-radius: 30px;
      /* Coins arrondis pour les boutons */
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
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- FORM Panel -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Add Category
          </div>
          <div class="card-body">
            <form action="" id="manage-category">
              <input type="hidden" name="id">
              <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-control" name="name">
              </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary btn-block">Save</button>
                <button class="btn btn-secondary btn-block" type="button" onclick="$('#manage-category').get(0).reset()">Cancel</button>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
      <!-- FORM Panel -->

      <!-- Table Panel -->
      <div class="col-md-8">
        <div class="card">

          <h4 class="card-title">Category List</h4>


          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $category = $conn->query("SELECT * FROM categories order by id asc");
                while ($row = $category->fetch_assoc()) :
                ?>
                  <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary edit_category" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>">Edit</button>
                      <button class="btn btn-sm btn-outline-danger delete_category" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Table Panel -->
    </div>
  </div>
</body>

</html>

<script>
  $('#manage-category').submit(function(e) {
    e.preventDefault()
    start_load()
    $.ajax({
      url: 'ajax.php?action=save_category',
      data: new FormData($(this)[0]),
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      type: 'POST',
      success: function(resp) {
        if (resp == 1) {
          alert_toast("Data successfully added", 'success')
          setTimeout(function() {
            location.reload()
          }, 1500)

        } else if (resp == 2) {
          alert_toast("Data successfully updated", 'success')
          setTimeout(function() {
            location.reload()
          }, 1500)

        }
      }
    })
  })
  $('.edit_category').click(function() {
    start_load()
    var cat = $('#manage-category')
    cat.get(0).reset()
    cat.find("[name='id']").val($(this).attr('data-id'))
    cat.find("[name='name']").val($(this).attr('data-name'))
    cat.find("[name='description']").val($(this).attr('data-description'))
    end_load()
  })
  $('.delete_category').click(function() {
    _conf("Are you sure to delete this category?", "delete_category", [$(this).attr('data-id')])
  })

  function delete_category($id) {
    start_load()
    $.ajax({
      url: 'ajax.php?action=delete_category',
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
  $('table').dataTable()
</script>