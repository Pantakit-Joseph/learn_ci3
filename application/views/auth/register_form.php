<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'class' => 'form-control',
		'placeholder' => 'Username',
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Email Address',
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Password',
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Confirm Password',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	'class' => 'form-control',
	'placeholder' => 'Confirmation Code',
	'autocomplete' => 'off',
);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('/assets/fontawesome/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/mystyle.css'); ?>">
    <title>Register</title>
</head>

<body>
    <div class="card my-card-login">
        <div class="card-body">
            <h2 class="text-center ">ลงทะเบียน</h1>
			<?php echo form_open($this->uri->uri_string()); ?>
					<?php echo form_label('ชื่อผู้ใช้', 'username', 'class="form-label"'); ?>
					<?php echo form_input($username); ?>
                    <div class="form-text my-form-error">
						<?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
                    </div>

					<?php echo form_label('อีเมล์', 'email', 'class="form-label"'); ?>
                    <?php echo form_input($email); ?>
                    <div class="form-text my-form-error">
						<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
                    </div>

					<?php echo form_label('ระหัสผ่าน', 'password', 'class="form-label"'); ?>
                    <?php echo form_password($password); ?>
                    <div class="form-text my-form-error">
						<?php echo form_error($password['name']); ?>
                    </div>

					<?php echo form_label('ยืนยันระหัสผ่าน', 'confirm_password', 'class="form-label"'); ?>
                    <?php echo form_password($confirm_password); ?>
                    <div class="form-text my-form-error">
						<?php echo form_error($confirm_password['name']); ?>
                    </div>

					<?php if ($captcha_registration) {
						if ($use_recaptcha) { ?>
						<?php } else { ?>
							<div class="text-center mt-4">
								<p>ป้อนรหัสตรงตามที่ปรากฏ</p>
								<?php echo $captcha_html; ?>
							</div>

							<?php echo form_label('รหัสยืนยัน', 'captcha', 'class="form-label"'); ?>
							<?php echo form_input($captcha); ?>
							<div class="form-text my-form-error">
								<?php echo form_error($captcha['name']); ?>
							</div>
					<?php }
					} ?>


                    <button class="btn btn-primary w-100 mt-3" type="submit">ลงทะเบียน</button>
					<?php echo form_close(); ?>
                    <hr>
                    <div class="text-center">
                        <?php echo anchor('/auth/login/', 'เข้าสู่ระบบ'); ?>
                    </div>

        </div>
    </div>
    </div>

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/fontawesome/js/all.min.js"></script>
</body>

</html>