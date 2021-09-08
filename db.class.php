<?php
class DB {
    public function __construct(
        private string $servername = "localhost",
        private string $username = "root",
        private string $password = "",
        private string $dbname = "group2"
    ) {}

    public function connect() {
        $dsn = "mysql:host=".$this->servername."; dbname=".$this->dbname."";
        
        try {
            $pdo = new PDO($dsn, $this->username, $this->password);
               echo "Veritabanı bağlantısı kuruldu";
            return $pdo;
        } catch (Exception $e) {
            echo "Veritabanı hatası {$e->getMessage()}";
             exit(1);
        }

    }

    
}
