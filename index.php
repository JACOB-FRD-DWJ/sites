<?php
    session_start();
    require_once 'controller/ControllerUser.php';
    require_once 'controller/admin/ControllerAdmin.php';
    $controllerAdmin = new ControllerAdmin();
    $controller = new ControllerUser();
    $message_flash = new Session_message_flash();
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
                    $message_flash->set_flash("Vous êtes déconnecté.", "success");
                    $message_flash->flash();
                    $controller->home();
                    break;
                case "logAdmin":
                    $controllerAdmin->control_admin_connect();
                    break;
                case "logoutAdmin":
                    unset($_SESSION['admin_connect']);
                    $message_flash->set_flash("Vous êtes déconnecté.", "success");
                    $message_flash->flash();
                    $controller->home();
                    break;
                case "read_comments":
                    $controllerAdmin->control_read_comments();
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
                case "delete_comment":
                    $controllerAdmin->control_delete_comment();
                    break;
                case "valid_comment":
                    $controllerAdmin->control_valid_comment();
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