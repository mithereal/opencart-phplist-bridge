<?php 
///////////////////////////////////////////////////////////////////
//	Copyright: Jason Clark
//	Product: Phplist Bridge
//	
//	
///////////////////////////////////////////////////////////////////
class ControllerModulePhplist extends Controller {
	private $error = array();
	 
	public function uninstall() {
            $this->db->query("
	DELETE FROM " . DB_PREFIX . "setting 
	WHERE `group` = 'phplist' 
	");
        }
	public function install() {
$this->load->model('setting/setting');     
$this->db->query("
	INSERT INTO " . DB_PREFIX . "setting (
	`setting_id` ,
	`store_id` ,
	`group` ,
	`key` ,
	`value` ,
	`serialized`
	)
	VALUES (
	NULL , '0', 'phplist', 'dbprefix', 'phplist_', '0'
	),(
	NULL , '0', 'phplist', 'phplist_defaultlist', '1', '0'
	);");
        }
        
	public function index() {
		$this->language->load('module/phplist');
                 $this->load->model('setting/setting');
              $this->load->model('phplist/config');
 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
                $this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_hide'] = $this->language->get('text_hide');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
                $this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_description'] = $this->language->get('entry_description');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['text_dbprefix'] = $this->language->get('text_dbprefix');
		
		$this->data['token'] = $this->session->data['token'];
                $this->data['modules'] = array();
		
		if (isset($this->request->post['phplist_module'])) {
			$this->data['modules'] = $this->request->post['phplist_module'];
		} elseif ($this->config->get('phplist_module')) { 
			$this->data['modules'] = $this->config->get('phplist_module');
		}	
		if (isset($this->request->post['phplist_position'])) {
			$this->data['phplist_position'] = $this->request->post['phplist_position'];
		} else {
			$this->data['phplist_position'] = $this->config->get('phplist_position');
		}
		
		if (isset($this->request->post['phplist_status'])) {
			$this->data['phplist_status'] = $this->request->post['phplist_status'];
		} else {
			$this->data['phplist_status'] = $this->config->get('phplist_status');
		}
		
		if (isset($this->request->post['phplist_sort_order'])) {
			$this->data['phplist_sort_order'] = $this->request->post['phplist_sort_order'];
		} else {
			$this->data['phplist_sort_order'] = $this->config->get('phplist_sort_order');
		}	

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL');
    	$this->data['config'] = $this->url->link('module/phplist/config', 'token=' . $this->session->data['token'], 'SSL');

  
       $this->data['dbprefix']=$this->config->get('dbprefix');

      
  
        
$this->data['action'] = $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL');
			
            if($this->request->server['REQUEST_METHOD'] == 'POST')
            {
           
                foreach($this->request->post as $k=>$config)
                {
                
                   
                        $prefixdata[$k]=$config;
                        $this->model_setting_setting->editSetting('phplist', $prefixdata);
                    
                }
              
                $this->redirect($this->url->link('module/phplist', 'token=' . $this->session->data['token'] , 'SSL'));
            }
            
            
		$this->template = 'module/phplist.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	public function tools() {
		$this->language->load('module/phplist');
                 $this->load->model('setting/setting');
              $this->load->model('phplist/config');
 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
                $this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_hide'] = $this->language->get('text_hide');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
                $this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['button_createocd'] = $this->language->get('button_createocd');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['text_dbprefix'] = $this->language->get('text_dbprefix');
		
		$this->data['token'] = $this->session->data['token'];
                $this->data['modules'] = array();
		
		if (isset($this->request->post['phplist_module'])) {
			$this->data['modules'] = $this->request->post['phplist_module'];
		} elseif ($this->config->get('phplist_module')) { 
			$this->data['modules'] = $this->config->get('phplist_module');
		}	
		if (isset($this->request->post['phplist_position'])) {
			$this->data['phplist_position'] = $this->request->post['phplist_position'];
		} else {
			$this->data['phplist_position'] = $this->config->get('phplist_position');
		}
		
		if (isset($this->request->post['phplist_status'])) {
			$this->data['phplist_status'] = $this->request->post['phplist_status'];
		} else {
			$this->data['phplist_status'] = $this->config->get('phplist_status');
		}
		
		if (isset($this->request->post['phplist_sort_order'])) {
			$this->data['phplist_sort_order'] = $this->request->post['phplist_sort_order'];
		} else {
			$this->data['phplist_sort_order'] = $this->config->get('phplist_sort_order');
		}	

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL');
    	$this->data['config'] = $this->url->link('module/phplist/config', 'token=' . $this->session->data['token'], 'SSL');

  
       $this->data['dbprefix']=$this->config->get('dbprefix');

      
  
        
$this->data['action'] = $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL');
			
            if($this->request->server['REQUEST_METHOD'] == 'POST')
            {
           
                foreach($this->request->post as $k=>$config)
                {
                
                   
                        $prefixdata[$k]=$config;
                        $this->model_setting_setting->editSetting('phplist', $prefixdata);
                    
                }
              
                $this->redirect($this->url->link('module/phplist/tools', 'token=' . $this->session->data['token'] , 'SSL'));
            }
            
            
		$this->template = 'module/phplisttools.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	public function config() {
		$this->language->load('module/phplist');
                 $this->load->model('setting/setting');
              $this->load->model('phplist/config');
              $this->load->model('phplist/lists');
 $this->data['lists'] =$this->model_phplist_lists->getLists();
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
                $this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_hide'] = $this->language->get('text_hide');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
                $this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_default_list'] = $this->language->get('entry_default_list');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['text_dbprefix'] = $this->language->get('text_dbprefix');
		
		$this->data['token'] = $this->session->data['token'];
                $this->data['modules'] = array();
		
		if (isset($this->request->post['phplist_module'])) {
			$this->data['modules'] = $this->request->post['phplist_module'];
		} elseif ($this->config->get('phplist_module')) { 
			$this->data['modules'] = $this->config->get('phplist_module');
		}	
		if (isset($this->request->post['phplist_position'])) {
			$this->data['phplist_position'] = $this->request->post['phplist_position'];
		} else {
			$this->data['phplist_position'] = $this->config->get('phplist_position');
		}
		
		if (isset($this->request->post['phplist_status'])) {
			$this->data['phplist_status'] = $this->request->post['phplist_status'];
		} else {
			$this->data['phplist_status'] = $this->config->get('phplist_status');
		}
		
		if (isset($this->request->post['phplist_sort_order'])) {
			$this->data['phplist_sort_order'] = $this->request->post['phplist_sort_order'];
		} else {
			$this->data['phplist_sort_order'] = $this->config->get('phplist_sort_order');
		}	

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL');
		//check if db is set
       $settings=$this->model_phplist_config->getConfigs();
       $this->data['dbprefix']=$this->config->get('dbprefix');

        $settinginputarr=array();
        $settinginputarr[]='pagefooter';
        $settinginputarr[]='pageheader';
        $settinginputarr[]='personallocation_message';
        $settinginputarr[]='confirmationmessage';
        $settinginputarr[]='subscribemessage';
        $settinginputarr[]='subscribemessage';
        $settinginputarr[]='unsubscribemessage';
        $settinginputarr[]='updatemessage';
        $settinginputarr[]='messagefooter';
        $settinginputarr[]='html_email_style';
        $settinginputarr[]='forwardfooter';
        $settinginputarr[]='emailchanged_text_oldaddress';
        $settinginputarr[]='emailchanged_text';
        $i=0;
        foreach($settings as $setting)
{
                 $this->data['settings'][$i]=$setting;
                 if(in_array($setting['item'], $settinginputarr))
                 {
                     $this->data['settings'][$i]['inputtype']='textarea';
                 }
                   $this->data['settings'][$i]['entry']=$this->language->get($setting['item']);
                 $i++;
        }
  
        
$this->data['action'] = $this->url->link('module/phplist/config', 'token=' . $this->session->data['token'], 'SSL');
			
            if($this->request->server['REQUEST_METHOD'] == 'POST')
            {
          
                foreach($this->request->post as $k=>$config)
                {
             
                    if($k=='dbprefix' || $k=='defaultlist')
                    {
                        $prefixdata[$k]=$config;
                       
                      $this->model_setting_setting->editSetting('phplist', $prefixdata);
                    }else{
               $this->model_phplist_config->editConfig($k,$config);
                      
                }
                }
              
                $this->redirect($this->url->link('module/phplist/config', 'token=' . $this->session->data['token'] , 'SSL'));
            }
            
            
		$this->template = 'module/phplist.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
public function contact() {
    $this->load->model('setting/setting');
    $this->language->load('module/phplistmessage');
    

                $this->document->addStyle('view/stylesheet/phplist.css');
                $this->document->addScript('view/javascript/jquery-ui-timepicker-addon.js');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		$this->data['text_customer_all'] = $this->language->get('text_customer_all');	
		$this->data['text_customer'] = $this->language->get('text_customer');	
		$this->data['text_customer_group'] = $this->language->get('text_customer_group');
		$this->data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
		$this->data['text_affiliate'] = $this->language->get('text_affiliate');	
		$this->data['text_product'] = $this->language->get('text_product');	

		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_to'] = $this->language->get('entry_to');
		$this->data['entry_from'] = $this->language->get('entry_from');
		$this->data['entry_text'] = $this->language->get('entry_text');
                
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_subject'] = $this->language->get('entry_subject');
		$this->data['entry_message'] = $this->language->get('entry_message');
		
		$this->data['button_send'] = $this->language->get('button_send');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['token'] = $this->session->data['token'];
$this->data['action'] = $this->url->link('module/phplist/contact', 'token=' . $this->session->data['token'], 'SSL');
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_lists'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_messages'),
			'href'      => $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('entry_message'),
			'href'      => $this->url->link('module/phplist/contact', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'], 'SSL');

        $this->load->model('phplist/lists');
        $this->load->model('phplist/message');
        $this->load->model('phplist/config');
        $this->data['lists']= $this->model_phplist_lists->getLists();
        
        
        
        if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm())
            {
            $to=$this->request->post['subscribe'];
            
            $defaultmail=array('customer_all','customer_group','customer','affiliate_all','affiliate','product');
            
        
      
            
            $this->load->model('phplist/listmessage');
           
                  
                        $this->request->post['embargo'].=':00';
                        $this->request->post['embargo']= preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $this->request->post['embargo']);
                        if(!is_array($to) || strlen(trim($this->request->post['message'])) < 1 || strlen(trim($this->request->post['subject'])) < 1 )
                            $this->request->post['status']='draft';
                            else
                        $this->request->post['status']='submitted';
                        $footer=$this->model_phplist_config->getConfig('messagefooter');
                        $this->request->post['footer']=$footer['value'];
                        $this->request->post['htmlformatted']=1;
                        $template=$this->model_phplist_config->getConfig('defaultmessagetemplate');
                        $this->request->post['template']=$template['value'];
                        $this->request->post['from']=$this->request->post['from'] .' '. $this->request->post['sender_email'];
                        $this->request->post['message']=  html_entity_decode($this->request->post['message']);
		
                        $messageid=$this->model_phplist_message->addMessage($this->request->post);  
                         foreach($to as $sendlist)
                         {
                        $listid=$this->model_phplist_lists->getList($sendlist);
                        $listid=$listid['id'];
                        $this->model_phplist_listmessage->addMessage($messageid,$listid);  
                        }
                        $this->session->data['success'] = $this->language->get('text_success');
                       
                        $this->redirect($this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] , 'SSL'));
                        
            
                        
             }

