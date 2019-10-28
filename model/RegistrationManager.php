<?php


    class RegistrationManager{

        public $db;

        public function dbConnect(){
            if ($_SERVER['HTTP_HOST'] === "localhost") {
                $this->db = new PDO('mysql:host=localhost;dbname=thewriterblog;charset=utf8', 'root', '');
                return $this->db;
            }else{
                $host_name = 'db5000206227.hosting-data.io';
                $database = 'dbs201170';
                $user_name = 'dbu172353';
                $password = 'c8!@brDRYTEZqFP';
                $dbh = null;
                try {
                    $this->db = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
                    return $this->db;
                } catch (PDOException $e) {
                    echo "Erreur!: " . $e->getMessage() . "<br/>";
                    die();
                }

            }
        }

        public function getIp(){

            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_X_FORWARDED']))
                $ip = $_SERVER['HTTP_X_FORWARDED'];
            else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
                $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
            else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ip = $_SERVER['HTTP_FORWARDED_FOR'];
            else if (isset($_SERVER['HTTP_FORWARDED']))
                $ip = $_SERVER['HTTP_FORWARDED'];
            else if (isset($_SERVER['REMOTE_ADDR']))
                $ip = $_SERVER['REMOTE_ADDR'];
            else
                $ip = 'UNKNOWN';

            return $ip;

        }

        public function check_user_exist_registration($pseudoRegistration, $emailRegistration){
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT * FROM `users` WHERE `pseudo` = ? or `email` = ?");
            $req->bindParam(1, $pseudoRegistration, PDO::PARAM_STR);
            $req->bindParam(2, $emailRegistration, PDO::PARAM_STR);
            $req->execute();
            $check_exist = $req->fetch();
            return $check_exist;
        }

        public function user_registration($pseudoRegistration,$emailRegistration,$passwordRegistration){
            $db = $this->dbConnect();
            $ip = $this->getIp();
            $key_user = random_int(0, 8000);
            $req = $db->prepare("INSERT INTO `users` (`ip`,`pseudo`,`email`,`password`,`key_user`) VALUES (?,?,?,?,?)");
            $req->bindParam(1, $ip, PDO::PARAM_STR);
            $req->bindParam(2, $pseudoRegistration, PDO::PARAM_STR);
            $req->bindParam(3, $emailRegistration, PDO::PARAM_STR);
            $req->bindParam(4, $passwordRegistration);
            $req->bindParam(5, $key_user);
            $req->execute();
        }

        public function user_success_registration(){
            $model_chapters = new ChapterManager();
            $model_comments = new CommentManager();
            $chapters = $model_chapters->return_chapters();
            $chapter_id = 1;
            $chapter = $model_chapters->return_chapter($chapter_id);
            $comments = $model_comments->return_all_comments();
            require_once 'view/view_chapter.php';
        }


    }