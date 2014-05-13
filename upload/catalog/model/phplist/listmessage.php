<?php
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	
//	
///////////////////////////////////////////////////////////////////
class ModelPhplistListmessage extends Model {
    private $dbprefix='phplist_';
public function addMessage($messageid,$listid){
   $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
  $sql="INSERT INTO " . $this->dbprefix . "listmessage SET messageid = '" . $messageid . "', entered = Now(), listid = '" . $listid. "'";

    $this->db->query($sql);
return $this->db->getLastId();
}


public function deleteMessage($id){
    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $this->db->query("DELETE FROM " . $this->dbprefix . "listmessage WHERE messageid = '" . (int)$id . "'");
}

public function editMessage($id){
    
}

public function getMessage($id){
    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $query= $this->db->query("SELECT  * FROM " . $this->dbprefix . "message WHERE id = '" . (int)$id . "'");
             return $query->row; 
    }
    
    
    public function getMessages(){
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $query= $this->db->query("SELECT  * FROM " . $this->dbprefix . "message");
             return $query->row;         
	
    }
    
    public function getListsbymessageid($mid){
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $query= $this->db->query("SELECT  * FROM " . $this->dbprefix . "listmessage m, " . $this->dbprefix . "message l, " . $this->dbprefix . "list s WHERE m.messageid= l.id && s.id= m.listid && m.messageid=".$mid);
             return $query->rows;         
	
    }
}

?>
