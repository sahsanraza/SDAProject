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

    .myhover:hover {
      background-color: #ecf0f1;
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
  .header{
    color: #333;
    font-weight: 700;
  }
  .card-body h2{
    font-size: 3rem;
  } .card-body h5{
    font-size: 2rem;
  }
  </style>
</head>

<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <a class="my-0 mr-md-auto font-weight-normal header" href="<?php echo site_url('User/Index'); ?>" title="Inventory Management System" data-toggle="tooltip">IMS</a>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="<?php echo site_url("Admin/Products"); ?>">Products</a>
    <a class="p-2 text-dark" href="<?php echo site_url("Admin/AllOrders"); ?>">Orders</a>
    <a class="p-2 text-dark" href="<?php echo site_url("Admin/AllUsers"); ?>">Users</a>
    <a class="p-2 text-dark" href="<?php echo site_url("Admin/AllComplains"); ?>">Complaints</a>
    <a class="p-2 text-dark" href="<?php echo site_url("Admin/Bundles"); ?>">Bundles</a>
  </nav>
  <a class="btn btn-outline-danger" href="<?php echo site_url("Account/Signout"); ?>">Sign out</a>
</div>
 
  <div class="container-fluid mt-5">
    <?php $this->load->view($Content); ?>
  </div>
  <footer class="text-center site-footer">
    Copyright &copy; 2020 IMS. All Rights Reserved.
  </footer>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  })
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