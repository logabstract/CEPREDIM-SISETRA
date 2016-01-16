<?php if (isset($login_fail)) : ?>
	<div class="alert alert-danger">usuario o password inválido</div>
<?php endif ;?>

<?php echo validation_errors(); ?>
<?php echo form_open('signin/index','class="form-signin" role="form"'); ?>
	<h2 class="form-signin-heading">Bienvenido</h2>

	<input type="text" name="usr_name" class="form-control" placeholder="usuario" required autofocus>
	<input type="password" name="usr_password" class="form-control" placeholder="contraseña" required >

	<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
<?php echo form_close(); ?>
</div>
