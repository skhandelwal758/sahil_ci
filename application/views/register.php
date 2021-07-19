<html>

<head>
    <title>Register Page</title>
    <?php
    require __DIR__ . '/../../assets/css/css.php';
    // require $_SERVER['DOCUMENT_ROOT'] .  '/codeigniter\assets\css\css.php';
    ?>
</head>

<body>
    <div class="container mt-5">
        <?php
            $msg = $this->session->flashdata('msg');
            if($msg != ""){
                echo "<div class='alert alert-success'>$msg</div>";
            }
        ?>
        <div class="col-md-6">
            <div class="card mt-3">
                <h5 class="card-header">Register Here</h5>
                <?php echo form_open('Auth/register'); ?>
                <div class="card-body">
                    <h6 class="card-title">Please fill with your details</h6>
                    <div class="form-froup">
                        <?php
                        echo form_label('Name', 'name');
                        echo form_input(['class' => 'form-control', 'id' => 'name', 'name' => 'name', 'placeholder' => 'Enter name', 'value'=>set_value('name')]) ?>
                    </div>
                    <div><?php echo form_error('name'); ?></div>
                    <div class="form-froup">
                        <?php
                        echo form_label('Email', 'email');
                        echo form_input(['class' => 'form-control', 'id' => 'email', 'type' => 'email', 'name' => 'email', 'placeholder' => 'Enter email', 'value'=>set_value('email')]) ?>
                    </div>
                    <div><?php echo form_error('email'); ?></div>
                    <div class="form-froup">
                        <?php
                        echo form_label('Password', 'password');
                        echo form_password(['class' => 'form-control', 'type' => 'password', 'id' => 'password', 'name' => 'password', 'placeholder' => 'Enter password', 'value'=>set_value('password')]) ?>
                    </div>
                    <div><?php echo form_error('password'); ?></div>
                    <div class="form-froup">
                        <?php
                        echo form_label('Confirm Password', 'conPassword');
                        echo form_password(['class' => 'form-control', 'type' => 'password', 'id' => 'conPassword', 'name' => 'conPassword', 'placeholder' => 'Confirm password', 'value'=>set_value('conPassword')]) ?>
                    </div>
                    <div><?php echo form_error('conPassword'); ?></div>
                    <div class="form-froup">
                        <?php
                        echo form_submit(['type' => 'submit', 'class' => 'btn btn-primary mt-3', 'value' => 'Submit']);
                        echo form_reset(['type' => 'reset', 'class' => 'btn btn-danger mt-3', 'value' => 'Reset']);
                        echo anchor('Welcome/login/', 'Already have an account? Click here to login', 'class="link-class"');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include __DIR__ . "/../../assets/js/script.php";
?>
</html>