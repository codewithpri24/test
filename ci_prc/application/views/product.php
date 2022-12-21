<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form id="p_form" method="post" action="<?php echo base_url('index.php/Product/editrow') ?>">
		<h5>Name</h5>
		<input type="text" name="name"><br>
		<h6>State</h6>
		<select id="state" name="state_id"> 
			<option>select</option>
			<?php foreach($data as $state){ ?>
				<option value="<?php echo $state['state_id'];?>"><?php echo $state['state'];?></option>
			<?php } ?>
		</select>
		<h6>City</h6>
		<select id="city" name="city_id">
			<option>select</option>
			
		</select>
		<p id="test"></p>
		<h5>Product Quantity</h5>
		<input type="number" name="quantity"><br>
		<input type="submit" name="submit" id="submit">
	</form>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

	$(window).on('load',function(){ alldata(); });

	$('#p_form').on('change','#state',function(){
		var state_id=$('#state').val();
			console.log(state_id);
			$.ajax({
			type:'post',
			url:"<?php echo base_url('index.php/Product/city_by_id') ?>",
			dataType:'json',
			async : false,
			data:{state_id:state_id},
			success:function(city){
				var html = '';
				var i;
				console.log(city);
				$('#city').html(city);
			},
			error:function()
			{
				alert('ajax error');
			}

		});
	});

	$('#p_form').on('click','#submit',function(){
		var state_id=$("#state").val();
		var city_id=$("#city").val();
		var quant=$("input[name='quantity']").val();

		$.ajax({
			type:'post',
			url:'<?php echo base_url('index.php/Product/editrow') ?>',
			data:{state_id:state_id,city_id:city_id,quant:quant},
			async:true,
			success:function(data){
				console.log('data');
			},
			error:function()
			{
				alert('insert ajax error');
			}
		});
	});

		function alldata(){
		
			$.ajax({
			type:'post',
			url:"<?php echo base_url('index.php/Product/table') ?>",
			dataType:'json',
			async : false,
			success:function(data){
				var html = '';
				var i;
				console.log(data);
				
			},
			error:function()
			{
				alert('ajax table error');
			}

		});
		}

</script>