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


class User extends BaseController
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

    public function new() 
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
        $data['content'] = 'user/new';
        return view('Design/default_page',$data);
        
    }
    

    public function delete() {
        $data = [];
        $to_delete = $_POST['to_exclude'];
        $id = substr($to_delete, strpos($to_delete, '=')+1);
        $id = substr($id, 0, strpos($id, ';'));
        $this->AdminUserCommentsModel->deleteByUserId($id);
        $this->AdminUserModel->deleteById($id);
        return redirect()->to( base_url() . '/public/dashboard'); 
    }


    public function post() {
        $data = [];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $ativo = 'N';
        $nascimento = $_POST['nascimento'];
        $username = $this->session->get('username');
        $data['cd_id'] = 0;
        $data['ds_nome'] = $nome;
        $data['cpf'] = $cpf;
        $data['ds_solicitante'] = $username;
        
        $data['sn_ativo'] = $ativo;
        $data['ds_localtrabalho'] = 'NENHUM';

        $nascimento = convertToDbValid($nascimento);
        
        $data['dt_nascimento'] = $nascimento;
       
        $this->AdminUserModel->insertNew($data);

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
        $data['comments'] = $this->AdminUserCommentsModel->getByUserId($id);
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
        $data['is_superuser'] = ($this->UserModel->isSuperuser($username)) ? 1 : 0;
        $data['content'] = 'user/edit';        
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
        $data['content'] = 'user/view';
        return view('Design/default_page',$data);
    }

    public function locaisTrabalho() {
        $alocais = $this->LocaisTrabalhoModel->getAll();
        asort($alocais);
        return $alocais;
    }   

    public function update($id) {
        $data = [];
        $usuario = $_POST['usuario'];
        $nome = $_POST['nome'];
        $matricula = $_POST['matricula'];
        $nascimento = $_POST['nascimento'];
        $nascimento = convertToDbValid($nascimento);
        $cpf = $_POST['cpf'];
        $especialidade = $_POST['especialidade'];
        $localtrabalho = $_POST['localtrabalho'];
        $cargo = $_POST['cargo'];
        $ativo = $_POST['ativo'];
        $rede = $_POST['rede'];
        $conselho = $_POST['conselho'] ?? 0;
        $cirurgia = $_POST['cirurgia'];
        $horario = $_POST['horario'];
        $perfilsimilar = $_POST['perfilsimilar'];
        $estagresidper = $_POST['estagresidper'];
        $cd_prestador = $_POST['cd_prestador'];
        $admissao = $_POST['admissao'];
        $admissao = convertToDbValid($admissao);
        $username = $this->session->get('username');
        // Items from check
        $items[0] = $_POST['check0'] ?? 0;
        $items[1] = $_POST['check1'] ?? 0;
        $items[2] = $_POST['check2'] ?? 0;
        $items[3] = $_POST['check3'] ?? 0;
        $items[80] = $_POST['check80'] ?? 0;
        $items[81] = $_POST['check81'] ?? 0;
        $items[82] = $_POST['check82'] ?? 0;
        $this->AdminUserModel->updateItemsData($id,$items);
        
        $data['cd_id'] = $id;
        $data['cd_usuario'] = $usuario;
        $data['ds_nome'] = $nome;
        $data['ds_solicitante'] = $username;
        $data['nr_matricula'] = $matricula;
        $data['dt_nascimento'] = $nascimento;        
        $data['cd_prestador'] = $cd_prestador;
        $data['cpf'] = $cpf;
        if ($conselho==''){
            $conselho = 0;
        }
        $data['nr_conselho'] = $conselho;
        $data['ds_localtrabalho'] = $localtrabalho;
        $data['ds_cargo'] = $cargo;
        $data['sn_ativo'] = $ativo;
        $data['sn_rede'] = $rede;
        $data['sn_cirurgia'] = $cirurgia;
        $data['ds_especialidade'] = $especialidade;
        $data['ds_horario'] = $horario;
        $data['ds_estagresidper'] = $estagresidper;
        $data['ds_perfilsimilar'] = $perfilsimilar;
        $data['dt_admissao'] = $admissao;
        $this->AdminUserModel->updateData($data);
        
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
            $validation[] = ['040','Matricula preenchida', ( !($data['nr_matricula']=='') )];
            $validation[] = ['041','Matricula com digitos válidos',  (validaNumbersOnly($data['nr_matricula']) )];    
            $validation[] = ['051','Usuário idêntico preenchido', ( !($data['ds_perfilsimilar']=='') )];
            $validation[] = ['052','Usuário idêntico existente', $this->existsUser($data['ds_perfilsimilar'])];
            $validation[] = ['053','Usuário idêntico ativo', $this->activeUser($data['ds_perfilsimilar'])];
            $validation[] = ['061','Cargo preenchido', ( !($data['ds_cargo']=='') )];
            $validation[] = ['062','Local de trabalho preenchido', ( !($data['ds_localtrabalho']=='NENHUM') )];
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
        $data['content'] = 'user/validate';
        return view('Design/default_page',$data);
    }

    public function sendmail($title='Novo requerimento de usuário', $id=0, $nome='')
    {        
        $email = \Config\Services::email();
        $email->setFrom('acessos@cardiologia.org.br', 'Acessos - Cardiologia');
        $email->setTo('acessos@cardiologia.org.br');
        $email->setCC('gruposuporte@cardiologia.org.br');
        $email->setSubject($title);
        $email->setMessage(
            "Sistema de registros de usuarios com um novo requerimento." .
            "\nUsuário: " . $nome . " " .
            "\n" . base_url() . "/public/user/edit/" . $id .
            "\nMensagem automática do sistema".
            "\nNão responda este e-mail");
        $email->send();
    }

    public function commentsCount($id){
        echo $this->AdminUserCommentsModel->getCommentsCount($id);
        die;
    }

    public function sendmailResponse($title){
        return "";
    }

    function existsUser( $user ){
        $userrecord = $this->UserModel->getByUsername($user);
        $result = false;
        foreach ($userrecord as $row){
            if ($row->NM_USUARIO==$user){
                $result = true;
            }
        }
        if (!$result){
            $userrecord = $this->UserModel->getByUserLogin($user);
            $result = false;
            foreach ($userrecord as $row){
                if ($row->CD_USUARIO==$user){
                    $result = true;
                }
            }
        }
        return $result;
    }

    function activeUser( $user ){
        $userrecord = $this->UserModel->getByUsername($user);
        $result = false;
        foreach ($userrecord as $row){
            if ($row->NM_USUARIO==$user){
                $result = ($row->SN_ATIVO == 'S');
            }
        }
        if (!$result){
            $userrecord = $this->UserModel->getByUserLogin($user);
            foreach ($userrecord as $row){
                if ($row->CD_USUARIO==$user){
                    $result = ($row->SN_ATIVO == 'S');
                }
            }
        }
        return $result;
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

    public function createProvider($id){
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
        //var_dump($data);var_dump($data);
        //die;
        /*
        $data['NR_CPF_CGC'] => string '81079893091' (length=11);
        $data['TP_SITUACAO'] => string 'A' (length=1);
        $data['NM_PRESTADOR'] => string 'CLAUDIA SAIONARA FABRICIO DA COSTA' (length=34);
        $data['NM_MNEMONICO'] => string 'CLAUDIA SAIONARA' (length=16);
        $data['TP_CORPO_CLINICO'] => string 'S' (length=1);
        $data['DS_CODIGO_CONSELHO'] => string '352610' (length=6);
        $data['DT_CADASTRO'] => string '21/01/22' (length=8);
        $data['DT_NASCIMENTO'] => null;
        $data['CD_CIDADE'] => string '7951' (length=4);
        $data['SN_REPASSE_FATURA_AMB_SUS'] => string 'S' (length=1);
        $data['SN_ANESTESISTA'] => string 'N' (length=1);
        $data['SN_AUXILIAR'] => string 'N' (length=1);
        $data['SN_CIRURGIAO'] => string 'N' (length=1);
        $data['SN_OUTROS'] => string 'N' (length=1);
        $data['TP_VINCULO'] => string 'F' (length=1);
        $data['SN_ATUANTE'] => string 'S' (length=1);
        $data['TP_DOCUMENTACAO'] => string 'P' (length=1);
        $data['SN_ALT_DADOS_ORA_APP'] => string 'S' (length=1);
        $data['CD_MULTI_EMPRESA'] => string '1' (length=1);
        $data['SN_CESSAO_CREDITO'] => string 'S' (length=1);
        $data['SN_AUDITOR_SUS'] => string 'N' (length=1);
        $data['TP_PRESTADOR'] => string 'O' (length=1);
        $data['SN_MOSTRA_ENDERECO'] => string 'N' (length=1);
        $data['SN_MOSTRA_ENDERECO_COM'] => string 'N' (length=1);
        $data['TP_REMESSA'] => string 'P' (length=1);
        $data['SN_LIBERA_EXAME'] => string 'S' (length=1);
        */
        return $records;
    }
    
    // Create new user into table "DBASGU.USUARIOS"
    public function create($id) {        
        $datarecord = $this->AdminUserModel->getById($id);
        $dataOrigin = $this->AdminUserModel->fromDatarecord($datarecord); 
        $prestador = $this->ProviderModel->getByCpfCgc($dataOrigin['cpf']);        
        $cargo = $dataOrigin['ds_cargo'];
        $setor = $dataOrigin['ds_localtrabalho'];
        $conselhoName = 'COREN';
        $conselhoId = $dataOrigin['nr_conselho'];
        $cd_prestador = null;
        foreach ($prestador as $row){
            $cd_prestador = $row->CD_PRESTADOR;
            if (isset($row->CD_TIP_PRESTA)){
                if ($row->CD_TIP_PRESTA==1){
                    $conselhoName = 'CRM';
                }
            }
        }        
        if ($conselhoId=='0') {
           $conselhoName = '';
        }
        $profile = $dataOrigin['ds_perfilsimilar'];
        $today =  date('d/m/Y');
        $data['CD_USUARIO'] = trim($dataOrigin['cd_usuario']);  
        $data['NM_USUARIO'] = strtoupper($dataOrigin['ds_nome']);  
        $data['DS_OBSERVACAO'] = 'MATR ' . $dataOrigin['nr_matricula'] . 
            ' | ' . $cargo . 
            ' | ' . $setor .
            ' | ' . $conselhoName . ' ' . $conselhoId . 
            ' | ' . $profile . 
            ' | ' . $today;
        $data['TP_PRIVILEGIO'] =  'U';
        $data['TP_STATUS'] = 'R';
        $data['CD_PRESTADOR'] = $cd_prestador;
        $data['SN_ATIVO'] =  'S';
        $data['SN_SENHA_PLOGIN'] = 'N';
        $data['SN_ABRE_FECHA_CONTA'] = 'S';
        $data['CPF'] = $dataOrigin['cpf'];
        $data['SN_RECEBE_MSG_EXPIRA_CHAVE'] = 'N';
        $data['SN_ALTERA_AUDITORIA_IN_LOCO'] = 'N';
        $data['SN_CADASTRA_PACIENTE'] =  'S';
        $data['SN_ALTERA_CADASTRO_PACIENTE'] = 'S';
        $data['DT_NASCIMENTO'] = date('d/m/Y',strtotime($dataOrigin['dt_nascimento']));
        $data['CD_MATRICULA'] = '';
        $data['DS_EMAIL'] = '';
        $data['SN_CERTIFICADO_DIGITAL'] = 'N';
        $data['SN_PERMITE_DESVINCULO_PACOTE'] = 'N';
        $data['SN_ALTERA_PACIENTE_SEM_CPF'] = 'N';
        $data['SN_ALTERA_OBSERVACAO_GUIA'] = 'S';
        $data['CD_SENHA'] = '0';
        $this->UserModel->insertData($data);
        return redirect()->to( base_url() . '/public/user/admin/' . $id);
  /*$data['CD_SENHA'] =  string '58>;A:R]Tj[b\NWTXW]Z[xz|~' (length=35)
  $data['TP_STATUS'] =  string 'R' (length=1)
  $data['CD_PRESTADOR'] =  string '13837' (length=5)
  $data['SN_ATIVO'] =  string 'S' (length=1)
  $data['SN_SENHA_PLOGIN'] =  string 'N' (length=1)
  $data['SN_ABRE_FECHA_CONTA'] =  string 'S' (length=1)
  $data['CPF'] =  string '81079893091' (length=11)
  $data['SN_RECEBE_MSG_EXPIRA_CHAVE'] =  string 'N' (length=1)
  $data['SN_ALTERA_AUDITORIA_IN_LOCO'] =  string 'N' (length=1)
  $data['SN_CADASTRA_PACIENTE'] =  string 'S' (length=1)
  $data['SN_ALTERA_CADASTRO_PACIENTE'] =  string 'S' (length=1)
  $data['DT_NASCIMENTO'] =  string '18/02/83' (length=8)
  $data['CD_MATRICULA'] =  null
  $data['DS_EMAIL'] =  null  
  $data['SN_CERTIFICADO_DIGITAL'] =  string 'N' (length=1)
  $data['SN_PERMITE_DESVINCULO_PACOTE'] =  string 'N' (length=1)
  $data['SN_ALTERA_PACIENTE_SEM_CPF'] =  string 'N' (length=1)
  $data['SN_ALTERA_OBSERVACAO_GUIA'] =  string 'S' (length=1)
  */
  
  
    }
    
}

