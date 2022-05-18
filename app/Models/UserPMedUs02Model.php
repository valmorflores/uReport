<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPMedUs02Model extends Model
{

    protected $table      = 'PMED.US02';
    protected $primaryKey = 'USERNUMBER';
    protected $returnType = 'array';
    protected $allowedFields = [
        'usernumber',
        'speciality',
        'aheadertype',
        'pacviewer',
        'pacviewerlaudos',
        'pacshow',
        'tratpac',
        'imageeditor',
        'texteditor',
        'others',
        'modelnumber1',
        'modelnumber2',
        'modelnumber3',
        'modelnumber4',
        'borderup',
        'borderdown',
        'borderleft',
        'borderright',
        'borderheader',
        'borderfooter',
        'crm',
        'address',
        'startsex',
        'startcity',
        'startstate',
        'defaultcid9',
        'defaultcid10',
        'defaultamb92',
        'defaultamb96',
        'defaultciefas',
    ];

    public function __consttruct() {       
    }

    public function getById($userId){
        $query   = $this->db->query('SELECT * FROM PMED.US02 WHERE usernumber = ' . $userId);
        $results = $query->getRowArray();
        return $results;
    }

    public function findByUsername($userName){
        return $this->find($userName);
    }

    // Insert
    public function insertData($data) {
        $exists = $this->exists($data['USERNUMBER']);
        if (!$exists) {
            $builder = $this->db->table('PMED.US02');
            $builder->insert($data);
        }
        return $this->getById($data['USERNUMBER']);
    }

    public function exists($id) {
        $recordFound = $this->getById($id);
        $exists = isset($data['USERNUMBER']);
        return $exists;
    }

    // copy de A para B, onde A é primeiro parametro e B é o segundo
    public function copy($userdefault, $usernumber) {
        $data = $this->getById($userdefault);
        $data['USERNUMBER'] = $usernumber;
        if ( $this->exists($usernumber) ) {
            // update
        }
        else
        {
            $this->insertData($data);
        }
        return true;
    }


    // Next 
    public function get_next_id( $field ){
        $sql = 'SELECT MAX(' . $field . ') as MAXIMO FROM PMED.US02';
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
CREATE TABLE us02 (
  usernumber      NUMBER(7,0)   NOT NULL,
  speciality      VARCHAR2(3)   NOT NULL,
  aheadertype     NUMBER(1,0)   DEFAULT 4 NOT NULL,
  pacviewer       NUMBER(4,0)   DEFAULT 2 NOT NULL,
  pacviewerlaudos NUMBER(4,0)   DEFAULT 2 NOT NULL,
  pacshow         NUMBER(3,0)   DEFAULT 0 NOT NULL,
  tratpac         VARCHAR2(20)  NULL,
  imageeditor     VARCHAR2(150) NULL,
  texteditor      VARCHAR2(150) DEFAULT 'Notepad.exe' NULL,
  others          VARCHAR2(40)  NULL,
  modelnumber1    NUMBER(7,0)   DEFAULT -1 NOT NULL,
  modelnumber2    NUMBER(7,0)   DEFAULT -1 NOT NULL,
  modelnumber3    NUMBER(7,0)   DEFAULT -1 NOT NULL,
  modelnumber4    NUMBER(7,0)   DEFAULT -1 NOT NULL,
  borderup        NUMBER(5,2)   DEFAULT 2.5 NOT NULL,
  borderdown      NUMBER(5,2)   DEFAULT 2.5 NOT NULL,
  borderleft      NUMBER(5,2)   DEFAULT 2.5 NOT NULL,
  borderright     NUMBER(5,2)   DEFAULT 2.5 NOT NULL,
  borderheader    NUMBER(5,2)   DEFAULT 1.3 NOT NULL,
  borderfooter    NUMBER(5,2)   DEFAULT 1.3 NOT NULL,
  crm             VARCHAR2(15)  NULL,
  address         VARCHAR2(40)  NULL,
  startsex        VARCHAR2(1)   NULL,
  startcity       VARCHAR2(25)  NULL,
  startstate      VARCHAR2(2)   NULL,
  defaultcid9     VARCHAR2(9)   NULL,
  defaultcid10    VARCHAR2(9)   NULL,
  defaultamb92    VARCHAR2(15)  NULL,
  defaultamb96    VARCHAR2(15)  NULL,
  defaultciefas   VARCHAR2(15)  NULL
)
  STORAGE (
    INITIAL     128 K
    NEXT       1024 K
  )
/

PROMPT ALTER TABLE us02 ADD PRIMARY KEY
ALTER TABLE us02
  ADD PRIMARY KEY (
    usernumber
  )
  USING INDEX
    STORAGE (
      INITIAL     128 K
      NEXT       1024 K
    )
/

PROMPT ALTER TABLE us02 ADD FOREIGN KEY
ALTER TABLE us02
  ADD FOREIGN KEY (
    usernumber
  ) REFERENCES us01 (
    usernumber
  )
/





*/