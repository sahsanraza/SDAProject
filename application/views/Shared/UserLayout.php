<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title><?php echo $Title; ?></title>
</head>
<style>
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
<!-- #778ca3; color:#f5f6fa -->

<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <a  class="my-0 mr-md-auto header" href="<?php echo site_url('User/Index'); ?>" title="Inventory Management System" data-toggle="tooltip">IMS</a>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="<?php echo site_url("User/Order"); ?>">New Order</a>
    <a class="p-2 text-dark" href="<?php echo site_url("User/CartDisplay"); ?>">Cart</a>
    <a class="p-2 text-dark" href="<?php echo site_url("User/History"); ?>">Orders</a>
    <a class="p-2 text-dark" href="<?php echo site_url("User/Complain"); ?>"> File Complain</a>
    <a class="p-2 text-dark" href="<?php echo site_url("User/AllComplains"); ?>">Complain History</a>
    <a class="p-2 text-dark" href="<?php echo site_url("User/Bundles"); ?>">Deals</a>
    <a class="p-2 text-dark" href="<?php echo site_url("User/BundleOrderHistory"); ?>">Deals History</a>
    
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
          window.location.replace('<?php echo site_url("User/"); ?>' + funct + "/" + id);
        }
      });
    });
  </script>

</body>

</html>