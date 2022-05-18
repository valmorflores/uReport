<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdminUserModel;
use App\Models\AdminInternalUsersModel;

class About extends BaseController
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->UserModel = new UserModel();        
        $this->AdminUserModel = new AdminUserModel();
        $this->AdminInternalUsersModel = new AdminInternalUsersModel();
        $this->session = session();
        helper('profile');
        /*
        $users = $this->UserModel->getByUsername('VALMORPF');
        $users = $this->UserModel->findByUsername('VALMORPF');
        var_dump($users);
        */
    }

    public function version(){        
        return $this->changelog()[1][0];
    }

    public function changelog(){
        $changelog = [];
        $changelog[] = ['', 'Maio/2022', ''];
        $changelog[] = ['v1.0.00', 'Lançamento', 'Inicio da elaboração da ferramenta de relatórios'];
        return $changelog;
    }

    public function apptitle(){
        return 'Sistema de administração de relatórios';
    }
    
    public function appname(){
        return 'uRep';
    }

    public function people(){
        $people = [];
        $people[] = [0,'Coordenador da TI', 'Projeto e desenvolvimento', 'Rodrigo Pedroso'];
        $people[] = [0,'Analista de Projetos', 'Projeto e desenvolvimento', 'Valmor Pereira Flores'];
        return $people;
    }

    public function index()
    {
        $data['appname'] = $this->appname();
        $data['apptitle'] = $this->apptitle();
        $data['people'] = $this->people();
        $data['version'] = $this->version();
        $data['changelog'] = $this->changelog();
        if ($this->isError()){
            $data['error'] = 1;
            $data['message'] = $this->session->get('message');
            $this->clear();
        }
        else {
            $data['error'] = 0;
        }
        $data['internalusersDatarecord'] = $this->AdminInternalUsersModel->getAllData();
        $data['content'] = 'about/credits';
        return view('Design/default_page',$data);
    }

    
    public function delete() {
        $data = [];
        $to_delete = $_POST['to_exclude'];
        $id = substr($to_delete, strpos($to_delete, '=')+1);
        $id = substr($id, 0, strpos($id, ';'));
        $this->AdminInternalUsersModel->deleteById($id);
        return redirect()->to( base_url() . '/public/internalusers'); 
    }

    public function searchform() 
    {  

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
        $data['content'] = 'internalusers/search';
        return view('Design/default_page',$data);
       
    }
    

    public function search() {
        $data = [];
        $nome = $_POST['nome'];
        $data['ds_nome'] = $nome;
        $data['resultDatarecord'] = $this->UserModel->search($data);
        $data['search_content'] = $nome;
        $data['content'] = 'internalusers/search_result';
        return view('Design/default_page',$data);
    }

    public function edit($user) {
        $datarecord = $this->AdminInternalUsersModel->getByUsername($user);
        $data = $this->AdminInternalUsersModel->fromDatarecord($datarecord);
        //var_dump($data[0]);die;
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
        $data['content'] = 'internalusers/edit';        
        return view('Design/default_page',$data);
    }

    public function post($user) {
        if (isset($_POST['checkAdmin'])){
            $admin = $_POST['checkAdmin'];
        } else {
            $admin = false;
        }
        $datarecord = $this->AdminInternalUsersModel->setAdministrador($user,$admin);
        return redirect()->to( base_url() . '/public/internalusers'); 
    }


    public function add($username) {
        $data['cd_id'] = 0;
        $data['cd_usuario'] = $username;
        $data['sn_ativo'] = 'S';
        $data['sn_administrador'] = 'N';
        $this->AdminInternalUsersModel->addNew($data);
        $datarecord = $this->AdminInternalUsersModel->getByUsername($username);
        $data['content'] = 'internalusers/edit';
        return view('Design/default_page',$data);
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


}
