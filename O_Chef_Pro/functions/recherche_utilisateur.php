<?php 
     session_start();
     require_once('../src/Repository/UtilisateurRepository.php');

     if(isset($_GET['user'])){
        $user = (String) trim($_GET['user']);
     
        $req = $DB->query("SELECT *
          FROM utilisateur
          WHERE nom LIKE ?
          LIMIT 10",
          array("$user%"));
     
        $req = $req->fetchALL();
      
        foreach($req as $r){
          ?>   
            <div style="margin-top: 20px 0; border-bottom: 2px solid #ccc"><?= $r['nom'] . " " . $r['prenom'] ?></div><?php    
        }
      } 

?>