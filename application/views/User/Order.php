<div class="row">
    <div class="col-8">
        <h2>Products</h2>
        <div class="row mt-5">

            <?php foreach ($Products as $Item) : ?>
                <div class="col-3">
                    <div class="card mb-3" style="background-color: #c8d6e5; color:#2f3640 ">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $Item['ProductName']; ?></h5>
                            <p class="card-text">Rs. <?php echo $Item['Price']; ?></p>
                            <a href="<?php echo site_url('User/AddtoCart/') . $Item['ProductID']; ?>" class="btn btn-secondary btn-block" style="background-color: #f5f6fa; color: #4b6584">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    <div class="col-4">
        <h2>Cart</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width: 8%">#</th>
                    <th>Name</th>
                    <th style="width: 10%">Qty</th>
                    <th style="width: 15%">Price</th>
                    <th style="width: 15%">Total</th>
                    <th style="width: 15%">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($this->session->userdata('Cart')) : ?>
                    <?php $i = 1;
                    $total = 0;
                    foreach ($this->session->userdata('Cart') as $CItem) : ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $CItem['Name'];  ?></td>
                            <td><?php echo $CItem['Qty']; ?></td>
                            <td><?php echo $CItem['Price'];
                                $subt = $CItem['Price'] * $CItem['Qty']; ?></td>
                            <td name="Subtotal"><?php echo $subt ?></td>
                            <td><a href="javascript:;" data-action="RemoveFromCart" data-id="<?php echo $CItem['ProductID']; ?>" class="badge badge-danger btn-check btn-delete">Remove</a></td>
                        </tr>
                    <?php $i++;
                        $total = $total + $subt;
                    endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if ($this->session->userdata('Cart')) : ?>
            <p class="badge badge-light" style="font-size: 1.5em; font-family: Roboto;"><strong>Subtotal</strong>: Rs. <?php echo $total; ?></p>
            <a href="javascript:;" class="btn btn-block btn-secondary" style="background-color: #2f3640" data-toggle="modal" data-target="#checkoutModal">Checkout</a>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #778ca3; color:#f5f6fa">
                <h5 class="modal-title" id="exampleModalLabel">Confirm your order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open(); ?>
            <div class="modal-body" style="background-color: #778ca3; color:#f5f6fa">
                <div class="form-group">
                    <label for="EmailTxt" class="col-form-label">Email:</label>
                    <input type="text" class="form-control" id="EmailTxt" name="EmailTxt" readonly="" value="<?php echo $User['Email']; ?>">
                </div>
                <div class="form-group">
                    <?php
                    echo form_label('Address', 'AddressTxt');
                    $data = array(
                        'name' => 'AddressTxt',
                        'id'    => 'AddressTxt',
                        'class' => 'form-control',
                        'value' => $User['Address'],
                    );
                    echo form_input($data);
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label('Description', 'DescTxt');
                    $data = array(
                        'name' => 'DescTxt',
                        'id'    => 'DescTxt',
                        'class' => 'form-control',
                        'placeholder' => 'Anything you want to say, related to order.',
                        'rows'  => '4'

                    );
                    echo form_textarea($data);
                    ?>
                    <!-- <label for="DescTxt" class="col-form-label">Description:</label> -->

                    <!-- <textarea class="form-control" id="DescTxt" placeholder="Anything you want to say, related to order."></textarea> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-success">Confirm Order</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>