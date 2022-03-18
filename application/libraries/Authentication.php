<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication {

    function authAdmin($username, $password){
     
        $acceptuser = "93a.rsK7HX(Gn4";
        $acceptpass = "[6NCvG1F=gNl";

        if($username == $acceptuser && $password == $acceptpass){
           
            return true;

        } else {
       
            return false;

	}
    }

}
