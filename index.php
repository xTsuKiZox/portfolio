<?php

session_start();



#region Projets

function projets()

{





    if ($connection->connect_error) {

        die("Connection impossible: " . $connection->connect_error);
    }



    $query = "SELECT * FROM `Projets`";

    $result = $connection->query($query);



    $imagesAcceuil = "SELECT * FROM `Projets`";

    $resultImg = $connection->query($imagesAcceuil);



    if (!$result) {

        die("Erreur dans la requête : " . $connection->error);
    }



    echo "<section class='Projets' id='projets'>";

    echo "<div class='row'>";

    echo "<h2>Liens</h2>";

    echo "<div class='LargeListBoxes'>";



    while ($row = $result->fetch_assoc()) {
        echo "<div class='AProject'>";

        echo "<div class='TextOfProject'>";

        echo "<h3>" . $row["TitreHome"] . "</h3>";

        echo "<p>" . $row["DescHome"] . "</p>";



        if ($row["LangHome"] != "") {
        $langages = explode(", ", $row["LangHome"]);

            echo "<ul class='WhichProjectLanguage'>";

            foreach ($langages as $langage) {

                echo "<li>" . $langage . "</li>";
            }

            echo "</ul>";
        }


        echo "<div class='LinkProjectPage'>";

        echo "<a class='LinkToPage' target='_blank' href='" .  $row["RedirectionBouton"] . "'" . $row['ID'] . "'>" . $row["MessageBouton"] . "<span>&rarr;</span></a>";

        echo "</div>";

        echo "</div>";



        if ($rowImg = $resultImg->fetch_assoc()) {

            echo "<div class='ProjectPresimage-box'>";

            if (!$rowImg["ImageHome"]) {
                echo "<img class='ProjectPresimage img-responsive lazy' src='https://raphaelmakaryan.fr/IMAGES/wait.jpg'>";
            } else {
                echo "<img class='ProjectPresimage img-responsive lazy' src='" . $rowImg["ImageHome"] . "'>";
            }
            echo "</div>";
        }



        echo "</div>";
    }



    echo "</div>";

    echo "</div>";

    echo "</section>";







    $result->close();

    $connection->close();
}

#endregion Projets

?>



<html lang="fr">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="icon" type="image/png" href="./IMAGES/logo.png"> -->

    <title>TsuKiZo</title>

    <link rel="stylesheet" href="./STYLE/style.css">

</head>



<body>

    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.4/dist/lazyload.min.js"></script>

    <main role="main">

        <?php

        include "./header.php";

        include "./acceuil.php";

        projets();

        include "./footer.php";

        ?>

</body>



</html>