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

    $sql = 'SELECT * FROM film ORDER BY titre ASC';
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <h1 class="text-dark m-2">Rechercher un film</h1>

            <form method="POST" action="my_cinema2.php" class="form-inline">
                <input type="text" name="nom" placeholder="Titre de film" class="form-control m-2">  

                <select name="genre" id="genre" class="custom-select m-2">
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

                <input type="submit" value="Rechercher" class="btn btn-dark m-2"> 
            </form>

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
                <?php if(!empty($_POST['nom']) || !empty($_POST['genre']) || !empty($_POST['distribution'])): ?>
                <?php foreach($movies as $film): ?>
                <tr>
                <td><?= $film["titre"]?></td>
                <td><?= $film["nom_genre"]?></td>
                <td><?= $film["resum"]?></td>
                <td><?= $film["duree_min"]?> mins</td>
                <td><?= $film["date_fin_affiche"]?></td>
                <td><?= $film["nom_distrib"]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <h1 class="text-primary m-2">Rechercher un client</h1>

        <form method="POST" action="my_cinema2.php" class="form-inline">
            <input type="text" name="client" placeholder="Nom et/ou prénom" class="form-control m-2">
            <input type="submit" value="Rechercher" class="btn btn-primary m-2">
        </form>

        <table class="table table-primary">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>          
                <th scope="col">Dernière visite</th>
                <th scope="col">Ville</th> 
                <th scope="col">N° Client</th>
            </tr>
            </thead>
            <tbody>
                <?php if(!empty($_POST['client'])) : ?>
                <?php foreach($customers as $client): ?>
                <tr>
                    <td><?= $client['nom'] ?></td>
                    <td><?= $client['prenom'] ?></td>
                    <td><?= $client['email'] ?></td>
                    <td><?= $client['date_dernier_film'] ?></td>
                    <td><?= $client['ville'] ?></td>
                    <td><?= $client['id_membre'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <h1 class="text-danger m-2">Abonnements</h1>

        <form method="POST" action="my_cinema2.php" class="form-inline">
            <input type="text" name="abos" placeholder="Nom et/ou prénom" class="form-control m-2">
            <input type="submit" value="Rechercher" class="btn btn-danger m-2">
        </form>

        <table class="table table-danger">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">N°client</th>
                <th scope="col">Abonnement</th>
                <th scope="col">Durée</th>
                <th scope="col">Inscription</th>          
                <th scope="col">Fin</th>
                <th scope="col">Prix</th> 
                <th scope="col">Descriptif</th>
            </tr>
            </thead>
            <tbody>
                <?php if(!empty($_POST['abos'])) : ?>
                <?php foreach($abos as $abo): ?>
                <tr>
                    <td><?= $abo['nom_client'] ?></td>
                    <td><?= $abo['prenom'] ?></td>
                    <td><?= $abo['id_membre'] ?></td>
                    <td><?= $abo['nom_abo'] ?></td>
                    <td><?= $abo['duree_abo'] ?></td>
                    <td><?= $abo['date_inscription'] ?></td>
                    <td><?= $abo['date_abo'] ?></td>
                    <td><?= $abo['prix'] ?>€</td>
                    <td><?= $abo['resum'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <h3 class="text-danger m-1">Ajouter un abonnement</h3>
        <form method="POST" action="my_cinema2.php">
            <input type="text" name="id_membre" placeholder="N° client" class="form-control m-2">

            <input type="submit" value="Ajouter" class="btn btn-danger btn-sm m-2">
        </form>

        <h1 class="text-success m-2">Historique client</h1>
        <form method="POST" action="my_cinema2.php" class="form-inline">
            <input type="text" name="histo" placeholder="N° client" class="form-control m-2">
            <input type="submit" value="Rechercher" class="btn btn-success m-2">
        </form>
        <table class="table table-success">
            <thead>
            <tr>
                <th scope="col">N°client</th>
                <th scope="col">Film</th>
                <th scope="col">Vu le</th>
                <th scope="col">Synopsis</th>
            </tr>
            </thead>
            <tbody>
                <?php if(!empty($_POST['histo'])) : ?>
                <?php foreach($histo as $film): ?>
                <tr>
                    <td><?= $film['id_membre'] ?></td>
                    <td><?= $film['titre'] ?></td>
                    <td><?= $film['date'] ?></td>
                    <td><?= $film['resum']?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <h3 class="text-success m-1">Ajouter un film à l'historique</h3>

        <form method="POST" action="my_cinema2.php">
            <input type="text" name="id_membre" placeholder="N° client" class="form-control m-2">

            <select name="id_film" id="films"class="custom-select m-2">
                <option value="">Sélectionnez un film</option>
                <?php foreach($films as $film): ?>
                <option value="<?= $film['id_film']; ?>"> <?= $film['titre']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="2018-12-22" min="2018-01-01" max="2019-12-31">

            <input type="submit" value="Ajouter" class="btn btn-success btn-sm m-2">
        </form>
    </div>
</body>
</html>