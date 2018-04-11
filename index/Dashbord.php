<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="css/img/header.png"> 
    <title>Ruche</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/Dashbord.css" type="text/css" rel="stylesheet">
    <script src="script/main.js"></script>
</head>

<body>
<div class="nav">
    <p> Je suis un text</p>
</div>
<div class="box">
    <header>
          <p class="titre">Ruche connecter</p>
          <a href="Historique.php" class="histo">Historique</a>
    </header>
    <?php
    try
    {
      	// On se connecte à MySQL
    	$bdd = new PDO('mysql:host=localhost;dbname=projetRuche;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
      	// En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }
    // Si tout va bien, on peut continuer
    // On récupère tout le contenu de la table jeux_video
    $reponse = $bdd->query('SELECT * FROM `Ruche` ORDER BY `id` DESC LIMIT 1');
    // On affiche chaque entrée une à une
    while ($donnees = $reponse->fetch())
    {
    ?>
    <div class="oui">
      <p>
        <strong>Nombre d'abeilles = </strong><?php echo $donnees['nb_abeille']; ?><br/>
        <strong>température extérieur = </strong> <?php echo $donnees['temp_ext']; ?> <br/>
        <strong>température intérieur = </strong> <?php echo $donnees['temp_int']; ?> <br/>
        <strong>température maximum =</strong> <?php echo $donnees['temp_max']; ?></br>
        <strong>température minimum =</strong> <?php echo $donnees['temp_min']; ?><br/>
        <strong>Humidité intérieur =</strong> <?php echo $donnees['humi_int']; ?><br/>
        <strong>Humidité extérieur =</strong> <?php echo $donnees['humi_ext']; ?><br/>
        <strong>Humidité maximum =</strong> <?php echo $donnees['humi_max']; ?><br/>
        <strong>Humidité minimum =</strong> <?php echo $donnees['humi_min']; ?><br/>
        <strong>Message = </strong><?php if ($donnees['message_alert']) { echo 'DANGER'; }?> <br/>
    </div>
    <footer class="pied">

    <?php
    }
    $reponse->closeCursor(); // Termine le traitement de la requête
    
    // toute les variable pour faire un système d'heure actuelle en GMT+2

    $date = date("d-m-Y");  
    $heure = date("G:i") + 2;
    $minutes = date("i");
    
    Print("La page a était actualiser pour la dernière fois le  $date à $heure h $minutes ");
    
    ?>
    
    </footer>
  </div>
</body>
</html>