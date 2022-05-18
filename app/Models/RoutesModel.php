<?php

namespace App\Models;
use CodeIgniter\Model;
      

class RoutesModel extends Model {

   private $map;

   public function __consttruct() {       
       
   }


   public function getAll() { 
       $this->loadAll();
       return $this->map;
   }

   public function loadAll() {       
        $url_base = 'http://srvm24:89';
        $this->map = [];
        $this->map[] = [
           1,
           'Relatório de mapa, dieta unificada, separado por unidade',
           $url_base . '/app/reports/urep/public/report/rdirect/rel_mapa_dieta_por_atendimento_unificada' ];
        $this->map[] = [
            2,
            'Relatório de mapa, dieta unificada, separado por unidade (pacientes com leitos)',
            $url_base . '/app/reports/urep/public/report/rdirect/rel_mapa_dieta_por_atendimento_unificada_com_leito' ];
        $this->map[] = [
            3,
            'Relatório de mapa, dieta unificada, separado por unidade (pacientes sem leitos)',
            $url_base . '/app/reports/urep/public/report/rdirect/rel_mapa_dieta_por_atendimento_unificada_sem_leito' ];
        $this->map[] = [
            4,
            'Relatório de dieta detalhada por atendimento (somente um atendimento)',
            $url_base . '/app/reports/urep/public/report/r/rel_mapa_dieta_por_atendimento_validade' ];
   }

   public function getUrl($id) {
   $url = '';
   $this->loadAll();
   $map = $this->map;
   foreach($map as $row){
       if ($row[0]==$id){
              $url = $row[2];
              break;
          }
       }
       return $url;
   }

}


