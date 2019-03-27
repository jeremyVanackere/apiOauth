<?php
include "connexion.php"; // On inclu la connexion à la base de donnée
// On vérifie s'il y a l'option callback est là et bonne
if(isset($_GET['callback']) && $_GET['callback'] == "AZERTY")
{
    // On vérifie s'il y a une action
    if(isset($_GET['action']))
    {
        $message = $_GET['action'];

        switch ($message) {
            case "add":
                // On insert la task
                $query = "INSERT INTO task VALUES (null,:name,:date)"; 
                $prep = $pdo->prepare($query);
                $prep->bindValue(':date',$_GET['date']);
                $prep->bindValue(':name',$_GET['name']);
                $prep->execute();
                $id_task = $pdo->lastInsertId(); // récupere le dernier id inserer

                // On récupére l'id du prenom 
                $query = "SELECT f.id_famille FROM famille f WHERE f.prenom=:prenom";
                $prep = $pdo->prepare($query);
                $prep->bindValue(':prenom',$_GET['prenom']);
                $prep->execute();
                $results = $prep->fetchAll(PDO::FETCH_ASSOC);
                $id_famille = $results[0]['id_famille'];

                // On insert la relation
                $query = "INSERT INTO avoir VALUES (:id_task,:id_famille)";
                $prep = $pdo->prepare($query);
                $prep->bindValue(':id_task',$id_task);
                $prep->bindValue(':id_famille',$id_famille);
                $prep->execute();

                break;
            case "updateName":
                $query = "UPDATE task SET name=:name WHERE id=:id"; // On update le nom (la task  )
                $prep = $pdo->prepare($query);
                $prep->bindValue(':name',$_GET['name']);
                $prep->bindValue(':id',$_GET['id']);
                $prep->execute();
                break;
            case "updateDate":
                $query = "UPDATE task SET date=:date WHERE id=:id"; // On update la date
                $prep = $pdo->prepare($query);
                $prep->bindValue(':date',$_GET['date']);
                $prep->bindValue(':id',$_GET['id']);
                $prep->execute();
                break;
            case "remove":
                $query = "DELETE FROM avoir WHERE id_task=:id;"; // on supprime la relation
                $prep = $pdo->prepare($query);
                $prep->bindValue(':id',$_GET['id']);
                $prep->execute();

                $query = "DELETE FROM task WHERE id=:id;"; // on supprime la tache
                $prep = $pdo->prepare($query);
                $prep->bindValue(':id',$_GET['id']);
                $prep->execute();
                break;
            case "famille":
                $query = "SELECT * FROM famille";
                $prep = $pdo->prepare($query);
                $prep->execute();
                $results = $prep->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                echo $json;
                break;
        }
    }
    else // s'il y a pas d'action
    {
            $query = "SELECT t.id,t.name,t.date,f.prenom FROM task t 
            LEFT JOIN avoir a ON t.id=a.id_task 
            LEFT JOIN famille f ON f.id_famille=a.id_famille ORDER BY t.date";
            $prep = $pdo->prepare($query);
            $prep->execute();
            $results = $prep->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            echo $json;
    }
}else{ // On passe forcement ici sauf si le token est bon 
    if(isset($_GET['auth'])) // On vérifie si on est deja passer pas l'autorisation de la connexion
    {
        echo "erreur"; // si on est ici, c'est que l'autorisation n'est pas bonne car on a pas le bon token
    }else{
        $getURL ="?auth=true"; // ici on rejoute les paramètre get à notre url de redirection vers l'OAuth
        foreach ($_GET as $key => $value) { 
            $getURL .= "&".$key."=".$value;
        }
        header('Location: autorisation.php'.$getURL); // on redirige vers l'autorisation avec les paramètres get
    }
}