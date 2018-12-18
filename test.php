<?php

    $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;host=127.0.0.1;charset=utf8', 'root', 'root');
    $sql = 'SELECT *, distrib.nom AS nom_distrib, genre.nom AS nom_genre FROM film INNER JOIN genre ON genre.id_genre=film.id_genre LEFT JOIN distrib ON distrib.id_distrib=film.id_distrib WHERE 1';
    
    if(isset($_POST["nom"]) && !empty($_POST["nom"])){
        $sql .= " AND film.titre LIKE '%{$_POST["nom"]}%'";
    }
    if(isset($_POST["genre"]) && !empty($_POST["genre"])){
        $sql .= " AND genre.id_genre = {$_POST["genre"]}";
    }
    if(isset($_POST["distribution"]) && !empty($_POST["distribution"])){
        $sql .= " AND distrib.id_distrib = {$_POST["distribution"]}";
    }
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //$sql2 = 'SELECT * FROM film INNER JOIN distrib ON distrib.id_distrib=film.id_distrib WHERE 1 ';
    //$tmp = $bdd->prepare($sql2);
    //$tmp->execute();
    //$distrib_table = $tmp->fetchAll(PDO::FETCH_ASSOC);