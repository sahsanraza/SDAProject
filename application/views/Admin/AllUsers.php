<?php if ($this->session->flashdata('padded')) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('padded'); ?>
            </div>
        <?php endif; ?>
<div class="row" style="padding:1% 5%">
    <h2 class="mb-4">Users</h2>
 
    <?php if (!empty($Users)) : ?>
      <div class="table-responsive">
        <table class="table table-hover">
            <thead  class="bg-dark text-white">
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Users as $User) : ?>
                    <tr>
                        <th scope="row"><?php echo $User['UserID']; ?></th>
                        <td><?php echo $User['FullName']; ?></td>
                        <td><?php echo $User['Email']; ?></td>
                        <td><?php echo $User['Address']; ?></td>
                        <td>
                           <?php
                           echo form_open('Admin/UpdateUserRole/'.$User['UserID']);
                           $options = [
                                'Admin'  => 'Admin',
                                'User'    => 'User',
                            ];
                            echo form_dropdown('Role',$options,$User['Role']);
                            $data=array(
                                'name'=>'UpdateRole',
                                'value'=>'Change',
                                'class'=>'btn btn-sm btn-secondary'
                            );
                            echo form_submit($data);
                            echo form_close();
                            ?>
                        </td>
                        <td>
                        <?php
                          
                           $opts = [
                                'Active'  => 'Active',
                                'Deleted'    => 'Deleted',
                            ];
                            echo form_dropdown('Status',$opts,$User['Status']);
                            $data=array(
                                'name'=>'UpdateStatus',
                                'content'=>'Change',
                                'data-id'=>$User['UserID'],
                                'id'=>'StatusBtn',
                                'class'=>'btn btn-sm btn-danger btn-check'
                            );
                            echo form_button($data);
                            
                            ?>
                        </td>
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