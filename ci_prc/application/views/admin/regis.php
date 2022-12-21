<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<form method="post" action="<?php echo base_url('index.php/Admin/regis') ?>" enctype="multipart/form-data">
<h2>Registration</h2>
<p style="color:red;"><?php echo form_error('name') ?></p>
<label>Name</label>
<input type="text" name="name"><br>
<p style="color:red;"><?php echo form_error('email') ?></p>
<label>Email</label>
<input type="email" name="email"><br>
<p style="color:red;"><?php echo form_error('gender') ?></p>
<label>Gender</label>
<input type="radio" name="gender" value="M">Male
<input type="radio" name="gender" value="F">Female
<input type="radio" name="gender" value="O">Others<br>
<label>Skill</label>
<input type="checkbox" name="skill[]" value="php">Php
<input type="checkbox" name="skill[]" value=".net">.Net
<input type="checkbox" name="skill[]" value="html">HTML<br>
<p style="color:red;"><?php echo form_error('password') ?></p>
<label>Password</label>
<input type="password" name="password"><br>
<label>Image</label>
<input type="file" name="image"><br>
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>