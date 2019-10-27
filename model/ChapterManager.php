<?php

    class ChapterManager{

        public $db;

        public function db_connect(){
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

        public function create_chapter($last_chapter_id,$title,$image,$contain){
            $db = $this->db_connect();
            $req = $db->prepare('insert into chapitres (chapter_id,title,image,chapter_contain) values (?,?,?,?)');
            $req->bindParam(1, $last_chapter_id);
            $req->bindParam(2, $title);
            $req->bindParam(3, $image);
            $req->bindParam(4, $contain);
            $req->execute();
        }

        public function return_chapters(){
            $db = $this->db_connect();
            $req = $db->query('select * from chapitres');
            $chapters = $req->fetchAll();
            return $chapters;
        }

        public function return_chapter($chapter_id){
            $db = $this->db_connect();
            $req = $db->prepare('select * from chapitres where chapter_id = ?');
            $req->bindParam(1, $chapter_id);
            $req->execute();
            $chapter = $req->fetch();
            return $chapter;
        }

        public function update_chapter($title,$image,$chapter_contain, $chapter_id){
            $db = $this->db_connect();
            $req = $db->prepare('update chapitres set title = ?, image = ?, chapter_contain = ? where chapter_id = ?');
            $req->bindParam(1, $title);
            $req->bindParam(2, $image);
            $req->bindParam(3, $chapter_contain);
            $req->bindParam(4, $chapter_id);
            $req->execute();
        }

        public function delete_chapter($chapter_id){
            $db = $this->db_connect();
            $db->exec('delete from chapitres where chapter_id='.$chapter_id);
        }

        public function return_chapters_row(){
            $db = $this->db_connect();
            $req = $db->query('select * from chapitres');
            $req->execute();
            $number_rows = $req->rowCount();
            return $number_rows;
        }

        public function return_id_last_chapter(){
            $db = $this->db_connect();
            $req = $db->query('select chapter_id from chapitres order by chapter_id DESC');
            $last_chapter_id = $req->fetch();
            return $last_chapter_id;
        }

    }