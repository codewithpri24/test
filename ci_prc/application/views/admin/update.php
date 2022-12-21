<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<form method="post" action="<?php echo base_url('index.php/Admin/edit') ?>" enctype="multipart/form-data">
<h2>Update Data</h2>
<?php foreach ($list as $admin) { ?>
<input type="number" name="id" value="<?php echo $admin['user_id']; ?>"><br>
<p style="color:red;"><?php echo form_error('name') ?></p>
<label>Name</label>
<input type="text" name="name1" value="<?php echo $admin['name']; ?>"><br>
<p style="color:red;"><?php echo form_error('email') ?></p>
<label>Email</label>
<input type="email" name="email1" value="<?php echo $admin['email']; ?>"><br>
<p style="color:red;"><?php echo form_error('gender') ?></p>
<label>Gender</label>
<input type="radio" name="gender1" value="M" <?php echo($admin['gender']=='M'?'checked':'') ?>>Male
<input type="radio" name="gender1" value="F" <?php echo($admin['gender']=='F'?'checked':'') ?>>Female
<input type="radio" name="gender1" value="O" <?php echo($admin['gender']=='O'?'checked':'') ?>>Others<br>
<label>Skill</label>
<?php $arraydata=explode(',', $admin['skill']); ?>

<input type="checkbox" name="skill1[]" value="php" <?php if(in_array('php',$arraydata)){echo 'checked';} ?>>Php
<input type="checkbox" name="skill1[]" value=".net" <?php if(in_array('.net',$arraydata)){echo 'checked';} ?>>.Net
<input type="checkbox" name="skill1[]" value="html" <?php if(in_array('html',$arraydata)){echo 'checked';} ?>>HTML<br>

<label>Image</label>
<input type="file" name="image1"><br>
<input type="submit" name="submit" value="Update">
<?php } ?>
</form>
</body>
</html>