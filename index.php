<?php

require('model/database.php');
require('model/domain.php');
require('model/task.php');


$task_id = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
$task_description = filter_input(INPUT_POST, 'task_description', FILTER_SANITIZE_STRING);
$domain_name = filter_input(INPUT_POST, 'domain_name', FILTER_SANITIZE_STRING);

$domain_id = filter_input(INPUT_POST, 'domain_id', FILTER_VALIDATE_INT);
if (!$domain_id) {
    $domain_id = filter_input(INPUT_GET, 'domain_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = "list_tasks";
    }
}

switch ($action) {
    case "list_domain":
        $domains = get_domains();
        include('view/domain_list.php');
        break;

    case "add_domain":
        add_domain($domain_name);
        header("Location: .?action=list_domain");
        break;

    case "add_task":
        var_dump($task_description);
        if ($domain_id && $task_description) {
            add_task($domain_id, $task_description);
            header("Location: .?domain_id=$domain_id");
        } else {
            $error = "Les données du devoirs sont incorrectes. Veuillez recommencer svp";
            include('view/error.php');
            exit();
        }
        break;

    case "delete_domain":
        if ($domain_id) {
            try {
                delete_domain($domain_id);
            } catch (PDOException $e) {
                $error = "Vous ne pouvez pas supprimer une matière s'il y a des devoirs associés: " . $e->getMessage();
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_domain");
        }
        break;

    case "delete_task":
        if ($task_id) {
            delete_task($task_id);
            header("Location: .?domain_id=$domain_id");
        } else {
            $error = "id du devoir incorrect ou absent";
            include('view/error.php');
        }
        break;

    default:
        $domain_name = get_domain_name($domain_id);
        $domains = get_domains();
        $tasks = get_task_by_domain($domain_id);
        include('view/task_list.php');
}
