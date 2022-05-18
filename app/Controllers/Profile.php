<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdminInternalUsersModel;

class Profile extends BaseController
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->UserModel = new UserModel();        
        $this->AdminInternalUsersModel = new AdminInternalUsersModel();
        $this->session = session();
        helper('profile');       
        
    }
 
    public function index()
    {
        if (trim(me()) ==''){
            return redirect()->to(base_url() . '/public/login');  
        }
        $data['username'] = me();
        $data['content'] = 'profile/me';
        return view('Design/default_page',$data);
    }
    
    public function update(){
        // Password
        if (isset($_POST['password'])){
            if (!$_POST['password']==''){
                $password = md5($_POST['password']);
                $this->AdminInternalUsersModel->updatePassword(me(),$password);
            }
        }
        return redirect()->to(base_url() . '/public/dashboard'); 
    }

    // GET information from api module via RestFull
    public function restget($username)
    {
        
        $options = [
            'baseURI' => 'http://10.1.6.22:89/tiadmin/api/public/v1/',
            'timeout'  => 3,
        ];
        $client = \Config\Services::curlrequest($options);
        
        $client = new \CodeIgniter\HTTP\CURLRequest(
            new \Config\App(),
            new \CodeIgniter\HTTP\URI(),
            new \CodeIgniter\HTTP\Response(new \Config\App()),
            $options
        );

        $response = $client->request('GET', $options['baseURI'] . 'users/' . $username, [
            'auth' => ['user', 'pass'],
        ]);
        if ( trim($response->getReasonPhrase())=='OK' ){
            $json = json_decode($response->getBody());
            $fisrtRecord = $json[0];
            var_dump($fisrtRecord);            
        }
        else {
            var_dump($response->getReasonPhrase());
        }
        
    }

}
