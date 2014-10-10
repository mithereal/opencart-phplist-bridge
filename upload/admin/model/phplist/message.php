<?php
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	
//	
///////////////////////////////////////////////////////////////////
class ModelPhplistMessage extends Model {

    public $dbprefix='phplist_';
    


public function addMessage($data){
$this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
  $sql="INSERT INTO " . $this->dbprefix . "message SET subject = '" . $data['subject'] . "', fromfield = '" . $data['from'] . "', message = '" . $data['message'] . "', footer = '" . $data['footer'] . "', entered = Now(), embargo = '" . $data['embargo'] ."', status = '" . $data['status'] ."', sendformat = '" . $data['sendformat'] ."', htmlformatted = '" . (int)$data['htmlformatted'] ."', template = '" . $data['template'] ."', owner = '1'";
  
 $this->db->query($sql);
 $messageid=$this->db->getLastId();
 
  if($data['emailalertstart'] !=''){
  $sql="INSERT INTO " . $this->dbprefix . "messagedata SET name = 'notify_start', id = '" . $messageid . "', data = '" . $data['emailalertstart'] . "'";
  $this->db->query($sql);
  }
  
  if($data['emailalertend'] !=''){
  $sql="INSERT INTO " . $this->dbprefix . "messagedata SET name = 'notify_end', id = '" . $messageid . "', data = '" . $data['emailalertend'] . "'";
  $this->db->query($sql);
  }
   
 return $messageid;
}

public function getTotalmessages($status) {
    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
     if(is_array($status))
        { 
            $sql="SELECT COUNT(*) AS total FROM " . $this->dbprefix . "message where status = '".$status[0]."' || status = '".$status[1]."' || status = '".$status[2]."'";

        }else{
    $sql="SELECT COUNT(*) AS total FROM " . $this->dbprefix . "message where status='".$status."'";
        }
      	$query = $this->db->query($sql);
		
		return $query->row['total'];
	}

public function deleteMessage($id){
    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $this->db->query("DELETE FROM " . $this->dbprefix . "message WHERE id = '" . (int)$id . "'");
    $this->db->query("DELETE FROM " . $this->dbprefix . "messagedata WHERE id = '" . (int)$id . "'");
    $this->db->query("DELETE FROM " . $this->dbprefix . "listmessage WHERE messageid = '" . (int)$id . "'");
}

public function editMessage($data){
    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $sql="UPDATE " . $this->dbprefix . "message SET subject = '" . $data['subject'] . "', fromfield = '" . $data['sender_email'] . "', message = '" . $data['message'] . "', footer = '" . $data['footer'] . "',  embargo = '" . $data['embargo'] ."', status = '" . $data['status'] ."', sendformat = '" . $data['sendformat'] ."', htmlformatted = '" . (int)$data['htmlformatted'] ."', template = '" . $data['template'] ."', owner = '1' WHERE id=".$data['id'];
    $this->db->query($sql);
    
    $messageid=$data['id'];
 
  if($data['emailalertstart'] !=''){
  $sql="UPDATE " . $this->dbprefix . "messagedata SET  data = '" . $data['emailalertstart'] . "' WHERE id = '" . $messageid . "' && name = 'notify_start'";
  $this->db->query($sql);
  }
  
  if($data['emailalertend'] !=''){
  $sql="UPDATE " . $this->dbprefix . "messagedata SET  data = '" . $data['emailalertend'] . "' WHERE id = '" . $messageid . "' && name = 'notify_end'";
$this->db->query($sql);
  }
  
}

public function editStatus($data){
    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $sql="UPDATE " . $this->dbprefix . "message SET  status = '" . $data['status'] . "' WHERE id = '" . $data['messageid'] . "'";
$this->db->query($sql);

    }
    
public function getMessage($id){
    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $query= $this->db->query("SELECT  * FROM " . $this->dbprefix . "message WHERE id = '" . (int)$id . "'");
             return $query->row; 
    }
    
public function getMessagedata($id){
    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        $sql="SELECT  * FROM " . $this->dbprefix . "messagedata WHERE id = '" . (int)$id . "'";
    $query= $this->db->query($sql);
            return $query->rows; 
    }
    
    public function getMessages($status='submitted',$data=null){
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        if(is_array($status))
        { 
            $sql="SELECT  * FROM " . $this->dbprefix . "message where status = '".$status[0]."' || status = '".$status[1]."' || status = '".$status[2]."'";

        }else{
        $sql="SELECT  * FROM " . $this->dbprefix . "message where status='".$status."'";
        }
         if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
    $query= $this->db->query($sql);

            return $query->rows; 
             
	
    }
    public function getMessagetotalbyuser($data){
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $query= $this->db->query("SELECT  * FROM " . $this->dbprefix . "usermessage WHERE userid = '".$data['id']."'");
                   $count=count($query->rows);       
             return $count;
             
	
    }
}
?>
