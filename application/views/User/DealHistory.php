<div class="row" style="padding:1% 5%">
    <h2 class="mb-4">Deals</h2>
    <?php if (!empty($Deals)) : ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Deal ID</th>
                    <th scope="col">Deal Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Deals as $Deal) : ?>
                    <tr>
                        <th scope="row"><?php echo $Deal['BundleOrderDetailsID']; ?></th>
                        <td><?php echo $Deal['BundleName']; ?></td>
                        <td><?php echo $Deal['Description']; ?></td>
                        <td>Rs. <?php echo $Deal['Total'] ?></td>
                        <td><a class="btn btn-sm btn-primary" href="<?php echo site_url('User/BundleOrderDetail/' . $Deal['BundleID']); ?>">View Deal</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="col-md-4 offset-4 text-center">
            <h1>You haven't availed any deal yet! </h1>
        </div>

    <?php endif; ?>
</div>
