<?php
    require_once 'model/ChapterManager.php';
    require_once 'model/CommentManager.php';
    require_once 'model/ConnectionManager.php';
    require_once 'model/RegistrationManager.php';
    require 'view/Session_message_flash.php';


class ControllerUser{

        public $message;

        public function message_flash(){
            $this->message = new Session_message_flash();
            return $this->message;
        }

        public function connect_user(){
            $session_flash_msg = $this->message_flash();
            if(!isset($_POST['emailConnect']) || !isset($_POST['passwordConnect'])){
                require_once 'view/view_user_auth.php';
            }else {
                $model = new ConnectionManager();
                $email_connect_user = filter_var($_POST['emailConnect'], FILTER_SANITIZE_EMAIL);
                $password_connect_user = $_POST['passwordConnect'];
                $check_user = $model->check_user_connection($email_connect_user);
                if($check_user !== false){
                    $password_match = password_verify($password_connect_user, $check_user['password']);
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
            $chapters = $chapters_object->return_chapters();
            require 'view/view_mozaic.php';
        }

        public function registration_user(){
            $session_flash_msg = $this->message_flash();
            if (!isset($_POST['emailRegistration']) || !isset($_POST['pseudoRegistration']) || !isset($_POST['passwordRegistration'])){
                $session_flash_msg->set_flash("Remplir tout les champs", "danger");
                $session_flash_msg->flash();
                require_once 'view/view_user_registr.php';
            } else{
                $emailRegistration = filter_var($_POST['emailRegistration'], FILTER_SANITIZE_EMAIL);
                $pseudoRegistration = filter_var($_POST['pseudoRegistration'], FILTER_SANITIZE_STRING);
                $passwordRegistration = password_hash($_POST['passwordRegistration'], PASSWORD_ARGON2ID);
                $registration_user = new RegistrationManager();
                $check = $registration_user->check_user_exist_registration($pseudoRegistration,$emailRegistration);
                var_dump($check);
                die();
                if ($check !== false){
                    $session_flash_msg->set_flash("Problème survenu lors de l'inscription.", "danger");
                    $session_flash_msg->flash();
                    require_once 'view/view_user_registr.php';
                } else{
                    $_SESSION['user_connect'] = 1;
                    $registration_user->user_registration($pseudoRegistration,$emailRegistration,$passwordRegistration);
                    $registration_user->user_success_registration();
                }
            }
        }

        public function post_comment(){
            $model_comment = new CommentManager();
            $model_chapter = new ChapterManager();
            $session_flash_msg = $this->message_flash();
            if (isset($_GET['chapter_id']) && is_numeric($_GET['chapter_id']) && isset($_POST['commentaires'])){
                $chapter_id = $_GET['chapter_id'];
                $pseudo = $_SESSION['pseudo_user'];
                $chapter_comment = htmlspecialchars($_POST['commentaires']);
                $valid = 0;
                $model_comment->post_comment($pseudo, $chapter_id, $chapter_comment, $valid);
                $session_flash_msg->set_flash("Remplir tout les champs", "danger");
                $session_flash_msg->flash();
                $comments = $model_comment->return_all_comments();
                $chapters = $model_chapter->return_chapters();
                $chapter = $model_chapter->return_chapter($chapter_id);
                require_once 'view/view_chapter.php';
            }

        }

        public function home(){
            $manager = new ChapterManager();
            $comment = new CommentManager();
            if (isset($_GET['chapter_id'])) {
                if (isset($_SESSION['user_connect'])) {
                    $chapter_id = htmlspecialchars($_GET['chapter_id']);
                    $chapters = $manager->return_chapters();
                    $chapter = $manager->return_chapter($chapter_id);
                    $comments = $comment->return_chapters_comments($chapter_id);
                }else{
                    $chapter_id = htmlspecialchars($_GET['chapter_id']);
                    $chapters = $manager->return_chapters();
                    $chapter = $manager->return_chapter($chapter_id);
                }
            }
            require 'view/home.php';
        }

        public function read_chapter(){
            $model_chapters = new ChapterManager();
            $model_comments = new CommentManager();
            if (isset($_GET['chapter_id'])) {
                $chapter_id = htmlspecialchars($_GET['chapter_id']);
                $chapters = $model_chapters->return_chapters();
                $chapter = $model_chapters->return_chapter($chapter_id);
                $comments = $model_comments->return_all_comments();
            } else {
                $chapters = $model_chapters->return_chapters();
                $chapter_id = 1;
                $chapter = $model_chapters->return_chapter($chapter_id);
                $comments = $model_comments->return_all_comments();
            }
            require 'view/view_chapter.php';

        }

        public function user_signal_comment(){
            $model_chapters = new ChapterManager();
            $model_comments = new CommentManager();
            $session_flash_msg = $this->message_flash();
            if(isset($_GET['comment_id'])) {
                $comment_id = htmlspecialchars($_GET['comment_id']);
                $chapters = $model_chapters->return_chapters();
                $comments = $model_comments->return_chapter_comments($comment_id);
                $model_comments->signal_comment($comment_id);
                $chapter = $model_chapters->return_chapter($comment_id);
                header('Location:./index.php?action=listChapter');
            }
            $session_flash_msg->set_flash("Le commentaire a été signalé.", 'success');
            $session_flash_msg->flash();
            require 'view/view_chapter.php';
        }

    }


