<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="row mt-5">
            <div class="col-md-6 ">
                <h4>Order ID</h4>
                <p><?php echo $Order['OrderID']; ?></p>

                <h4>Address</h4>
                <p><?php echo $Order['Address']; ?></p>

            </div>
            <div class="col-md-6">
                <h4>Email</h4>
                <p><?php echo $Order['Email']; ?></p>
                <h4>Order Date</h4>
                <p><?php echo date("d M Y h:i A", strtotime($Order['DateCreated'])); ?></p>
            </div>
        </div>
        <table class="table table-sm mt-3">
            <thead class="bg-dark text-white">
                <tr >
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">SubTotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1;
                $total = 0;
                foreach ($Order['Items'] as $Item) :  ?>
                    <tr>
                        <td>
                            <?php echo $count; ?>
                        </td>
                        <td>
                            <?php echo $Item['ProductName']; ?>
                        </td>
                        <td>
                            <?php echo $Item['Price']; ?>
                        </td>
                        <td>
                            <?php echo $Item['Quantity']; ?>
                        </td>
                        <td>
                            <?php $subt = $Item['Price'] * $Item['Quantity'];
                            $total += $subt;
                            echo $subt;  ?>
                        </td>
                    </tr>

                <?php $count++;
                endforeach; ?>
                <tr>
                    <td colspan="5" class="text-right"><strong>Total = Rs. <?php echo $total; ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>