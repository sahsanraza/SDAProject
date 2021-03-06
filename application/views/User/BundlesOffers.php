<div class="row">
    <?php if ($this->session->flashdata('padded')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('padded'); ?>
        </div>
    <?php endif; ?>
    <div class="col-8 offset-2">
        <?php if (!empty($Bundles)) : ?>
            <h2>Available Deals</h2>
            <div class="row mt-5">
                <?php foreach ($Bundles as $Bundle) : ?>
                    <div class="col-6">
                        <div class="card mb-5" style="background-color: #c8d6e5; color:#d1d8e0 ">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead class="bg-dark text-white">
                                            <tr class="rounded-top bg-info text-white text-center ">
                                                <td colspan="3">
                                                    <?php echo $Bundle['BundleName']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quanity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($Bundle['Items'] as $Item) : ?>
                                                <tr>
                                                    <td><?php echo $Item['ProductName']; ?></td>
                                                    <td><?php echo $Item['Price']; ?></td>
                                                    <td><?php echo $Item['Quantity']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <th class="text-right">Original Price</th>
                                                <td colspan="2">Rs. <?php echo $Bundle['Total'] + $Bundle['Discount']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th class="text-right">Discount</th>
                                                <td colspan="2">Rs. <?php echo $Bundle['Discount']; ?> </td>
                                            </tr>
                                            <tr>
                                                <th class="text-right">Sale Price</th>
                                                <td colspan="2">Rs. <?php echo $Bundle['Total']; ?> </td>
                                            </tr>
                                            <tr style="height:80px;">
                                                <th class="text-right">Description</th>
                                                <td colspan="2"><?php echo $Bundle['Description']; ?> </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">
                                                    <a class="btn btn-block btn-success" href="<?php echo site_url('User/BuyBundle/' . $Bundle['BundleID']); ?>">Buy</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h2>No deals available!</h2>
            <?php endif; ?>
            </div>
    </div>