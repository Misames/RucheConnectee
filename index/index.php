<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- liste de toute les meta plus lien des images et fichier css-->

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="François">
    <meta name="description" content="Site web conçus pour un apiculteur.">
    <meta name="keywords" lang="fr" content="abeilles, ruche, historique">
    <meta name="reply-to" content="francois.bouscaillou@gmail.com">
    <meta name="copyright" content="WiZaR xD">
    <title>Ruche connecté</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/Acceuil.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/tab.css" />
    <link rel="icon" type="image/png" href="css/img/bee.png" />
</head>

<body>
    <?php
        try
        {
              // On se connecte à MySQL
            $bdd = new PDO('mysql:host=localhost;dbname=projetruche;charset=utf8', 'root', '');
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

        <!--header-->
        
        <div class="container">
            <button class="tablink" onclick="openCity('London', this, 'aqua')" id="defaultOpen">
                <img src="css/img/home.png" alt="Smiley face" height="42" width="42">
            </button>
            <button class="tablink" onclick="openCity('Paris', this, 'gold')">
                <img src="css/img/columns.png" alt="Smiley face" height="42" width="42">
            </button>
            <button class="tablink" onclick="openCity('Tokyo', this, 'burlywood')">
                <img src="css/img/history-clock-button.png" alt="Smiley face" height="42" width="42">
            </button>
        </div>

        <!--Onglet de l'acceuil-->

        <div id="London" class="tabcontent contenue">
            <div class="header">
                <h3>Home</h3>
                <h5>La clef de notre avenir ?
                    <br>
                    <strong> abeilles en font partie !</strong>
                </h5>
                <img src="css/img/bee.png" alt="Smiley face" height="42" width="42">
            </div>
            <div class="article">
                <h1> Les principes de notre Projet </h1>
                <p>Les principes de notre Projet sont de simplifier la vie de l'Apiculteur, mais aussi de préserver les Abeilles.
                    Notre ruche sera reliée à un Smartphone via une Page Web, sur ce Smartphone, diverses informations seront
                    indiquées, comme la Température, l'Humidité, le poids de miel fabriqué par les abeilles.
                </p>
            </div>
            <div class="article">
                <h1>Création de la Page Web</h1>
                <p>
                    Toutes les informations envoyés de la ruche sera transmit via une Page Web
                </p>
            </div>
            <div class="article">
                <h1>Les abeilles, c'est essentiel !</h1>
                <p>
                    Les abeilles représentent environ 80% de la pollinisation. CelleS-ci sont indispensableS à notre Écosystème et à notre Écologie. Elles constituent notre environnement actuel. En cas de disparition de ces pollinisateurs, il n'y aurait pas de production de graines ou de fruits essentiels à notre alimentation.
                </p>
            </div>
        </div>

        <!--Onglet du tableau-->

        <div id="Paris" class="tabcontent">
            <table id="tableau" summary="état de la Ruche">
                <thead>
                    <tr>
                        <th></th>
                        <th>Valeurs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th rowspan="1">Valeur actuel</th>
                        <td colspan="1">
                            
                        </td>
                    </tr>
                    <tr>
                        <th>Nombre d'abeilles</th>
                        <td colspan="1">
                            <?php echo $donnees['nb_abeille']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Masse de miel en Kg</th>
                        <td colspan="1">
                            <?php echo $donnees['mass_miel']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Température extérieure en °C</th>
                        <td colspan="1">
                            <?php echo $donnees['temp_int']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Température intérieure en °C</th>
                        <td colspan="1">
                            <?php echo $donnees['temp_ext']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Température maximum en °C</th>
                        <td colspan="1">
                            <?php echo $donnees['temp_max']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Température minimum en °C</th>
                        <td colspan="1">
                            <?php echo $donnees['temp_min']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Humidité intérieure en %</th>
                        <td colspan="1">
                            <?php echo $donnees['humi_int']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Humidité extérieure en %</th>
                        <td colspan="1">
                            <?php echo $donnees['humi_ext']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Humidité maximum en %</th>
                        <td colspan="1">
                            <?php echo $donnees['humi_max']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Humidité minimum en %</th>
                        <td colspan="1">
                            <?php echo $donnees['humi_min']; ?>
                        </td>
                    </tr>
                </tbody>

                <?php
            }
            $reponse->closeCursor(); // Termine le traitement de la requête
            
            // toute les variables pour faire un système d'heure actuelle en GMT+2
            
            $date = date("d-m-Y");  
            $heure = date("G:i") + 2;
            $minutes = date("i");
            Print(" <p> La page a était actualiser pour la dernière fois le  $date à $heure h $minutes </p>");
            ?>

            </table>
        </div>

        <!--Onglet de l'historique des données-->
        
        <div id="Tokyo" class="tabcontent">
            <h3>historique</h3>
            <p>Aucunes données trouver ...</p>
        </div>

        <div id="Oslo" class="tabcontent">
            <h3>Oslo</h3>
            <p>Oslo is the capital of Norway.</p>
        </div>

        <script> // script pour changer le style en fonction du clic de l'utilisateur
            function openCity(cityName, elmnt, color) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].style.backgroundColor = "";
                }
                document.getElementById(cityName).style.display = "block";
                elmnt.style.backgroundColor = color;
            }
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

</body>

</html>