<?php
    require_once 'model/ChapterManager.php';
    require_once 'model/CommentManager.php';
    require_once 'model/ConnectionManager.php';
    require_once 'model/RegistrationManager.php';
    require 'view/Session_message_flash.php';


class ControllerUser{

        public function connect_user(){
            $session_flash_msg = new Session_message_flash();
            if(!isset($_POST['emailConnect']) || !isset($_POST['passwordConnect'])){
                require_once 'view/view_user_auth.php';
            }else {
                $model = new ConnectionManager();
                $_SESSION['emailConnect'] = filter_var($_POST['emailConnect'], FILTER_SANITIZE_EMAIL);
                $_SESSION['passwordConnect'] = $_POST['passwordConnect'];
                $check_user = $model->check_user_connection();
                if($check_user !== false){
                    $password_match = password_verify($_POST['passwordConnect'], $check_user['password']);
                    if($password_match === true){
                        $session_flash_msg->set_flash("Vous êtes connecté.", 'success');
                        $session_flash_msg->flash();
                        $_SESSION['user_connect'] = 1;
                        $_SESSION['pseudo_user'] = $check_user['pseudo'];
                        $this->read_chapter();
                    } else{
                        $session_flash_msg->set_flash("Problème d'authentification");
                        $session_flash_msg->flash();
                        require_once 'view/view_user_auth.php';
                    }
                } else{
                    $session_flash_msg->set_flash("Erreur d'authentification");
                    $session_flash_msg->flash();
                    require_once 'view/view_user_auth.php';
                }
            }
        }

        public function list_chapter_mozaic(){
            $chapters_object = new ChapterManager();
            $chapters = $chapters_object->get_chapters();
            require 'view/view_mozaic.php';
        }

        public function registration_user(){
            if (!isset($_POST['emailRegistration'])){
                require_once 'view/view_user_registr.php';
            } else{
                $_SESSION['emailRegistration'] = filter_var($_POST['emailRegistration'], FILTER_SANITIZE_EMAIL);
                $_SESSION['pseudoRegistration'] = filter_var($_POST['pseudoRegistration'], FILTER_SANITIZE_STRING);
                $_SESSION['passwordRegistration'] = password_hash($_POST['passwordRegistration'], PASSWORD_ARGON2ID);
                $registration_user = new RegistrationManager();
                $check = $registration_user->check_user_exist_registration();
                if ($check !== false){
                    require_once 'view/view_user_registr.php';
                } else{
                    $_SESSION['pseudo_user'] = $_SESSION['pseudoRegistration'];
                    $_SESSION['success_user'] = "success_connect";
                    $registration_user->user_registration();
                    $registration_user->user_success_registration();
                }
            }
        }

        public function post_comment(){
            $model_comment = new CommentManager();
            $model_chapter = new ChapterManager();
            if (isset($_GET['chapter_id']) && is_numeric($_GET['chapter_id']) && isset($_POST['commentaires'])){
                $chapter_id = $_GET['chapter_id'];
                $pseudo = $_SESSION['pseudo_user'];
                $chapter_comment = htmlspecialchars($_POST['commentaires']);
                $valid = 0;
                $model_comment->post_comment($pseudo, $chapter_id, $chapter_comment, $valid);
                $comments = $model_comment->get_comments();
                $chapters = $model_chapter->get_chapters();
                $chapter = $model_chapter->read_chapter($chapter_id);
                require_once 'view/view_chapter.php';
            }

        }

        public function home(){
            $manager = new ChapterManager();
            $comment = new CommentManager();
            if (isset($_GET['chapter_id'])) {
                if (isset($_SESSION['user_connect'])) {
                    $chapter_id = htmlspecialchars($_GET['chapter_id']);
                    $chapters = $manager->get_chapters();
                    $chapter = $manager->read_chapter($chapter_id);
                    $comments = $comment->get_chapter_comments($chapter_id);
                }else{
                    $chapter_id = htmlspecialchars($_GET['chapter_id']);
                    $chapters = $manager->get_chapters();
                    $chapter = $manager->read_chapter($chapter_id);
                }
            }else{
                if (isset($_SESSION['user_connect'])) {
                    $chapters = $manager->get_chapters();
                    $first_chapter = $manager->get_first_chapter();
                    $chapter_id = 1;
                    $comments = $comment->get_chapter_comments($chapter_id);
                }else{
                    $chapters = $manager->get_chapters();
                    $first_chapter = $manager->get_first_chapter();
                }

            }
            require 'view/home.php';
        }

        public function read_chapter(){
            $model_chapters = new ChapterManager();
            $model_comments = new CommentManager();
            if (isset($_GET['chapter_id'])) {
                $chapter_id = htmlspecialchars($_GET['chapter_id']);
                $chapters = $model_chapters->get_chapters();
                $chapter = $model_chapters->read_chapter($chapter_id);
                $comments = $model_comments->get_comments();
            }
            require 'view/view_chapter.php';
        }

        public function user_signal_comment(){
            $model_chapters = new ChapterManager();
            $model_comments = new CommentManager();
            $session_flash_msg = new Session_message_flash();
            if(isset($_GET['comment_id'])) {
                $comment_id = htmlspecialchars($_GET['comment_id']);
                $chapters = $model_chapters->get_chapters();
                $comments = $model_comments->get_chapter_comments($comment_id);
                $first_chapter = $model_chapters->get_first_chapter();
                $model_comments->signal_comment($comment_id);
            }
            $session_flash_msg->set_flash("Le commentaire a été signalé.", 'success');
            $session_flash_msg->flash();
            require 'view/view_chapter.php';
        }

    }


