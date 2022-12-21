<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<a href="<?php echo base_url('index.php/Admin/registration'); ?>"><button>add new</button></a>
	<h4><?php echo $this->pagination->create_links(); ?></h4>
	<table border="1">
		<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Gender</th>
		<th>Skill</th>
		<th>Image</th>
		<th>Action</th>
		</tr>
		<?php foreach($data as $admin) {?>
		<tr>
			<td><?php echo $admin['name']; ?></td>
			<td><?php echo $admin['email']; ?></td>
			<td><?php echo $admin['gender']; ?></td>
			<td><?php echo $admin['skill']; ?></td>
			<td><img src="<?php echo base_url().$admin['image']; ?>" height='200' width='300'> </td>
			<td><a href="<?php echo base_url('index.php/Admin/edit'); ?>?eid=<?php echo $admin['user_id']; ?>">Edit</a><a href="<?php echo base_url('index.php/Admin/delete'); ?>?did=<?php echo $admin['user_id']; ?>">Delete</a></td>
		</tr>
	<?php } ?>
	</table>

</body>
</html>