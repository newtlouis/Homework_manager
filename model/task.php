<?php 

function get_task_by_domain(int $domain_id){
    global $db;

    if($domain_id){
        $query = 'SELECT task.id, task.description, domain.name FROM task LEFT JOIN domain ON task.domain_id = domain.id WHERE task.domain_id = :domain_id ORDER BY task.id';
    }
    else{
        $query = 'SELECT task.id, task.description, domain.name FROM task LEFT JOIN domain ON task.domain_id = domain.id ORDER BY task.id';
    }

    $statement = $db->prepare($query);
    $statement->bindValue(':domain_id', $domain_id);
    $statement->execute();
    $tasks = $statement->fetchAll();
    $statement->closeCursor();

    return $tasks;
}

function delete_task(int $task_id){
    global $db;
    $query = 'DELETE  FROM task WHERE id = :task_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':task_id', $task_id);
    $statement->execute();
    $statement->closeCursor();

}

function add_task(int $domain_id, string $description){
    global $db;
    $query = 'INSERT INTO task (description, domain_id) VALUE (:description, :domain_id)';    
    $statement = $db->prepare($query);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':domain_id', $domain_id);
    $statement->execute();
    $statement->closeCursor();

}

?>