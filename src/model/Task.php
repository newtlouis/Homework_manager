<?php 

namespace App\Model;

class Task{
    public function get_task_by_domain($domain_id){
        global $db;
    
        if($domain_id){
            $query = 'SELECT task.id, task.description, domain.name FROM task LEFT JOIN domain ON task.domain_id = domain.id WHERE task.domain_id = :domain_id ORDER BY task.id';
        }
        else{
            $query = 'SELECT task.id, task.description, domain.name FROM task LEFT JOIN domain ON task.domain_id = domain.id ORDER BY task.id';
        }
    
        $statement = $db->prepare($query);
        if($domain_id){
            $statement->bindValue(':domain_id', $domain_id);
        }    
        $statement->execute();
        $tasks = $statement->fetchAll();
        $statement->closeCursor();
    
        return $tasks;
    }
    
    public function delete_task($task_id){
        global $db;
        $query = 'DELETE  FROM task WHERE id = :task_id';    
        $statement = $db->prepare($query);
        $statement->bindValue(':task_id', $task_id);
        $statement->execute();
        $statement->closeCursor();
    
    }
    
    public function add_task($domain_id,$description){
        global $db;
        $query = 'INSERT INTO task (description, domain_id) VALUE (:description, :domain_id)';    
        $statement = $db->prepare($query);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':domain_id', $domain_id);
        $statement->execute();
        $statement->closeCursor();
    
    }
}

?>