<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{

    protected $table      = 'DBAMV.PACIENTE';
    protected $primaryKey = 'CD_PACIENTE';
    protected $returnType = 'array';
    protected $allowedFields = [
        "CD_PACIENTE",
        "CD_CIDADE",
        "CD_DIS_SAN",
        "TP_SITUACAO",
        "NM_MNEMONICO",
        "NM_PACIENTE",
        "TP_SEXO",
        "TP_ESTADO_CIVIL",
        "CD_CIDADE_TEM",
        "DS_ENDERECO",
        "DT_CADASTRO",
        "DT_NASCIMENTO",
        "TP_COR",
        "NM_MAE",
        "CD_CLA_ECO",
        "CD_CIDADANIA",
        "CD_TIP_MOR",
        "CD_TIP_RES",
        "CD_GRAU_INS",
        "CD_RELIGIAO",
        "CD_PROFISSAO",
        "NR_CEP",
        "NR_DOCUMENTO",
        "HR_CADASTRO",
        "NR_FONE",
        "NM_BAIRRO",
        "NM_PAI",
        "CD_DIS_SAN_MUITOS",
        "DS_TRABALHO",
        "NM_CONJUGE",
        "TP_SANGUINEO",
        "SN_DOADOR",
        "DS_CHECAPAC",
        "NM_USUARIO",
        "CD_CNS",
        "NR_CNS",
        "NR_CPF",
        "DS_COMPLEMENTO",
        "NR_ENDERECO",
        "NR_RG_NASC",
        "NR_IDENTIDADE",
        "DS_OM_IDENTIDADE",
        "DS_OBSERVACAO",
        "CD_PACIENTE_ANTIGO",
        "DT_ULTIMA_ATUALIZACAO",
        "CD_NATURALIDADE",
        "CD_MULTI_EMPRESA",
        "DS_ATRIBUTO1",
        "SN_ALT_DADOS_ORA_APP",
        "EMAIL",
        "CD_PACIENTE_INTEGRA",
        "DT_INTEGRA",
        "CD_SEQ_INTEGRA",
        "DT_INATIVO",
        "CD_PIS_PASEP",
        "TP_CERTIDAO",
        "NM_CARTORIO",
        "DS_LIVRO",
        "DS_FOLHA",
        "DT_EMISSAO_CERTIDAO",
        "DT_EMISSAO_IDENTIDADE",
        "CD_UF_EMISSAO_IDENTIDADE",
        "DT_ENTRADA_ESTRANGEIRO",
        "NR_CTPS",
        "NR_SERIE_CTPS",
        "DT_EMISSAO_CTPS",
        "CD_UF_EMISSAO_CTPS",
        "NR_TITULO_ELEITORAL",
        "NR_ZONA_TITULO_ELEITORAL",
        "NR_SECAO_TITULO_ELEITORAL",
        "SN_RECEBE_CONTATO",
        "CD_TIPO_LOGRADOURO",
        "SN_PERMITE_AGENDAR_PARA_SUS",
        "CD_CATEGORIA_OPINIAO",
        "SN_VIP",
        "CD_PAIS",
        "CD_PACIENTE_EXTERNO",
        "NR_DDD_FONE",
        "NR_DDD_CELULAR",
        "NR_CELULAR",
        "SN_NOTIFICACAO_SMS",
        "CD_ETNIA",
        "DS_HASH",
        "NR_DOCUMENTO_ESTRANGEIRO",
        "DT_ENTRADA_BRASIL",
        "DT_NATURALIZACAO",
        "NR_PORTARIA_NATURALIZACAO",
        "NR_DDI_FONE",
        "NR_DDI_CELULAR",
        "NR_DDI_FONE_COMERCIAL",
        "NR_DDD_FONE_COMERCIAL",
        "NR_FONE_COMERCIAL",
        "SN_ENDERECO_SEM_NUMERO",
        "CD_IDENTIFICADOR_PESSOA",
        "SN_UTILIZA_NOME_SOCIAL",
        "NM_SOCIAL_PACIENTE",
        "CD_BANCO",
        "NR_AGENCIA",
        "DS_AGENCIA",
        "NR_CONTA",
        "SN_FREQUENTA_ESCOLA",
        "DS_CARGO_TRABALHO",
        "NR_REGISTRO_FUNCIONAL_TRABALHO",
        "DS_VINCLULO_TRABALHO",
        "DS_HORARIO_TRABALHO",
        "TP_PACIENTE",
        "CD_TIP_PAREN",
        "DS_COMPLEMENTO_TUTOR",
        "NM_TUTOR",
        "DT_NASCIMENTO_TUTOR",
        "TP_SEXO_TUTOR",
        "NR_CPF_TUTOR",
        "DT_CADASTRO_MANUAL"
    ];

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
        $nome = $data['ds_nome'];
        $palavra1 = $palavras[0];
        $palavra2 = $palavras[1];
        $palavra3 = $palavras[2];
        $sqlDefault = 'SELECT * FROM DBAMV.PACIENTE ' . 
            ' WHERE NM_PACIENTE LIKE ' .  $this->db->escape( $nome . '%' ) .
            ' OR NM_PACIENTE LIKE ' . $this->db->escape( '%' . $nome . '%' ) .
            ' OR NM_PACIENTE LIKE ' .  $this->db->escape( '%' . $nome ) . 
            ' OR NM_PACIENTE = ' . $this->db->escape( $data['ds_nome'] ) .
            ' OR ( NM_PACIENTE LIKE '. $this->db->escape( $palavra1 . '%' ) . 
                ' AND NM_PACIENTE LIKE ' . $this->db->escape( '%' . $palavra2 . '%' ) . 
                ' AND NM_PACIENTE LIKE ' . $this->db->escape( '%' . $palavra3 . '%' ) . ' )';
        
        if ( $limit <= 0 ) {
            $query = $this->db->query( $sqlDefault );
        }
        else {
            //var_dump($sqlDefault);die;
            //$query = $this->db->query( $sqlDefault );
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