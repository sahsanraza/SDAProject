<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title><?php echo $Title; ?></title>
</head>

<body style="background-color: #778ca3; color:#f5f6fa ">
  <nav class="navbar navbar-expand-lg navbar-dark bg-default" style="background-color: #353b48">
    <a class="navbar-brand" href="#">Inventory Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo site_url('User/Index'); ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url("User/Order"); ?>">New Order</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url("User/History"); ?>">Orders</a>
        </li>
    
      </ul>
      <form class="form-inline my-2 my-lg-0">
          <a  class="nav-item justify-content-end text-white" href="<?php echo site_url("Account/Signout"); ?>">Signout</a>
        </form>
    </div>
  </nav>
  <div class="container-fluid mt-5">
    <?php $this->load->view($Content); ?>
  </div>

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
          window.location.replace('<?php echo site_url("User/Order/"); ?>' + id);
        }
      });
    });

    
  </script>

</body>

</html>