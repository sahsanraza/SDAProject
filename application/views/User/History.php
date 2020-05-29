<div class="row">
<?php if(!empty($Orders)): ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Order #</th>
      <th scope="col">Address</th>
      <th scope="col">Created Date</th>
      <th scope="col">Total</th>
      <th scope="col">Detail</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($Orders as $Order): ?>
  <tr>
      <th scope="row"><?php echo $Order['OrderID']; ?></th>
      <td><?php echo $Order['Address']; ?></td>
      <td><?php echo $Order['DateCreated']; ?></td>
      <td><?php echo $Order['TotalPrice']; ?></td>
      <td><a data-id=<?php echo $Order['OrderID']; ?>>Details</a></td>
    </tr>
    <?php endforeach; ?>
   

  </tbody>
</table>
<?php else:?>
    <div class="col-md-4 offset-4 text-center" >
    <h1>No Orders found! </h1>
    </div>
    
<?php endif; ?>
</div>