<?php

class Comment_con extends CI_Controller{
    function index()
    {
        $this->load->view('admin/comment');
    }
    function save()
    {
        $data['email']=$_REQUEST['email'];
        $data['message']=$_REQUEST['message'];
        $msg['response']=false;
        if($this->Comment_model->savedata($data)){
            $msg['response']=true;
        }
        echo json_encode($msg);
    }
    function commentdata(){
        $result=$this->Comment_model->calldata();
        echo json_encode($result);
    }

}
?>