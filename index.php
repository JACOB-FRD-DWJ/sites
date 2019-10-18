<?php
    session_start();
    require_once 'controller/ControllerUser.php';
    require_once 'controller/admin/ControllerAdmin.php';
    $controllerAdmin = new ControllerAdmin();
    $controller = new ControllerUser();
    $action = '';

    if (isset($_GET['action'])) {

            $action = $_GET['action'];
            switch ($action) {
                case "login":
                    $controller->connect_user();
                    break;
                case "listChapter":
                    $controller->list_chapter_mozaic();
                    break;
                case "read":
                    $controller->read_chapter();
                    break;
                case "userComment":
                    $controller->post_comment();
                    break;
                case "userSignalComment":
                    $controller->user_signal_comment();
                    break;
                case "registration":
                    $controller->registration_user();
                    break;
                case "logout":
                    unset($_SESSION['user_connect']);
                    $controller->home();
                    break;
                case "logAdmin":
                    $controllerAdmin->control_admin_connect();
                    break;
                case "logoutAdmin":
                    session_destroy();
                    $controller->home();
                    break;
                case "create":
                    $controllerAdmin->control_create_chapter();
                    break;
                case "update":
                    $controllerAdmin->control_update_chapter();
                    break;
                case "delete":
                    $controllerAdmin->control_delete_chapter();
                    break;
                case "displayChapter":
                    $controllerAdmin->control_display_chapter();
                    break;
                case "update_chapter":
                    $controllerAdmin->control_update_chapter();
                    break;
                default:
                    $controller->home();
                    break;
            }

    } else {
        $controller->home();
    }