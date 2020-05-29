<div class="row" style="padding:1% 5%">
<h2 class="mb-4">My Orders</h2>
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
      <td><?php echo date("d M Y h:i A",strtotime($Order['DateCreated'])); ?></td>
      <td>Rs. <?php echo number_format($Order['TotalPrice'],0); ?></td>
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