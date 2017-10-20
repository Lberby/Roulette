<?php session_start();
 require_once ("connect.php");?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Roulette - Identification </title>

        <link href="css.css" rel="stylesheet"> 
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    </head>
    <body>
	
    <h1> Inscription </h1>

	   <form action="Inscription.php" method="post">
            <p> <b class="barre"> Connectez-vous pour jouer à la roulette: </b> </br></br>

            
     
            Identifiant : <input type="text" name="id" /></br></br>
            Mot de passe : <input type="password" name="mdp" /> </br></br>
        
            <button type="reset" value="Effacer" class="btn btn-outline-primary">Effacer</button>
            <button type="submit" value="Inscrire" name="Inscrire" class="btn btn-outline-info">Inscrire</button>
             <a href="index.php"><button type="button" name="Retour" value="Retour" class="btn btn-outline-danger">Retour</button></a>
             
            
           <p>
        </form>
	

    <?php   
        if (isset($_POST['Inscrire'])){
            if($_POST['id']!= "" && $_POST['mdp']!= ""){     

            
            $bdd=connectDB();
            if($bdd){

            $bdd->query('INSERT INTO joueur (nom,mdp,argent) VALUES ("'.$_POST['id'].'","'.$_POST['mdp'].'",500);');

            $_SESSION['utilisateur']=$_POST['id'];
            $_SESSION['argent']=500;
            //$_SESSION['id']=$data['id'];
            header("Location: roulette.php");
                }
            }
            else{
                    echo'<h2>Veuillez remplir les deux champs</h2>';
                  
                }
        }

           
  

    ?>

	</body>
</html>