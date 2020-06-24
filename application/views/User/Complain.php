<div class="row">
 
    
    <div class="col-md-6 offset-3">
    <?php if ($this->session->flashdata('padded')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('padded'); ?>
        </div>
    <?php endif; ?>
<<<<<<< HEAD
        <h2 class="mb-4">Complain</h2>
=======
        <h2 class="mb-4">Complains</h2>
>>>>>>> 60551e3f1794c5746c870e373ecd6b97db8b9356
        <?php echo form_open(); ?>
        <div>
            <div class="form-group">
                <label for="EmailTxt" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="EmailTxt" name="EmailTxt" readonly="" value="<?php echo $this->session->userdata('Email'); ?>">
            </div>
            <div class="form-group">
                <?php
                echo form_label('Subject', 'SubjectTxt');
                $data = array(
                    'name' => 'SubjectTxt',
                    'id'    => 'SubjectTxt',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Complain title here'
                );
                echo form_input($data);
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label('Complain', 'CompTxt');
                $data = array(
                    'name' => 'CompTxt',
                    'id'    => 'CompTxt',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Complain here',
                    'rows'  => '4'

                );
                echo form_textarea($data);
                ?>

            </div>

        </div>
        <div class="modal-footer">

            <button type="button" class="btn btn-secondary">Close</button>
            <?php
            $btn = array(
                'value' => 'File Complain',
                'class' => 'btn btn-success',
            );
            echo form_submit($btn);
            ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>