<?php

    $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;host=127.0.0.1;charset=utf8', 'root', 'root');
    $movie_query = 'SELECT *, distrib.nom AS nom_distrib, genre.nom AS nom_genre 
                    FROM film 
                    INNER JOIN genre ON genre.id_genre=film.id_genre 
                    LEFT JOIN distrib ON distrib.id_distrib=film.id_distrib 
                    WHERE 1';

    if(isset($_POST["nom"]) && !empty($_POST["nom"])){
        $movie_query .= " AND film.titre LIKE '%{$_POST["nom"]}%'";
    }
    if(isset($_POST["genre"]) && !empty($_POST["genre"])){
        $movie_query .= " AND genre.id_genre = {$_POST["genre"]}";
    }
    if(isset($_POST["distribution"]) && !empty($_POST["distribution"])){
        $movie_query .= " AND distrib.id_distrib = {$_POST["distribution"]}";
    }
    
    $stmt = $bdd->prepare($movie_query);
    $stmt->execute();
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST["client"]) && !empty($_POST["client"])){
    $customer_query = "SELECT * from fiche_personne 
                        INNER JOIN membre ON fiche_personne.id_perso=membre.id_fiche_perso 
                        WHERE nom LIKE '%{$_POST["client"]}%' OR prenom LIKE '%{$_POST["client"]}%' 
                        ORDER BY nom ASC";
    $stmt = $bdd->prepare($customer_query);
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    if(isset($_POST["abos"]) && !empty($_POST["abos"])){
    $abo_query = "SELECT *, fiche_personne.nom AS nom_client, abonnement.nom AS nom_abo from fiche_personne 
                    INNER JOIN membre ON fiche_personne.id_perso=membre.id_fiche_perso 
                    LEFT JOIN abonnement ON abonnement.id_abo=membre.id_abo 
                    WHERE fiche_personne.nom LIKE '%{$_POST["abos"]}%' OR prenom LIKE '%{$_POST["abos"]}%' 
                    ORDER BY fiche_personne.nom ASC";
    $stmt = $bdd->prepare($abo_query);
    $stmt->execute();
    $abos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if(isset($_POST['histo']) && !empty($_POST['histo'])){
    $histo_query = "SELECT * from historique_membre 
                    INNER JOIN film ON historique_membre.id_film=film.id_film 
                    LEFT JOIN membre ON historique_membre.id_membre=membre.id_membre 
                    WHERE membre.id_membre = {$_POST['histo']} 
                    ORDER BY date DESC";
    $stmt = $bdd->prepare($histo_query);
    $stmt->execute();
    $histo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if(isset($_POST['id_membre']) && isset($_POST['id_film']) && isset($_POST['date']) && !empty($_POST['id_membre']) && !empty($_POST['id_film']) && !empty($_POST['date'])){
    $add_movie_query = "INSERT INTO historique_membre(id_membre, id_film, date) VALUES(:id_membre, :id_film, :date)";
    $stmt = $bdd->prepare($add_movie_query);
    $stmt->execute(array(
        'id_membre' => $_POST['id_membre'],
        'id_film' =>  $_POST['id_film'],
        'date' => $_POST['date']
        ));
    }

    if(isset($_POST['num_client']) && isset($_POST['id_abo']) && !empty($_POST['num_client']) && !empty($_POST['id_abo'])){
        $add_abo_query = "UPDATE membre SET id_abo = :id_abo WHERE id_membre = :num_client";
        $stmt = $bdd->prepare($add_abo_query);
        $stmt->execute(array(
            'id_abo' => $_POST['id_abo'],
            'num_client' => $_POST['num_client']
        ));
        if($_POST['id_abo'] == "NULL"){
            $delete_abo_query = "UPDATE membre SET id_abo = NULL WHERE id_membre = :num_client";
            $stmt = $bdd->prepare($delete_abo_query);
            $stmt->execute(array(
                'num_client' => $_POST['num_client']
            ));
        }
    }

    $stmt = $bdd->prepare('ALTER TABLE historique_membre ADD avis VARCHAR(255)');
    $stmt->execute();

    if(isset($_POST['avis']) && isset($_POST['movies']) && !empty($_POST['avis']) && !empty($_POST['movies'])){
        $add_opinion_query = "UPDATE historique_membre SET avis = :avis WHERE id_film = :movie AND id_membre = :n_client";
        $stmt = $bdd->prepare($add_opinion_query);
        $stmt->execute(array(
            'avis' => $_POST['avis'],
            'movie' => $_POST['movies'],
            'n_client' => $_POST['n_client']
        ));
    }