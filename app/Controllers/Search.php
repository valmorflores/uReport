<?php

namespace App\Controllers;
use App\Models\PatientModel;
use App\Models\ProviderModel;
use App\Models\TreatmentModel;
use App\Models\LocaisTrabalhoModel;
use App\Models\AdminUserCommentsModel;
use App\Controllers\UserActiveDirectory;

class Search extends BaseController
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->PatientModel = new PatientModel();
        $this->ProviderModel = new ProviderModel();
        $this->LocaisTrabalhoModel = new LocaisTrabalhoModel();
        $this->AdminUserCommentsModel = new AdminUserCommentsModel();
        $this->UserActiveDirectory = new UserActiveDirectory();
        $this->TreatmentModel = new TreatmentModel();
        $this->session = session();
        helper('validation');
        helper('profile');
        /*
        $users = $this->PatientModel->getByUsername('VALMORPF');
        $users = $this->PatientModel->findByUsername('VALMORPF');
        var_dump($users);
        */
    }

    public function index()
    {
        if (trim(me()) ==''){
            return redirect()->to(base_url() . '/public/login');  
        } else {
            if ($this->isError()){
                $data['error'] = 1;
                $data['message'] = $this->session->get('message');
                $this->clear();
            }
            else {
                $data['error'] = 0;
            }
            return $this->searchform();
        }
    }

    function isError(){
        $error = ( $this->session->get('error') == 1 );
        return $error;
    }

    function getMessage() { 
        return $this->session->get('message');
    }


    function set_message( $message ) 
    {
        $newdata = [
            'message'  => $message,
            'error'    => 0,
        ];       
        $this->session->set($newdata);
    }

    function set_error($message ) 
    {
        $newdata = [
            'message'  => $message,
            'error'    => 1,
        ];       
        $this->session->set($newdata);    
    }

    function clear()
    {
        $newdata = [
            'message'  => '',
            'error'    => 0,
        ];       
        $this->session->set($newdata);
    }

    public function searchform() 
    {  
        if (trim(me()) ==''){
            return redirect()->to(base_url() . '/public/login');  
        } else {
            $username = $this->session->get('username');
            $data['username'] = $username;
            if ($this->isError()){
                $data['error'] = 1;
                $data['message'] = $this->session->get('message');
                $this->clear();
            }
            else {
                $data['error'] = 0;
            }
            $data['content'] = 'search/search';
            return view('Design/default_page',$data);
        }
    }

    public function do() {
        $nome = $_POST['nome'];
        $data['ds_nome'] = $nome;
        $data['limit'] = 25;
        $data['offset'] = 0;
        $data['resultDatarecord'] = $this->PatientModel->search($data);
        $data['search_content'] = $nome;
        $data['content'] = 'search/search_result';
        return view('Design/default_page',$data);
    }

    public function select($patientId) 
    {      
        $data['username'] = $patientId;
        if ($this->isError()){
            $data['error'] = 1;
            $data['message'] = $this->session->get('message');
            $this->clear();
        }
        else {
            $data['error'] = 0;
        }
        $data['useractivedirectoryExact'] = [];
        $data['userrecord'] = $this->TreatmentModel->getByPatient($patientId);
        $data['userpmedrecord'] = [];
        $data['useractivedirectory'] = null;
        $data['content'] = 'search/selected';
        return view('Design/default_page',$data);
    }
}