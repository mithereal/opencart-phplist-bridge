<?php
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	
//	
///////////////////////////////////////////////////////////////////
class ModelPhplistLists extends Model {
    
      public $dbprefix='phplist_';
    
	public function addList($data) {
$this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');     	
		$sql = "INSERT INTO " . $this->dbprefix . "list SET active = '".$data['active'] . "', description = '" . $data['description'] . "', name = '".$data['name'] . "'";
		$this->db->query($sql);
                
	}
	public function addListuser($data) {
$this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        $userxist=$this->getListmembershipbyuserid($data);

if($userxist == false && $data['listid'] !='')
{
		$sql = "INSERT INTO " . $this->dbprefix . "listuser SET listid = '".$data['listid'] . "', userid = '" . $data['userid'] . "', entered = NOW()";
               // var_dump($data['userid']);
		$this->db->query($sql);
                //retrun id
	}
        }
	public function editList($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$sql="UPDATE " . $this->dbprefix . "list SET active = '".$data['active'] . "'";
                
                if(isset($data['description']))
                $sql .=", description = '" . $data['description'] . "'";
                
                if(isset($data['name']))
                $sql .=", name = '".$data['name'] . "'"; 
                
                $sql .=" WHERE id = '" . (int)$data['id'] . "'";
		$this->db->query($sql);
     //  return $sql;
	}
	
	public function deleteList($list_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$this->db->query("DELETE FROM " . $this->dbprefix . "list WHERE id = '" . (int)$list_id . "'");
		
	}	
	public function deleteListuser($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$this->db->query("DELETE  FROM " . $this->dbprefix . "listuser WHERE userid = '" . (int)$data['id'] . "' && listid = '".$data['listid']."'");
		
	}	
	public function deletefromallLists($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$this->db->query("DELETE  FROM " . $this->dbprefix . "listuser WHERE userid = '" . (int)$data['id'] . "'");
		
	}	
        
        public function deleteListusers($id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$this->db->query("DELETE  FROM " . $this->dbprefix . "listuser WHERE listid = '" . (int)$id . "'");
        }
        public function deletemsgfromallLists($id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$this->db->query("DELETE  FROM " . $this->dbprefix . "listmessage WHERE messageid = '" . (int)$id . "'");
        }

	public function getList($list_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$query = $this->db->query("SELECT  * FROM " . $this->dbprefix . "list WHERE id='" . (int)$list_id . "'");
		
		return $query->row;
	}
        
	public function getListbyname($list_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$query = $this->db->query("SELECT id FROM ". $this->dbprefix . "list WHERE name = '" . $list_id . "'");
                
        }
        
        	public function getListsbymsgid($msg_id) {
                    $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$query = $this->db->query("SELECT * FROM ". $this->dbprefix . "list l, ". $this->dbprefix . "listmessage m WHERE m.messageid = '" . $msg_id . "' && l.id=m.listid");
		
		return $query->rows;
	}
        
	public function getListmembershipbyuserid($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$query = $this->db->query("SELECT * FROM ". $this->dbprefix . "listuser WHERE userid = '" . $data['userid'] . "' && listid = '" . $data['listid'] . "'");
		
		return $query->row;
	}
		
	public function getLists() {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix'); 
                                $sql = "SELECT * FROM ".$this->dbprefix."list LIMIT 0, 100 ";
                                $query=$this->db->query($sql);
				$list_data = $query->rows;
                                
				//$this->cache->set('list.' . (int)$this->config->get('config_language_id'), $list_data);
			return $list_data;			
		}
	public function getActivelists() {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix'); 
                                $sql = "SELECT * FROM ".$this->dbprefix."list WHERE active = 1 LIMIT 0, 100 ";
                                $query=$this->db->query($sql);
				$list_data = $query->rows;
                                
				//$this->cache->set('list.' . (int)$this->config->get('config_language_id'), $list_data);
			return $list_data;			
		}
	public function getListsmembers() {
          $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
                                $sql = "SELECT *, l.userid as member FROM ".$this->dbprefix."list p left outer join  ".$this->dbprefix."listuser l  on p.id = l.listid";
                                $query=$this->db->query($sql);
				$list_data = $query->rows;

			return $list_data;			
		}
                
                public function getListmembers($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
                                $sql = "SELECT *, l.userid as member FROM ".$this->dbprefix."list p left outer join  ".$this->dbprefix."listuser l  on p.id = l.listid && l.userid='".$data."'";
                            //    var_dump($sql);
                                $query=$this->db->query($sql);
				$list_data = $query->rows;

			return $list_data;			
		}
                public function getActivelistmembers($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
                                $sql = "SELECT *, l.userid as member FROM ".$this->dbprefix."list p left outer join  ".$this->dbprefix."listuser l  on p.id = l.listid && l.userid='".$data['id']."' WHERE active = 1";
                            //    var_dump($sql);
                                $query=$this->db->query($sql);
				$list_data = $query->rows;

			return $list_data;			
		}
                
	public function getListsformessage($id) {
             $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
                                $sql = "SELECT p.id as id, p.name as name, l.listid as checked FROM ".$this->dbprefix."list p left outer join  ".$this->dbprefix."listmessage l  on p.id = l.listid && l.messageid='".$id."'";
                                $query=$this->db->query($sql);
				$list_data = $query->rows;
			return $list_data;			
		}
	
	
	public function getListDescriptions($list_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$list_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . $this->dbprefix . "list_description WHERE list_id = '" . (int)$list_id . "'");

		foreach ($query->rows as $result) {
			$list_description_data[$result['language_id']] = array(
				'title'       => $result['title'],
				'description' => $result['description']
			);
		}
		
		return $list_description_data;
	}
	
	public function getListStores($list_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$list_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . $this->dbprefix . "list_to_store WHERE list_id = '" . (int)$list_id . "'");

		foreach ($query->rows as $result) {
			$list_store_data[] = $result['store_id'];
		}
		
		return $list_store_data;
	}

	public function getListLayouts($list_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$list_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . $this->dbprefix . "list_to_layout WHERE list_id = '" . (int)$list_id . "'");
		
		foreach ($query->rows as $result) {
			$list_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $list_layout_data;
	}
		
	public function getTotalLists() {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . $this->dbprefix . "list");
		
		return $query->row['total'];
	}	
	
	public function getTotalListsByLayoutId($layout_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . $this->dbprefix . "list_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
        
        public function getTotalMembers($id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . $this->dbprefix . "listuser WHERE listid='".$id."'");
		
		return $query->row['total'];
	}	
}
?>
