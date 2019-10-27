<?php

    class ModelConnectAdminManager{

        public function dbConnect(){
            $this->db = new PDO('mysql:host=localhost;dbname=thewriterblog;charset=utf8', 'root', '');
            return $this->db;
        }

        public function check_admin_connect($admin){
            $db = $this->dbConnect();
            $req = $db->prepare("select * from admin where admin = ?");
            $req->bindParam(1, $admin);
            $req->execute();
            $check = $req->fetch();
            return $check;
        }

    }