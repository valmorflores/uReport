<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminLogModel extends Model
{

    protected $table      = 'DBAMV.TIADMIN_USER';
    protected $primaryKey = 'cd_id';
    protected $returnType = 'array';

    public function __consttruct() {       
    }

    public function getAll(){
        $query   = $this->db->query('SELECT * FROM DBAMV.TIADMIN_USER_LOGS ');
        $results = $query->getResult();
        return $results;
    }

    public function getByUsername($userName){
        $query   = $this->db->query('SELECT * FROM DBAMV.TIADMIN_USER_LOGS WHERE CD_USUARIO = ' . "'".$userName."'");
        $results = $query->getResult();
        return $results;
      // return $this->UserModel->find($userName);
    }

    public function insert( $data ){
        $id = $this->get_next_id( 'CD_ID' );
        $data['cd_id' ] = $id;
        $data['cd_usuario' ] = $id;
        // $this->db->table('DBAMV.TIADMIN_USER')->insert($data);                
        $sql = "INSERT INTO DBAMV.TIADMIN_USER (" . 
                " cd_id, " . 
                " cd_user_id, " .
                " cd_usuario, " .
                " ds_description, " .
                " ds_timestamp " . " ) " . 
            "VALUES (".
                    $this->db->escape($data['cd_id']).", ".
                    $this->db->escape($data['cd_user_id']).", ".
                    $this->db->escape($data['cd_usuario']).", ".
                    $this->db->escape($data['ds_description']).", ".
                    $this->db->escape($data['ds_timestamp'])."  " .
                    ")";
        $this->db->query($sql);
        return $this->affectedRows();
    }
}
/*  
  cd_id          NUMBER(10,0)  NOT NULL,
  cd_user_id     NUMBER(10,0)  NOT NULL,
  cd_usuario     VARCHAR2(30)  NULL,
  ds_description VARCHAR2(255) NULL,
  ds_timestamp   NUMBER(10,0)  NULL

*/