<?php 
require APPPATH.'libraries\RestController.php';

use chriskacerguis\RestServer\RestController;

class Admin extends RestController
{
	// function index()
	// {
	// 	$this->load->view('admin/adminview');
		
	// }
	function registration_get()
	{
		$this->load->view('admin/regis');
	}
	function regis_post()
	{
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('gender','Gender','required');
		if($this->form_validation->run()==true)
		{
			$data['name']=$this->input->post('name');
			$data['email']=$this->input->post('email');
			$data['password']=md5($this->input->post('password'));
			$data['gender']=$this->input->post('gender');
			// $data['skill']=implode(',',$this->input->post('skill'));
			$filename=$_FILES['image']['name'];
			$tempname=$_FILES['image']['tmp_name'];
			$data['image']='image/'.$filename;
			move_uploaded_file($tempname,$data['image']);

						// print_r($data);
			if($this->Admin_model->regisdata($data))
			{
				redirect('Admin/view');

			}
			else
			{
				echo "error";
			}

			
		}
		else
		{
			$this->load->view('admin/regis');
		}
	}
	function view_get()
	{
		$config=[
                'base_url'=>base_url('index.php/Admin/view'),
                'per_page'=>2,
                'total_rows'=>$this->Admin_model->patient_num(),
                    ];
                    $this->pagination->initialize($config);
                    $result['data']=$this->Admin_model->showdata($config['per_page'],$this->uri->segment(3));
		// $result['data']=$this->Admin_model->showdata();
			 // print_r($result); 
		if($result){
			$this->load->view('admin/adminview',$result);
		}
		else
		{
			echo "no data";
		}
	}
	function delete()
	{
		$id=$this->input->post('did');
		if($this->Admin_model->deletedata($id))
		{
			echo "<script>alert('Delete Successfull')</script>";
			echo "<script>window.location.href='view'</script>";
		}
	}
	function edit_post()
	{
		$data='';
		
		$id=$this->input->post('eid');
		$edit['list']=$this->Admin_model->collect($id);
		$this->form_validation->set_rules('name1','Name','required');
		$this->form_validation->set_rules('email1','Email','required|valid_email');
		$this->form_validation->set_rules('gender1','Gender','required');
		if($this->form_validation->run()==true)
		{
			$id=$this->input->post('id');
			$data1['name']=$this->input->post('name1');
			$data1['email']=$this->input->post('email1');
			$data1['gender']=$this->input->post('gender1');
			// $data1['skill']=implode(',',$this->input->post('skill1'));
			if($this->Admin_model->editdata($id,$data1))
			{
			echo "<script>alert('Update Successfull')</script>";
			echo "<script>window.location.href='view'</script>";
			}
			else
			{
				echo "error";
			}

			
		}
		else
		{
			$this->load->view('admin/update',$edit);
		}
		
	}

	// -----------Ajax-------------------
	function list()
	{
		

		$this->load->view('admin/viewajax');
	}
	function view_ajax()
	{
		
		$config=[
                'base_url'=>base_url('index.php/Admin/view_ajax'),
                'per_page'=>3,
                'total_rows'=>$this->Admin_model->patient_num(),
                    ];
                    $this->pagination->initialize($config);
                    $result=$this->Admin_model->showdata($config['per_page'],$this->uri->segment(3));
		// $result=$this->Admin_model->showdata();
		$html='';
		foreach ($result as $person)
		{
			$html.="<tr>"."<td>".$person['name']."</td>"."<td>".$person['email']."<td>".$person['gender']."</td>"."<td>".$person['skill']."<td><img src='". base_url().$person['image']."' width='300' height='300'><td><button><a href='".base_url('index.php/Admin/delete_ajax')."/".$person['user_id']."'>Delete</a></button></td>"."<td><a href='javascript:;' data=".$person['user_id']." id='ebutton'>edit</a></td>"."</tr>"; 
		}
		echo json_encode($html);
	}
	function regis_ajax()
	{
		$data['name']=$_REQUEST['name'];
			$data['email']=$_REQUEST['email'];
			$data['password']=md5($_REQUEST['password']);
			$data['gender']=$_REQUEST['gender'];;
			$data['skill']=$_REQUEST['skill'];;
			$filename=$_FILES['image']['name'];
			$tempname=$_FILES['image']['tmp_name'];
			$data['image']='image/'.$filename;
			move_uploaded_file($tempname,$data['image']);
		print_r($data);
			$msg['success']=false;
			$result=$this->Admin_model->regisdata_ajax($data);
			if($result)
			{
				$msg['success']=true;
			}
			else
			{
				$msg['success']=false;
			}
			echo json_encode($msg);
	}
	function delete_ajax($id)
	{
		// $id=$this->input->get('did');
		if($this->Admin_model->deletedata($id))
		{
			echo "<script>alert('Delete Successfull')</script>";
			echo "<script>window.location.href='".base_url('index.php/Admin/list')."'</script>";
		}
	}
	function edit_ajax()
	{
		$result=$this->Admin_model->edit_ajax_model();
		$html='';
		foreach ($result as $person)
		{

			$arraydata=explode(',', $person['skill']) ;
			if(in_array('php',$arraydata))
				{$php='checked';}else{$php="";};
			if(in_array('.net',$arraydata))
				{$net='checked';}else{$net="";};
			if(in_array('html',$arraydata))
				{$ht='checked';}else{$ht="";};
			// print_r($arraydata);
			$html.="<input type='number' name='u_id' value='". $person['user_id']."'hidden><br>Name:<br><input type='text' name='u_name' value='". $person['name']."'><br>Email:<br><input type='email' name='u_email' value='". $person['email']."'><br>Gender:<br><input type='radio' name='u_gender' value='M' ". ($person['gender']=='M'?'checked':'').">Male<input type='radio' name='u_gender' value='F'". ($person['gender']=='F'?'checked':'')." >Female<input type='radio' name='u_gender' value='O'". ($person['gender']=='O'?'checked':'').">Others<br>Skill:<br><input type='checkbox' name='u_skill' value='php' ".$php.">Php<input type='checkbox' name='u_skill' value='.net' ".$net.">.Net<input type='checkbox' name='u_skill' value='html' ".$ht.">HTML<br>Image<input type='file' name='u_image'><br><input type='submit' name='update' value='Update' id='update'>"; 
		}
		echo json_encode($html);
	}
	function update_ajax()
	{
			$id=$_REQUEST['id'];
			$data['name']=$_REQUEST['name'];
			$data['email']=$_REQUEST['email'];
			$data['gender']=$_REQUEST['gender'];;
			$data['skill']=$_REQUEST['skill'];;
			$filename=$_FILES['image']['name'];
			$tempname=$_FILES['image']['tmp_name'];
			$data['image']='image/'.$filename;
			move_uploaded_file($tempname,$data['image']);
		// print_r($data);
			$msg['success']=false;
			$result=$this->Admin_model->updatedata_ajax($id,$data);
			if($result)
			{
				$msg['success']=true;
			}
			else
			{
				$msg['success']=false;
			}
			echo json_encode($msg);
	}
}