<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=dz', 'root', '');

if(isset($_POST['forminscription'])){
			
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
		
 	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {

    	$pseudolength = strlen($pseudo);

      	if($pseudolength <= 255) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               	$reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
               	$reqmail->execute(array($mail));
               	$mailexist = $reqmail->rowCount();

               	$reqpseudo = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
               	$reqpseudo->execute(array($pseudo));
               	$pseudoexist = $reqpseudo->rowCount();

				if($mailexist == 0){
					if($pseudoexist == 0){
						if($mdp == $mdp2) {
                     		$insertmbr = $bdd->prepare("INSERT INTO users(pseudo, motdepasse, mail, rank) VALUES(?, ?, ?, ?)");
                     		$insertmbr->execute(array($pseudo, $mdp, $mail, "joueur"));
                     		$erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  		}else{
							$erreur = "Vos mots de passes ne correspondent pas!";
						}
					}else{
						$erreur = "Pseudo déjà utilisé";
					}
				}else{
					$erreur = "Adresse mail déjà utilisé";
				}
			}else{
				$erreur= "Votre adresse mail n'est pas valide!";
			}
		}else{
			$erreur = "Votre Pseudo est beaucoup trop long!" ;
		}
	}else{
		$erreur = "Tous les champs doivent être complétés!";
	}
}


?>
<html style="background-color: aqua">
	<!--- Le titre dans l'onglet --->
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>DZ</title>
	</head>
	<!--- La Page du site --->
	<body>
		<div align="center" class="form">
			<h2>Inscription</h2>
			<br /><br />
			<form method="POST" action="">
				<label>Pseudo :</label>
				<input type="text" placeholder="Votre Pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo;} ?>" class="inputbasic"/>
				<label>Mail :</label>
				<input type="email" placeholder="Votre Mail" name="mail" id="mail" value="<?php if(isset($mail)) { echo $mail;} ?>" class="inputbasic"/>
				<label>Mot de Passe :</label>
				<input type="password" placeholder="Mot de Passe" name="mdp" id="mdp" class="inputbasic"/>
				<label>Confirmer votre Mot de Passe:</label>
				<input type="password" placeholder="Confirmer votre mdp" name="mdp2" id="mdp2" class="inputbasic"/>
				<input type="submit" name ="forminscription" value="S'Inscrire" />
			</form>
			<?php if(isset($erreur)){ echo '<font color="red">'.$erreur.'</font>'; } ?>
		</div>
	</body>
</html>
