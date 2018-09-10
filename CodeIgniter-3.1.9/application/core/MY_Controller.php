<?php
class MY_Controller extends CI_Controller {
    protected $twig;
	
    public function __construct(){
        parent::__construct();
        
        $loader = new Twig_Loader_Filesystem('./application/views');
        // $this->twig = new Twig_Environment($loader, array('cache' => APPPATH.'/cache/twig', 'debug' => true));
        $this->twig = new Twig_Environment($loader);

        if( !empty($this->session->alert) ){
            $this->twig->addGlobal('alert', $this->session->alert);
            $this->session->alert = '';
        }

        if(!empty($this->session->user) ){
			unset($this->session->user->password);
            $this->twig->addGlobal('user', $this->session->user);
        }

        if(!empty($this->session->is_login) ){
            $this->twig->addGlobal('is_login', $this->session->is_login);
        }

        $this->twig->addGlobal('url', base_url());
        $this->twig->addGlobal('current_url', current_url());
        $this->twig->addGlobal('uri_string', uri_string());

        // $this->output->enable_profiler('TRUE');
	}

}
