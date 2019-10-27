<?php

    class CommentManager{

        public $db;

        public function dbConnect(){
            if ($_SERVER['HTTP_HOST'] === "localhost") {
                $this->db = new PDO('mysql:host=localhost;dbname=thewriterblog;charset=utf8', 'root', '');
                return $this->db;
            }else{
                $host_name = 'db5000206227.hosting-data.io';
                $database = 'dbs201170';
                $user_name = 'dbu172353';
                $password = 'mergue45121p_zorientAsdCccslodkADdsdqSDale7779aze';
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

        public function return_all_comments(){
            $db = $this->dbConnect();
            $req = $db->query('select * from commentaires');
            $req->execute();
            $comments = $req->fetchAll();
            return $comments;
        }

        public function return_comments($chapter_id){
            $db = $this->dbConnect();
            $req = $db->query('select * from commentaires where chapter_id ='.$chapter_id);
            $req->execute();
            $comments = $req->fetchAll();
            return $comments;
        }

        public function post_comment($pseudo, $chapter_id, $chapter_comment, $valid){
            $db = $this->dbConnect();
            $req = $db->prepare("insert into commentaires (pseudo, chapter_id, commentaires, status) values (?,?,?,?)");
            $req->bindParam(1, $pseudo);
            $req->bindParam(2, $chapter_id);
            $req->bindParam(3, $chapter_comment);
            $req->bindParam(4, $valid);
            $req->execute();
        }

        public function return_chapter_comments($comment_id){
            $db = $this->dbConnect();
            $req = $db->query('SELECT * FROM `commentaires` WHERE `chapter_id` ='.$comment_id);
            $comments = $req->fetchAll();
            return $comments;
        }

        public function signal_comment($comment_id){
            $db = $this->dbConnect();
            $req = $db->prepare('update commentaires set status = 1 where id = ?');
            $req->bindParam(1, $comment_id);
            $req->execute();
        }

        public function valid_comment($comment_id){
            $db = $this->dbConnect();
            $req = $db->prepare('update commentaires set status = 0 where id = ?');
            $req->bindParam(1, $comment_id);
            $req->execute();

        }

        public function delete_comment($comment_id){
            $db = $this->dbConnect();

        }

    }