<?php

class DB {
    public function __construct(
        private string $servername = "localhost",
        private string $username = "root",
        private string $password = "123456789",
        private string $dbname = "group2"
    ) {}

    public function connect() {

        try {
            $dsn = "mysql:host=".$this->servername."; dbname=".$this->dbname."";

            $pdo = new PDO($dsn, $this->username, $this->password);
            return $pdo;

            // echo "Veritabanı bağlantısı kuruldu";
        
        } catch (Exception $e) {
            echo "Veritabanı hatası {$e->getMessage()}";
            exit(1);
        }
    }
}


    


  