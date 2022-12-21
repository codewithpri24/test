 <?php 

class Admin_model extends CI_Model
{
	function regisdata($data)
	{
		if($this->db->insert('admin',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function patient_num()
    {
        $query=$this->db->select('*')->from('admin')->get();
        return $query->num_rows();
        
    }
	function showdata($limit,$offset)
	{
		$query=$this->db->select('*')->from('admin')->limit($limit,$offset)->get();
		return $query->result_array();
	}
	function deletedata($id)
	{
		$query=$this->db->where('user_id',$id)->delete('admin');
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function editdata($id,$data)
	{
		$query=$this->db->where('user_id',$id)->update('admin',$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function collect($id)
	{
		if($query=$this->db->where('user_id',$id)->select('*')->from('admin')->get())
		{
			return $query->result_array();
		}
		else
		{
			return $data='';
		}
	}

	function regisdata_ajax($data)
	{
			
		if($this->db->insert('admin',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function edit_ajax_model()
	{
		$id=$_REQUEST['id'];
		$query=$this->db->where('user_id',$id)->select('*')->from('admin')->get();
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	function updatedata_ajax($id,$data)
	{
		if($this->db->where('user_id',$id)->update('admin',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


}