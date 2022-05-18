<?php


function isProfileAdmin(){
    $session = session();
    return $session->get('is_admin') == 'S';
}

function setProfileAsAdmin(){
    $session = session();
    $session->set('is_admin', 'S' );
    return 1;
}

function setProfileAsNormal(){
    $session = session();
    $session->set('is_admin', 'N' );
    return 1;
}

function me(){
    $session = session();
    return '*CORRIGIR*USER*';
    //return $session->get('username') ?? '';
}

function setMe($username){
    $session = session();
    $session->set(['username'=>$username]);    
}


