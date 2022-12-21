<?php 
class Product_model extends CI_model{
	function all_state_data()
	{
		$query=$this->db->select('*')->from('state')->get();
		return $query->result_array();
	}
	function all_city_data_by_id($state_id)
	{
		$query=$this->db->where('state_id',$state_id)->select('*')->from('city')->get();
		return $query->result_array();
	}
	function editrow_by_id($data)
	{
		$query=$this->db->where('state_id',$data['state_id'])->where('city_id',$data['city_id'])->select('*')->from('city')->get();
		return $query->row();
	}
	function addrow_by_id($data)
	{
		$query=$this->db->where('state_id',$data['state_id'])->where('city_id',$data['city_id'])->set('allowted',$data['new_quant'])->set('used',$data['new_used'])->update('city');
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function all_table_data()
	{
		$query=$this->db->select('*')->from('city')->get();
		return $query->result_array();
	}
}
?>