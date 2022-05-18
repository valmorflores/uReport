<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdminInternalUsersModel;

class Login extends BaseController
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->UserModel = new UserModel();        
        $this->AdminInternalUsersModel = new AdminInternalUsersModel();
        $this->session = session();
        helper('profile');
        /*
        $users = $this->UserModel->getByUsername('VALMORPF');
        $users = $this->UserModel->findByUsername('VALMORPF');
        var_dump($users);
        */
    }

    public function off() 
    {
        setcookie('login_key', '', -1);
        setcookie('login_user', '', -1);
        return redirect()->to(base_url() . '/public'); 
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
        return view('Design/blank_page',$data);
    }

    public function loginDo($username){
        $this->clear();
        setcookie('login_key', md5($username));
        setcookie('login_user', $username);
        //$this->session->set(['username'=>$username]);     
        setMe($username);
        if (($this->AdminInternalUsersModel->isAdmin($username))){
            setProfileAsAdmin(); 
        }
        else {
            # code...
            setProfileAsNormal(); //
        }                                       
        return redirect()->to(base_url() . '/public/dashboard'); 
    }

    public function auth() 
    {  
        $error = false;
        $username = strtoupper( $_POST['username'] );
        $cpf = $_POST['password'];
        $user = $this->UserModel->findByUsername($username);        
        if ( isset( $user['CD_USUARIO'] ) ) {
            $user['CD_USUARIO']==$username;            
            if (!($this->AdminInternalUsersModel->isAuthorized($username))){
                $this->set_error( 'Sem autorização, fale com o setor de informática' );
            } else if ($user['CD_USUARIO']==$username){
                $user['DS_PASSWORD'] = $this->AdminInternalUsersModel->getPasswordHash($username);
                if ($user['DS_PASSWORD'] != ''){
                    if ( md5($_POST['password']) == $user['DS_PASSWORD'] ){
                       return $this->loginDo($username);
                    }
                    else {
                        $this->set_error( 'Senha diferente da que você criou neste sistema' );
                    }
                } else if (substr($user['CPF'],0,6)==substr($_POST['password'],0,6) ||
                    $user['CPF']==$_POST['password'] ){                    
                    return $this->loginDo($username);
                }
                else {
                    # code...
                    $this->set_error( 'Senha invalida' );
                }
            }
            else{
                $this->set_error( 'Erro ao executar login' );
            }
        }
        else
        {
            $this->set_error( 'Erro ao executar login' );

        }
        $error = $this->isError();
        if ($error){
            $data['error'] = 1;
            $data['message'] = $this->getMessage();
            $data['content'] = '/login/login';
            $this->clear();
            return view('Design/blank_page',$data);
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

}
