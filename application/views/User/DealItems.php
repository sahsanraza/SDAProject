<div class="row mt-5">
    <div class="col-6 offset-3">
    <div class="row mt-5">
            <div class="col-md-6 ">
                <h4>Deal Name</h4>
                <p><?php echo $Bundle['BundleName']; ?></p>

                <h4>Discount</h4>
                <p>Rs. <?php echo $Bundle['Discount']; ?></p>

            </div>
            <div class="col-md-6">
                <h4>Original Price</h4>
                <p>Rs. <?php echo $Bundle['Discount']+$Bundle['Total']; ?></p>
                <h4>Sale Price</h4>
                <p>Rs. <?php echo $Bundle['Total']; ?></p>
            </div>
        </div> 
    <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Items as $Item) : ?>
                        <tr>
                            <td><?php echo $Item['ProductName']; ?></td>
                            <td><?php echo $Item['Price']; ?></td>
                            <td><?php echo $Item['Quantity']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-center"><a class="btn btn-sm btn-secondary" href="<?php echo site_url('User/BundleOrderHistory');?>">Close</a></td>
                            </tr>
                        </tfoot>
            </table>
        </div>
    </div>
</div>