<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserPMedModel;
use App\Models\ProviderModel;
use App\Models\AdminUserModel;
use App\Models\LocaisTrabalhoModel;
use App\Models\AdminUserCommentsModel;

// Do / Todo: CAMPO PARA USERNAME final
// Todo: USUARIO PERFIL INATIVO (VALIDAR)
// Todo: Tipo de usuario: MEDICO, ENFERMEIRO, TECNICO ENFERMAGEM, 


class Provider extends BaseController
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

    public function new() 
    {  
        $username = $this->session->get('username');
        $data['username'] = $username;
        $data['cd_usuario'] = '*PRESTADOR*';
        $data['cd_tipo'] = '003';
        if ($this->isError()){
            $data['error'] = 1;
            $data['message'] = $this->session->get('message');
            $this->clear();
        }
        else {
            $data['error'] = 0;
        }
        $data['content'] = 'provider/new';
        return view('Design/default_page',$data);
        
    }
    
    
    public function post() {
        $data = [];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $ativo = 'N';
        $nascimento = '01/01/1990';
        $username = $this->session->get('username');
        $data['cd_id'] = 0;
        $data['ds_nome'] = $nome;
        $data['cpf'] = $cpf;
        $data['ds_solicitante'] = $username;
        $data['cd_tipo'] = '003';
        $data['sn_ativo'] = $ativo;
        $data['cd_usuario'] = '*PRESTADOR*';
        // nascimento
        $nascimento = convertToDbValid($nascimento);       
        $data['dt_nascimento'] = $nascimento;
        // inserir novo
        $id = $this->AdminUserModel->insertNew($data);
        $error = $this->isError();
        if ($error){
            $data['error'] = 1;
            $data['message'] = $this->getMessage();
            $data['content'] = 'Main/dashboard';
            $this->clear();
            return view('Design/default_page',$data);
        }
        else {
            return redirect()->to( base_url() . '/public/user/edit/' . $id); 
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
        $data['content'] = 'user/search';
        return view('Design/default_page',$data);

        
    }

    public function search() {
        $data = [];
        $nome = $_POST['nome'];
        $data['ds_nome'] = $nome;
        $data['limit'] = 5;
        $data['offset'] = 0;
        $data['resultDatarecord'] = $this->UserModel->search($data);
        $data['search_content'] = $nome;
        $data['content'] = 'user/search_result';
        return view('Design/default_page',$data);
    }

    public function admin($id) {

        $datarecord = $this->AdminUserModel->getById($id);
        $data = $this->AdminUserModel->fromDatarecord($datarecord);
        $info = [];
        if (isset($data['nr_conselho'])){
            if ($data['nr_conselho']<>'0'){                
                $info[] = ['000','Possui conselho. Prestador existente'];
            }
        }
        $info[] = ['000','Usuário pelo CPF existente'];
        $username = $this->session->get('username');
        $data['username'] = $username;

        $data['user'] = $this->AdminUserModel->fromDatarecord($datarecord);
        $data['usuario'] = $this->UserModel->getByCpf($data['cpf']);

        if ( $data['cd_prestador'] > 0 ) {
           $data['prestador'] = $this->ProviderModel->getById($data['cd_prestador']);
           $data['prestador_porcpf'] = $this->ProviderModel->getByCpfCgc($data['cpf']);
        }
        else
        {
           $data['prestador'] = $this->ProviderModel->getByCpfCgc($data['cpf']);
        }
        
        $data['pmed_user'] = $this->UserPMedModel->getByCpfCgc($data['cpf']);
        $data['content'] = 'user/admin';
        return view('Design/default_page',$data);

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
            $validation[] = ['000','Tipo de registro: ' . $data['cd_tipo'], true];
            $validation[] = ['010','CPF preenchido', ( !($data['cpf']=='') )];
            $validation[] = ['011','CPF com número de dígitos', ( (strlen($data['cpf'])==11) )];
            $validation[] = ['012','CPF válido', validaCPF($data['cpf'])];
            $validation[] = ['030','Nome preenchido', ( !($data['ds_nome']=='') )];
            $validation[] = ['061','Cargo preenchido', ( !($data['ds_cargo']=='') )];
            $validation[] = ['062','Local de trabalho', ( !($data['ds_localtrabalho']=='NENHUM') )];
            foreach ($validation as $row) {
                if (!( $row[2] )){
                    $isValid = false;
                }
            }            
            $this->AdminUserModel->setValid($id,$isValid);
            if ($isValid){
                $id = $data['cd_id'];
                $nome = $data['ds_nome'];
                $this->sendmail('Novo registro de usuário validado: ' . $nome, $id, $nome);
                return redirect()->to( base_url() . '/public/dashboard'); 
            }
        }
        $data['id'] = $id;
        $data['validate'] = $validation;
        $data['content'] = 'provider/validate';
        return view('Design/default_page',$data);
    }

    public function updateProviderInfo($id){
        $this->updateBasicProvider($id);
        return redirect()->to( base_url() . '/public/user/admin/' . $id);
    }

    public function updateBasicProvider($id){
        $datarecord = $this->AdminUserModel->getById($id);
        $dataOrigin = $this->AdminUserModel->fromDatarecord($datarecord);        
        $exp = explode(" ", $dataOrigin['ds_nome']);
        $string = current($exp) . " " . end($exp);
        $data['DS_CARGO'] = $dataOrigin['ds_cargo'];
        $data['NM_MNEMONICO'] = substr(strtoupper($string), 0, 20);
        $data['CD_PRESTADOR'] = $dataOrigin['cd_prestador'];
        $data['NR_CPF_CGC'] = $dataOrigin['cpf'];
        $data['NM_PRESTADOR'] = strtoupper( $dataOrigin['ds_nome'] );
        $data['NR_CONSELHO'] = $dataOrigin['nr_conselho'];
        $data['DT_NASCIMENTO'] = $dataOrigin['dt_nascimento'];
        $records = $this->ProviderModel->updateBasicData($data);
    }

    public function create($id){
        //'CD_PRESTADOR' => string '13837' (length=5)
        $datarecord = $this->AdminUserModel->getById($id);
        $dataOrigin = $this->AdminUserModel->fromDatarecord($datarecord);
        if (stripos($dataOrigin['ds_cargo'],"enfermagem")>0) {
            $data['CD_CONSELHO'] = '16';
            $data['CD_TIP_PRESTA'] = '23';
        }
        else if (stripos($dataOrigin['ds_cargo'],"nfermei")>0) {
            $data['CD_CONSELHO'] = '16';
            $data['CD_TIP_PRESTA'] = '4';
        }
        else
        {
            $data['CD_CONSELHO'] = '1';
            $data['CD_TIP_PRESTA'] = '1';
        }
        $data['NR_CPF_CGC'] = $dataOrigin['cpf'];
        $data['TP_SITUACAO'] = 'A';
        $data['NM_PRESTADOR'] = strtoupper( $dataOrigin['ds_nome'] );
        $data['DT_NASCIMENTO'] = date('d/m/Y',strtotime($dataOrigin['dt_nascimento']));
        // first and last
        $exp = explode(" ", $dataOrigin['ds_nome']);
        $string = current($exp) . " " . end($exp);
        $data['NM_MNEMONICO'] = substr(strtoupper($string), 0, 20);
        $data['TP_CORPO_CLINICO'] = 'S';
        $data['DS_CODIGO_CONSELHO'] = $dataOrigin['nr_conselho'];
        $data['CD_CIDADE'] = '7951';
        $data['SN_REPASSE_FATURA_AMB_SUS'] = 'S';
        $data['SN_ANESTESISTA'] = 'N';
        $data['SN_AUXILIAR'] = 'N';
        if (isset($dataOrigin['sn_cirurgia'])){
            if ($dataOrigin['sn_cirurgia']=='S'){
                $data['SN_CIRURGIAO'] ='S';        
            }
            else
            {
                $data['SN_CIRURGIAO'] ='N';
            }
        }
        else
        {
            $data['SN_CIRURGIAO'] ='N';
        }
        $data['SN_OUTROS'] = 'N';
        $data['TP_VINCULO'] = 'F';
        $data['SN_ATUANTE'] = 'S';
        $data['TP_DOCUMENTACAO'] = 'P';
        $data['SN_ALT_DADOS_ORA_APP'] = 'S';
        $data['CD_MULTI_EMPRESA'] = '1';
        $data['SN_CESSAO_CREDITO'] = 'S';
        $data['SN_AUDITOR_SUS'] = 'N';
        $data['TP_PRESTADOR'] = 'O';
        $data['SN_MOSTRA_ENDERECO'] = 'N';
        $data['SN_MOSTRA_ENDERECO_COM'] = 'N';
        $data['TP_REMESSA'] = 'P';
        $data['SN_LIBERA_EXAME'] = 'S';
        $records = $this->ProviderModel->insertData($data);
        return redirect()->to( base_url() . '/public/user/admin/' . $id);        
    }

    public function sendmail($title='Novo registro de prestador', $id=0, $nome='')
    {        
        $email = \Config\Services::email();
        $email->setFrom('acessos@cardiologia.org.br', 'Acessos - Cardiologia');
        $email->setTo('acessos@cardiologia.org.br');
        $email->setSubject($title);
        $email->setMessage(
            "Sistema de registros de usuarios com um novo requerimento." .
            "\nPrestador: " . $nome . " " .
            "\n" . base_url() . "/public/user/edit/" . $id .
            "\nMensagem automática do sistema".
            "\nNão responda este e-mail");
        $email->send();
    }
}
