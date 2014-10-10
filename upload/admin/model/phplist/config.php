<?php
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	Distributors: www.plugmycode.com
//	Support: www.plugmycode.com/support
///////////////////////////////////////////////////////////////////
class ModelPhplistConfig extends Model{
    
    private $dbprefix='phplist_';
   
	public function addConfig($data) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$this->db->query("INSERT INTO " . $this->dbprefix . "config SET value = '" . $data['value'] . "', editable = '" . $data['editable'] .  "', type = '" . $data['type'] . "'");

	}
	
	public function editConfig($key,$data) {
               $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$this->db->query("UPDATE " . $this->dbprefix . "config SET value = '" . $data  .  "' WHERE item = '" . $key . "'");

	}
	

	public function getConfig($config_id) {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$query = $this->db->query("SELECT value FROM ". $this->dbprefix . "config WHERE item = '" . $config_id . "'");
                
		return $query->row;
	}
        
	public function getConfigs() {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
		$query = $this->db->query("SELECT * FROM ". $this->dbprefix . "config WHERE editable = 1");
		return $query->rows;
	}
		
	
}
?>
