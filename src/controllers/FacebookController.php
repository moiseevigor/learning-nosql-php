<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;

class FacebookController {

    public static function login(){
        
        global $config;

        FacebookSession::setDefaultApplication($config['facebook']['appId'], $config['facebook']['secret']);
        $helper = new FacebookRedirectLoginHelper('http://192.168.88.250');
        $loginUrl = $helper->getLoginUrl();
        
        var_dump($loginUrl);
    
    }
    
    public static function callback(){
        
        echo "ciao sono una stringa vuota";
        
        
    }

}


