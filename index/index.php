<!DOCTYPE html>
<html lang="en">

<head>

    <!--list of all meta plus link images and file css-->

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="François">
    <meta name="description" content="Site web conçus pour un apiculteur.">
    <meta name="keywords" lang="fr" content="abeilles, beehouse, historique">
    <meta name="reply-to" content="francois.bouscaillou@gmail.com">
    <meta name="copyright" content="François">
    <title>Connected beehouse</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/Acceuil.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/tab.css" />
    <link rel="icon" type="image/png" href="css/img/bee.png" />
</head>

<body>
    <?php
        try
        {
              // We connect to MySQL
            $bdd = new PDO('mysql:host=localhost;dbname=projetruche;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
              // In case of error, we display a message and stop all
                die('Erreur : '.$e->getMessage());
        }
        // If all goes well, we can continue
        // We recover all the contents of the table Ruche
        $reponse = $bdd->query('SELECT * FROM `Ruche` ORDER BY `id` DESC LIMIT 1');
        // We display each entry one by one
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

        <!--Home tab-->

        <div id="London" class="tabcontent contenue">
            <div class="header">
                <h3>Home</h3>
                <h5>The key to our future?
                    <br>
                    <strong>Bees are part of it!</strong>
                </h5>
                <img src="css/img/bee.png" alt="Smiley face" height="42" width="42">
            </div>
            <div class="article">
                <h1>The principles of our Project</h1>
                <p>The principles of our project are to simplify the life of the beekeeper, but also to preserve bees.
                    Our hive will be connected to a Smartphone via a Web Page, on this Smartphone, various information will be
                    indicated, such as Temperature, Humidity, honey weight made by bees.
                </p>
            </div>
            <div class="article">
                <h1>Creating the Web Page</h1>
                <p>
                    All information sent from the hive will be transmitted via a Web Page
                </p>
            </div>
            <div class="article">
                <h1>Bees are essential!</h1>
                <p>
                    Bees make up about 80% of the pollination. These are essential to our Ecosystem and Ecology. They are our current environment. If these pollinators disappear, there will be no production of seeds or fruits essential to our diet.
                </p>
            </div>
        </div>

        <!--Tab of the table-->

        <div id="Paris" class="tabcontent">
            <table id="tableau" summary="table of the beehouse">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <th>Number of bees</th>
                        <td colspan="1">
                            <?php echo $donnees['nb_abeille']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Mass of honey in Kg</th>
                        <td colspan="1">
                            <?php echo $donnees['mass_miel']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Temperature outside in °C</th>
                        <td colspan="1">
                            <?php echo $donnees['temp_int']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Temperature outside in °C</th>
                        <td colspan="1">
                            <?php echo $donnees['temp_ext']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Temperature maximum in °C</th>
                        <td colspan="1">
                            <?php echo $donnees['temp_max']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Temperature minimum in °C</th>
                        <td colspan="1">
                            <?php echo $donnees['temp_min']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Humidity inside in %</th>
                        <td colspan="1">
                            <?php echo $donnees['humi_int']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Humidity outside %</th>
                        <td colspan="1">
                            <?php echo $donnees['humi_ext']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Humidity maximum in %</th>
                        <td colspan="1">
                            <?php echo $donnees['humi_max']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Humidity minimum in %</th>
                        <td colspan="1">
                            <?php echo $donnees['humi_min']; ?>
                        </td>
                    </tr>
                </tbody>

                <?php
            }
            $reponse->closeCursor(); // Finish processing the request
            
            // all the variables to make a system at the moment in GMT +2
            
            $date = date("d-m-Y");  
            $heure = date("G:i") + 2;
            $minutes = date("i");
            Print(" <p> The page was last refreshed on  $date at $heure h $minutes </p>");
            ?>

            </table>
        </div>

        <!--Data History Tab-->
        
        <div id="Tokyo" class="tabcontent">
            <h3>history</h3>
            <p>No data found...</p>
        </div>

        <script> // script to change the style according to the user's click
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