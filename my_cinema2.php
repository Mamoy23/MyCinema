<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;host=127.0.0.1;charset=utf8', 'root', 'root');
} catch (Exception $e) {
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

$sql = 'SELECT * FROM abonnement ORDER BY nom ASC';
$stmt = $bdd->prepare($sql);
$stmt->execute();
$list_abos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'test.php';
?>

<!DOCTYPE html>
<html lang="fr">
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
                    <?php foreach ($genres as $genre): ?>
                    <option value="<?=$genre['id_genre'];?>"><?=$genre['nom'];?></option>
                    <?php endforeach;?>
                </select>

                <select name="distribution" class="custom-select m-2">
                    <option value="">Sélectionnez un distributeur</option>
                    <?php foreach ($distribs as $distrib): ?>
                        <option value="<?=$distrib['id_distrib'];?>"><?=$distrib['nom'];?></option>
                    <?php endforeach;?>
                </select>

                <input type="submit" value="Rechercher" class="btn btn-dark m-2">
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

        <h1 class="text-primary m-2">Rechercher un client</h1>

        <form method="POST" action="my_cinema2.php" class="form-inline">
            <input type="text" name="client" placeholder="Nom ou prénom" class="form-control m-2">
            <input type="submit" value="Rechercher" class="btn btn-primary m-2">
        </form>

                <?php if (!empty($_POST['client'])): ?>
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
                <?php foreach ($customers as $client): ?>
                <tr>
                    <td class="text-capitalize font-weight-bold"><?=$client['nom']?></td>
                    <td class="text-capitalize font-weight-bold"><?=$client['prenom']?></td>
                    <td><?=$client['email']?></td>
                    <td><?=$client['date_dernier_film']?></td>
                    <td><?=$client['ville']?></td>
                    <td class="font-weight-bold"><?=$client['id_membre']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
                <?php endif;?>

        <h1 class="text-danger m-2">Abonnements</h1>

        <form method="POST" action="my_cinema2.php" class="form-inline">
            <input type="text" name="abos" placeholder="Nom ou prénom" class="form-control m-2">
            <span class="text-muted align-middle">OU</span>
            <input type="number" name="abos2" placeholder="N°client" class="form-control m-2">
            <input type="submit" value="Rechercher" class="btn btn-danger m-2">
        </form>

        <?php if (!empty($_POST['abos']) || !empty($_POST['abos2'])): ?>
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
                <?php foreach ($abos as $abo): ?>
                <tr>
                    <td class="text-capitalize"><?=$abo['nom_client']?></td>
                    <td class="text-capitalize"><?=$abo['prenom']?></td>
                    <td class="font-weight-bold"><?=$abo['id_membre']?></td>
                    <td class="font-weight-bold text-uppercase"><?=$abo['nom_abo']?></td>
                    <td><?=$abo['duree_abo']?></td>
                    <td><?=$abo['date_inscription']?></td>
                    <td><?=$abo['date_abo']?></td>
                    <td><?=$abo['prix']?>€</td>
                    <td class="text-capitalize"><?=$abo['resum']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php endif;?>

        <h3 class="text-danger m-1">Mettre à jour l'abonnement</h3>
        <form method="POST" action="my_cinema2.php">
            <input type="number" name="num_client" placeholder="N° client" class="form-control m-2 border-danger bg-light">
            <select name="id_abo" class="custom-select m-2 border-danger bg-light">
                <option value="">Faites votre choix ici</option>
                <?php foreach ($list_abos as $abo): ?>
                <option value="<?=$abo['id_abo'];?>"> Ajouter l'abonnement <?=$abo['nom'];?></option>
                <?php endforeach;?>
                <option value="NULL">Supprimer l'abonnement</option>
            </select>
            <input type="submit" value="Valider" class="btn btn-danger btn-sm m-2">
        </form>

        <h1 class="text-success m-2">Historique client</h1>
        <form method="POST" action="my_cinema2.php" class="form-inline">
            <input type="number" name="histo" placeholder="N° client" class="form-control m-2">
            <input type="submit" value="Rechercher" class="btn btn-success m-2">
        </form>

        <?php if (!empty($_POST['histo'])): ?>
        <table class="table table-success">
            <thead>
            <tr>
                <th scope="col">N°client</th>
                <th scope="col">Film</th>
                <th scope="col">Vu le</th>
                <th scope="col">Synopsis</th>
                <th scope="col">Avis</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($histo as $film): ?>
                <tr>
                    <td><?=$film['id_membre']?></td>
                    <td class="font-weight-bold"><?=$film['titre']?></td>
                    <td><?=$film['date']?></td>
                    <td><?=$film['resum']?></td>
                    <td><?=$film['avis']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php endif;?>

        <h3 class="text-success m-1">Ajouter un film à l'historique</h3>

        <form method="POST" action="my_cinema2.php">
            <input type="number" name="id_membre" placeholder="N° client" class="form-control m-2 border-success bg-light">

            <select name="id_film" id="films" class="custom-select m-2 border-success bg-light">
                <option value="">Sélectionnez un film</option>
                <?php foreach ($films as $film): ?>
                <option value="<?=$film['id_film'];?>"> <?=$film['titre'];?></option>
                <?php endforeach;?>
            </select>
            <label for="date" class="text-dark m-2">Date</label>
            <input type="date" id="date" name="date" min="2018-01-01" max="2019-12-31" class="border-success bg-light text-dark">

            <input type="submit" value="Ajouter" class="btn btn-success btn-sm m-2">
        </form>

        <h1 class="text-warning m-2">Avis client</h1>

        <form method="POST" action="my_cinema2.php">
            <input type="number" name="n_client" placeholder="N° client" class="form-control m-2 border-warning bg-light">
            <textarea name="avis" cols="50" rows="5" placeholder="Rédiger l'avis ici..." class="form-control m-2 border-warning bg-light"></textarea>
            <select name="movies" class="custom-select m-2 border-warning bg-light">
                <option value="">Sélectionnez un film</option>
                <?php foreach ($films as $film): ?>
                <option value="<?=$film['id_film'];?>"> <?=$film['titre'];?></option>
                <?php endforeach;?>
            </select>
            <input type="submit" value="Ajouter" class="btn btn-warning btn-sm m-2">
        </form>

        <h1 class="text-dark m-2">Programme du jour</h1>

        <form method="POST" action="my_cinema2.php">
            <input type="date" name="program" class="border-dark m-2 bg-light">
            <input type="submit" value="Rechercher" class="btn btn-dark m-2">
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