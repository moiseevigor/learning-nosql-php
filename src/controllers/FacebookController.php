<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;

class FacebookController {

    public static function login(){
        
        global $config;
        global $app;

        FacebookSession::setDefaultApplication($config['facebook']['appId'], $config['facebook']['secret']);
        $helper = new FacebookRedirectLoginHelper('http://192.168.88.250/facebook/callback');
        $loginUrl = $helper->getLoginUrl(array('scope' => 'email,read_stream'));
        
        $app->redirect($loginUrl);
        //var_dump($loginUrl);
        
       
    
    }
    
    public static function callback()
    {
        global $config;
        global $app;

        $session = null ;
        FacebookSession::setDefaultApplication($config['facebook']['appId'], $config['facebook']['secret']);
        $helper = new FacebookRedirectLoginHelper('http://192.168.88.250/facebook/callback');
       
       try {
          $session = $helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
          // When Facebook returns an error
        } catch(\Exception $ex) {
          // When validation fails or other local issues
        }
        
        if ($session)
        {
          // Logged in
          $me = (new FacebookRequest(
             $session, 'GET', '/me?scope=email'
          ))->execute()->getGraphObject(GraphUser::className());
  
  
          // Controllo se l'utente esiste già
      	  if (Utenti::findOne(array('email' => $me->getEmail()))) {
            $_SESSION['email'] = $me->getEmail();
            $app->redirect("/app/#pagina-feed");
            
          } else {
            Utenti::create(array(
                "nome" => $me->getFirstName(),
                "cognome" => $me->getLastName(),
                "email" => $me->getEmail(),
                "password" => null,
                "privacy" => true,
                "facebook_id" => $me->getId()
            ));

            $_SESSION['email'] = $me->getEmail();
            $app->redirect("/app/#pagina-feed");
          }
        
        }
    }

}


