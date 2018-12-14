<?php

function byName(){

    $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;host=127.0.0.1;charset=utf8', 'root', 'root');
    $tmp = $_POST['nom'];
    $nom = $bdd->prepare('SELECT * FROM film WHERE titre LIKE ?');
    $nom->execute(array('%'.$tmp.'%'));
    
    while ($array = $nom->fetch())
    {
        if(!empty($tmp)){
    ?>
        <p>
        <strong>Nom</strong> : <?= $array['titre']; ?><br />
        <strong>Synopsis</strong> : <?= $array['resum']; ?><br />
        <strong>Début</strong> : <?= $array['date_debut_affiche']; ?><br />
        <strong>A l'affiche jusqu'au</strong> : <?= $array['date_fin_affiche']; ?><br />
        <strong>Durée</strong> : <?= $array['duree_min']; ?> min<br />
        <strong>Année de production</strong> : <?= $array['annee_prod']; ?><br />
        </p>
    <?php
        }
    }
    $nom->closeCursor();
}

function byType(){

    $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;host=127.0.0.1;charset=utf8', 'root', 'root');
    $tmp = $_POST['genre'];
    $type = $bdd->prepare('SELECT * from film WHERE id_genre ?');
    $type->execute(array($tmp));

    while ($array = $type->fetch())
    {
        if(!empty($tmp)){
    ?>
        <p>
        <strong>Nom</strong> : <?= $array['titre']; ?><br />
        <strong>Synopsis</strong> : <?=$array['resum']; ?><br />
        <strong>Début</strong> : <?= $array['date_debut_affiche']; ?><br />
        <strong>A l'affiche jusqu'au</strong> : <?= $array['date_fin_affiche']; ?><br />
        <strong>Durée</strong> : <?= $array['duree_min']; ?> min<br />
        <strong>Année de production</strong> : <?= $array['annee_prod']; ?><br />
        </p>
    <?php
        }
    }
    $type->closeCursor();

}
byName();
byType();
?>