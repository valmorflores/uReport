<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminInternalUsersModel extends Model
{

    protected $table      = 'DBAMV.TIADMIN_INTERNALUSERS';
    protected $primaryKey = 'cd_id';
    protected $returnType = 'array';

    /*public function __construct() {       
    }
*/
    public function updatePassword($user,$hash){
        $sql = 'UPDATE DBAMV.TIADMIN_INTERNALUSERS ' . 
               'SET DS_PASSWORD = ' . $this->db->escape($hash) .
               ' WHERE CD_USUARIO = ' .$this->db->escape( $user );
        $query = $this->db->query($sql);
        return true;
    }

    public function getAllData(){
        $builder = $this->db->table('DBAMV.TIADMIN_INTERNALUSERS');
        $builder->orderby('CD_ID','DESC');
        $query = $builder->get(); 
        $result = $query->getResult();        
        return $result;
    }

    public function get_next_id( $field ){
        $sql = 'SELECT MAX(' . $field . ') as MAXIMO FROM DBAMV.TIADMIN_INTERNALUSERS';
        $query = $this->db->query($sql);
        $results = $query->getResult();
        $id = 0;
        foreach ($results as $row) {
            $id = $row->MAXIMO;
            break;
        }
        return $id+1;
    }

    // Delete record
    public function deleteById($id) {
        $sql = "DELETE FROM DBAMV.TIADMIN_INTERNALUSERS WHERE cd_id = " . $id;
        $this->db->query($sql);
        return $this->affectedRows();
    }

    
    // Get by Id
    public function getById($id) {
        $sql = "SELECT * FROM DBAMV.TIADMIN_INTERNALUSERS WHERE cd_id = " . $id;
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    // Get by username
    public function getByUsername($username) {
        $sql = "SELECT * FROM DBAMV.TIADMIN_INTERNALUSERS WHERE cd_usuario = " . $this->db->escape($username)." ";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // Exists username
    public function exists($username){
        $userlist = $this->getByUsername($username);
        return count($userlist)>=1;
    }

    // add
    public function addNew($data){
        if ( $this->exists($data['cd_usuario'])){
            return 0;
        }
        else {
            # code...
            $id = $this->get_next_id( 'CD_ID' );
            $data['cd_id' ] = $id;
            // $this->db->table('DBAMV.TIADMIN_USER')->insert($data);                
            $sql = "INSERT INTO DBAMV.TIADMIN_INTERNALUSERS (" . 
                " cd_id, " . 
                " cd_usuario, " . 
                " sn_ativo, " . 
                " sn_administrador" .          
                " ) " . 
                "VALUES (".
                        $this->db->escape($data['cd_id']).", ".
                        $this->db->escape($data['cd_usuario']).", ".
                        $this->db->escape($data['sn_ativo']).", " . 
                        $this->db->escape($data['sn_administrador'])." " .                     
                ")";
            $this->db->query($sql);
            return $this->affectedRows();
        }
    }

    // from database to array
    public function fromDatarecord( $datarecord ){
        $data = [];
        foreach ($datarecord as $row){
            $data['cd_id'] = $row->CD_ID;
            $data['cd_usuario'] = $row->CD_USUARIO;
            $data['sn_ativo'] = $row->SN_ATIVO;
            $data['sn_administrador'] = $row->SN_ADMINISTRADOR;
        }
        return $data;
    }

    // date
    public function dateFromBase($date){
        // dd/mm/yyyy
        $dateNew = substr($date,3,2) . '/' . substr($date,0,2) . '/' . substr($date,6,2);
        $finaldate = date('Y-m-d', strtotime($dateNew));
        return $finaldate;
    }

    // set to administrador
    public function setAdministrador($usuario,$status) {
        if ($status){
            $admin = 'S';
        }
        else {
            $admin  = 'N';
        }
        $sql = "UPDATE DBAMV.TIADMIN_INTERNALUSERS SET " .         
          "sn_administrador = " . $this->db->escape($admin) . 
          " WHERE cd_usuario = " . $this->db->escape($usuario);
        $this->db->query($sql);
        return $this->affectedRows();
    }


    public function getPasswordHash($username){
        $sql = "SELECT * FROM DBAMV.TIADMIN_INTERNALUSERS " . 
             " WHERE cd_usuario = " . $this->db->escape($username)." ";
        $query = $this->db->query($sql);
        $data = $query->getResult();
        $hash = '';
        foreach ($data as $row) { 
            $hash = $row->DS_PASSWORD;
        }
        return $hash;
    }

    // isAuthorized
    public function isAuthorized($username) {
        $datarecord = $this->getByUsername($username);
        if (count($datarecord)<=0) {
            return false;
        }
        $authorized = false;
        foreach ($datarecord as $row){
            if ($row->CD_USUARIO==$username) {
                $authorized = true;
            }
        }
        return $authorized;
    }

    // isAdmin
    public function isAdmin($username) {
        $datarecord = $this->getByUsername($username);
        if (count($datarecord)<=0) {
            return false;
        }
        $isAdmin = false;
        foreach ($datarecord as $row){
            if ($row->SN_ADMINISTRADOR=='S') {
                $isAdmin = true;
            }
        }
        return $isAdmin;
    }
    
}

