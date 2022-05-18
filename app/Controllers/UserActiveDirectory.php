<?php

namespace App\Controllers;
use App\Models\AdminUserModel;
use App\Models\UserModel;
use App\Models\AdminUserCommentsModel;

const LDAP_HOSTNAME = 'srvm11';
const LDAP_DOMAIN = 'cardiologia.org';

class UserActiveDirectory extends BaseController 
{
    private $session;

    public function __construct()
    {
        // Create a shared instance of the model
        $this->UserModel = new UserModel();        
        $this->AdminUserModel = new AdminUserModel();
        $this->AdminUserCommentsModel = new AdminUserCommentsModel();
        $this->session = session();
        helper('profile');
    }

    public function index()
    {   
       var_dump($this->UserModel);
    }

    public function show($person){
        $info = $this->getInfo($person);
        var_dump($info);
    }

    public function getinfo($person)
    {

        $ldap_columns = NULL;
        $ldap_connection = NULL;
        $ldap_password = 'vv160302';
        $ldap_username = 'CARDIOLOGIA\valmorpf';
        
        //------------------------------------------------------------------------------
        // Connect to the LDAP server.
        //------------------------------------------------------------------------------
        $ldap_connection = ldap_connect(LDAP_HOSTNAME);
        if (FALSE === $ldap_connection){
            die("<p>Failed to connect to the LDAP server: ". LDAP_HOSTNAME ."</p>");
        }
        else
        {
            //var_dump($ldap_connection);
        }
        
        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
        ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.
        
        $ldap_bind = ldap_bind($ldap_connection, $ldap_username, $ldap_password);
        if (TRUE !== $ldap_bind){
            die('<p>Failed to bind to LDAP server.</p>');
        }
        $ldap_base_dn = 'DC=cardiologia,DC=org';
        //$person = 'VALMORPF';
        $filter="(|(sn=$person*)(givenname=$person*)(cn=$person*)(samaccountname=$person))";
        $justthese = array("cn", "ou", "sn", "givenname", "mail", "samaccountname");
        
        $sr=ldap_search($ldap_connection, $ldap_base_dn, $filter, $justthese);        
        $info = ldap_get_entries($ldap_connection, $sr);        
        //echo $info["count"]." entries returned\n";
        return $info;
        //die;


        $cookie = '';

        do {
            $ldap_base_dn = 'DC=cardiologia,DC=org';
            $result = ldap_search(
                $ldap_connection, $ldap_base_dn, '(cn=*)', ['cn'], 0, 0, 0, LDAP_DEREF_NEVER,
                [['oid' => LDAP_CONTROL_PAGEDRESULTS, 'value' => ['size' => 2, 'cookie' => $cookie]]]
            );
            ldap_parse_result($ldap_connection, $result, $errcode , $matcheddn , $errmsg , $referrals, $controls);
            // Pour garder l'exemple simple les erreurs ne sont pas testées
            $entries = ldap_get_entries($ldap_connection, $result);
            foreach ($entries as $entry) {
                var_dump($entry);
                //echo "cn: ".$entry['cn'][0]."\n";
            }
            if (isset($controls[LDAP_CONTROL_PAGEDRESULTS]['value']['cookie'])) {
                // Vous devez passer le cookie du dernier appel au prochain
                $cookie = $controls[LDAP_CONTROL_PAGEDRESULTS]['value']['cookie'];
            } else {
                $cookie = '';
            }
            // Cookie vide signifie dernière page
        } while (!empty($cookie));
        die;
         



        //------------------------------------------------------------------------------
        // Get a list of all Active Directory users.
        //------------------------------------------------------------------------------
        $ldap_base_dn = 'DC=cardiologia,DC=org';
        //$search_filter = "(&(objectCategory=user))";
        //$search_filter = "(&(objectClass=user)(objectCategory=person)(sn=*))";
        $search_filter = '(objectClass=Group)';        
     
        $filter = $search_filter;
        $attributes = false;
        $base_dn = $ldap_base_dn;
             
    
            $entries = false;
            if (is_string($filter) && $ldap_bind) {
                    if (is_array($attributes)) {
                            $search  = ldap_search($ldap_connection, $base_dn, $filter, $attributes);
                    } else {
                            $search  = ldap_search($ldap_connection, $base_dn, $filter);
                    }
                    if ($search !== false) {
                            $entries = ldap_get_entries($ldap_connection, $search);
                    }
            }
       var_dump($entries);
    

        




        ///-------- get informations -------///
        $LDAPFieldsToFind = [];
        $SearchField = $this->request->getVar("SearchField");
        $SearchFor = $this->request->getVar("SearchFor");
        $filter="($SearchField=$SearchFor)";
        $pageSize = 100;
        $cookie = '';
        //ldap_control_paged_result($ldap_connection, $pageSize, true, $cookie);
        $sr=ldap_search($ldap_connection, $ldap_base_dn, $search_filter, $LDAPFieldsToFind);
        $info = ldap_get_entries($ldap_connection, $sr);
        var_dump($sr);
        var_dump($info);
        if($info["count"] > 0) {
            for ($x=0; $x<$info["count"]; $x++) {
                $sam=$info[$x]['samaccountname'][0];
                $giv=$info[$x]['givenname'][0];
                $tel=$info[$x]['telephonenumber'][0];
                $email=$info[$x]['mail'][0];
                $nam=$info[$x]['cn'][0];
                $dir=$info[$x]['homedirectory'][0];
                $dir=strtolower($dir);
                $pos=strpos($dir,"home");
                $pos=$pos+5;
                    if (stristr($sam, $SearchFor) && (strlen($dir) > 8)) {
                    print "\nActive Directory says that:\n";
                    print "CN is: ".$nam." \n";
                    print "SAMAccountName is: ".$sam." \n";
                    print "Given Name is: ".$giv." \n";
                    print "Telephone is: ".$tel." \n";
                    print "Home Directory is: ".$dir." \n";
                    }   
            }
        }
    }
}