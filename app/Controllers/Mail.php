<?php

namespace App\Controllers;
 
class Mail extends BaseController
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

    public function sendmail()
    {
        $email = \Config\Services::email();

        $email->setFrom('acessos@cardiologia.org.br', 'Acessos - Cardiologia');
        $email->setTo('valmor.info@cardiologia.org.br');
        //$email->setCC('another@another-example.com');
        //$email->setBCC('them@their-example.com');
        
        $email->setSubject('Novo requerimento de usuário');
        $email->setMessage(
            "Sistema de registros de usuarios. Novo status de requerimento." .
            "\nMensagem automática do sistema".
            "\nNão responda este e-mail");
        
        $email->send();

    }

}
