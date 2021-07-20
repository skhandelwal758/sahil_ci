<html>

<head>
    <title>Login Page</title>
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
                echo "<div class='alert alert-danger'>$msg</div>";
            }
        ?>
        <div class="col-md-6">
            <div class="card mt-3">
                <h5 class="card-header">Login Now</h5>
                <?php echo form_open('Auth/login'); ?>
                <div class="card-body">
                    <h6 class="card-title">Please enter login credentials</h6>
                    <div class="form-group">
                        <?php
                        echo form_label('Email', 'email');
                        echo form_input(['class' => 'form-control', 'id' => 'email', 'name' => 'email', 'placeholder' => 'Enter email', 'value'=>set_value('email')]) ?>
                    </div>
                    <div><?php echo form_error('email'); ?></div>
                    <div class="form-group">
                        <?php
                        echo form_label('Password', 'password');
                        echo form_password(['class' => 'form-control', 'type' => 'password', 'id' => 'password', 'name' => 'password', 'placeholder' => 'Enter password', 'value'=>set_value('password')]) ?>
                    </div>
                    <div><?php echo form_error('password'); ?></div>
                    <div class="form-group">
                        <?php
                        echo form_submit(['type' => 'submit', 'class' => 'btn btn-primary mt-3', 'value' => 'Login']);
                        echo anchor('Welcome/index/', 'Sign up?', 'class="link-class"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo anchor('Auth/forgot_password/', 'Forgot Password?', 'class="text-danger"');
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