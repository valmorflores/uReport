<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{

    protected $table      = 'DBAMV.TIADMIN_USER';
    protected $primaryKey = 'cd_id';
    protected $returnType = 'array';

    public function __consttruct() {       
    }

    public function getByUsername($userName){
        $query   = $this->db->query('SELECT * FROM DBAMV.TIADMIN_USER WHERE DS_NOME LIKE ' . "'".$userName."%'");
        $results = $query->getResult();
        return $results;
      // return $this->UserModel->find($userName);
    }

    public function findByUsername($userId){
        return $this->find($userId);
    }

    public function getAllData($limit = null, $page = null){
        if ($limit == null){
            $builder = $this->db->table('DBAMV.TIADMIN_USER');
            $builder->orderby('CD_ID','DESC');
            $query = $builder->get(); 
            $result = $query->getResult();
        } else {
            $builder = $this->db->table('DBAMV.TIADMIN_USER');
            $builder->limit($limit,$page*$limit);
            $builder->orderby('CD_ID','DESC');
            $query = $builder->get(); 
            $result = $query->getResult();
        }
        return $result;
    }

    public function getAllDataCount($limit = null, $page = null){
        $builder = $this->db->query('SELECT count(*) AS COUNT_FIELD FROM DBAMV.TIADMIN_USER');
        $result = $builder->getResult();
        $result_count = 0;
        foreach($result as $row){
            $result_count = $row->COUNT_FIELD;
        }
        return $result_count;
    }

    public function getMyUsers($solicitante, $limit= null, $page= null){
        if ($limit == null){
            $builder = $this->db->table('DBAMV.TIADMIN_USER');        
            $builder->where('DS_SOLICITANTE', $solicitante);
            $builder->orderby('CD_ID','DESC');
            $query = $builder->get(); 
            $result = $query->getResult();
        }
        else
        {
            $builder = $this->db->table('DBAMV.TIADMIN_USER');        
            $builder->where('DS_SOLICITANTE', $solicitante);
            $builder->orderby('CD_ID','DESC');
            $query = $builder->get($limit,$page*$limit); 
            $result = $query->getResult();
        }
        return $result;
    }

    public function getMyUsersCount($solicitante){
        $builder = $this->db->query('SELECT count(*) AS COUNT_FIELD FROM DBAMV.TIADMIN_USER WHERE DS_SOLICITANTE = ' . $this->db->escape($solicitante));
        $result = $builder->getResult();
        $result_count = 0;
        foreach($result as $row){
            $result_count = $row->COUNT_FIELD;
        }
        return $result_count;
    }

    public function get_next_id( $field ){
        $sql = 'SELECT MAX(' . $field . ') as MAXIMO FROM DBAMV.TIADMIN_USER';
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
        $sql = "DELETE FROM DBAMV.TIADMIN_USER WHERE cd_id = " . $id;
        $this->db->query($sql);
        return $this->affectedRows();
    }
    
    // Get by id
    public function getById($id) {
        $sql = "SELECT * FROM DBAMV.TIADMIN_USER WHERE cd_id = " . $id;
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // insert new record
    public function insertNew($data){
        $id = $this->get_next_id( 'CD_ID' );
        $data['cd_id' ] = $id;
        if (!(isset($data['cd_usuario']))){
            $data['cd_usuario' ] = $id;
        }
        if (!(isset($data['cd_tipo']))){
            $data['cd_tipo' ] = 0;
        }
        if (!(isset($data['ds_localtrabalho']))){
            $data['ds_localtrabalho'] = 'NENHUM';
        }
        // $this->db->table('DBAMV.TIADMIN_USER')->insert($data);                
        $sql = "INSERT INTO DBAMV.TIADMIN_USER (" . 
             " cd_id, " . 
             " cd_usuario, " . 
             " cd_tipo, " . 
             " ds_solicitante, " . 
             " cpf, " . 
             " ds_nome, " .              
             " sn_ativo, " . 
             " dt_nascimento, " . 
             " ds_localtrabalho" .
             " ) " . 
            "VALUES (".
                    $this->db->escape($data['cd_id']).", ".
                    $this->db->escape($data['cd_usuario']).", ".
                    $this->db->escape($data['cd_tipo']).", ".
                    $this->db->escape($data['ds_solicitante']).", " .
                    $this->db->escape($data['cpf']).", " .
                    $this->db->escape($data['ds_nome']).", " . 
                    $this->db->escape($data['sn_ativo']).", " . 
                    "TO_DATE(".$this->db->escape($data['dt_nascimento']).",'YYYY/MM/DD')," . 
                    $this->db->escape($data['ds_localtrabalho'])." " . 
                    ")";
        $this->db->query($sql);
        return $id;
        // echo $this->affectedRows();die;
    }

   
    // insert new record / requirement
    public function insertNewRequirement($data){
        $id = $this->get_next_id( 'CD_ID' );
        $data['cd_id' ] = $id;
        $data['cd_usuario' ] = $id;
        // $this->db->table('DBAMV.TIADMIN_USER')->insert($data);                
        $sql = "INSERT INTO DBAMV.TIADMIN_USER (" . 
             " cd_id, " . 
             " cd_tipo, " .
             " cd_requerimento, " .
             " cd_usuario, " . 
             " ds_solicitante, " . 
             " ds_nome, " .              
             " cpf, " .     
             " ds_localtrabalho, " .
             " sn_ativo " . 
             " ) " . 
            "VALUES (".
                    $this->db->escape($data['cd_id']).", ".
                    $this->db->escape($data['cd_tipo']).", ".
                    $this->db->escape($data['cd_requerimento']).", ".
                    $this->db->escape($data['cd_usuario']).", ".
                    $this->db->escape($data['ds_solicitante']).", " .                    
                    $this->db->escape($data['ds_nome']).", " . 
                    $this->db->escape($data['cpf']).", " . 
                    $this->db->escape($data['ds_localtrabalho']).", " . 
                    $this->db->escape($data['sn_ativo'])." " . 
                    ")";
        $this->db->query($sql);
        // echo $this->affectedRows();die;
    }

        
    public function updateData($data){
 
       $sql = "UPDATE DBAMV.TIADMIN_USER SET " . 
                  "  " . 
                    "cd_usuario = " . $this->db->escape($data['cd_usuario']) . ", " . 
                    "ds_nome = " . $this->db->escape($data['ds_nome']) . ", " . 
                    "dt_nascimento = TO_DATE(". $this->db->escape($data['dt_nascimento']) . ",'YYYY/MM/DD')" . ", " . 
                    "cpf = " . $this->db->escape($data['cpf']) . ", " . 
                    "nr_conselho = " . $data['nr_conselho'] . ", " .
                    'ds_localtrabalho = ' . $this->db->escape($data['ds_localtrabalho']) . ", " .
                    "ds_cargo = " . $this->db->escape($data['ds_cargo']) . ", " .
                    "sn_ativo = " . $this->db->escape($data['sn_ativo']) . ", " .
                    "sn_rede = " . $this->db->escape($data['sn_rede']) . ", " .
                    "sn_cirurgia = " . $this->db->escape($data['sn_cirurgia']) . "," .
                    "ds_especialidade = " . $this->db->escape($data['ds_especialidade']) . "," .
                    "ds_horario = " . $this->db->escape($data['ds_horario']) . "," .
                    "ds_perfilsimilar = " . $this->db->escape($data['ds_perfilsimilar']) . "," .
                    "dt_admissao = TO_DATE(". $this->db->escape($data['dt_admissao'])  . ",'YYYY/MM/DD')" . ", " . 
                    "ds_estagresidper = " . $this->db->escape($data['ds_estagresidper']) . "," .
                    "cd_prestador = " . $data['cd_prestador'] . "," .
                    "nr_matricula = " . $this->db->escape($data['nr_matricula']) . 
                    " WHERE cd_id = " . $data['cd_id'];
       
       $this->db->query($sql);
       return $this->affectedRows();
    }

    public function fromDatarecord( $datarecord ){
        $data = [];
        foreach ($datarecord as $row){
            $data['cd_id'] = $row->CD_ID;
            $data['cd_usuario'] = $row->CD_USUARIO;
            $data['ds_nome'] = $row->DS_NOME;
            $data['dt_nascimento'] = $this->dateFromBase($row->DT_NASCIMENTO);
            $data['cpf'] = $row->CPF;
            $data['nr_matricula'] = $row->NR_MATRICULA;
            $data['nr_conselho'] = $row->NR_CONSELHO;
            $data['ds_localtrabalho'] = $row->DS_LOCALTRABALHO;
            $data['ds_cargo'] = $row->DS_CARGO;
            $data['ds_horario'] = $row->DS_HORARIO;
            $data['sn_ativo'] = $row->SN_ATIVO;
            $data['sn_cirurgia'] = $row->SN_CIRURGIA;
            $data['ds_especialidade'] = $row->DS_ESPECIALIDADE;
            $data['ds_estagresidper'] = $row->DS_ESTAGRESIDPER;
            $data['ds_perfilsimilar'] = $row->DS_PERFILSIMILAR;            
            $data['dt_admissao'] = $this->dateFromBase($row->DT_ADMISSAO);
            $data['ds_solicitante'] = $row->DS_SOLICITANTE;
            $data['cd_tipo'] = $row->CD_TIPO;
            $data['cd_requerimento'] = $row->CD_REQUERIMENTO;
            $data['sn_rede'] = $row->SN_REDE;
            $data['cd_prestador'] = $row->CD_PRESTADOR;
        }
        return $data;
    }

    public function dateFromBase($date=''){
        // dd/mm/yyyy
        if ($date==null){
            $date='';
        }
        $dateNew = substr($date,3,2) . '/' . substr($date,0,2) . '/' . substr($date,6,2);
        $finaldate = date('Y-m-d', strtotime($dateNew));
        return $finaldate;
    }

    public function setValid($id,$status) {
        if ($status){
            $validado = 'S';
        }
        else {
            $validado = 'N';
        }
        $sql = "UPDATE DBAMV.TIADMIN_USER SET " .         
          "sn_validado = " . $this->db->escape($validado) . 
          " WHERE cd_id = " . $id;
        $this->db->query($sql);
        return $this->affectedRows();
    }


    /* $id - id of user record (cd_id) */
    public function getItemsById($id){
        $sql = "SELECT * FROM DBAMV.TIADMIN_USER_ITEMS WHERE cd_user_id = " . $id . ' ORDER BY nr_check_id';
        $query = $this->db->query($sql);
        $result = $query->getResult();
        $items = [];
        foreach ($result as $row){
            if ($row->SN_CHECKED=='S'){
                $items[$row->NR_CHECK_ID] = 1;
            }
            else {
                $items[$row->NR_CHECK_ID] = 0;
            }
        }
        // start
        $items[0] = $items[0] ?? 0;
        $items[1] = $items[1] ?? 0;
        $items[2] = $items[2] ?? 0;
        $items[3] = $items[3] ?? 0;
        $items[4] = $items[4] ?? 0;
        $items[5] = $items[5] ?? 0;
        $items[6] = $items[6] ?? 0;
        $items[7] = $items[7] ?? 0;
        $items[8] = $items[8] ?? 0;
        $items[9] = $items[9] ?? 0;
        // more
        $items[80] = $items[80] ?? 0;
        $items[81] = $items[81] ?? 0;
        $items[82] = $items[82] ?? 0;
        return $items;
    }

    public function createItem($id, $itemId) {
        $sql = "SELECT * FROM DBAMV.TIADMIN_USER_ITEMS " . 
               " WHERE cd_user_id = " . $id . " AND nr_check_id = " . $itemId;
        $query = $this->db->query($sql);
        $result = $query->getResult();
        log_message('info', 'Query about: ' . $id . ' - ' . $itemId );
        log_message('info', 'With result? ' . isset($result) );
        $lexists = false;
        foreach ($result as $row) {
            log_message('info', 'Result: ' . $row->CD_USER_ID . ', ' . $row->NR_CHECK_ID );
            $lexists = true;
        }   
        if ( !($lexists) ){
            log_message('info', 'Adicionar items: ' . $id . ' - ' . $itemId );
            $sql = "INSERT INTO DBAMV.TIADMIN_USER_ITEMS " . 
                 " ( cd_user_id, nr_check_id, sn_checked ) VALUES " . 
                 " ( " . $id . ', ' . $itemId . ', ' . $this->db->escape('N') . ')';
            $query = $this->db->query($sql);
            return $this->affectedRows();
        }
    }

    
    public function updateItemsData($id, $items) {
        log_message('info', 'Update items data, start' );
        $options = array( 0, 1, 2, 3, 80, 81, 82 );
        for ($i=0;$i<99;$i++){
            if ( in_array( $i, $options ) ){
                log_message('info', '--------------------' );
                log_message('info', 'Content: ' . $id . ' ' . $i . '[' . $items[$i] . ']' );
                $this->createItem($id,$i);
                if ($items[$i]==='on'){
                    $this->updateItem($id,$i,'S'); 
                } else if ($items[$i]===0){
                   $this->updateItem($id,$i,'N');
                } else if ($items[$i]==='0'){
                    $this->updateItem($id,$i,'N');
                } else {
                   $this->updateItem($id,$i,'S');                    
                }
            }
        }
        log_message('info', 'Update items data, end' );
    }

    public function updateItem($cd_user_id, $nr_check_id, $sn_checked){
        log_message('info', 'Update items [' . $cd_user_id . ',' . $nr_check_id . ',' .$sn_checked .']' );
        $sql = "UPDATE DBAMV.TIADMIN_USER_ITEMS SET sn_checked = " .$this->db->escape($sn_checked) . 
            ' WHERE cd_user_id = ' . $cd_user_id . ' AND nr_check_id = ' . $nr_check_id;
        $query = $this->db->query($sql);
        return $this->affectedRows();
    }
        
}

/*



 cd_id            NUMBER(10,0)  NULL,
  cd_usuario       VARCHAR2(30)  NULL,
  ds_solicitante   VARCHAR2(20)  NULL,
  ds_nome          VARCHAR2(100) NULL,
  dt_nascimento    DATE          NULL,
  nr_matricula     VARCHAR2(100) NULL,
  cpf              VARCHAR2(11)  NULL,
  sn_ativo         VARCHAR2(1)   DEFAULT 'S' NOT NULL,
  ds_horario       VARCHAR2(100) NULL,
  ds_localtrabalho VARCHAR2(50)  NULL,
  ds_cargo         VARCHAR2(50)  NULL,
  dt_admissao      DATE          NULL,
  nr_conselho      NUMBER        NULL,
  sn_cirurgia      VARCHAR2(1)   DEFAULT 'N' NOT NULL,
  ds_especialidade VARCHAR2(60)  NULL,
  ds_estagresidper VARCHAR2(60)  NULL


SELECT * FROM (
    SELECT rownum rnum, a.* 
    FROM(
        SELECT fieldA,fieldB 
        FROM table 
        ORDER BY fieldA 
    ) a 
    WHERE rownum <=5+14
)
WHERE rnum >=5



  */