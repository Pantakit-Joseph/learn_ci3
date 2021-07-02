<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
    'class' => 'form-control',
	'placeholder' => 'Email Address',
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Password',
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	// 'style' => 'margin:0;padding:0',
    'class' => 'form-check-input',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
    'autocomplete' => 'off',
    'class' => 'form-control',
	'placeholder' => 'Confirmation Code',
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
    <title>Login</title>
</head>

<body>
    <div class="card my-card-login">
        <div class="card-body">
            <h2 class="text-center ">ลงชื่อชื่อเข้าสู่ระบบ</h1>
			<?php echo form_open($this->uri->uri_string()); ?>
                    <?php echo form_label('อีเมล์', $login['id'], 'class="form-label"'); ?>
                    <?php echo form_input($login); ?>
                    <div id="emailHelp" class="form-text my-form-error">
					<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
                    </div>

                    <!-- <?php echo form_label('อีเมล์', $login['id'], 'class="form-label"'); ?>
                    <?php echo form_input($login); ?>
                    <div id="emailHelp" class="form-text my-form-error">
					<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
                    </div> -->

                    <?php echo form_label('ระหัสผ่าน', $password['id'], 'class="form-label mt-2"'); ?>
		            <?php echo form_password($password); ?>
                    <div id="passHelp" class="form-text my-form-error">
					<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
                    </div>
                    <div class="form-check">
                        <?php echo form_checkbox($remember); ?>
			            <?php echo form_label('จดจำฉัน', $remember['id'], 'class="form-check-label"'); ?>
                    </div>

                    <?php if ($show_captcha) {
						if ($use_recaptcha) { ?>
						<?php } else { ?>
							<div class="text-center mt-4">
								<p>ป้อนรหัสตรงตามที่ปรากฏ</p>
								<?php echo $captcha_html; ?>
							</div>

							<?php echo form_label('รหัสยืนยัน', $captcha['id'], 'class="form-label"'); ?>
							<?php echo form_input($captcha); ?>
							<div class="form-text my-form-error">
								<?php echo form_error($captcha['name']); ?>
							</div>
					<?php }
					} ?>

                    <button class="btn btn-primary w-100 mt-3" type="submit">เข้าสู่ระบบ</button>
					<?php echo form_close(); ?>
                    <hr>
                    <div class="text-center">
                        <?php echo anchor('/auth/forgot_password/', 'ลืมรหัสผ่าน'); ?>
                        <?php if ($this->config->item('allow_registration', 'tank_auth')) {
                            echo ' | ';
                            echo anchor('/auth/register/', 'ลงทะเบียน');
                        }  ?>
                    </div>

        </div>
    </div>
    </div>

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/fontawesome/js/all.min.js"></script>
</body>

</html>