<?php

namespace App\Models;

use CodeIgniter\Model;
      
class RequirementModel extends Model
{

    protected $table      = 'DBASGU.USUARIOS';
    protected $primaryKey = 'CD_USUARIO';
    protected $returnType = 'array';

    public function __consttruct() {       
    }

    public function getAll(){
        $requirements = [];
        $requirements[] = ['000','Nenhum',0];
        $requirements[] = ['001','Reativar usuário',0];
        $requirements[] = ['002','Bloquear usuário',0];
        $requirements[] = ['003','Refazer senhas',0];
        $requirements[] = ['004','Refazer restrições conforme critérios',1];
        $requirements[] = ['005','Desativar e-mail',0];
        $requirements[] = ['006','Criar e-mail',0];
        $requirements[] = ['007','Alterar período',1];
        $requirements[] = ['008','Alterar setor',1];
        $requirements[] = ['009','Alterar cargo/função',1];
        $requirements[] = ['010','Criar senha de rede',0];
        $requirements[] = ['011','Criar senha de internet',0];
        $requirements[] = ['999','Outros conforme descrição',1];
        return $requirements;
    }

    public function updateData($data){
 
        $sql = "UPDATE DBAMV.TIADMIN_USER SET " . 
                   "  " . 
                   "sn_ativo = " . $this->db->escape($data['sn_ativo']) . ',' .
                   "cd_requerimento = " . $this->db->escape($data['cd_requerimento']) .
                     " WHERE cd_id = " . $data['cd_id'];
        
        $this->db->query($sql);
        return $this->affectedRows();
     }


     

 

}