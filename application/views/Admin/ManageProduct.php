<div class="row">
    <div class="col-3">
        <?php echo form_open('Admin/Products'); ?>
        <div class="form-group">
            <?php echo form_label("Product Name", "PName");
            $array = array(
                'id' => 'PName',
                'Name' => 'PName',
                'placeholder' => 'Enter Product Name',
                'class' => 'form-control',
                'value' =>  set_value('PName')
            );
            echo form_input($array);
            ?>
        </div>
        <div class="form-group">
            <?php echo form_label("Product Price", "PPrice");
            $array = array(
                'id' => 'PPrice',
                'Name' => 'PPrice',
                'placeholder' => 'Enter Product Price',
                'class' => 'form-control',
                'value' =>  set_value('PPrice')
            );
            echo form_input($array);
            ?>
        </div>

        <div class="form-group">
            <?php
            $array = array(
                'Name' => 'AddProduct',
                'class' => 'btn btn-outline-dark btn-block',
                'value' => 'Add Product'
            );
            echo form_submit($array);
            ?>
        </div>
        <?php echo validation_errors('<p class="alert alert-danger">'); ?>
        <?php echo form_close(); ?>

        <?php if ($this->session->flashdata('padded')) : ?>
            <div class="alert alert-success mt-3"><?php echo $this->session->flashdata('padded'); ?></div>
        <?php endif; ?>
    </div>
    <div class="col-9">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col" style="width: 10%">Price</th>
                        <th scope="col" style="width: 15%">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($Products as $Product) : ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $Product['ProductName']; ?></td>
                            <td>Rs. <?php echo $Product['Price']; ?></td>
                            <td>
                                <?php if ($Product['Status'] == "Active") {
                                    echo '<span class="badge badge-success">' . $Product['Status'] . '</span>';
                                } else {
                                    echo '<span class="badge badge-danger">' . $Product['Status'] . '</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo site_url("Admin/EditProduct/") . $Product['ProductID']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <?php if($Product['Status']=="Deleted"):?>
                                    <a href="javascript:;" class="btn btn-sm btn-success btn-delete"  data-id="<?php echo $Product['ProductID'];?>" data-action="UnDeleteProduct">Un-Delete</a>
                                <?php else:?>
                                    <a href="javascript:;" class="btn btn-sm btn-danger btn-delete" data-id="<?php echo $Product['ProductID'];?>" data-action="DeleteProduct">Delete</a>
                                <?php endif;?>
                            </td>
                        </tr>

                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>