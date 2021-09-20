<?php

require('model/database.php');
require('model/domain.php');
require('model/task.php');


$task_id = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
$task_description = filter_input(INPUT_POST, 'task_description', FILTER_SANITIZE_STRING);
$domain_name = filter_input(INPUT_POST, 'domain_name', FILTER_SANITIZE_STRING);

$domain_id = filter_input(INPUT_POST, 'domain_id', FILTER_VALIDATE_INT);
if(!$domain_id){
    $domain_id = filter_input(INPUT_GET, 'domain_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if(!$action){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!$action){
        $action = "list_tasks";
    }
}

switch($action){
    default:
        $domain_name = get_domain_name($domain_id);
        $domains = get_domains();
        $tasks = get_task_by_domain($domain_id);
        include('view/task_list.php');
}


?>