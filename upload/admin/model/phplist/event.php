<?php
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	
//	
///////////////////////////////////////////////////////////////////
class ModelPhplistEvent extends Model {
     private $dbprefix='phplist_';
     

	public function deleteEvent($id) {
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        $this->db->query("DELETE  FROM " . $this->dbprefix . "eventlog WHERE id = '" . (int)$id . "'");
        }
        
	public function deleteEventrange($id) {
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        $this->db->query("DELETE  FROM " . $this->dbprefix . "eventlog WHERE id = '" . (int)$id . "'");
        }
        
	public function deleteAllevents() {
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        $this->db->query("DELETE  FROM " . $this->dbprefix . "eventlog");
        }
        
		
	public function getTotalevents() {
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix'); 
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . $this->dbprefix . "eventlog");
	return $query->row['total'];
	}	
	
        public function getEvents() {
       $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');

        $sql="SELECT  * FROM " . $this->dbprefix . "eventlog";
        $sql .= " ORDER BY id DESC";
        
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
        
        public function getEvent($id) {
        $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
        $query=$this->db->query("SELECT *  FROM " . $this->dbprefix . "eventlog WHERE id = '" . (int)$id . "'");
        return $query->row;
        }
}
?>
