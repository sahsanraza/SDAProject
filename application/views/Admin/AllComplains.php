<div class="row" style="padding:1% 5%">
    <?php if ($this->session->flashdata('padded')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('padded'); ?>
        </div>
    <?php endif; ?>
   
    <?php if (!empty($Complains)) : ?>
        <h2 class="mb-4">Complains</h2>
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Complain Message</th>
                        <th scope="col">Response</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Complains as $Complain) : ?>
                        <tr>
                            <th scope="row" style="width: 50px;"><?php echo $Complain['ComplainID']; ?></th>
                            <td style="width: 150px;"><?php echo $Complain['Email']; ?></td>
                            <td><?php echo $Complain['Subject']; ?></td>
                            <td style="width: 200px;"><?php echo $Complain['Complain']; ?></td>
                            <?php if ($Complain['Response'] != NULL) : ?>
                                <td style="width: 300px;"> <?php echo $Complain['Response'] ?></td>
                            <?php else : ?>
                                <td style="width: 300px;">
                                    <?php
                                    echo form_open('Admin/UpdateResponse/' . $Complain['ComplainID']);
                                    $opts = array(
                                        'class' => 'input',
                                        'placeholder' => 'Add Response here',
                                        'name' => 'Response'
                                    );
                                    echo form_input($opts);
                                    $data = array(
                                        'name' => 'SubmitResponse',
                                        'value' => 'Submit',
                                        'class' => 'btn btn-sm btn-success'
                                    );
                                    echo form_submit($data);
                                    echo form_close();
                                    ?>
                                </td>
                            <?php endif; ?>

                            <td>
                                <?php
                                echo form_open('Admin/UpdateComplainStatus/' . $Complain['ComplainID']);
                                $opts = [
                                    'Pending'  => 'Pending',
                                    'Received'    => 'Received',
                                    'Resolved' => 'Resolved'
                                ];
                                echo form_dropdown('Status', $opts, $Complain['Status']);
                                $data = array(
                                    'name' => 'UpdateStatus',
                                    'value' => 'Change',
                                    'id' => 'StatusBtn',
                                    'class' => 'btn btn-sm btn-secondary'
                                );
                                echo form_submit($data);
                                echo form_close();
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="col-md-4 offset-4 text-center">
            <h1>No Complains found! </h1>
        </div>

    <?php endif; ?>
</div>