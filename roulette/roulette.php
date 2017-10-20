<?php session_start(); //POUR UTILISER LES SESSIONS PHP, IL EST NÉCESSAIRE D’AJOUTER L’INSTRUCTION PHP
require_once ("connect.php");
if(!isset($_SESSION['utilisateur'])){
	header("Location: index.php"); //rediriger l’utilisateur vers la page du jeu de roulette
	}
	?>


<!DOCTYPE html>
<html>
<head>
	<title> Roulette </title>
	  <link href="css.css" rel="stylesheet"> 
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    </head>
</head>
<body>
 
 
 

  <form method="post" action="roulette.php">
		<p class="deco"> 
		  	<button type="submit" class="btn btn-dark" name="Déconnexion">Déconnexion</button>
		  	
		</p> 
 </form>
<h1 >Jeu de la roulette </h1>
            
	


<p class="couleur">

	 </br></br>
	<form method="post" action="roulette.php">
	   
				<label>Votre mise</label> : </br> <input type="text" name="mise" size=30/> </br></br>

			 	<hr style="width:30%">

			 	<label class="switch">
				  <input type="checkbox">
				  <span class="slider round"></span>
				</label>

				<hr style="width:30%">

				<label>Miser sur un nombre </label> :</br> <input type="text" name="nb" size=22 /> 
			 	</br></br>

			 <hr style="width:30%">
			 
		 
			 	</br></br>
				<label>Miser sur la parité  </label> :  </br> 
				<label class="radio-inline"><input type="radio" name="Radiopair" value="pair"> pair</label> </br>
				<label class="radio-inline"><input type="radio" name="Radiopair" value="impair"> impair</label>
				
				
				
			 

		  <hr style="width:30%">
		
		  <button type="submit" value="Jouer" name="Jouer" class="btn btn-info">Jouer</button>
		  </br>

		 

<div class="espace">
	
</div>

	<?php


	if(isset($_POST['Déconnexion']))
    {
        unset($_SESSION['id']);
        unset($_SESSION['mdp']);
        unset($_SESSION['argent']);
        unset($_SESSION['utilisateur']);
    	header("Location:index.php");

    }



	$num=rand(1,36);
	?> <h4 class="num"> <?php echo 'Le numéro est : '.$num.' </br>'; ?> </h4> 
	<hr> <?php
	$bdd=connectDB();
	$gain=0;
	//var_export($_SESSION);

	if(isset($_POST['Jouer'])) // Si on joue
		{
			if($_POST['mise']>0)

				{
					if($_POST['mise']!=0)
					{
                        if($_SESSION['argent']>=$_POST['mise'])
                        {
                            if($_POST['nb']!="" || isset($_POST['Radiopair']))
                            {
                                if($bdd)
                                {
						              $_SESSION['argent']-=$_POST['mise'];
						              if ($_POST['nb']!='')
                                      {
                                          if($_POST['nb']==$num) //bon numéro
                                          {
                                              $_SESSION['argent']+=$_POST['mise']*35;
                                              $gain=$_POST['mise']*35;
                                              ?>  <h4 class="partie"> <?php echo "Vous avez gagné ! "; ?> </h4> <?php 
								             
							               }
							               else
							               {
							               		?>  <h4 class="partie"> 
							               		<?php echo "Vous avez perdu ! :("; ?> </h4> <?php

							               }
						              }
                                    else
                                    {   //pair ou impair
                                        if($num%2==0 && $_POST['mise']%2==0 )
                                        {   //bonne parité
                                            $_SESSION['argent']+=$_POST['mise']*2;
                                            $gain=$_POST['mise']*2;
                                            ?>  <h4 class="partie"> <?php echo "Vous avez gagné ! C'est pair !  "; ?> </h4> <?php
                                           
                                        }
                                        else if($num%2==1 && $_POST['mise']%2==1 )
                                        {	
                                        	$_SESSION['argent']+=$_POST['mise']*2;
                                            $gain=$_POST['mise']*2;
                                            ?> <h4 class="partie"> <?php  echo "Vous avez gagné ! C'est impair !  ";?> </h4> <?php
                                            
                                        }
                                        else
                                        {
                                        	?> <h4 class="partie"> <?php echo "Vous avez perdu ! :(";?> </h4> <?php
                                        }
                                    }
                                    $bdd -> query('UPDATE joueur SET argent='.$_SESSION['argent'].' WHERE nom="'.$_SESSION['utilisateur'].'";');
                                    $bdd -> query('INSERT INTO partie(joueur, date, mise, gain) VALUES ("'.$_SESSION['id'].'", NOW(), '.$_POST['mise'].', '.$gain.');');
					           }
					           else
                               {
                                   ?> <h4 class="rouge"> <?php echo 'La connexion a echouée';?> </h4> <?php
					           }
				            }
	 			           else 
                           {
	 				          ?> <h4 class="rouge"> <?php echo 'Veuillez choisir un nombre ou une parité !';?> </h4> <?php
				            }

			             }
			             else
                         {//argent
                             ?> <h4 class="rouge"> <?php echo 'Vous ne pouvez pas miser plus que vous avez !';?> </h4> <?php
			             }

			         }
		              else
                      {//aucune mise
                          ?> <h4 class="rouge"> <?php echo 'Vous devez miser quelque chose !';?> </h4> <?php
		              }

	           }      
	           else
               {
		          ?> <h4 class="rouge"> <?php echo 'Vous devez miser une valeur positive !';?> </h4> <?php
	           } 

}

                                
						
	

	?> 
	 </br></br>
	<b style="font-size: 2em;"> <?php echo $_SESSION['utilisateur'].':</br>'.$_SESSION['argent']."€";?></b>

	</form>
</p>



<script src="https://code.jquery.com/jquery-1.10.2.js" type="text/javascript">

jQuery(document).ready(function($){
var jeu="nombre";
$(".Radiopair").hide();
$(".nb").show();
if(jeu == "nombre")
{
	$(".nb").show();
	$(".Radiopair").hide();
}
else
{
	$(".nb").hide();
	$(".Radiopair").show();
}
});

jQuery(document).ready(function($){
	var colors = ['red','green', 'blue', 'black','lightgreen'];
	var cpt=0;
	$("h1").click(function(){
		var color = colors[cpt++%5];
		$("header h1").css('background-color',color);
	});
});

</script>

</body>
</html>









