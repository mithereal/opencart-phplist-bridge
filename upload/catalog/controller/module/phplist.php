<?php 
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	
//	
///////////////////////////////////////////////////////////////////
class ControllerModulePhplist extends Controller {  
	public function index() {
		if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/newsletter', '', 'SSL');
	  
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
    	} 
		
		$this->language->load('account/newsletter');
		$this->load->model('account/customer');
                $this->load->model('phplist/lists');
		$this->load->model('phplist/user');
                $this->load->model('phplist/listmessage');
    	 
		$this->document->setTitle($this->language->get('heading_title'));
                $email=$this->customer->getEmail();
              
                $user=$this->model_phplist_user->getuserbyEmail($email);
            	
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

              $this->model_phplist_lists->deletefromallLists($user);
                         
             
              
              if($this->request->post['newsletter'] == "1" )
              {
                  
                  if(isset($this->request->post['subscribe']) )
              {
                      
                  foreach($this->request->post['subscribe'] as $sub)
                  {
                      $data['userid']=$user['id'];
                      $data['listid']=$sub;

                       $this->model_phplist_lists->addListuser($data);
                  }
                 
              }else{
                  
                  $this->load->model('setting/setting');
                  $data['userid']=$user['id'];
                  $data['listid']=$this->config->get('phplist_defaultlist');
                 $this->model_phplist_lists->addListuser($data);
              }
              }
              
              
			
			$this->model_account_customer->editNewsletter($this->request->post['newsletter']);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('account/account', '', 'SSL'));
		}

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),       	
        	'separator' => false
      	); 

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);
		
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_newsletter'),
			'href'      => $this->url->link('account/newsletter', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);
		
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
		$this->data['entry_newsletter'] = $this->language->get('entry_newsletter');
		
		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_back'] = $this->language->get('button_back');

    	$this->data['action'] = $this->url->link('module/phplist', '', 'SSL');
		
		$this->data['newsletter'] = $this->customer->getNewsletter();
		
		$this->data['back'] = $this->url->link('account/account', '', 'SSL');
                
                 $this->data['lists'] = $this->model_phplist_lists->getActivelistmembers($user);
                 
$this->language->load('module/phplist');
$this->data['entry_lists'] = $this->language->get('entry_lists');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/phplist.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/phplist.tpl';
		} else {
			$this->template = 'default/template/module/phplist.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'	
		);
						
		$this->response->setOutput($this->render());			
  	}
}
?>
