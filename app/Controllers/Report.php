<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserPMedModel;
use App\Models\ProviderModel;
use App\Models\AdminUserModel;
use App\Models\LocaisTrabalhoModel;
use App\Models\AdminUserCommentsModel;

class Report extends BaseController
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->UserModel = new UserModel();
        $this->UserPMedModel = new UserPMedModel();
        $this->ProviderModel = new ProviderModel();
        $this->AdminUserModel = new AdminUserModel();
        $this->LocaisTrabalhoModel = new LocaisTrabalhoModel();
        $this->AdminUserCommentsModel = new AdminUserCommentsModel();
        $this->session = session();
        helper('validation');
        helper('profile');
        /*
        $users = $this->UserModel->getByUsername('VALMORPF');
        $users = $this->UserModel->findByUsername('VALMORPF');
        var_dump($users);
        */
    }

    public function index()
    {
        if (trim(me()) ==''){
            return redirect()->to(base_url() . '/public/login');  
        }
        if ($this->isError()){
            $data['error'] = 1;
            $data['message'] = $this->session->get('message');
            $this->clear();
        }
        else {
            $data['error'] = 0;
        }
        $data['content'] = 'login/login';
        return view('Design/default_page',$data);
    }

    public function r($fileReport) 
    {  
        $username = $this->session->get('username');
        $data['username'] = $username;
        $data['error'] = 0;
        $data['content'] = 'report/run';
        $data['report'] = $fileReport;
        return view('Design/default_page',$data);       
    }

    public function rview($fileReport){
        $atendimento = $_POST['atendimento'];
        $url = 'http://srvm24:88/?r=' . $fileReport;
        $url = $url . '/atendimento=' . $atendimento;
        $content = file_get_contents( $url );
        $content = '.' . $content;
        if ( strpos($content,'<a href') ) {
            $urlGo = substr($content, strpos($content,'"')+1);
            $urlGo = substr($urlGo,0,strpos($urlGo,'"'));
            return redirect()->to($urlGo);
            //var_dump($urlGo);die;
            // return redirect()->to($url); <- for debug
        }
        else 
        {
            var_dump($content);die;
        }
        //var_dump($content); // <a href="http://srvm24:89/app/reports/download/repV1022022169762.pdf">
        //die;
        //return redirect()->to($url);
    }

    public function rdirect($fileReport){
        $url = 'http://srvm24:88/?r=' . $fileReport . '/0';
        //return redirect()->to($url); //<- for debug
        $content = file_get_contents( $url );
        $content = '.' . $content;
        if ( strpos($content,'<a href') ) {
            $urlGo = substr($content, strpos($content,'"')+1);
            $urlGo = substr($urlGo,0,strpos($urlGo,'"'));
            return redirect()->to($urlGo);
            //var_dump($urlGo);die;
            //return redirect()->to($url); //<- for debug
        }
        else 
        {
            var_dump($content);die;
        }
        //var_dump($content); // <a href="http://srvm24:89/app/reports/download/repV1022022169762.pdf">
        //die;
        //return redirect()->to($url);
    }

    public function rviewatend($fileReport,$atendimento){
        $url = 'http://srvm24:88/?r=' . $fileReport;
        $url = $url . '/atendimento=' . $atendimento;
        $content = file_get_contents( $url );
        $content = '.' . $content;
        if ( strpos($content,'<a href') ) {
            $urlGo = substr($content, strpos($content,'"')+1);
            $urlGo = substr($urlGo,0,strpos($urlGo,'"'));
            return redirect()->to($urlGo);
            //var_dump($urlGo);die;
            // return redirect()->to($url); <- for debug
        }
        else 
        {
            var_dump($content);die;
        }
    }
    
}

