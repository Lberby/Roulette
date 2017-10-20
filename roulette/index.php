<?php session_start();?> //POUR UTILISER LES SESSIONS PHP, IL EST NÉCESSAIRE D’AJOUTER L’INSTRUCTION PHP

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Roulette - Identification </title>

        <link href="css.css" rel="stylesheet"> 
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    </head>
    <body>
	
    <h1> La roulette </h1>

	   <form action="index.php" method="post">
            <p> <b class="barre"> Connectez-vous pour jouer à la roulette: </b> </br></br>

            
             Identifiant : <input type="text" name="id" /></br></br>
            Mot de passe : <input type="password" name="mdp" /> </br></br>
     
            <button type="reset" value="Effacer" class="btn btn-outline-primary">Effacer</button>
            <button type="submit" value="Valider" name="Valider" class="btn btn-outline-info">Valider</button>
             
            <a href="Inscription.php"><button type="button" name="inscription" value="S'inscrire" class="btn btn-outline-warning">S'inscrire</button></a>
            
           </p>
        </form>
	<p class="paragraphe">
        La roulette est un jeu de hasard. Elle comporte 36 cases numérotées de 1 à 36, une bille est lancée dedans et s'arrête à un moment dans une case. Le but est de prévoir où la bille va s'arrêter en misant sur le résultat. </br>
        Il existe plusieurs façon de miser offrant plus ou moins de chance de gagner et les gains s’accordent avec le pourcentage de chance de gain.</br>

        Avant chaque partie, le joueur mise de l’argent selon un choix de jeu. Dans notre cas, les possibilités de jeux sont limitées aux suivantes:</br>
        <ul style="margin-left:30%;"><li> Le joueur peut choisir de miser sur la valeur exacte du résultat</br></li>
        <li>Le joueur peut choisir de miser sur la parité du résultat</br></li></ul>
    </p>
	
    <?php   
    if(isset($_POST['Valider'])){


    require_once ("connect.php");

    $bdd=connectDB();

    if($bdd)
    {
        $query = $bdd -> query ('SELECT * FROM joueur Where nom="'.$_POST['id'].'";');
        $data = $query->fetch();
        if($_POST['mdp']!="" && $_POST['id']!="" )
        {
            if($data['nom']==$_POST['id'])
                {
                    if($data['mdp'] == $_POST['mdp'] )
                    {
                        $_SESSION['utilisateur']=$data['nom'];
                        $_SESSION['argent']=$data['argent'];
                        $_SESSION['id']= $data['id'];
                        header("Location: roulette.php");
                    }
                     else 
                     {
                            echo 'Mauvais mot de passe';
                     }
                }
                else
                {
                    echo 'Mauvais identifiant';
                }
        }
        else 
        {
            echo 'Saisir les deux champs';
        }
        }
    }


    
    
    ?>

    <img src="img.jpeg" alt="Mountain View" style="width:304px;height:228px;filter: invert(100%);margin-left:40%;border-radius: 10px;">

	</body>
</html>