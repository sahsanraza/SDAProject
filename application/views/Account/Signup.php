<?php
echo form_open('Account/Signup');
?>
<div class="form-group">
    <?php echo form_label("Full Name", "FullName");
    $array = array(
        'id' => 'FullName',
        'Name' => 'FullName',
        'placeholder' => 'Enter name here',
        'class' => 'form-control',
        'value'=> set_value('FullName')
    );
    echo form_input($array);
    ?>
</div>
<div class="form-group">
    <?php echo form_label("Email Address", "Email");
    $array = array(
        'id' => 'Email',
        'Name' => 'Email',
        'placeholder' => 'Enter email here',
        'class' => 'form-control',
        'value'=> set_value('Email')
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
    <?php echo form_label("Address", "Address");
    $array = array(
        'id' => 'Address',
        'Name' => 'Address',
        'placeholder' => 'Enter your address here',
        'class' => 'form-control',
        'value'=> set_value('Address')
    );
    echo form_input($array);
    ?>
</div>
<div class="form-group">
    <?php echo form_label("Phone Number", "Phone");
    $array = array(
        'id' => 'Phone',
        'Name' => 'Phone',
        'placeholder' => 'Enter phone number here',
        'class' => 'form-control',
        'value'=> set_value('Phone')
    );
    echo form_input($array);
    ?>
</div>
<div class="form-group">
    <?php
    $array = array(
        'Name' => 'Signup',
        'class' => 'btn btn-outline-primary btn-block',
        'value' => 'Sign Up'
    );
    echo form_submit($array);
    ?>
</div>
<?php echo validation_errors('<p class="alert alert-danger">'); ?>
<?php echo form_close(); ?>
