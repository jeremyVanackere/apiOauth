<?php
$Authentifier = true; // simule une bonne authentification
// Si on est connecté avec les bonnes autentifications
if($Authentifier)
{
    $token = getToken(); // la on simule la récupération du token de l'utilisateur
    $getURL =""; // ici on rejoute les paramètre get à notre url de redirection
        foreach ($_GET as $key => $value) { 
            $getURL .= "&".$key."=".$value;
        }
    header('Location: api.php?callback='.$token.''.$getURL); // on redirige vers l'api avec le token et les information get
}else{
    header('Location: api.php?auth=true'); // on redirige vers l'pai avec une information pour nous indiquer qu'on est passer par ici
}

function getToken() // va récupérer le token de l'utilisateur
{
    return "AZERTY";
}
?>