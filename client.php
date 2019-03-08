<?php include 'controller.php'?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clients</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="bg">
    <?php include 'navbar.html' ?>
    <div class="container bord border-info">

    <h1 class="text-info m-2 lobster">Rechercher un client</h1>

    <form method="POST" action="" class="form-inline">
        <input type="text" name="client" placeholder="Nom ou prénom" class="border-info form-control m-2">
        <input type="submit" value="Rechercher" class="btn btn-info m-2">
    </form>

    <?php if (!empty($_POST['client'])): ?>
        <table class="table table-info">
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
    </div>
    
    <div class="container bord border-danger">
        <h1 class="text-danger m-2 lobster">Abonnements</h1>

        <form method="POST" action="" class="form-inline">
            <input type="text" name="abos" placeholder="Nom ou prénom" class="border-danger form-control m-2">
            <span class="text-muted align-middle">OU</span>
            <input type="number" name="abos2" placeholder="N°client" class="border-danger form-control m-2">
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
        <form method="POST" action="">
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
    </div>
    
    <div class="container bord border-success">
        <h1 class="text-success m-2 lobster">Historique client</h1>
        <form method="POST" action="" class="form-inline">
            <input type="number" name="histo" placeholder="N° client" class="border-success form-control m-2">
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

        <form method="POST" action="">
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
    </div>

    <div class="container bord border-warning">
        <h1 class="text-warning m-2 lobster">Avis client</h1>

        <form method="POST" action="">
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
    </div>

</body>
</html>