<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserPMedModel;
use App\Models\UserPMedUs02Model;
use App\Models\ProviderModel;
use App\Models\AdminUserModel;
use App\Models\LocaisTrabalhoModel;
use App\Models\AdminUserCommentsModel;

class UserPMed extends BaseController
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->UserModel = new UserModel();
        $this->UserPMedModel = new UserPMedModel();
        $this->UserPMedUs02Model = new UserPMedUs02Model();
        $this->ProviderModel = new ProviderModel();
        $this->AdminUserModel = new AdminUserModel();
        $this->LocaisTrabalhoModel = new LocaisTrabalhoModel();
        $this->AdminUserCommentsModel = new AdminUserCommentsModel();
        $this->session = session();
        helper('validation');
        helper('profile');
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

    // Create new user into table "pmed.us01"
    public function create($id) {
        $datarecord = $this->AdminUserModel->getById($id);
        $dataOrigin = $this->AdminUserModel->fromDatarecord($datarecord); 
        $prestador = $this->ProviderModel->getByCpfCgc($dataOrigin['cpf']);
        $cargo = $dataOrigin['ds_cargo'];
        $setor = $dataOrigin['ds_localtrabalho'];
        $conselhoName = 'COREN';
        $conselhoId = $dataOrigin['nr_conselho'];
        $occupationcod = 1;
        if (stripos($dataOrigin['ds_cargo'],"enfermagem")>0) {
            $speciality = 'ENF';
            $occupationcod = 4;
        }
        else if (stripos($dataOrigin['ds_cargo'],"nfermei")>0) {
            $speciality = 'ENF';
            $occupationcod = 4;
        }
        else
        {
            $speciality = 'CA2';
            $occupationcod = 1;
        }
        //$data['TODAY'] =  date('d/m/Y');
        $dataNasc = date('d/m/Y',strtotime($dataOrigin['dt_nascimento']));
        $data['USERCODE'] = trim($dataOrigin['cd_usuario']);
        $data['OCCUPATIONCOD'] = $occupationcod;
        $data['NAME'] = strtoupper($dataOrigin['ds_nome']);  
        $data['USERTYPE'] = 'M';
        $data['PASS'] = '';
        $data['CFGACCESS'] = 'T';
        $data['DOREPLY'] = 'T';
        $data['ACTIVE'] = 'T';
        $data['ISUSER'] = 'T';
        $data['CGC_CPF'] =$dataOrigin['cpf'];
        $data['BIRTHDATE'] = $dataNasc;
        $data['REGISTRATION'] = (int) $conselhoId;
        $data['SPECIALITY'] = $speciality;
        // Create user
        $newInfo = $this->UserPMedModel->insertData($data);
        // Create Us02 record
        $this->us02($id);
        return redirect()->to( base_url() . '/public/user/admin/' . $id);
    }

    public function us02($id){
        // Get user record
        $datarecord = $this->AdminUserModel->getById($id);
        $dataOrigin = $this->AdminUserModel->fromDatarecord($datarecord);
        $cpf = $dataOrigin['cpf'];
        $data = $this->UserPMedModel->getRowByCpfCgc($cpf);
        var_dump($data);
        $speciality = $data['SPECIALITY'];
        if ($speciality=='CA2'){
            $this->UserPMedUs02Model->copy(2152,$data['USERNUMBER']);
        } else if ($speciality=='ENF'){
            $this->UserPMedUs02Model->copy(2163,$data['USERNUMBER']);
        }
    }

    public function copy($userdefault, $usernumber){
        $this->UserPMedUs02Model->copy($userdefault, $usernumber);
        return redirect()->to( base_url() . '/public/user/admin/' . $usernumber);
    }
    
}

