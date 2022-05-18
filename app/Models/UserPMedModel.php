<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPMedModel extends Model
{

    protected $table      = 'PMED.US01';
    protected $primaryKey = 'USERNUMBER';
    protected $returnType = 'array';
    protected $allowedFields = [
                'usernumber',
                'occupationcod',
                'usercode',
                'name',
                'pass',
                'level_',
                'access_',
                'usertype',
                'speciality',
                'cfgaccess',
                'doreply',
                'attendancelocalcod',
                'address',
                'district',
                'city',
                'state',
                'zip',
                'phone',
                'fax',
                'email',
                'sex',
                'birthdate',
                'specialtycod',
                'registration',
                'id',
                'bankcod',
                'agencynumber',
                'countnumber',
                'active',
                'hasnotebook',
                'isuser',
                'jurphysperson',
                'cgc_cpf',
                'workplace',
                'linksistemainterno',
                'passdatechange',
                'providercod',
                'prestadorexterno',
                'enterprisecod',
                'tipoprofissional',
                'codigoexterno',
                'integ_ems',
                'userad',
                'activead'];

    public function __consttruct() {       
    }

    public function getByUsername($userName){
        $query   = $this->db->query('SELECT * FROM PMED.US01 WHERE name = ' . $this->db->escape($userName));
        $results = $query->getResult();
        return $results;      
    }

    public function getByUserLogin($userLogin){
        $query   = $this->db->query('SELECT * FROM PMED.US01 WHERE usercode = ' . $this->db->escape(substr($userLogin,0,20)));
        $results = $query->getResult();
        return $results;      
    }

    public function findByUsername($userName){
        return $this->find($userName);
    }

    // from database to array
    public function fromDatarecord( $datarecord ){
        $data = $datarecord;        
        return $data;
    }

    public function getByCpfCgc($data){
        $sqlDefault = 'SELECT * FROM pmed.us01 ' . 
            ' WHERE CGC_CPF = ' ."'" . $data . "'";
        $query = $this->db->query( $sqlDefault );       
        // result
        $results = $query->getResult();
        return $results;
    }

    public function getRowByCpfCgc($data){
        $sqlDefault = 'SELECT * FROM pmed.us01 ' . 
            ' WHERE CGC_CPF = ' ."'" . $data . "'";
        $query = $this->db->query( $sqlDefault );       
        // result
        $results = $query->getRowArray();
        return $results;
    }


    // Insert
    public function insertData($data) {
        $recordFound = $this->getByCpfCgc($data['CGC_CPF']);        
        $exists = false;
        foreach ($recordFound as $row) {
            $exists = true;
        }
        if (!$exists) {
            $data['USERNUMBER'] = $this->get_next_id('USERNUMBER');
            $builder = $this->db->table('PMED.US01');
            $builder->insert($data);
        }
        return $this->getRowByCpfCgc($data['CGC_CPF']);
    }

    // Next 
    public function get_next_id( $field ){
        $sql = 'SELECT MAX(' . $field . ') as MAXIMO FROM PMED.US01';
        $query = $this->db->query($sql);
        $results = $query->getResult();
        $id = 0;
        foreach ($results as $row) {
            $id = $row->MAXIMO;
            break;
        }
        return $id+1;
    }

}


/*
PROMPT CREATE TABLE us01
CREATE TABLE us01 (
  usernumber         NUMBER(7,0)  NOT NULL,
  occupationcod      NUMBER(3,0)  NULL,
  usercode           VARCHAR2(30) NULL,
  name               VARCHAR2(40) NOT NULL,
  pass               VARCHAR2(40) NULL,
  level_             NUMBER(3,0)  NULL,
  access_            VARCHAR2(5)  NULL,
  usertype           VARCHAR2(1)  NOT NULL,
  speciality         VARCHAR2(3)  NULL,
  cfgaccess          VARCHAR2(1)  DEFAULT 'F' NOT NULL,
  doreply            VARCHAR2(1)  DEFAULT 'F' NOT NULL,
  attendancelocalcod NUMBER(7,0)  NULL,
  address            VARCHAR2(40) NULL,
  district           VARCHAR2(20) NULL,
  city               VARCHAR2(25) NULL,
  state              VARCHAR2(3)  NULL,
  zip                VARCHAR2(15) NULL,
  phone              VARCHAR2(40) NULL,
  fax                VARCHAR2(20) NULL,
  email              VARCHAR2(40) NULL,
  sex                VARCHAR2(1)  NULL,
  birthdate          DATE         NULL,
  specialtycod       NUMBER(5,0)  NULL,
  registration       VARCHAR2(20) NULL,
  id                 VARCHAR2(15) NULL,
  bankcod            NUMBER(5,0)  NULL,
  agencynumber       VARCHAR2(5)  NULL,
  countnumber        VARCHAR2(10) NULL,
  active             VARCHAR2(1)  DEFAULT 'T' NOT NULL,
  hasnotebook        VARCHAR2(1)  DEFAULT 'T' NULL,
  isuser             VARCHAR2(1)  DEFAULT 'T' NOT NULL,
  jurphysperson      VARCHAR2(1)  NULL,
  cgc_cpf            VARCHAR2(16) NULL,
  workplace          VARCHAR2(30) NULL,
  linksistemainterno VARCHAR2(40) NULL,
  passdatechange     DATE         NULL,
  providercod        NUMBER(9,0)  NULL,
  prestadorexterno   VARCHAR2(1)  NULL,
  enterprisecod      NUMBER(10,0) NULL,
  tipoprofissional   VARCHAR2(1)  NULL,
  codigoexterno      NUMBER(9,0)  NULL,
  integ_ems          CHAR(1)      NULL,
  userad             VARCHAR2(40) NULL,
  activead           VARCHAR2(1)  DEFAULT 'F' NULL
)
  STORAGE (
    INITIAL     128 K
    NEXT       1024 K
  )





*/