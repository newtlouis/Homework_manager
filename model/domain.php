<?php

function get_domains(){
    global $db;
    $query = 'SELECT * FROM domain ORDER BY id';
    $statement = $db->prepare($query);
    $statement->execute();
    $domains = $statement->fetchAll();
    $statement->closeCursor();

    return $domains;
}

function get_domain_name(int $domain_id){
    if (!$domain_id){
        return "Toutes les matières";
    }
    global $db;
    $query = 'SELECT name FROM domain WHERE id = :$domain_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':domain_id', $domain_id);
    $statement->execute();
    $domain = $statement->fetchAll();
    $statement->closeCursor();

    return $domain;
}

function delete_domain(int $domain_id){
    global $db;
    $query = 'DELETE FROM domain WHERE id = :$domain_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':domain_id', $domain_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_domain(string $domain_name){
    global $db;
    $query = 'INSERT INTO domain (name) VALUES (:domain_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':domain_name', $domain_name);
    $statement->execute();
    $statement->closeCursor();
}

?>