	$this->data['sendername']= $this->model_phplist_config->getConfig('message_from_name');
        
        $domain=$this->model_phplist_config->getConfig('domain');
        $senderemails= $this->model_phplist_config->getConfig('message_from_address');
        $this->data['senderemails'][]= str_ireplace('[DOMAIN]',$domain['value'],$senderemails);
  
     	
		
	$this->data['store_name'] = array($this->config->get('config_name'),$this->data['sendername']['value']);	
	$this->data['store_email'] = $this->config->get('config_email');
		$this->template = 'module/phplistmessage.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
}
public function editmessage() {
    $this->load->model('setting/setting');
    $this->language->load('module/phplistmessage');
    

                $this->document->addStyle('view/stylesheet/phplist.css');
                $this->document->addScript('view/javascript/jquery-ui-timepicker-addon.js');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['message_title'] = $this->language->get('message_title');
		
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		$this->data['text_customer_all'] = $this->language->get('text_customer_all');	
		$this->data['text_customer'] = $this->language->get('text_customer');	
		$this->data['text_customer_group'] = $this->language->get('text_customer_group');
		$this->data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
		$this->data['text_affiliate'] = $this->language->get('text_affiliate');	
		$this->data['text_product'] = $this->language->get('text_product');	
		$this->data['text_editmessage'] = $this->language->get('text_editmessage');	
		$this->data['text_messages'] = $this->language->get('text_messages');	

		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_to'] = $this->language->get('entry_to');
		$this->data['entry_from'] = $this->language->get('entry_from');
		$this->data['entry_text'] = $this->language->get('entry_text');
                
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_subject'] = $this->language->get('entry_subject');
		$this->data['entry_message'] = $this->language->get('entry_message');
		
		$this->data['button_send'] = $this->language->get('button_send');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['token'] = $this->session->data['token'];
$this->data['action'] = $this->url->link('module/phplist/editmessage', 'token=' . $this->session->data['token'], 'SSL');
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_lists'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_messages'),
			'href'      => $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' =>  ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_editmessage'),
			'href'      => $this->url->link('module/phplist/editmessage&messageid='.$this->request->get['messageid'], 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'], 'SSL');

        $this->load->model('phplist/lists');
        $this->load->model('phplist/listmessage');
        $this->load->model('phplist/message');
        $this->load->model('phplist/config');
       
    
 if($this->request->server['REQUEST_METHOD'] == 'GET')
            {
      $this->data['lists']= $this->model_phplist_lists->getListsformessage($this->request->get['messageid']);
$this->data['message'] =$this->model_phplist_message->getMessage($this->request->get['messageid']);

            $md=$this->model_phplist_message->getMessagedata($this->request->get['messageid']);

foreach($md as $val)
{
   
    $this->data['message']['message_data'][$val['name']]=$val['data'];
}

$this->data['message']['emailalertstart']=$this->data['message']['message_data']['notify_start'];
$this->data['message']['emailalertend']=$this->data['message']['message_data']['notify_end'];
            }
        
        if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm())
            {
             $to=$this->request->post['subscribe'];
            $defaultmail=array('customer_all','customer_group','customer','affiliate_all','affiliate','product');
            
          
      

                        $this->load->model('phplist/listmessage');
           
                      
                        $this->request->post['embargo'].=':00';
                        $this->request->post['embargo']= preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $this->request->post['embargo']);
                      
                        $this->request->post['status']='submitted';
                        $footer=$this->model_phplist_config->getConfig('messagefooter');
                        $this->request->post['footer']=$footer['value'];
                        $this->request->post['htmlformatted']=1;
                        $template=$this->model_phplist_config->getConfig('defaultmessagetemplate');
                        $this->request->post['template']=$template['value'];
                        $this->request->post['from']=$this->request->post['sender_email'];
                        $this->request->post['message']=  html_entity_decode($this->request->post['message']);
		$this->request->post['message_data']=$this->model_phplist_message->getMessagedata($this->request->get['messageid']);
                        
                         if(!isset($this->request->post['subscribe']))
              {
                             $this->request->post['status']="draft";
                         }
                         
                        $messageid=$this->model_phplist_message->editMessage($this->request->post);  
                    
                        $this->session->data['success'] = $this->language->get('text_success');
                        
                        $this->load->model('phplist/lists');
                        $this->load->model('phplist/listmessage');
                                      $this->model_phplist_lists->deletemsgfromallLists($this->request->post['id']);
 
              if(isset($this->request->post['subscribe']))
              {

                  foreach($this->request->post['subscribe'] as $sub)
                  {
                      $data['id']=$this->request->post['id'];
                      $data['listid']=$sub;
                       $this->model_phplist_listmessage->addMessage($data['id'],$data['listid']);
                 
                  }
                 
              }
          
                        $this->redirect($this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] , 'SSL'));
                        
            
                        
             }
             
        $this->data['senderemail']=$this->data['message']['fromfield'];
	
		
	$this->data['store_email'] = $this->config->get('config_email');
		$this->template = 'module/phplistmessage_edit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
}

