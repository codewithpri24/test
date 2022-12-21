<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<button onclick=" return add()">Add New</button>
<form enctype="multipart/form-data">
	<table id="regis" cellpadding="10" cellspacing="10" ><thead><tr><td><h2>Registration</h2></td></tr></thead>
<tbody>
<tr>
<td>
	<p>Name</p>
	<input type="name" name="name">
</td>
</tr>
<tr>
<td>
	<p>Email</p>
	<input type="email" name="email">
</td>
</tr>
<tr>
<td>
	<p>gender</p>
	<input type="radio" name="gender" value="M">Male
<input type="radio" name="gender" value="F">Female
<input type="radio" name="gender" value="O">Others
</td>
</tr>
<tr>
<td>
	<p>Skill</p>
	<input type="checkbox" name="skill" value="php">Php
<input type="checkbox" name="skill" value=".net">.Net
<input type="checkbox" name="skill" value="html">HTML
</td>
</tr>
<tr>
<td>
	<p>password</p>
	<input type="password" name="password">
</td>
</tr>
<tr>
<td>
	<p>image</p>
	<input type="file" name="image">
</td>
</tr>
<tr>
<td>

	<input type="submit" name="submit" value="register">
</td>
</tr>
</tbody>

</table>
</form>
	<table border="1" id='viewtable'>
		<tr ><td colspan='4'><h4><?php echo $this->pagination->create_links(); ?></h4></td></tr>
		<thead>
<tr><thead>name</thead></thead></tr>
		</thead>
<tbody id="d1">

</tbody>
	</table>
	<form id="update_form">

	</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	$(window).on("load",function(){
		showdata();
	});
	function showdata()
	{
		$("#regis").hide();
		$.ajax({
			type:'post',
			dataType:'json',
			async: false,
			url:'<?php echo base_url('index.php/Admin/view_ajax'); ?>',
			success:function(data)
			{
				console.log(data);
				
            	$('#d1').html(data);
				
			},
			error:function() {
				alert("ajax error");
			}
		});
	}
	function add()
	{
		$("#regis").show();
		$("input[name='submit']").click(function(e){
			e.preventDefault();
			var name=$("input[name='name']").val();
			var email=$("input[name='email']").val();
			var gender=$("input[name='gender']:checked").val();
			var password=$("input[name='password']").val();
			var skill = new Array();
		$('input[name="skill"]:checked').each(function() {
			skill.push(this.value);
		});
		var skills=skill.join(",");
			var images=$("input[name='image']")[0].files[0];
			 formdata=new FormData();
        formdata.append('name',name);
            formdata.append('email',email);
             formdata.append('gender',gender);
                 formdata.append('password',password);
                  formdata.append('skill',skills);
                  formdata.append('image',images);
			console.log(formdata);
			$.ajax({
				type:'post',
				url:'<?php echo base_url('index.php/Admin/regis_ajax'); ?>',
				data:formdata,
              contentType:false,
              processData:false,
				success:function(response)
				{
					window.location.href='list';
				},
				error:function()
				{
					alert('ajax error');
				}
			});
		});
	}
	$('#viewtable').on('click','#ebutton',function(){
		var id=$(this).attr('data');
		console.log(id);
		$.ajax({
			type:'post',
			url:'<?php echo base_url('index.php/Admin/edit_ajax'); ?>',
			data:{id:id},
			success:function(data)
			{
				$('#update_form').html(data);
			},
				error:function()
				{
					alert('ajax error');
				}

		});
	});

	$('#update_form').on('click','#update',function(e){
			e.preventDefault();
			var id=$("input[name='u_id']").val();
			var name=$("input[name='u_name']").val();
			var email=$("input[name='u_email']").val();
			var gender=$("input[name='u_gender']:checked").val();
			var skill = new Array();
		$('input[name="u_skill"]:checked').each(function() {
			skill.push(this.value);
		});
		var skills=skill.join(",");
			var images=$("input[name='u_image']")[0].files[0];
			 formdata=new FormData();
			 formdata.append('id',id);
        	formdata.append('name',name);
            formdata.append('email',email);
             formdata.append('gender',gender);
                  formdata.append('skill',skills);
                  formdata.append('image',images);
			console.log(formdata);
			$.ajax({
				type:'post',
				url:'<?php echo base_url('index.php/Admin/update_ajax'); ?>',
				data:formdata,
              contentType:false,
              processData:false,
				success:function(response)
				{
					window.location.href='list';
				},
				error:function()
				{
					alert('ajax error');
				}
			});
		});

</script>
</body>
</html>