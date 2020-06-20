<div class="row" style="padding:1% 5%">
    <h2 class="mb-4">Orders</h2>
    <?php if ($this->session->flashdata('padded')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('padded'); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($Orders)) : ?>
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Orders as $Order) : ?>
                        <tr>
                            <th scope="row"><?php echo $Order['OrderID']; ?></th>
                            <td><?php echo $Order['FullName']; ?></td>
                            <td><?php echo date("d M Y h:i A", strtotime($Order['DateCreated'])); ?></td>
                            <td>Rs. <?php echo number_format($Order['TotalPrice'], 0); ?></td>
                            <td>
                                <?php
                                echo form_open('Admin/UpdateOrderStatus/' . $Order['OrderID']);
                                $options = [
                                    'Pending'  => 'Pending',
                                    'Completed'    => 'Completed',
                                    'Cancelled'  => 'Cancelled',
                                ];
                                echo form_dropdown('Status', $options, $Order['Status']);
                                $data = array(
                                    'name' => 'UpdateStatus',
                                    'value' => 'Change',
                                    'class' => 'btn btn-sm btn-secondary'
                                );
                                echo form_submit($data);
                                echo form_close();
                                ?>
                            </td>
                            <td><a class="btn btn-sm btn-primary" href="<?php echo site_url('Admin/OrderDetail/' . $Order['OrderID']); ?>">View Order</a></td>
                        </tr>
                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="col-md-4 offset-4 text-center">
            <h1>No Orders found! </h1>
        </div>

    <?php endif; ?>
</div>