public function lists(){
    
    $this->load->model('setting/setting');
    $this->language->load('module/phplistlists');
    

                $this->document->addStyle('view/stylesheet/phplist.css');
                $this->document->addScript('view/javascript/jquery-ui-timepicker-addon.js');
		
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['entry_sendmessage'] = $this->language->get('entry_sendmessage');
		$this->data['entry_edit'] = $this->language->get('entry_edit');
		$this->data['entry_delete'] = $this->language->get('entry_delete');
		$this->data['entry_viewmembers'] = $this->language->get('entry_viewmembers');
		$this->data['entry_continue'] = $this->language->get('entry_continue');
		$this->data['entry_suspend'] = $this->language->get('entry_suspend');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['text_default'] = $this->language->get('text_default');
		
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		
		
		$this->data['token'] = $this->session->data['token'];
$this->data['action'] = $this->url->link('module/phplist/contact', 'token=' . $this->session->data['token'], 'SSL');
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
;
$this->load->model('phplist/lists');
$lists=$this->model_phplist_lists->getLists();
$countedlists=array();
$i=0;
foreach($lists as $list)
{
$countedlists[$i]=$list;
$countedlists[$i]['members']=$this->model_phplist_lists->getTotalMembers($list['id']);
$i++;
}

 $this->data['lists']=$countedlists;
         $this->data['token'] =$this->session->data['token'];
    $this->template = 'module/phplistlists.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());

}

