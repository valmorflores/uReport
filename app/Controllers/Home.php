<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $session;

    public function __construct()
    {         
        $this->session = session();
    }


    public function index()
    {                     
        $logged = $this->session->get('username');     
        if (isset($logged)){
            $this->session->set(['username'=>'']);
        }
        if ($this->session->get('username')!=''){
            $data['content'] = 'welcome_message';
            return view('Design/default_page',$data);   
        }
        else {
            $data['error'] = 0;
            $data['content'] = 'login/login';
            return view('Design/blank_page',$data);   
        }
    }
}
