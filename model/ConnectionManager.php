<?php

    class ConnectionManager{

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

        public function check_user_connection($email_connect_user){
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT pseudo,email,password FROM `users` WHERE `email` = ?");
            $req->bindParam(1, $email_connect_user, PDO::PARAM_STR);
            $req->execute();
            $check_user = $req->fetch();
            return $check_user;
        }

    }