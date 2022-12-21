<?php 
class Product extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->Model('Product_model');
	}
	function index()
	{
		$result['data']=$this->Product_model->all_state_data();
		$this->load->view('product',$result);
		
	}
	function city_by_id()
	{
		$state_id=$_REQUEST['state_id'];
		$html="";
		$result1=$this->Product_model->all_city_data_by_id($state_id);
		foreach($result1 as $city){
		$html.="<option value='".$city['city_id']."'>".$city['city']."</option>";}
		echo json_encode($html);
	}
	function editrow()
	{
		$data['state_id']=$_REQUEST['state_id'];
		$data['city_id']=$_REQUEST['city_id'];
		$data['quant']=$_REQUEST['quantity'];
		$msg['response']=false;
		$result=$this->Product_model->editrow_by_id($data);
		// print_r($result);
		$data['new_quant']=$result->allowted-$data['quant'];
		$data['new_used']=$result->used+$data['quant'];

		$result2=$this->Product_model->addrow_by_id($data);
		if($result2)
		{
			$msg['response']=true;
		}
		
		echo json_encode($msg);
	}
	function table()
	{
		$result['table']=$this->Product_model->all_table_data();
		echo json_encode($result);
		
	}
}
?>