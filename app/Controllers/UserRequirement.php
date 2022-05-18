<?php


namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdminUserModel;
use App\Models\LocaisTrabalhoModel;
use App\Models\RequirementModel;
use App\Models\AdminUserCommentsModel;


// Do / Todo: CAMPO PARA USERNAME final
// Do / Todo: USUARIO PERFIL INATIVO (VALIDAR)
// Todo: Tipo de usuario: MEDICO, ENFERMEIRO, TECNICO ENFERMAGEM, 


class UserRequirement extends BaseController
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->UserModel = new UserModel();
        $this->AdminUserModel = new AdminUserModel();
        $this->LocaisTrabalhoModel = new LocaisTrabalhoModel();
        $this->RequirementModel = new RequirementModel();
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

    public function new($user) 
    {  
        $username = $this->session->get('username');
        $datarecord =$this->UserModel->getByUserLogin($user);
        $data = [];
        $data = $this->UserModel->fromDatarecord($datarecord);
        $data['username'] = $username;
        $ativo = 'N';
        $nascimento = '01/01/1981';  
        $data['cd_tipo'] = '001';
        $data['cd_requerimento'] = '000';
        $data['cd_id'] = 0;
        $data['ds_solicitante'] = $username;
        $data['ds_nome'] = $data['nm_usuario'];
        $data['sn_ativo'] = $ativo;        
        $nascimento = convertToDbValid($nascimento);
        $data['dt_nascimento'] = $nascimento;
        $data['ds_localtrabalho'] = 'NENHUM';
        $this->AdminUserModel->insertNewRequirement($data);
        $error = $this->isError();
        if ($error){
            $data['error'] = 1;
            $data['message'] = $this->getMessage();
            $data['content'] = 'Main/dashboard';
            $this->clear();
            return view('Design/default_page',$data);
        }
        else {
            return redirect()->to( base_url() . '/public/dashboard'); 
        }
        
    }

    public function edit($id) {
        $datarecord = $this->AdminUserModel->getById($id);
        $data = $this->AdminUserModel->fromDatarecord($datarecord);        
        $items = $this->AdminUserModel->getItemsById($id);
        $data['dt_nascimento'] = convertToInputValid($data['dt_nascimento']);
        $data['dt_admissao'] = convertToInputValid($data['dt_admissao']);
        $data['item'] = $items;
        $username = $this->session->get('username');
        $data['username'] = $username;
        $data['locaistrabalho'] = $this->LocaisTrabalhoModel->getAll();
        $data['requerimentos'] = $this->RequirementModel->getAll();
        if ($this->isError()){
            $data['error'] = 1;
            $data['message'] = $this->session->get('message');
            $this->clear();
        }
        else {
            $data['error'] = 0;
        }
        $data['content'] = 'userrequirement/edit';        
        return view('Design/default_page',$data);
    }

    public function comments($id) {
        $datarecord = $this->AdminUserModel->getById($id);
        $data = $this->AdminUserModel->fromDatarecord($datarecord);        
        $items = $this->AdminUserModel->getItemsById($id);
        $data['comments'] = $this->AdminUserCommentsModel->getByUserId($id);
        $data['dt_nascimento'] = convertToInputValid($data['dt_nascimento']);
        $data['dt_admissao'] = convertToInputValid($data['dt_admissao']);
        $data['item'] = $items;
        $username = $this->session->get('username');
        $data['username'] = $username;
        $data['locaistrabalho'] = $this->LocaisTrabalhoModel->getAll();
        $data['requerimentos'] = $this->RequirementModel->getAll();
        if ($this->isError()){
            $data['error'] = 1;
            $data['message'] = $this->session->get('message');
            $this->clear();
        }
        else {
            $data['error'] = 0;
        }
        $data['content'] = 'userrequirement/comments';        
        return view('Design/default_page',$data);
    }

    public function view($id) {
        $datarecord = $this->AdminUserModel->getById($id);
        $data = $this->AdminUserModel->fromDatarecord($datarecord);        
        $items = $this->AdminUserModel->getItemsById($id);
        $data['dt_nascimento'] = convertToInputValid($data['dt_nascimento']);
        $data['dt_admissao'] = convertToInputValid($data['dt_admissao']);
        $data['item'] = $items;
        $username = $this->session->get('username');
        $data['username'] = $username;
        $data['locaistrabalho'] = $this->locaisTrabalho();
        if ($this->isError()){
            $data['error'] = 1;
            $data['message'] = $this->session->get('message');
            $this->clear();
        }
        else {
            $data['error'] = 0;
        }
        $data['content'] = 'userrequirement/view';
        return view('Design/default_page',$data);
    }

    public function update($id) {
        $data = [];         
        $requerimento = $_POST['requerimento'];
        $requerimento = substr( $requerimento, 0, 3 );        
        $ativo = $_POST['ativo'];
        $username = $this->session->get('username');
        $data['cd_id'] = $id;
        $data['cd_requerimento'] = $requerimento;
        $data['sn_ativo'] = $ativo;
        $this->RequirementModel->updateData($data);
        $error = $this->isError();
        if ($error){
            $data['error'] = 1;
            $data['message'] = $this->getMessage();
            $data['content'] = 'Main/dashboard';
            $this->clear();
            return view('Design/default_page',$data);
        }
        else {
            return redirect()->to( base_url() . '/public/dashboard'); 
        }
    }


    function addComments($id) {
        $username = $this->session->get('username');
        $data['cd_user_id'] = $id;
        $data['cd_usuario'] = $username;
        $data['ds_comments'] = $_POST['comentario'];
        $this->AdminUserCommentsModel->add($data);
        $error = $this->isError();
        return redirect()->to( base_url() . '/public/userrequirement/comments/'.$id); 
        
    }

    function deleteComments($id) {
        $username = $this->session->get('username');
        $data = $this->AdminUserCommentsModel->getById($id);
        $isSome = false;
        $idConversation = 0;
        foreach ($data as $row) {
            if ( strtoupper( $row->CD_USUARIO ) == strtoupper( $username ) ){
                $isSome = true; 
                $idConversation = $row->CD_USER_ID;
            }
        }
        if ($isSome) {
            $this->AdminUserCommentsModel->deleteById($id);
        }               
        $error = $this->isError();
        if ($idConversation == 0) {
            return redirect()->to( base_url() . '/public/dashboard');
        } 
        return redirect()->to( base_url() . '/public/userrequirement/comments/'.$idConversation);
    }

    public function validateById($id) {
        $datarecord = $this->AdminUserModel->getById($id);
        $data = $this->AdminUserModel->fromDatarecord($datarecord);
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
        $validation = [];
        // Validation
        $isValid = true;
        $validation[] = ['000','Validação interna',  (validaNumbersOnly('0123456'))];
        if (!isset($data['cd_id'])){
            $validation[] = ['000','Registro armazenado com identificador na base de dados da TI', false];
            $validation[] = ['000','Validação interna',  (validaNumbersOnly('0123456'))];
            $isValid = false;
        }
        else {
                    
            $isValid = true;
            $validation[] = ['000','Registro armazenado com identificador na base de dados da TI', true];
            $validation[] = ['070','Identificação do requerimento', ( !($data['cd_requerimento']=='000') )];            
            foreach ($validation as $row) {
                if (!( $row[2] )){
                    $isValid = false;
                }
            }
            $this->AdminUserModel->setValid($id,$isValid);
        }
        $data['id'] = $id;
        $data['validate'] = $validation;
        $data['content'] = 'userrequirement/validate';
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