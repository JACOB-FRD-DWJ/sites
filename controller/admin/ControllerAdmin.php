<?php

class ControllerAdmin{

    public function root_view($view){
        switch ($view){
            case "home":
                require 'view/admin/home_admin_view.php';
                break;
            case "create":
                require 'view/admin/create_view.php';
                break;
            case "update":
                require 'view/admin/update_view.php';
                break;
            default:
                require 'view/admin/home_admin_view.php';
                break;
        }
    }

    public function check_admin_connect(){
        if (isset($_SESSION['admin_connect'])){
            return true;
        } else{
            header('Location:./index.php');
        }
    }

    public function control_admin_connect(){
        require_once 'model/admin/ConnectAdminManager.php';
        require_once 'model/ChapterManager.php';
        $chapterManager = new ChapterManager();
        $message_flash = new Session_message_flash();
        if(isset($_POST['admin']) && isset($_POST['pass'])){
            $admin = filter_var($_POST['admin'], FILTER_SANITIZE_STRING);
            $password = $_POST['pass'];
            //password : JesuisicientantquadmiN
            $model_action_admin = new ModelConnectAdminManager();
            $check = $model_action_admin->check_admin_connect($admin);
            if ($check == true){
                $password_match = password_verify($password, $check['pass']);
                if ($password_match === true) {
                    $message_flash->set_flash("Bienvenu M. Forteroche !", "success");
                    $message_flash->flash();
                    $_SESSION['admin_connect'] = 1;
                    $number_rows = $chapterManager->return_chapters_row();
                    $chapters = $chapterManager->return_chapters();
                } else{
                    $message_flash->set_flash("Problème d'authentification !");
                    $message_flash->flash();
                }
            }
        }else{
            $chapters = $chapterManager->return_chapters();
            $number_rows = $chapterManager->return_chapters_row();
        }
        require 'view/admin/home_admin_view.php';
    }

    public function control_create_chapter(){
        require_once 'model/ChapterManager.php';
        $this->check_admin_connect();
        $chapterManager = new ChapterManager();
        $root_img = "media/images/";
        $last_chapter_id = $chapterManager->return_id_last_chapter();
        $last_chapter_id = $last_chapter_id['chapter_id'];
        if (isset($_POST['title']) && isset($_POST['image']) && isset($_POST['contain'])) {
            $last_chapter_id = $last_chapter_id + 1;
            $title = $_POST['title'];
            $img = $_POST['image'];
            $file_parts = pathinfo($img);
            $file_parts['extension'];
            $cool_extensions = Array('jpg','png');
            if (in_array($file_parts['extension'], $cool_extensions)){
                echo 'ok good';
            } else {
                echo 'nooooooooo';
                header('location: ./index.php');
            }
            $image = $root_img.$_POST['image'];
            $contain = $_POST['contain'];
            $chapterManager->create_chapter($last_chapter_id,$title,$image,$contain);
            $chapters = $chapterManager->return_chapters();
            require 'view/admin/home_admin_view.php';
        } else{
            $chapters = $chapterManager->return_chapters();
            require_once 'view/admin/create_view.php';
        }
    }

    public function control_update_chapter(){
        require_once 'model/ChapterManager.php';
        $this->check_admin_connect();
        $root_img = "media/images/";
        $chapter_id = $_GET['chapter_id'];
        $chapter_manager = new ChapterManager();
        $chapters = $chapter_manager->return_chapters();
        $chapter = $chapter_manager->return_chapter($chapter_id);
        $number_rows = $chapter_manager->return_chapters_row();
        if (isset($_GET['chapter_id'])) {
            if ($_GET['chapter_id'] > 0) {
                if(isset($_POST['title']) && isset($_POST['image']) && isset($_POST['contain'])) {
                    $chapter_id = htmlspecialchars($_GET['chapter_id']);
                    $title = filter_var($_POST['title'], FILTER_DEFAULT);
                    $image = $root_img . $_POST['image'];
                    $chapter_contain = $_POST['contain'];
                    $chapter_manager->update_chapter($title, $image, $chapter_contain, $chapter_id);
                    $message_flash = new Session_message_flash();
                    $message_flash->set_flash("Le chapitre a était mis à jour.", "success");
                    $message_flash->flash();
                }else{
                    require_once 'view/admin/update_view.php';
                }
            }
            else{
                require_once 'view/admin/update_view.php';
            }
        }else{
            echo 'non';
            require 'view/admin/home_admin_view.php';
        }
    }

    public function control_delete_chapter(){
        require_once 'model/ChapterManager.php';
        $this->check_admin_connect();
        $chapter_manager = new ChapterManager();
        if(isset($_GET['chapter_id'])) {
            $chapter_id = $_GET['chapter_id'];
            $chapters = $chapter_manager->return_chapters();
            $chapter_manager->delete_chapter($chapter_id);
            $chapters = $chapter_manager->return_chapters();
            require 'view/admin/home_admin_view.php';
        }else{
            $chapters = $chapter_manager->return_chapters();
            $number_rows = $chapter_manager->return_chapters_row();
            require 'view/admin/delete_view.php';
        }
    }

    public function control_display_chapter(){
        require_once 'model/ChapterManager.php';
        $this->check_admin_connect();
        $chapter_manager = new ChapterManager();
        if (isset($_GET['chapter_id'])) {
            $chapter_id = htmlspecialchars($_GET['chapter_id']);
            $chapters = $chapter_manager->return_chapters();
            $chapter = $chapter_manager->return_chapter($chapter_id);
            require 'view/admin/displayChapter.php';
        } else{
            $chapters = $chapter_manager->return_chapters();
            $number_rows = $chapter_manager->return_chapters_row();
            require 'view/admin/home_admin_view.php';
        }
    }

    public function control_read_comments(){
        require_once 'model/ChapterManager.php';
        require_once 'model/CommentManager.php';
        $this->check_admin_connect();
        $chapter_manager = new ChapterManager();
        $comments_manager = new CommentManager();
        if (isset($_GET['chapter_id'])){
            $chapter_id = htmlspecialchars($_GET['chapter_id']);
            $chapter = $chapter_manager->return_chapter($chapter_id);
            $comments = $comments_manager->return_comments($chapter_id);
        }else{
            $comments = $comments_manager->return_all_comments();
        }
        require 'view/admin/view_admin_comments.php';
    }

    public function control_size_and_extension_img(){

    }

    public function control_valid_comment(){
        require_once 'model/ChapterManager.php';
        require_once 'model/CommentManager.php';
    }

    public function control_delete_comment(){

    }

}