public function messages(){
    
    $this->load->model('setting/setting');
    $this->language->load('module/phplistmessage');
    

                $this->document->addStyle('view/stylesheet/phplist.css');
                $this->document->addScript('view/javascript/jquery-ui-timepicker-addon.js');
		
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['tab_queued'] = $this->language->get('tab_queued');
		$this->data['tab_sent'] = $this->language->get('tab_sent');
		$this->data['tab_draft'] = $this->language->get('tab_draft');
		$this->data['entry_sendmessage'] = $this->language->get('entry_sendmessage');
		$this->data['entry_edit'] = $this->language->get('entry_edit');
		$this->data['entry_delete'] = $this->language->get('entry_delete');
		$this->data['entry_viewmembers'] = $this->language->get('entry_viewmembers');
		$this->data['entry_continue'] = $this->language->get('entry_continue');
		$this->data['entry_suspend'] = $this->language->get('entry_suspend');
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		
		
		
                $this->data['token'] = $this->session->data['token'];
$this->data['action'] = $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'], 'SSL');
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
                $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_lists'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
        $url = '';
         if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
                
                if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
         if (isset($this->request->get['type'])) {
			$type = $this->request->get['type'];
		} else {
			$type = 'submitted';
		}

                if (isset($this->request->get['type'])) {
			$url .= '&type=' . $this->request->get['type'];
		}
                
$this->load->model('phplist/lists');
$this->load->model('phplist/message');
$messagearrsus=array();
$messages=array();
$draftmessages=array();
$sentmessages=array();
$defaultsub=array();
$defaultsub[]='submitted';
$defaultsub[]='suspended';
$defaultsub[]='inprocess';

 $totalmessages = $this->model_phplist_message->getTotalmessages($defaultsub);
 $totaldraftmessages = $this->model_phplist_message->getTotalmessages('draft');
 $totalsentmessages = $this->model_phplist_message->getTotalmessages('sent');
 
 $pagnations = array(
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
 

$messagearr=$this->model_phplist_message->getMessages($defaultsub,$pagnations);


foreach($messagearr as $k=> $m)
{
    $messages[]=$m;
    $messages[$k]['lists']=$this->model_phplist_lists->getListsbymsgid($m['id']);
    
    $md=$this->model_phplist_message->getMessagedata($m['id']);

                
    foreach($md as $val)
{
    $messages[$k]['message_data'][$val['name']]=$val['data'];

}

}


$this->data['messages']=$messages;

$draftmessagearr=$this->model_phplist_message->getMessages('draft');

foreach($draftmessagearr as $k=> $m)
{
    $draftmessages[]=$m;
    $draftmessages[$k]['lists']=$this->model_phplist_lists->getListsbymsgid($m['id']);
}
$this->data['draftmessages']=$draftmessages;
$sentmessagearr=$this->model_phplist_message->getMessages('sent');

foreach($sentmessagearr as $k=> $m)
{
    $sentmessages[]=$m;
    $sentmessages[$k]['lists']=$this->model_phplist_lists->getListsbymsgid($m['id']);
}
$this->data['sentmessages']=$sentmessages;

$submittedpagination = new Pagination();
		$submittedpagination->total = $totalmessages;
		$submittedpagination->page = $page;
		$submittedpagination->limit = $this->config->get('config_admin_limit');
		$submittedpagination->text = $this->language->get('text_pagination');
		$submittedpagination->url = $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		$this->data['submitted_pagination'] = $submittedpagination->render();
                
$draftpagination = new Pagination();
		$draftpagination->total = $totaldraftmessages;
		$draftpagination->page = $page;
		$draftpagination->limit = $this->config->get('config_admin_limit');
		$draftpagination->text = $this->language->get('text_pagination');
		$draftpagination->url = $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		$this->data['draft_pagination'] = $draftpagination->render();
                
$sentpagination = new Pagination();
		$sentpagination->total = $totalsentmessages;
		$sentpagination->page = $page;
		$sentpagination->limit = $this->config->get('config_admin_limit');
		$sentpagination->text = $this->language->get('text_pagination');
		$sentpagination->url = $this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		$this->data['sent_pagination'] = $sentpagination->render();
                

         $this->data['token'] =$this->session->data['token'];
    $this->template = 'module/phplistmessage_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());

}
public function addmember(){
    $this->language->load('module/phplistmember');
   $this->load->model('phplist/user');
    $this->document->setTitle($this->language->get('heading_title'));
    $this->data['heading_title'] = $this->language->get('heading_title');
    $this->data['button_save'] = $this->language->get('button_save');
    $this->data['button_cancel'] = $this->language->get('button_cancel');
    $this->data['button_add_module'] = $this->language->get('button_add_module');
    $this->data['button_remove'] = $this->language->get('button_remove');
		
    $this->data['token'] = $this->session->data['token'];
    $this->data['token'] =$this->session->data['token'];
    
    $this->load->model('phplist/lists');
    $this->data['lists']= $this->model_phplist_lists->getLists();
    
             
             if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
                 $this->request->post['listid']=$this->model_phplist_lists->getListbyname($this->request->post['listid']);
                 $this->request->post['listid']=$this->request->post['listid']['id'];
              $userid=$this->model_phplist_user->addUser($this->request->post);	
             $this->session->data['success'] = $this->language->get('text_success');
              $this->load->model('phplist/lists');
              if(isset($this->request->post['subscribe']))
              {
                  $this->model_phplist_lists->deletefromallLists($this->request->post);
                  foreach($this->request->post['subscribe'] as $sub)
                  {
                      $data['userid']=$userid;
                      $data['listid']=$sub;
                       $this->model_phplist_lists->addListuser($data);
                  //var_dump($data);
                  }
              }
             $this->redirect($this->url->link('module/phplist/users', 'token=' . $this->session->data['token'] , 'SSL'));
             }
             
               $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
   $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
                'href'      => $this->url->link('module/phplist/addmember', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
   $this->data['action'] = $this->url->link('module/phplist/addmember', 'token=' . $this->session->data['token'], 'SSL');
   $this->data['cancel'] = $this->url->link('module/phplist/users', 'token=' . $this->session->data['token'], 'SSL');
 $this->template = 'module/phplistmember_edit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
}

public function getmemberform()
{
     if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
$url = '';
if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
                
      $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
                'href'      => $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    $this->data['cancel'] = $this->url->link('module/phplist', 'token=' . $this->session->data['token'], 'SSL');

    $this->data['products'] = array();

		$data = array(
			'filter_name'	  => $filter_name, 
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
			'filter_quantity' => $filter_quantity,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
                
                foreach ($results as $result) {
                    
                    
                }
                
                		
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
                
    $this->template = 'module/phplistmember_edit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
}
public function editmember(){
   $this->language->load('module/phplistmember');
   $this->load->model('phplist/user');
    $this->document->setTitle($this->language->get('heading_title'));
    $this->data['heading_title'] = $this->language->get('heading_title');
    $this->data['button_save'] = $this->language->get('button_save');
    $this->data['button_cancel'] = $this->language->get('button_cancel');
    $this->data['button_add_module'] = $this->language->get('button_add_module');
    $this->data['button_remove'] = $this->language->get('button_remove');
    $this->data['heading_users'] = $this->language->get('heading_users');
    $this->data['heading_lists'] = $this->language->get('heading_lists');
		
    $this->data['token'] = $this->session->data['token'];
    $this->data['token'] =$this->session->data['token'];
    $this->data['cancel'] = $this->url->link('module/phplist/users', 'token=' . $this->session->data['token'], 'SSL');
    $this->load->model('phplist/lists');
    $this->data['lists']= $this->model_phplist_lists->getListmembers($this->request->get['userid']);

 if($this->request->server['REQUEST_METHOD'] == 'GET')
            {
    $this->data['user']= $this->model_phplist_user->getUser($this->request->get['userid']);
            }
    
             
             if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
              $this->model_phplist_user->editUser($this->request->post);	
             $this->session->data['success'] = $this->language->get('text_success');
              $this->load->model('phplist/lists');
              if(isset($this->request->post['subscribe']))
              {
                  $this->model_phplist_lists->deletefromallLists($this->request->post);
                  foreach($this->request->post['subscribe'] as $sub)
                  {
                      $data['userid']=$this->request->post['id'];
                      $data['listid']=$sub;
                       $this->model_phplist_lists->addListuser($data);
                  
                  }
              }
             
          
                 $this->redirect($this->url->link('module/phplist/users', 'token=' . $this->session->data['token'] , 'SSL'));
             }
             
               $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
               $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_lists'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
               $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_users'),
			'href'      => $this->url->link('module/phplist/users', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/editmember&userid='.$_GET['userid'], 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
   $this->data['action'] = $this->url->link('module/phplist/editmember', 'token=' . $this->session->data['token'], 'SSL');
 $this->template = 'module/phplistmember_edit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
}
public function deletemember(){
    $id = $_GET['userid'];
    $this->load->model('phplist/user');
    $this->load->model('phplist/lists');
    $this->model_phplist_user->delete($id);
  $this->model_phplist_lists->deleteListuser($id);
     echo 'member '.$id. 'deleted';
 if(!isset($_POST['ajax']))
     $this->redirect($this->url->link('module/phplist/users', 'token=' . $this->session->data['token'] , 'SSL'));
}
public function deletemembership(){
    $data['id'] = $_GET['userid'];
    $data['listid']=$_GET['listid'];
    $this->load->model('phplist/lists');
    $this->model_phplist_lists->deleteListuser($data);
 if(!isset($_POST['ajax']))
     $this->redirect($this->url->link('module/phplist/listmembers&listid='.$data['listid'], 'token=' . $this->session->data['token'] , 'SSL'));
}
public function viewmember(){
		
		$this->editmember();
}

public function listmembers(){

    
    $this->load->model('phplist/message');
    $this->load->model('phplist/lists');
    $this->load->model('setting/setting');
    $this->language->load('module/phplistmember');
    

                $this->document->addStyle('view/stylesheet/phplist.css');
                $this->document->addScript('view/javascript/jquery-ui-timepicker-addon.js');
		
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_lists'] = $this->language->get('text_lists');
		$this->data['entry_sendmessage'] = $this->language->get('entry_sendmessage');
		$this->data['entry_edit'] = $this->language->get('entry_edit');
		$this->data['entry_delete'] = $this->language->get('entry_delete');
		$this->data['entry_viewmember'] = $this->language->get('entry_viewmember');
		$this->data['entry_continue'] = $this->language->get('entry_continue');
		$this->data['entry_suspend'] = $this->language->get('entry_suspend');
		$this->data['entry_listname'] = $this->language->get('entry_listname');
		$this->data['entry_members'] = $this->language->get('entry_members');
		$this->data['entry_messages'] = $this->language->get('entry_messages');
		$this->data['entry_action'] = $this->language->get('entry_action');
		$this->data['entry_confirmed'] = $this->language->get('entry_confirmed');
		$this->data['entry_listname'] = $this->language->get('entry_listname');
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		
		
		$this->data['token'] = $this->session->data['token'];
$this->data['action'] = $this->url->link('module/phplist/addmember', 'token=' . $this->session->data['token'], 'SSL');
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_lists'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
if(isset($this->request->get['listid']))
{
   
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/listmembers&listid='.$this->request->get['listid'], 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
			}else{
                            $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/listmembers', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
                        }	
    	$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
         if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
                $url = '';
                if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
        
       
 if($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['listid']))
            {
     $data['listid']=$this->request->get['listid'];
$list=$this->model_phplist_lists->getList($this->request->get['listid']);
if(isset($list['name']))
$this->data['listname']=$list['name'];
            }
            
            
$this->load->model('phplist/user');


 
 $pagnations = array(
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);

if(isset($data['listid']))
{
    $pagdata=array_merge($pagnations,$data);
    $totalmembers = $this->model_phplist_lists->getTotalmembers($data['listid']);
    $url='&listid='.$data['listid'];
$members=$this->model_phplist_user->getListmembers($pagdata);
}else{
    $totalmembers = $this->model_phplist_user->getTotalUsers();
    $members=$this->model_phplist_user->getMembers($pagnations);
}


$i=0;
foreach($members as $member){
    
    $this->data['members'][$i]=$member;
    $this->data['members'][$i]['total']=$this->model_phplist_message->getMessagetotalbyuser($member);
    $i++;
}
//
$pagination = new Pagination();
		$pagination->total = $totalmembers;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('module/phplist/users', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

         $this->data['token'] =$this->session->data['token'];
    $this->template = 'module/phplistmembers_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());

}

public function suspendmessage(){
    echo 'message suspended';
        $this->load->model('phplist/message');   
       $this->model_phplist_message->editStatus($this->request->get);
    if(!isset($_POST['ajax']))
       $this->redirect($this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] , 'SSL'));
}
public function resendmessage(){
    echo 'message resended';
     $this->load->model('phplist/message');   
    
       $this->model_phplist_message->editStatus($this->request->get);
       if(!isset($_POST['ajax']))
       $this->redirect($this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] , 'SSL'));
}
public function queuemessage(){
    echo 'message resended';
     $this->load->model('phplist/message');   
       $this->model_phplist_message->editStatus($this->request->get);
       if(!isset($_POST['ajax']))
       $this->redirect($this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] , 'SSL'));
}

