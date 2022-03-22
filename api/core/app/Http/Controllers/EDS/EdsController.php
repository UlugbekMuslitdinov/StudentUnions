<?php
namespace App\Http\Controllers\EDS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EdsController extends Controller 
{

	public function __construct()
    {
        // $this->middleware('suapi');
	}

	public function getCustomerInfo(Request $request){
        $custId = $request->custId;
        //$custId = '159971';
        //$custId = 'eotkank87';

        // setup LDAP parameters
        $ldapUrl = "ldaps://eds.arizona.edu";
        $bindDn = "uid=sunion-mealplans,ou=App Users,dc=eds,dc=arizona,dc=edu";
        $bindPw = "CnQc3r2BIDf2DMBRKobragkLIJBsm7";
		// $bindPw = "vfGgrKB2Ds64FO3yctAqRyGTAYccgvdZ";
        $searchBase = "ou=People,dc=eds,dc=arizona,dc=edu";
        $searchFilter = "(|(uid=$custId)(uaid=$custId)(isonumber=$custId)(uid=$custId)(emplid=$custId))";

        // establish LDAP connection
        putenv('LDAPTLS_REQCERT = never');
        $ldap = ldap_connect($ldapUrl);

        if (!ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7)) {
            print "Could not set LDAPv3\r\n";
        }

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, false);

        //ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
        if (!$ldap) {
            return "[PHP] Could not connect to LDAP server. Please report this issue if the problem persists.";
        }

        // bind as app user
        ldap_bind($ldap, $bindDn, $bindPw);
        $result = array();

        // perform search
        if (($sr = ldap_search($ldap, $searchBase, $searchFilter)) == FALSE) {
            error_log(ldap_error($ldap));
            return "[PHP] Could not connect to LDAP server. Please report this issue if the problem persists.";
        } else {
            // retrieve entry
            $entry = ldap_first_entry($ldap, $sr);

            if (!empty($entry)) {
                $attrs = ldap_get_attributes($ldap, $entry);
                $result = array();

                for ($i = 0; $i < $attrs["count"]; $i++) {
                    $result[$attrs[$i]] =   ldap_get_values($ldap, $entry, $attrs[$i]);
                }
            } else {
                // return "[PHP] Not found";
            }

            echo "<pre>";
            ldap_close($ldap);
            var_dump($result);
            return $result;
        }

	}
}
