<?php 

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdminUserModel;

function validaCPF($cpf) {
 
 // Extrai somente os números
 $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
  
 // Verifica se foi informado todos os digitos corretamente
 if (strlen($cpf) != 11) {
     return false;
 }

 // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
 if (preg_match('/(\d)\1{10}/', $cpf)) {
     return false;
 }

 // Faz o calculo para validar o CPF
 for ($t = 9; $t < 11; $t++) {
     for ($d = 0, $c = 0; $c < $t; $c++) {
         $d += $cpf[$c] * (($t + 1) - $c);
     }
     $d = ((10 * $d) % 11) % 10;
     if ($cpf[$c] != $d) {
         return false;
     }
 }
 return true;

}

function validaNumbersOnly( $information = ''){
 if (trim($information??'')==''){
     return false;
 }
 $i = 0;
 $res = true;
 for ($i=0; $i<strlen($information); $i++){
     if ( strpos( '-0123456789', substr($information, $i,1)) <= 0 ){
         $res = false;
         break;
     }
 }
 return $res;
}


function convertToDbValid($dateToValidate){
    if (strpos($dateToValidate,'/')==2){
        $dateToValidate= implode('-', array_reverse(explode('/', $dateToValidate)));
    }
    return $dateToValidate;
}

function convertToInputValid($dateToValidate){
    // 1976-10-15, convert to 15/10/1976
    if (strpos($dateToValidate,'-')==4){
       $dateToValidate= implode('/', array_reverse(explode('-', $dateToValidate)));
    }
    return $dateToValidate;
}
