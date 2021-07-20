<html>

<head>
    <title>Forgot Password</title>
    <?php
    require __DIR__ . '/../../assets/css/css.php';
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
                <h5 class="card-header">Forgot Password</h5>
                <?php echo form_open('Auth/forgot_password'); ?>
                <div class="card-body">
                    <h6 class="card-title">Please enter your email address</h6>
                    <div class="form-group">
                        <?php
                        echo form_label('Email', 'email');
                        echo form_input(['class' => 'form-control', 'id' => 'email', 'name' => 'email', 'placeholder' => 'Enter email']) ?>
                    </div>
                    <div><?php echo form_error('email'); ?></div>
                    <div class="form-group">
                        <?php
                        echo form_submit(['type' => 'submit', 'class' => 'btn btn-primary mt-3', 'value' => 'Submit']);
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