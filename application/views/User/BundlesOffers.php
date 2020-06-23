<h1>
<!--  <php    
foreach($Bundles->result() as $row)
{
each $row->bundles.BundleID.'<br>';

}

>
-->
Bundles Section
</h1>
<div class="row">
    <div class="col-8">
        <h2>Available Bundles</h2>
        <div class="row mt-5">
        bundles.BundleID,BundleName,product.ProductID,ProductName,bundledetails.Price,bundledetails.Quantity,Discount,Total,bundles.Description
            <?php foreach ($Bundles as $Item) : ?>
                <div class="col-3">
                    <div class="card mb-3" style="background-color: #4b6584; color:#d1d8e0 ">
                        <div class="card-body">
                            <h5 class="card-title">Bundle Name : <?php echo $Item['BundleName']; ?></h5>
                            <p class="card-text">Product Name :<?php echo $Item['ProductName']; ?></p>
                            <p class="card-text">Price : Rs. <?php echo $Item['Price']; ?></p>

                            <a href="<?php echo site_url('User/BuyBundle/') . $Item['BundleID']; ?>" class="btn btn-secondary btn-block" style="background-color: #f5f6fa; color: #4b6584" onclick="alert()">Buy</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>    



