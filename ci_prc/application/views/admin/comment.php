<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Comment Panel</title>
</head>
<body>


    <div class="container">
        <div id="card"></div>
 
<form id='commentform'>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='email'>
    
  </div>
  <div class="form-floating">
  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name='message'></textarea>
  <label for="floatingTextarea">Comments</label>
</div>
  <button type="submit" class="btn btn-primary" id='submit'>Submit</button>
</form>
</div>   
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type='text/javascript'>
    $(window).on('load',function(){

        alldata();
    });
$('#commentform').on('click','#submit',function(){
    var email=$("input[name='email']").val();
    var message=$("textarea[name='message']").val();
   console.log(message);
   formdata=new FormData();
			 formdata.append('message',message);
            formdata.append('email',email);

    $.ajax({
        type:'post',
        url:'<?php echo base_url('index.php/Comment_con/save'); ?>',
        dataType:'json',
        data:formdata,
        contentType:false,
        processData:false,
        success:function(response)
        {
            alldata();
        },
        error:function(response)
        {
            alert('unsuccess');
        }
    });
});
function alldata()
{
    $.ajax({
        type:'post',
        async: false,
        url:'<?php echo base_url('index.php/Comment_con/commentdata'); ?>',
        dataType:'json',
        success:function(data)
        {
            var html="";
           console.log(data);
           for(i=0; i<data.length; i++){
             html += "<div class='container'><div class='card' style='width: 18rem;'>"+"<div class='card-body'><h5 class='card-title'>"+data[i].email+"</h5>"+"<p class='card-text'>"+data[i].message+"</p>"+"<a href='#' class='card-link'>"+"Cardlink"+"</a>"+"<a href='#' class='card-link'>"+"Anotherlink"+"</a>"+"</div></div></div>";
           };
           $('#card').html(html);
        },
        error:function()
        {
            alert('data unsuccess');
        }
    });
}
</script>