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

    <div class="container">
        <h1 class="text-dark text-center">Rechercher un film</h1>
        <nav class="navbar-dark bg-dark mt-3 mb-3 p-3">
            <form method="POST" action="my_cinema2.php" class="form-inline">
                <input type="text" name="nom" placeholder="Titre de film" class="form-control m-2">  

                <select name="genre" id="genre" class="custom-select" m-2>
                    <option value="">Sélectionnez un genre</option>
                    <?php foreach($genres as $genre): ?>
                    <option value="<?= $genre['id_genre']; ?>"> <?= $genre['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
                
                <select name="distribution" id="distrib" class="custom-select m-2">
                <option value="">Sélectionnez un distributeur</option>
                <?php foreach($distribs as $distrib): ?>
                    <option value="<?= $distrib['id_distrib']; ?>"> <?= $distrib['nom']; ?></option>
                <?php endforeach; ?>
                </select>

                <input type="submit" value="Rechercher" class="btn btn-light m-2"> 
            </form>
        </nav>
        <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Titre</th>
            <th scope="col">Genre</th>
            <th scope="col">Synopsis</th>
            <th scope="col">Durée</th>
            <th scope="col">Jusqu'au</th>
            <th scope="col">Distributeur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($films as $film): ?>
            <tr>
            <td><?= $film["titre"]?></td>
            <td><?= $film["nom_genre"]?></td>
            <td><?= $film["resum"]?></td>
            <td><?= $film["duree_min"]?> mins</td>
            <td><?= $film["date_fin_affiche"]?></td>
            <td><?= $film["nom_distrib"]?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </div>

</body>
</html>