private function validate() {
		if (!$this->user->hasPermission('modify', 'module/phplist')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
private function validateForm() {
		if (!$this->user->hasPermission('modify', 'module/phplist')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
        public function addFrom($data=null) {
            $this->load->model('setting/setting');
              $this->load->model('phplist/config');
      
        $senderemail= $this->model_phplist_config->getConfig('message_from_name');
        $senderemails=array();
        $options=null;
        if(strlen(trim($_POST['from']))>0)
        $senderemails[]=$_POST['from'];
        $senderemails[]=$this->config->get('config_name');
        $senderemails[]=$senderemail['value'];
        
        foreach($senderemails as $v)
        {
            $options.='<option value='.$v.'>'.$v."</option>";
        
        }
     
            echo $options;
        }
        public function ocimport($data=null) {
            $this->load->model('setting/setting');
            $this->load->model('sale/customer');
            $this->load->model('phplist/user');
            $this->load->model('phplist/lists');
            

			$sort = 'username';
		
		
		
			$order = 'ASC';
		
		
		if (isset($this->request->post['page'])) {
			$page = $this->request->post['page'];
		} else {
			$page = 1;
		}
                
           $this->data['users'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$user_total = $this->model_sale_customer->getTotalCustomers();
		
                $num_pages = ceil($user_total / $data['limit']);
                
		$results['emails'] = $this->model_sale_customer->getCustomers($data);
                $results['page']=$page;
                $results['num_pages']=$num_pages;

                
                foreach($results['emails'] as $v)
                {
                  
                    $data['email']=$v['email'];
                    $data['password']=$v['password'];
                    $data['confirmed']=$v['status'];
                    $data['newsletter']=$v['newsletter'];
                    $data['htmlemail']=1;
                    $data['rssfrequency']=0;
                    $data['disabled']=0;
                    
                    
                    $userid=$this->model_phplist_user->addUser($data);
                    
                    $listdata=array(); 
            
                $listdata['name']='All Customers';
                $listdata['active']=0;
                $listdata['description']='All Opencart Customers';
                $listdata['listid']=$this->model_phplist_lists->addList($listdata);
                $listdata['userid']=$userid;
                
                 $this->model_phplist_lists->addListuser($listdata);

                    if($v['newsletter'] == "1")
                    {
                        $listuser['userid']=$userid;
                        $listuser['listid']=$this->config->get('phplist_defaultlist');
                       

                      $this->model_phplist_lists->addListuser($listuser);
                      
                    }
                }
              if($page == $num_pages)
                {
                    $results['emails'][]['email']='Import Completed';
                }
         
                $this->response->setOutput(json_encode($results));
     
        }

        
        
        public function addEmail($data=null) {
        $this->load->model('setting/setting');
        $this->load->model('phplist/config');
        $domain=$this->model_phplist_config->getConfig('domain');
        $senderemail= $this->model_phplist_config->getConfig('message_from_address');
        $senderemail= str_ireplace('[DOMAIN]',$domain['value'],$senderemail['value']);
        
        $senderemails=array();
        if(strlen(trim($_POST['email']))>0)
        $senderemails[]=$_POST['email'];
        $senderemails[]=$this->config->get('config_email');
        $options=null;
      $senderemails[]=$senderemail;
        
        foreach($senderemails as $v)
        {
            $options.='<option value='.$v.'>'.$v."</option>";
        
        }
         
            echo $options;
        }
        


public function editlist(){
   $this->load->model('setting/setting');
    $this->language->load('module/phplistlist');
    

                $this->document->addStyle('view/stylesheet/phplist.css');
                $this->document->addScript('view/javascript/jquery-ui-timepicker-addon.js');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_default'] = $this->language->get('text_default');
		
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		
		$this->data['token'] = $this->session->data['token'];
$this->data['action'] = $this->url->link('module/phplist/contact', 'token=' . $this->session->data['token'], 'SSL');
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL');
;

$this->data['action'] = $this->url->link('module/phplist/editlist', 'token=' . $this->session->data['token'], 'SSL');

$this->load->model('phplist/lists');


 if($this->request->server['REQUEST_METHOD'] == 'GET')
            {
$this->data['list'] =$this->model_phplist_lists->getList($this->request->get['listid']);
            }
         
            if($this->request->server['REQUEST_METHOD'] == 'POST')
            {
                
                $listdata=array(); 
                $listdata['id']=$this->request->post['id'];
                $listdata['name']=$this->request->post['name'];
                $listdata['active']=isset($this->request->post['active']);
                $listdata['description']=trim($this->request->post['description']);
                $this->model_phplist_lists->editList($listdata);
             
                $this->redirect($this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'] , 'SSL'));
            }
            
$this->data['token'] =$this->session->data['token'];
         
    $this->template = 'module/phplistedit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  
    
}

public function deletelist()
{
    $id = $_GET['listid'];
    $this->load->model('phplist/lists');
   $this->load->model('phplist/message');
     $this->model_phplist_lists->deleteList($id);
     $this->model_phplist_lists->deleteListusers($id);
     echo 'test';
     if(!isset($_POST['ajax']))
       $this->redirect($this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'] , 'SSL'));
}

public function deletemessage()
{
    $id = $_GET['messageid'];
    $this->load->model('phplist/message');
    $this->model_phplist_message->deleteMessage($id);
     echo 'message '.$id. 'deleted';
     if(!isset($_POST['ajax']))
       $this->redirect($this->url->link('module/phplist/messages', 'token=' . $this->session->data['token'] , 'SSL'));
}

public function deleteevent()
{
    $id = $_GET['eventid'];
    $this->load->model('phplist/event');
    $this->model_phplist_event->deleteEvent($id);
     echo 'event '.$id. 'deleted';
     if(!isset($_POST['ajax']))
       $this->redirect($this->url->link('module/phplist/eventlog', 'token=' . $this->session->data['token'] , 'SSL'));
}
public function deleteevents()
{
    $this->load->model('phplist/event');
    $this->model_phplist_event->deleteAllevents();
     if(!isset($_POST['ajax']))
       $this->redirect($this->url->link('module/phplist/eventlog', 'token=' . $this->session->data['token'] , 'SSL'));
}

public function addlist()
{
     $this->load->model('setting/setting');
    $this->language->load('module/phplistlist');
    

                $this->document->addStyle('view/stylesheet/phplist.css');
              
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_default'] = $this->language->get('text_default');
		
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['token'] = $this->session->data['token'];
$this->data['action'] = $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL');
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL');
;

$this->data['action'] = $this->url->link('module/phplist/addlist', 'token=' . $this->session->data['token'], 'SSL');

$this->load->model('phplist/lists');


 if($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['listid']))
            {
$this->data['list'] =$this->model_phplist_lists->getList($this->request->get['listid']);
            }
           
            if($this->request->server['REQUEST_METHOD'] == 'POST')
            {
                
                $listdata=array(); 
                $listdata['id']=$this->request->post['id'];
                $listdata['name']=$this->request->post['name'];
                $listdata['active']=isset($this->request->post['active']);
                $listdata['description']=trim($this->request->post['description']);
                $this->model_phplist_lists->addList($listdata);
                 $this->redirect($this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'] , 'SSL'));
             
            }
            
$this->data['token'] =$this->session->data['token'];
         
    $this->template = 'module/phplistedit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  
}

public function toggleactivelist(){
    $this->load->model('phplist/lists');

 if($this->request->server['REQUEST_METHOD'] == 'POST')
            {
$success=$this->model_phplist_lists->editList($this->request->post);
            }
}

public function autocomplete() {
    $email=$this->request->get['email'];
    
    $this->load->model('phplist/user');
    $user=$this->model_phplist_user->getUserbyemail($email);
		$json[] = array(
					'id' =>$user['id'],
					'email'       => $user['email'],
					'confirmed'       => $user['confirmed'],
					'blacklisted'       => $user['blacklisted'],
					'bouncecount'       => $user['bouncecount'],
					'entered'       => $user['entered'],
					'modified'       => $user['modified'],
					'uniqid'       => $user['uniqid'],
					'htmlemail'       => $user['htmlemail'],
					'subscribepage'       => $user['subscribepage'],
					'rssfrequency'       => $user['rssfrequency'],
					'password'       => $user['password'],
					'passwordchanged'       => $user['passwordchanged'],
					'disabled'       => $user['disabled'],
					'extradata'       => $user['extradata'],
					'foreignkey'       => $user['foreignkey']
					
				);	
		$this->response->setOutput(json_encode($json));
	}
	
	public function users(){
    
    $this->listmembers();
}
        
public function eventlog() {
    $this->load->model('phplist/message');
    $this->load->model('phplist/lists');
    $this->load->model('setting/setting');
    $this->language->load('module/phplist');
    

                $this->document->addStyle('view/stylesheet/phplist.css');
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_lists'] = $this->language->get('text_lists');
		$this->data['entry_sendmessage'] = $this->language->get('entry_sendmessage');
		$this->data['entry_edit'] = $this->language->get('entry_edit');
		$this->data['entry_delete'] = $this->language->get('entry_delete');
		$this->data['entry_viewmember'] = $this->language->get('entry_viewmember');
		$this->data['entry_continue'] = $this->language->get('entry_continue');
		$this->data['entry_suspend'] = $this->language->get('entry_suspend');
		$this->data['entry_id'] = $this->language->get('entry_id');
		$this->data['entry_time'] = $this->language->get('entry_time');
		$this->data['entry_message'] = $this->language->get('entry_message');
		$this->data['entry_action'] = $this->language->get('entry_action');
		$this->data['entry_confirmed'] = $this->language->get('entry_confirmed');
		$this->data['entry_listname'] = $this->language->get('entry_listname');
		
		$this->data['button_delete'] = $this->language->get('entry_delete_all');
		
		
		$this->data['token'] = $this->session->data['token'];
$this->data['action'] = $this->url->link('module/phplist/addmember', 'token=' . $this->session->data['token'], 'SSL');
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_lists'),
			'href'      => $this->url->link('module/phplist/lists', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
if(isset($this->request->get['listid']))
{
   
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/listmembers&listid='.$this->request->get['listid'], 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
			}else{
                            $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/phplist/listmembers', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
                        }	
    	$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
         if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
                $url = '';
                if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
        
       
 if($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['listid']))
            {
     $data['listid']=$this->request->get['listid'];
$list=$this->model_phplist_lists->getList($this->request->get['listid']);
if(isset($list['name']))
$this->data['listname']=$list['name'];
            }
            
            
$this->load->model('phplist/event');


 
 $pagnations = array(
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
 


$totalevents = $this->model_phplist_event->getTotalevents();
$this->data['events']=$this->model_phplist_event->getEvents($pagnations);



$pagination = new Pagination();
		$pagination->total = $totalevents;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('module/phplist/eventlog', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

         $this->data['token'] =$this->session->data['token'];
    $this->template = 'module/phplisteventlog.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
}

}

?>
