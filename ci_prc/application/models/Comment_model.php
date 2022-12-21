<?php 
class Comment_model extends CI_Model{
    function savedata($data){
        if($this->db->insert('comment',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function calldata()
    {
        $query=$this->db->select('*')->from('comment')->get();
        return $query->result_array();
    }
}