<div class="row">
    <div class="container-fluid col-md-3">
        <?php echo form_open('Admin/EditProduct/' . $Product['ProductID']); ?>
        <div class="form-group">
            <?php echo form_label("Product Name", "ProductName");
            $array = array(
                'id' => 'ProductName',
                'Name' => 'ProductName',
                'class' => 'form-control',
                'value' =>  $Product['ProductName']
            );
            echo form_input($array);
            ?>
        </div>
        <div class="form-group">
            <?php echo form_label("Product Price", "c");
            $array = array(
                'id' => 'PPrice',
                'Name' => 'PPrice',
                'placeholder' => 'Enter Product Price',
                'class' => 'form-control',
                'value' =>  $Product['Price']
            );
            echo form_input($array);
            ?>
        </div>

        <div class="form-group">
            <?php
            $array = array(
                'Name' => 'UpdateProduct',
                'class' => 'btn btn-outline-success btn-block',
                'value' => 'Update Product',
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
</div>