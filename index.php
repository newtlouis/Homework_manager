<?php

use App\Model\Domain;
use App\Model\Task;

require_once realpath("vendor/autoload.php");



require('src/model/database.php');




$task_id = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
$task_description = filter_input(INPUT_POST, 'task_description', FILTER_SANITIZE_STRING);
$domain_name = filter_input(INPUT_POST, 'domain_name', FILTER_SANITIZE_STRING);

if(isset($_POST['date_task'])){
    $date_task = $_POST['date_task'];
}

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

$domain = new Domain();
$task = new Task();

switch ($action) {

    case "list_domain":
        $domains = $domain->get_domains();
        include('src/view/domain_list.php');
        break;

    case "add_domain":
        $domain->add_domain($domain_name);
        header("Location: .?action=list_domain");
        break;

    case "add_task":
        if ($domain_id && $task_description) {
            $task->add_task($domain_id, $task_description, $date_task);
            header("Location: .");
        } else {
            $error = "Les données du devoirs sont incorrectes. Veuillez recommencer svp";
            include('src/view/error.php');
            exit();
        }
        break;

    case "delete_domain":
        if ($domain_id) {
            try {
                $domain->delete_domain($domain_id);
            } catch (PDOException $e) {
                $error = "Vous ne pouvez pas supprimer une matière s'il y a des devoirs associés: " . $e->getMessage();
                include('src/view/error.php');
                exit();
            }
            header("Location: .?action=list_domain");
        }
        break;

    case "delete_task":
        if ($task_id) {
            $task->delete_task($task_id);
            header("Location: .?domain_id=$domain_id");
        } else {
            $error = "id du devoir incorrect ou absent";
            include('src/view/error.php');
        }
        break;

    default:
        $domain_name = $domain->get_domain_name($domain_id);
        $domains = $domain->get_domains();
        $tasks = $task->get_task_by_domain($domain_id);
        include('src/view/task_list.php');
}
