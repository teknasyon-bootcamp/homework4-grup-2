<?php
require_once "db.class.php";
class Post extends DB {
   

  public function getPostList () {
   
    $listele= $this->connect()->query("SELECT * FROM post");
    foreach($listele->fetchAll(PDO::FETCH_ASSOC) as $item) {
        echo "<li>{$item["post_id"]} - {$item["title"]} </li>";
    
    }
  }

    public function getCategoryList () {
        $categories = $this->connect()->query("SELECT * FROM category");

        foreach($categories->fetchAll(PDO::FETCH_ASSOC) as $category) {
            echo '<option value="'.$category["category_id"].'">'.$category["name"].'</option>';
        }
    }

    public function create($title, $content, $category_id, $image, $author, $source) {
        $addQuery = "INSERT INTO post (title, content, category_id, post_image, author, source) VALUES('$title', '$content', $category_id, '$image', '$author', '$source')";
        $this->connect()->query($addQuery);
    }

    public function update($post_id, $title, $content, $category_id, $post_image, $author, $source) {
        if ($post_image["size"] > 0) {
            $uploads_dir = 'img/posts';
            @$tmp_name = $post_image["tmp_name"];
            @$name = $post_image["name"];
            $refimgyol=$uploads_dir."/".$name;
            @move_uploaded_file($tmp_name, "$uploads_dir/$name");

            $edit=$this->connect()->prepare("UPDATE post SET
            post_image=:post_image
            WHERE post_id={$post_id}");
            $update=$edit->execute(array(
                'post_image' => $refimgyol,
            ));
            $removeImage=$_POST['oldImage'];
            unlink("$removeImage");
        }

        //sql sorgusu imageyi komut olarak tanımlıyor adını değiştir

        $edit=$this->connect()->prepare("UPDATE post SET
            title=:title,
            content=:content,
            category_id=:category_id,
            author=:author,
            source=:source
            WHERE post_id={$post_id}");

        $update=$edit->execute(array(
            'title' => $title,
            'content' => $content,
            'category_id' => $category_id,
            'author' => $author,
            'source' => $source,
        ));
    }

    public function delete() {
        $post_id = $_GET["post_id"];
        $remove = $this->connect()->prepare("DELETE FROM post WHERE post_id=:id");

        $delete = $remove->execute(array(
            'id'=> $post_id
        ));

        //unlink("$post_image");
    }
}
