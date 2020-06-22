<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title><?php echo $Title; ?></title>
  <style>
    .chart {
      height: 200px;
    }

    .inlineChart {
      float: left;
      width: 30%;
      margin-bottom: 50px;
    }

    .inlineChart canvas {
      float: left;
    }

    .inlineChart .info {
      float: left;
      padding-left: 20px;
      padding-top: 16px;
    }

    .inlineChart .info .value {
      font-size: 2.0rem;
      color: #D3D3D3;
    }

    .site-footer {
      background-repeat: no-repeat;
      background-position: center top;
      text-align: center;
      position: fixed;
      width: 100%;
      bottom: 0;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-default" style="background-color: #353b48">
    <a class="navbar-brand" href="#">Inventory Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo site_url('Admin/Index'); ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url("Admin/Products"); ?>">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url("Admin/AllOrders"); ?>">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url("Admin/AllUsers"); ?>">Users</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <a class="nav-item justify-content-end text-white" href="<?php echo site_url("Account/Signout"); ?>">Signout</a>
      </form>
    </div>
  </nav>
  <div class="container-fluid mt-5">
    <?php $this->load->view($Content); ?>
  </div>
  <footer class="text-center site-footer">
    Copyright &copy; 2020 Syed Ahsan Raza. All Rights Reserved.
  </footer>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script type="text/javascript">
    $('.btn-delete').on('click', function() {
      var id = $(this).attr('data-id');
      var funct = $(this).attr('data-action');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.value) {
          window.location.replace('<?php echo site_url("Admin/"); ?>' + funct + "/" + id);
        }
      });
    });

    $('.btn-check').on('click', function() {
      var id = $(this).attr('data-id');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.value) {
          window.location.replace('<?php echo site_url("Admin/UpdateUserStatus/"); ?>' + id);
        }
      });
    });
  </script>

</body>

</html>