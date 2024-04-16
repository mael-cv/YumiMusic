<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function gestonario($token, $password) {
        $decryptedToken = '';
        $tokenLength = strlen($token);
        $passwordLength = strlen($password);

        for ($i = 0; $i < $tokenLength; $i++) {
            $decryptedToken .= $token[$i] ^ $password[$i % $passwordLength];
        }

        return $decryptedToken;
    }

    function request($url, $params) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
       
        return $output;
      }

    if (!empty($_GET['session']) & !empty($_GET["token"])) {
        $checkSession = json_decode(request("https://api.yuminako.com/yumid/checksession.php", "session=".$_GET['session']));
        if ($checkSession->out) {
          $api_token = "FTZ8FphLSxR4447mx9MsK3c8PqCBb467n7A2qL95yDb8sLyh8t";
          $api_key = "JabRwF9sW6E245K9CBrn7pU9mf8Nccm9A68";
    
          $params_request = ['api_token' => $api_token, 'api_key' => $api_key, 'session' => $_GET['session']];
        
          $sessioninfos = json_decode(request("https://api.yuminako.com/yumid/getsessioninfos.php",  $params_request));
          if ($sessioninfos->out) {
            $userinfos = json_decode($sessioninfos->infos);
            setcookie("session", $_GET['session'], time() + 60 * 60 * 24 * 30, "/", "stream.yuminako.com");
            header("Location: https://my.yuminako.com/");
          }else{
            echo "L'utilisateur associé a la session n'existe plus ou n'as jamais existé.";
          }
        }else{
          echo "Votre session n'est pas valide.";
        }
    }else{
      echo "Vous n'êtes pas connecté.";
    }

