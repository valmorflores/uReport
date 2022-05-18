<?php

namespace App\Models;

use CodeIgniter\Model;
      
class AdminUserCommentsModel extends Model
{

    protected $table      = 'DBAMV.TIADMIN_USER_COMMENTS';
    protected $primaryKey = 'CD_ID';
    protected $returnType = 'array';

    public function __consttruct() {       
    }
    
    public function getByUserId($id){
        $sql = "SELECT * FROM DBAMV.TIADMIN_USER_COMMENTS " . 
                " WHERE is_deleted = 0 AND cd_user_id = " . $id . " ORDER BY DS_TIMESTAMP ASC ";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getById($id){
        //deleteComments
        $sql = "SELECT * FROM DBAMV.TIADMIN_USER_COMMENTS WHERE cd_id = " . $id . ' AND is_deleted <> 1';
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function deleteById($id){       
        $sql = "UPDATE DBAMV.TIADMIN_USER_COMMENTS " . 
               " SET is_deleted = 1  " . 
               " WHERE cd_id = " . $id;
        $this->db->query($sql);
        return $this->affectedRows();
    }

    public function deleteByUserId($id){
        $sql = "UPDATE DBAMV.TIADMIN_USER_COMMENTS " . 
               " SET is_deleted = 1  " . 
               " WHERE cd_user_id = " . $id;
        $this->db->query($sql);
        return $this->affectedRows();
    }

    public function add($data){
        $cd_id = $this->get_next_id('CD_ID');
        $cd_user_id = $data['cd_user_id'];
        $cd_usuario = $data['cd_usuario'];
        $ds_comments = $data['ds_comments'];
        $date = new \DateTime();
        $ds_timestamp = $date->getTimestamp();
        $sql = 'INSERT INTO DBAMV.TIADMIN_USER_COMMENTS (
                    cd_id,
                    cd_user_id,
                    cd_usuario,
                    ds_comments,
                    ds_timestamp ) VALUES
                    ( ' . $cd_id . ','
                        . $cd_user_id . ','
                        . $this->db->escape($cd_usuario) . ','
                        . $this->db->escape($ds_comments) . ','
                        . $ds_timestamp . ')' ;
        $this->db->query($sql);
        return $this->affectedRows();
    }

    public function getCommentsCount($conversationId) {
        $sql = 'select count(A.CD_ID) AS COMMENTS ' . 
               ' FROM DBAMV.TIADMIN_USER_COMMENTS A ' . 
               ' WHERE IS_DELETED = 0 AND CD_USER_ID = ' . $conversationId;
        $query = $this->db->query($sql);
        $results = $query->getResult();
        $i = 0;
        foreach ($results as $row){
            $i = $row->COMMENTS;
        }
        return $i;
    }
     
    public function get_next_id( $field ){
        $sql = 'SELECT MAX(' . $field . ') as MAXIMO FROM DBAMV.TIADMIN_USER_COMMENTS';
        $query = $this->db->query($sql);
        $results = $query->getResult();
        $id = 0;
        foreach ($results as $row) {
            $id = $row->MAXIMO;
            break;
        }
        return $id+1;
    }

/*
        cd_id        NUMBER(10,0)  NOT NULL,
        cd_user_id   NUMBER(10,0)  NOT NULL,
        cd_usuario   VARCHAR2(30)  NULL,
        ds_comments  VARCHAR2(512) NULL,
        ds_timestamp NUMBER(10,0)  NULL
      
    */

}