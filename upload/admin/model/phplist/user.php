<?php
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	
//	
///////////////////////////////////////////////////////////////////
class ModelPhplistUser extends Model {
     private $dbprefix='phplist_';
     
   
	public function addUser($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        
            $userxist=$this->getUserbyemail($data['email']);
            if($userxist == false)
            {
            $data['uniqid']=md5(uniqid(time()));;
            //check if user exist 
           
		$this->db->query("INSERT INTO " .$this->dbprefix . "user_user SET email = '".$data['email']."',  htmlemail = '".$data['htmlemail'] ."', rssfrequency = '".$data['rssfrequency'] ."', confirmed = '".$data['confirmed'] ."', password = '".$data['password'] ."', disabled = '".$data['disabled'] ."', uniqid = '".$data['uniqid'] ."', entered = NOW()");
                $data['userid']=$this->db->getLastId();
            }else{
                 $data['userid']=$userxist['id'];
            }
            if(isset($data['listid']) && $data['userid']){

                $this->load->model('phplist/lists');
                $this->model_phplist_lists->addListuser($data);
            }
		return $this->db->getLastId();
	}
	
	public function editUser($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        
        $userxist=$this->getUserbyemail($data['email']);
            if($userxist != false)
            {
                $data['userid']=null;
            }else{
			$this->db->query("UPDATE " .$this->dbprefix . "user_user SET email = '".$data['email']."',  htmlemail = '".$data['htmlemail'] ."', rssfrequency = '".$data['rssfrequency'] ."', confirmed = '".$data['confirmed'] ."', password = '".$data['password'] ."', disabled = '".$data['disabled'] ."', entered = NOW() WHERE id='".$data['id']."'");
                $data['userid']=$this->db->getLastId();
		
	}
        return $data;
        }
	
	public function getUserbyemail($email) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$sql = "SELECT * FROM " .  $this->dbprefix  . "user_user   WHERE email = '" . $email."'";
             $query=$this->db->query($sql);
             return  $query->row;
	}	
        
	public function getUser($id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$sql = "SELECT * FROM " .  $this->dbprefix  . "user_user   WHERE id = '" . $id."'";
             $query=$this->db->query($sql);
             return  $query->row;
	}	
        
	public function getUsers($data=null) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$sql = "SELECT * FROM " .  $this->dbprefix  . "user_user";
                if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
                
             $query=$this->db->query($sql);
             return  $query->rows;
	}	
        	

	public function delete($id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$this->db->query("DELETE  FROM " . $this->dbprefix . "user_user WHERE id = '" . (int)$id . "'");
        }
        
	public function getlistmembers($data = array()) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		if ($data) {
			$sql = "SELECT DISTINCT email,confirmed, id FROM " .  $this->dbprefix  . "user_user u, " . $this->dbprefix . "listuser l WHERE l.listid = '" . (int)$data['listid']."' && u.id = l.userid";
		//TODO: make distinct usernames
			$sort_data = array(
				'l.modified'
				
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY l.modified";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
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
			//var_dump($sql);
			$query = $this->db->query($sql);
			
			return $query->rows;
                        //return $sql;
                       
		} 
	
	
						
		}
	
	public function getMembers($data = array()) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
			$sql = "SELECT DISTINCT email,confirmed, id FROM " .  $this->dbprefix  . "user_user u left outer join " . $this->dbprefix . "listuser l on l.userid = u.id";

			$sort_data = array(
				'l.modified'
				
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY l.modified";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
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

			$query = $this->db->query($sql);
			
			return $query->rows;
		
		}

	
	
		
	public function getTotalUsers() {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix'); 
  
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . $this->dbprefix . "user_user");
		
		return $query->row['total'];
	}	
	
	
	public function getTotalUsersByLayoutId($layout_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}	
}
?>
