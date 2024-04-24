<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style1.css" rel="stylesheet">
</head>

<?php
session_start();
include('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
  if (!is_numeric($key))
    $_SESSION['system'][$key] = $value;
}
ob_end_flush();
include('header.php');


?>




<body id="page-top">
  <!-- Navigation-->
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">

      <a class="custom-navbar navbar-brand " href="./" style="display: flex;align-items: center !important;"><img src="./images/enchere1.png" alt="auction-icon" style="margin: auto 10px; width: 30px !important;">MDS BIDDING</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="searchGroup">

        <input type="search" class="form-control roundedSearch" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <span class="searchIcon border-0" id="search-addon">
          <i class="fas fa-search"></i>
        </span>
      </div>

      <div class="collapse navbar-collapse" id="navbarsFurni">

        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">

          <li class="nav-item "><a class="nav-link" href="index.php?page=home" style="font-size: 17px;">Home</a></li>

          <li class="nav-item"><a class="nav-link" href="index.php?page=about" style="font-size: 17px;">About us</a></li>
          <?php if (isset($_SESSION['login_id'])) : ?>
            <li class="nav-item"><a class="nav-link" href="admin/ajax.php?action=logout2" style="font-size: 17px;"><?php echo "Welcome " . $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a></li>
          <?php else : ?>
            <li class="nav-item"><a class="nav-link" href="javascript:void(0)" id="login_now" onclick="uni_modal('Login', 'login.php')" style="font-size: 17px;">Login</a></li>
          <?php endif; ?>



        </ul>
      </div>
    </div>
  </nav>
  <main>
 
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    include $page . '.php';
    ?>

  </main>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-right"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
        <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
  <footer class=" py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0 text-white" style="color: #3b5d50 !important;">Contact us</h2>
          <hr class="divider my-4" />
        </div>
      </div>
      <div class="row" style="justify-content: space-around;">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0" style="padding: 20px;background: #fff;box-shadow: 0px 7px 29px 0px rgb(0 0 0 / 26%);border-radius: 20px;border-top: 3px solid #3b5d50;width: 100%;max-width: 400px;margin-left: 0px !important;margin-right: 40px;">
          <i class="fas fa-phone fa-3x mb-3 text-muted" style="transform: rotate(90deg) !important;"></i>
          <div class="text-black"><a href="tel:'<?php echo $_SESSION['system']['contact'] ?>'"><?php echo $_SESSION['system']['contact'] ?></a></div>
        </div>
        <div class="col-lg-4 mr-auto text-center" style="padding: 20px;background: #fff;box-shadow: 0px 7px 29px 0px rgb(0 0 0 / 26%);border-radius: 20px;border-top: 3px solid #3b5d50; margin-bottom: 0px !important;width: 100%;max-width: 400px;">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
          <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
        </div>
        <div class="col-lg-4 mr-auto text-center" style="padding: 20px;background: #fff;box-shadow: 0px 7px 29px 0px rgb(0 0 0 / 26%);border-radius: 20px;border-top: 3px solid #3b5d50; margin-bottom: 0px !important;width: 100%;max-width: 400px;">
          <h3 style="color:#3b5d50">SUBSCRIBE</h3>
          <div class="social-media-icons" style="display: flex;justify-content: space-evenly;">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-linkedin"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="container">
      <div class="small text-center text-muted">Copyright © 2024 - MDS BIDDING </div>
    </div>
  </footer>

  <?php include('footer.php') ?>
</body>
<script type="text/javascript">
  $('#login').click(function() {
    uni_modal("Login", 'login.php')
  })

  $('.datetimepicker').datetimepicker({
    format: 'Y-m-d H:i',
  })
  $('#find-car').submit(function(e) {
    e.preventDefault()
    location.href = 'index.php?page=search&' + $(this).serialize()
  })
</script>
<?php $conn->close() ?>

</html>