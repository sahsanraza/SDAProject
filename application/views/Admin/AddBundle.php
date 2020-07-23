<div class="row">
    <div class="col-8 offset-2">
        <?php if (!empty($Items)) : ?>
            <div class="row">
                <div class="col-6">
                    <h2> Available Items
                    </h2>
                </div>
                <div class="col-6">
                    <h2> Bundle Items
                    </h2>
                </div>
            </div>
            <div class="row mt-2">

                <div class="col-6">
                    <div class="card mb-5" style="background-color: #c8d6e5; color:#d1d8e0 ">
                        <div class="card-body">
                            <div class="table-responsive  table-wrap">
                                <table class="table table-hover table-striped">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Items as $Item) : ?>
                                            <tr>
                                                <td><?php echo $Item['ProductName']; ?></td>
                                                <td><?php echo $Item['Price']; ?></td>
                                                <td><?php
                                                    echo form_open('Admin/AddBundleItem/' . $Item['ProductID']);
                                                    $arr = array(
                                                        'name' => 'QuantityTxt',
                                                        'value' => '1',
                                                        'style' => 'width:60px',
                                                        'placeholder' => 'Quantity',
                                                        'title' => 'Quantity'
                                                    );
                                                    echo form_input($arr);
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    $s = array(
                                                        'class' => 'btn btn-sm btn-primary',
                                                        'value' => '->',
                                                        'title' => 'Add',
                                                        'name' => 'AddItem'
                                                    );
                                                    echo form_submit($s);
                                                    echo form_close();
                                                    ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                                
                <div class="col-6">
                    <div class="card mb-5" style="background-color: #576574; color:#c8d6e5; ">
                        <div class="card-body">
                            <div class="table-responsive table-wrap">
                                <table class="table table-hover table-striped">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-white">
                                        <?php $Total = 0;
                                        foreach ($this->session->userdata('BundleItems') as $Item) : ?>
                                            <tr>
                                                <td><?php echo $Item['ProductName']; ?></td>
                                                <td><?php echo $Item['Price']; ?></td>
                                                <td><?php echo $Item['Quantity']; ?></td>
                                                <td><a href="javascript:;" data-id="<?php echo $Item['ProductID']; ?>" class="btn btn-sm btn-remove btn-danger">X</a></td>
                                            </tr>
                                        <?php $Total += $Item['Price'] * $Item['Quantity'];
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <h2>No items available in stock!</h2>
            <?php endif; ?>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <?php
                    echo form_open('Admin/AddBundle');
                    echo form_label('Bundle Name', 'BundleNameTxt');
                    $s = array(
                        'name' => 'BundleNameTxt',
                        'class' => 'form-control',
                        'placeholder' => 'Enter bundle name here'
                    );
                    echo form_input($s);
                    ?>
                    <br />
                    <?php
                    echo form_label('Description', 'DescTxt');
                    $data = array(
                        'name' => 'DescTxt',
                        'id'    => 'DescTxt',
                        'class' => 'form-control',
                        'placeholder' => 'Enter bundle description here',
                        'rows'  => '3'

                    );
                    echo form_textarea($data);
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    echo form_label('Discount', 'Discount');
                    $s = array(
                        'name' => 'Discount',
                        'id'=>'DiscountTxt',
                        'class' => 'form-control',
                        'value'=>0,
                        'placeholder' => 'Enter discount here'
                    );
                    echo form_input($s);
                    ?>
                    <br />
                    <?php
                   //hidden element
                   $ds = array(
                        'name' => 'Original',
                        'id'=>'OriginalTxt',
                        'value' => $Total,
                        'hidden' =>true,
                    );
                    echo form_input($ds);
                    echo form_label('Total', 'Total');
                    $s = array(
                        'name' => 'Total',
                        'id'=>'TotalTxt',
                        'value' => $Total,
                        'class' => 'form-control',
                    );
                    echo form_input($s);
                    $d = array(
                        'name' => 'AddBtn',
                        'class' => 'btn mt-3 btn-sm btn-outline-success float-right',
                        'value' => 'Add Bundle'
                    );
                    echo form_submit($d);
                    echo form_close();
                    ?>
                </div>

            </div>
         <br/>
    </div>
</div>