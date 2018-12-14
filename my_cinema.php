<?php
    try
    {
    $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;host=127.0.0.1;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
    var_dump($e);
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Marine's Cinema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>

    <section>
        <h1>Rechercher un film</h1>
        <h2>Par nom</h2>
        <form method="POST" action="">
            <input type="text" name="nom" placeholder="Titre de film">  
        
        <h2>Par type ou distributeur</h2>

            <select name="genre" id="genre">
                <?php
                $reponse = $bdd->query('SELECT * FROM genre ORDER BY nom ASC');
                while ($donnees = $reponse->fetch())
                {
                    ?>
                        <option value="<?php echo $donnees['id_genre']; ?>"> <?php echo $donnees['nom']; ?></option>
                    <?php
                    }
                    ?>
            </select>
            
            <select name="distribution" id="distrib">
            <?php
                $reponse = $bdd->query('SELECT * FROM distrib ORDER BY nom ASC');
                while ($donnees = $reponse->fetch())
                {
                    ?>
                        <option value="<?php echo $donnees['id_distrib']; ?>"> <?php echo $donnees['nom']; ?></option>
                    <?php
                    }
                    ?>
            </select>
            <input type="submit" value="Rechercher"> 
            <?php include('test.php');?>
        </form> 
    </section>

</body>
</html>