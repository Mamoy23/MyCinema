<?php
    try
    {
    $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;host=127.0.0.1;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
    var_dump($e);
    }
    
    $sql = 'SELECT * FROM genre ORDER BY nom ASC';
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM distrib ORDER BY nom ASC';
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $distribs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT * FROM film';
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $table_films = $stmt->fetchAll(PDO::FETCH_ASSOC);


    include('test.php');
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Marine's Cinema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

    <section>
        <h1>Rechercher un film</h1>
        <h2>Par nom</h2>
        <form method="POST" action="my_cinema2.php">
            <input type="text" name="nom" placeholder="Titre de film">  
        
        <h2>Par type ou distributeur</h2>

            <select name="genre" id="genre">
                <option value="">Sélectionnez un genre</option>
                <?php foreach($genres as $genre): ?>
                <option value="<?= $genre['id_genre']; ?>"> <?= $genre['nom']; ?></option>
                <?php endforeach; ?>
            </select>
            
            <select name="distribution" id="distrib">
            <option value="">Sélectionnez un distributeur</option>
            <?php foreach($distribs as $distrib): ?>
                <option value="<?= $distrib['id_distrib']; ?>"> <?= $distrib['nom']; ?></option>
            <?php endforeach; ?>
            </select>
            <input type="submit" value="Rechercher"> 

        <table class="table">
        <thead>
            <tr>
            <th scope="col">Titre</th>
            <th scope="col">Genre</th>
            <th scope="col">Synopsis</th>
            <th scope="col">Durée</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php foreach($films as $film): ?>
            <td><?= $film["titre"]?></td>
            <td><?= $film["nom"]?></td>
            <?php foreach($table_films as $columns): ?>
            <td><?= $columns["resum"]?></td>
            </tr>
        </tbody>

            <?php endforeach; ?>
            <?php endforeach; ?>
           
        </form> 
    </section>

</body>
</html>