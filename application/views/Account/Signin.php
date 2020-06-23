<?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
<?php
echo form_open();
?>

<div class="form-group">
    <?php echo form_label("Email Address", "Email");
    $array = array(
        'id' => 'Email',
        'Name' => 'Email',
        'placeholder' => 'Enter email here',
        'class' => 'form-control'
    );
    echo form_input($array);
    ?>
</div>
<div class="form-group">
    <?php echo form_label("Password", "Pass");
    $array = array(
        'id' => 'Pass',
        'Name' => 'Pass',
        'placeholder' => 'Enter password here',
        'class' => 'form-control'
    );
    echo form_password($array);
    ?>
</div>
<div class="form-group">
    <?php
    $array = array(
        'Name' => 'Signin',
        'class' => 'btn btn-outline-success btn-block',
        'value' => 'Sign In'
    );
    echo form_submit($array);
    ?>
</div>
<?php echo validation_errors('<p class="alert alert-danger">'); ?>
<?php echo form_close(); ?>

<?php if ($this->session->flashdata('loginerror')) : ?>
    <div class="alert alert-danger mt-3"><?php echo $this->session->flashdata('loginerror'); ?></div>
<?php endif; ?>

<?php if ($this->session->flashdata('signedup')) : ?>
    <div class="alert alert-success mt-3"><?php echo $this->session->flashdata('signedup'); ?></div>
<?php endif; ?>