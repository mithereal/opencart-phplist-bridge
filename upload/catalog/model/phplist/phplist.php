<?php
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	
//	
///////////////////////////////////////////////////////////////////
class ModelPhplistPhplist {
		
	public function getlists() {
            $this->load->model('setting/setting');
        $this->dbprefix=$this->config->get('dbprefix');
    $query=$this->db->query("SELECT * FROM" .$this->dbprefix . "list");
    return $query->rows;
	}

}
?>
