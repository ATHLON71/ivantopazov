<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
    
    protected $user_info = array();
    protected $store_info = array();
	
    protected $post = array();
    protected $get = array();
    
    public function __construct() {        
        parent::__construct();
		$this->user_info = ( $this->mdl_users->user_data() )? $this->mdl_users->user_data() : false; 
        $this->store_info = $this->mdl_stores->allConfigs();      
        
        $this->post = $this->security->xss_clean($_POST);
        $this->get = $this->security->xss_clean($_GET);
    }
    
    // Страница О КОМПАНИИ
    public function index(){
        
        $start = microtime(true); 
        
        
		$title = ( !empty( $this->store_info['seo_title'] ) ) ? $this->store_info['seo_title'] : $this->store_info['header'];
		$page_var = 'about';
        
        $this->mdl_tpl->view( 'templates/doctype_home.html' , array(
        
            'title' => $title,
            'addons_folder' => $this->mdl_stores->getСonfigFile('addons_folder'),
            'config_styles_path' => $this->mdl_stores->getСonfigFile('config_styles_path'), 
            'config_images_path' => $this->mdl_stores->getСonfigFile('config_images_path'), 
            
            'seo' => $this->mdl_tpl->view('snipets/seo_tools.html',array(
                'mk' => ( !empty( $this->store_info['seo_keys'] ) ) ? $this->store_info['seo_keys'] : '',
                'md' => ( !empty( $this->store_info['seo_desc'] ) ) ? $this->store_info['seo_desc'] : ''
            ), true),
            
            'navTop' => $this->mdl_tpl->view('snipets/navTop.html',array(
                'store' => $this->store_info,
                'active' => 'home',
                'config_images_path' => $this->mdl_stores->getСonfigFile('config_images_path')
            ),true),
            
            'header' => $this->mdl_tpl->view('snipets/header.html',array(
                'store' => $this->store_info,
                'config_images_path' => $this->mdl_stores->getСonfigFile('config_images_path')
            ),true),
            
            'navMenu' => $this->mdl_tpl->view('snipets/navMenu.html',array(
                'store' => $this->store_info,
                'active' => 'home',
                'itemsTree' => $this->mdl_category->getTreeMenu(),
                'config_images_path' => $this->mdl_stores->getСonfigFile('config_images_path')
            ),true),
            
            'slider' => '',
            
            'content' => $this->mdl_tpl->view('pages/about/basic.html',array(),true),
                        
            'preimushchestva' => $this->mdl_tpl->view('snipets/preimushchestva.html',array(
                'config_images_path' => $this->mdl_stores->getСonfigFile('config_images_path')
            ),true),
            
            'footer' => $this->mdl_tpl->view('snipets/footer.html',array(
                'config_images_path' => $this->mdl_stores->getСonfigFile('config_images_path')
            ), true),
            
            'load' => $this->mdl_tpl->view('snipets/load.html',array(
                'addons_folder' => $this->mdl_stores->getСonfigFile('addons_folder'),
                'utmLabels' => $this->mdl_tpl->view('snipets/utmLabels.html', $this->mdl_seo->utmLabels( $this->get ), true )
            ),true),
            
            'resorses' => $this->mdl_tpl->view('resorses/home/head.html',array(
                'addons_folder' => $this->mdl_stores->getСonfigFile('addons_folder'),
                'config_scripts_path' => $this->mdl_stores->getСonfigFile('config_scripts_path')
            ),true)
            
        ), false);
        
        //echo '<p style="background: yellow none repeat scroll 0% 0%; margin: 20px 0px 0px; position: fixed; bottom: 0px;">Время выполнения скрипта: '.(microtime(true) - $start).' сек.</p>'; 
        
        
    }
    
    // Заявка на обратный звонок
    public function callBack(){
        
        $html_content = $this->mdl_tpl->view( 'email/about/callBack.html', array( 
        
            'domen' => 'IVAN TOPAZOV',
            'http' => 'http://' . $_SERVER['HTTP_HOST'],
            
            'type' => 'Заявка на обратный звонок',
            'name' => ( isset( $this->post['fio'] ) ) ? $this->post['fio'] : '',
            'phone' => ( isset( $this->post['phone'] ) ) ? $this->post['phone'] : '',
            
            'ulmLabels' => $this->mdl_tpl->view( 'email/ulmLabels/labelItems.html', $this->mdl_seo->getUtmData(), true ),
            
            'date' => date('d.m.Y в H.i')
        ), true ); 
        
        
        $this->load->model('mdl_mail');			
        $this->mdl_mail->set_ot_kogo_from( 'order@ivantopazov.ru', 'IVAN TOPAZOV' );
        //$this->mdl_mail->set_komu_to( 'korchma-kursk@yandex.ru', 'Покупатель');
        $this->mdl_mail->set_tema_subject( 'Заявка на обратный звонок - ' . date('d.m.Y H:i:s') );
        $this->mdl_mail->set_tema_message( $html_content );
        $this->mdl_mail->send();
        
        
        $this->mdl_mail->set_komu_to( '2Kem@mail.ru', 'Покупатель');
        $this->mdl_mail->send();
        
        $this->mdl_mail->set_komu_to( 'ivantopazov@bk.ru', 'Покупатель');
        $this->mdl_mail->send();
    
        $this->mdl_mail->set_komu_to( 'info.nikoniki@gmail.com', 'Покупатель');
        $this->mdl_mail->send();
        
        echo json_encode(array( 'err' => 0));
        
    }
    
    
}
