<?php

namespace App\Controllers;
use App\Models\AdminUserModel;
use App\Models\UserModel;
use App\Models\RoutesModel;
use App\Models\AdminUserCommentsModel;

const DEFAULT_LIMIT = 25;

class Dashboard extends BaseController
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->UserModel = new UserModel();        
        $this->AdminUserModel = new AdminUserModel();
        $this->AdminUserCommentsModel = new AdminUserCommentsModel();
        $this->RoutesModel = new RoutesModel();
        $this->session = session();
        helper('profile');
    }

    public function index()
    {   
        if (trim(me()) ==''){
            return redirect()->to(base_url() . '/public/login');  
        }
        else {
            // get query variable - limit and page
            $limit = $this->request->getVar("limit");
            $page = $this->request->getVar("page");
            $solicitante = $this->request->getVar("solicitante");
            if ($limit == null){
                $limit = DEFAULT_LIMIT;
            }
            if ($page==null){
                $page = 0;
            }
            $data['routes'] = $this->RoutesModel->getAll();
            $data['limit'] = $limit;
            $data['page'] = $page;
            $data['filter_solicitante'] = $solicitante;
            $data['maxpage'] = $this->maxpage($solicitante, $limit, $page);

            if (isProfileAdmin()){
                if ($data['filter_solicitante']==null){
                   $data['datatable'] = $this->getTiAdminUsers($limit, $page);
                }
                else
                {
                    $data['datatable'] = $this->getUsersBy($data['filter_solicitante'], $limit, $page);
                }
            }
            else {
                $data['datatable'] = $this->getMyUsers($limit, $page);
                $data['maxpage'] = $this->maxpage(me(), $limit, $page);
            }
            $dataList = [];
            foreach ($data['datatable'] as $row) {
                $count = 0;
                if (($count = $this->AdminUserCommentsModel->getCommentsCount($row->CD_ID) )>0) {
                    $row->COMMENTS = $count;
                    $dataList[] = $row;
                }
                else
                {
                    $row->COMMENTS = 0;
                    $dataList[] = $row;
                }
            }
            $data['datatable'] = $dataList;
            $data['content'] = 'Main/dashboard';
            return view('Design/default_page',$data);
        }
        
    }

    function getMyUsers($limit = null, $page = null)
    {
        $data = $this->AdminUserModel->getMyUsers(me(), $limit, $page);
        return $data;
    }

    function getUsersBy($solicitante, $limit = null, $page = null){
        $data = $this->AdminUserModel->getMyUsers($solicitante, $limit, $page);
        return $data;
    }

    function getTiAdminUsers($limit = null, $page = null)
    {
        $data = $this->AdminUserModel->getAllData($limit, $page);
        return $data;
    }
 
    function getUsersByCount($solicitante){
        $count = $this->AdminUserModel->getMyUsersCount($solicitante);
        return $count;
    }


    function getMyUsersCount()
    {
        $count = $this->AdminUserModel->getMyUsersCount(me());
        return $count;
    }

    function getTiAdminUsersCount()
    {
        $count = $this->AdminUserModel->getAllDataCount();
        return $count;
    }


    function maxpage($solicitante = null, $limit = null, $page = null){
        $count_global=$this->getTiAdminUsersCount();
        $count_bysolicitante = $this->getUsersByCount($solicitante);
        if ($limit==null){
            $limit = DEFAULT_LIMIT;
        }
        if ($solicitante==null){
            $maxpage = (int) ( $count_global / $limit );
            if ( ( $count_global / $limit ) > $maxpage ){
                $maxpage = $maxpage + 1;
            }
        }
        else
        {
            $maxpage = (int) ( $count_bysolicitante / $limit );
            if ( ( $count_bysolicitante / $limit ) > $maxpage){
                $maxpage = $maxpage+1;
            };
        }
        return $maxpage;
    }


    function variables(){
        $count_myusers = $this->getMyUsersCount();
        $count_global = $this->getTiAdminUsersCount();
        $limit = $this->request->getVar("limit");
        $page = $this->request->getVar("page");
        $solicitante = $this->request->getVar("solicitante");
        $count_bysolicitante = $this->getUsersByCount($solicitante);
        $maxpage = $this->maxpage($solicitante, $limit, $page);
        echo 'Count_global';
        var_dump($count_global);
        echo 'Count_myusers';
        var_dump($count_myusers);
        echo 'Count_bysolicitante';
        var_dump($count_bysolicitante);
        echo 'limit';
        var_dump($limit);
        echo 'page';
        var_dump($page);
        echo 'max.page';
        var_dump($maxpage);
        echo 'solicitante';
        var_dump($solicitante);
        die;
    }
}
