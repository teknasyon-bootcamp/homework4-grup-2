<?php
require_once "db.class.php";
class Post extends DB {
   

  public function getPostList () {
   
    $listele= $this->connect()->query("SELECT * FROM post");
    foreach($listele->fetchAll(PDO::FETCH_ASSOC) as $item) {
        echo "<li>{$item["post_id"]} - {$item["title"]} </li>";
    
    }
  }


}