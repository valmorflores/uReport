<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table      = 'DBASGU.USUARIOS';
    protected $primaryKey = 'CD_USUARIO';
    protected $returnType = 'array';
    protected $allowedFields = [
                'CD_USUARIO',
                'NM_USUARIO',
                'DS_OBSERVACAO',
                'TP_PRIVILEGIO',
                'TP_STATUS',
                'CD_PRESTADOR',
                'SN_ATIVO',
                'SN_SENHA_PLOGIN',
                'SN_ABRE_FECHA_CONTA',
                'CPF',
                'SN_RECEBE_MSG_EXPIRA_CHAVE',
                'SN_ALTERA_AUDITORIA_IN_LOCO',
                'SN_CADASTRA_PACIENTE',
                'SN_ALTERA_CADASTRO_PACIENTE',
                'DT_NASCIMENTO',
                'CD_MATRICULA',
                'DS_EMAIL',
                'SN_CERTIFICADO_DIGITAL',
                'SN_PERMITE_DESVINCULO_PACOTE',
                'SN_ALTERA_PACIENTE_SEM_CPF',
                'SN_ALTERA_OBSERVACAO_GUIA',
                'CD_SENHA'];

    public function __consttruct() {       
    }

    public function getByUsername($userName){
        $query   = $this->db->query('SELECT * FROM DBASGU.USUARIOS WHERE NM_USUARIO = ' . $this->db->escape($userName));
        $results = $query->getResult();
        return $results;      
    }

    public function getByUserLogin($userLogin){
        $query   = $this->db->query('SELECT * FROM DBASGU.USUARIOS WHERE CD_USUARIO = ' . $this->db->escape(substr($userLogin??'',0,20)));
        $results = $query->getResult();
        return $results;      
    }

    public function findByUsername($userName){
        return $this->find($userName);
    }

    public function search($data){
        // pagination
        $limit = $data['limit'] ?? 0;
        $offset = $data['offset'] ?? 0;
        // words
        $palavras = explode( ' ', $data['ds_nome'] . ' ' . ' ' . ' ' );
        // 1,2,3
        $palavra1 = $palavras[0];
        $palavra2 = $palavras[1];
        $palavra3 = $palavras[2];
        $sqlDefault = 'SELECT * FROM DBASGU.USUARIOS ' . 
            ' WHERE NM_USUARIO LIKE ' .  $this->db->escape($data['ds_nome'] . '%') .
            ' OR CD_USUARIO = ' .  $this->db->escape(trim(substr($data['ds_nome'],0,30))) .
            ' OR NM_USUARIO LIKE ' .  $this->db->escape( '%' . $data['ds_nome'] . '%') .
            ' OR NM_USUARIO LIKE ' .  $this->db->escape( '%' . $data['ds_nome'] ) .
            ' OR NM_USUARIO = ' .  $this->db->escape( $data['ds_nome'] ) .
            ' OR ( NM_USUARIO LIKE '.  $this->db->escape( $palavra1 . '%' ) . 
                ' AND NM_USUARIO LIKE ' . $this->db->escape( '%' . $palavra2 . '%' ) . 
                ' AND NM_USUARIO LIKE ' . $this->db->escape( '%' . $palavra3 . '%' ) . ' )';
        
        if ( $limit <= 0 ) {
            $query = $this->db->query( $sqlDefault );
        }
        else {
            // oracle pagination
            $query = $this->db->query(
                "SELECT * FROM 
                    ( SELECT rownum rnum, a.* 
                       FROM ( " . $sqlDefault . ") a " . 
                       ' WHERE rownum <= '. $offset .' + ' . $limit .' ) WHERE rownum >= ' . $offset
            );        
        }
        
        // result
        $results = $query->getResult();
        return $results;
    }

    // from database to array
    public function fromDatarecord( $datarecord ){
        $data = [];
        foreach ($datarecord as $row){            
            $data['cd_usuario'] = $row->CD_USUARIO;
            $data['cpf'] = $row->CPF;
            $data['nm_usuario'] = $row->NM_USUARIO;
            $data['sn_ativo'] = $row->SN_ATIVO;             
        }
        return $data;
    }

    public function getByCpf($data){
        $sqlDefault = 'SELECT * FROM DBASGU.USUARIOS ' . 
            ' WHERE CPF = ' .  $this->db->escape($data);
        $query = $this->db->query( $sqlDefault );       
        // result
        $results = $query->getResult();
        return $results;
    }

    // Insert
    public function insertData($data) {        
        $query = $this->insert($data);
        return $this->getByCpf($data['CPF']);
    }

    public function isAdmin($username) {
        $datarecord = $this->getByUserLogin($username);
        if (count($datarecord)<=0) {
            return false;
        }
        $isAdmin = false;
        foreach ($datarecord as $row){
            if ($row->TP_PRIVILEGIO == 'A') {
                $isAdmin = true;
            }
        }
        return $isAdmin;
    }

    public function isSuperuser($username){
        return $this->isAdmin($username);
    }

}