<?php include 'controller.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Films</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body class="bg">
    <?php include 'navbar.html' ?>

    <div class="container bord">

    <h1 class="text-danger m-2 lobster">Rechercher un film</h1>

    <form method="POST" action="" class="form-inline">
        <input type="text" name="nom" placeholder="Titre de film" class="form-control m-2 border-danger">

        <select name="genre" id="genre" class="custom-select m-2 border-danger">
            <option value="">Sélectionnez un genre</option>
            <?php foreach ($genres as $genre): ?>
            <option value="<?=$genre['id_genre'];?>"><?=$genre['nom'];?></option>
            <?php endforeach;?>
        </select>

        <select name="distribution" class="custom-select m-2 border-danger">
            <option value="">Sélectionnez un distributeur</option>
            <?php foreach ($distribs as $distrib): ?>
                <option value="<?=$distrib['id_distrib'];?>"><?=$distrib['nom'];?></option>
            <?php endforeach;?>
        </select>

        <input type="submit" value="Rechercher" class="btn btn-danger m-2 lobster">
    </form>

    <?php if (!empty($_POST['nom']) || !empty($_POST['genre']) || !empty($_POST['distribution'])): ?>
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
            <?php foreach ($movies as $film): ?>
            <tr>
            <td class="font-weight-bold"><?=$film["titre"]?></td>
            <td class="text-capitalize"><?=$film["nom_genre"]?></td>
            <td><?=$film["resum"]?></td>
            <td><?=$film["duree_min"]?> mins</td>
            <td><?=$film["date_fin_affiche"]?></td>
            <td class="text-capitalize"><?=$film["nom_distrib"]?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php endif;?>
    </div>

    <div class="container bord border-dark">
    <h1 class="text-dark m-2 lobster">Programme du jour</h1>

    <form method="POST" action="">
        <input type="date" name="program" class="border-dark m-2 bg-light">
        <input type="submit" value="Rechercher" class="btn btn-dark m-2 lobster">
    </form>

    <?php if(!empty($_POST['program'])): ?>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Heure</th>
            <th scope="col">Durée</th>
            <th scope="col">Film</th>
            <th scope="col">Synopsis</th>
            <th scope="col">N°Salle</th>
            <th scope="col">Nom salle</th>
            <th scope="col">Etage</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($programs as $film): ?>
            <tr>
                <td><?=$film['date_seance']?></td>
                <td><?=$film['debut_sceance']?></td>
                <td><?=$film['duree_min']?> mins</td>
                <td class="font-weight-bold"><?=$film['titre']?></td>
                <td><?=$film['resum']?></td>
                <td><?=$film['numero_salle']?></td>
                <td class="text-capitalize"><?=$film['nom_salle']?></td>
                <td><?=$film['etage_salle']?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php endif;?>
    </div>
</body>
</html>