<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderModel extends Model
{

    protected $table      = 'DBAMV.PRESTADOR';
    protected $primaryKey = 'CD_PRESTADOR';
    protected $returnType = 'array';
    protected $allowedFields = [
        'CD_PRESTADOR',
        'NR_CPF_CGC',
        'TP_SITUACAO',
        'NM_PRESTADOR',
        'NM_MNEMONICO',
        'TP_CORPO_CLINICO',
        'DS_CODIGO_CONSELHO',
        'CD_CONSELHO',
        'CD_CIDADE',
        'SN_REPASSE_FATURA_AMB_SUS',
        'SN_ANESTESISTA',
        'SN_CIRURGIAO',  
        'SN_OUTROS',
        'SN_AUXILIAR',
        'TP_VINCULO',
        'SN_ATUANTE',
        'TP_DOCUMENTACAO',
        'SN_ALT_DADOS_ORA_APP',
        'CD_MULTI_EMPRESA',
        'SN_CESSAO_CREDITO',
        'SN_AUDITOR_SUS',
        'TP_PRESTADOR',
        'CD_TIP_PRESTA',
        'SN_MOSTRA_ENDERECO',
        'SN_MOSTRA_ENDERECO_COM',
        'TP_REMESSA',
        'DT_NASCIMENTO',
        'SN_LIBERA_EXAME'];

    public function __consttruct() {       
    }

    public function findByUsername($userName){
        return $this->find($userName);
    }

    public function search($data){
        // pagination
        $limit = $data['limit'] ?? 0;
        $offset = $data['offset'] ?? 0;
        // words
        $palavras = explode( ' ', $data['nm_prestador'] . ' ' . ' ' . ' ' );
        // 1,2,3
        $palavra1 = $palavras[0];
        $palavra2 = $palavras[1];
        $palavra3 = $palavras[2];
        $sqlDefault = 'SELECT * FROM DBAMV.PRESTADOR ' . 
            ' WHERE NM_PRESTADOR LIKE ' .  $this->db->escape($data['nm_prestador'] . '%') .
            ' OR NM_PRESTADOR = ' .  $this->db->escape(trim(substr($data['nm_prestador'],0,30))) .
            ' OR NM_PRESTADOR LIKE ' .  $this->db->escape( '%' . $data['nm_prestador'] . '%') .
            ' OR NM_PRESTADOR LIKE ' .  $this->db->escape( '%' . $data['nm_prestador'] ) .
            ' OR NM_PRESTADOR = ' .  $this->db->escape( $data['nm_prestador'] ) .
            ' OR ( NM_PRESTADOR LIKE '.  $this->db->escape( $palavra1 . '%' ) . 
                ' AND NM_PRESTADOR LIKE ' . $this->db->escape( '%' . $palavra2 . '%' ) . 
                ' AND NM_PRESTADOR LIKE ' . $this->db->escape( '%' . $palavra3 . '%' ) . ' )';
        
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
            $data['cd_prestador'] = $row->CD_PRESTADOR;
            $data['nr_cpf_cgc'] = $row->NR_CPF_CGC;
            $data['nm_prestador'] = $row->NM_PRESTADOR;
        }
        return $data;
    }

    // GET by CPF or CGC
    public function getByCpfCgc($data){
        $sqlDefault = 'SELECT * FROM DBAMV.PRESTADOR ' . 
            ' WHERE NR_CPF_CGC = ' .  $this->db->escape($data);
        $query = $this->db->query( $sqlDefault );       
        // result
        $results = $query->getResult();
        return $results;
    }

    // GET by Id
    public function getById($data){
        $sqlDefault = 'SELECT * FROM DBAMV.PRESTADOR ' . 
            ' WHERE CD_PRESTADOR = ' .  $this->db->escape($data);
        $query = $this->db->query( $sqlDefault );       
        // result
        $results = $query->getResult();
        return $results;
    }

    // Next record
    public function insertData($data) {
        $cd_prestador = $this->get_next_id('CD_PRESTADOR');
        if (!isset($cd_prestador)){
            $cd_prestador = 1;
        }
        $data['CD_PRESTADOR'] = $cd_prestador;
        var_dump($data);
        $query = $this->insert($data);
        return $this->getByCpfCgc($data['NR_CPF_CGC']);
    }

    public function updateBasicData($dataOrigin) {
        if (stripos($dataOrigin['DS_CARGO'],"enfermagem")>0) {
            $data['CD_CONSELHO'] = '16';
            $data['CD_TIP_PRESTA'] = '23';
        }
        else if (stripos($dataOrigin['DS_CARGO'],"nfermei")>0) {
            $data['CD_CONSELHO'] = '16';
            $data['CD_TIP_PRESTA'] = '4';
        }
        else
        {
            $data['CD_CONSELHO'] = '1';
            $data['CD_TIP_PRESTA'] = '1';
        }
        $data['CD_PRESTADOR'] = $dataOrigin['CD_PRESTADOR'];
        $data['NR_CPF_CGC'] = $dataOrigin['NR_CPF_CGC'];
        $data['NM_PRESTADOR'] = strtoupper( $dataOrigin['NM_PRESTADOR'] );
        $data['DS_CODIGO_CONSELHO'] = $dataOrigin['NR_CONSELHO'];
        $data['DT_NASCIMENTO'] = $dataOrigin['DT_NASCIMENTO'];
        $exp = explode(" ", $dataOrigin['NM_PRESTADOR']);
        $string = current($exp) . " " . end($exp);
        $data['NM_MNEMONICO'] = substr(strtoupper($string), 0, 20);
        // Update routine
        $sql = "UPDATE DBAMV.PRESTADOR SET " . 
                  " NM_PRESTADOR = " . $this->db->escape($data['NM_PRESTADOR']) . ", " . 
                    "NM_MNEMONICO = " . $this->db->escape($data['NM_MNEMONICO']) . ", " . 
                    "NR_CPF_CGC = " . $this->db->escape($data['NR_CPF_CGC']) . ", " . 
                    "DT_NASCIMENTO = TO_DATE(". $this->db->escape($data['DT_NASCIMENTO']) . ",'YYYY-MM-DD')" . ", " .
                    "DS_CODIGO_CONSELHO = " . $data['DS_CODIGO_CONSELHO'] . " " .
                    " WHERE CD_PRESTADOR = " . $data['CD_PRESTADOR'];       
       $this->db->query($sql);
       return $this->affectedRows();
    }

    public function get_next_id( $field ){
        $sql = 'SELECT MAX(' . $field . ') as MAXIMO FROM DBAMV.PRESTADOR';
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