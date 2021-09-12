<?php
require_once "db.class.php";
class Post extends DB {
   //manage sayfasına post listeni çağırmak için kullanılan fonksiyon
    public function getPostListAdmin () {
   
        $listele= $this->connect()->query("SELECT * FROM post");
        foreach($listele->fetchAll(PDO::FETCH_ASSOC) as $item) {
          echo "        <div class='post admin'>
                <div class='post_img'>
                    <img src='{$item["post_image"]}' alt='image'>
                </div>
                <h1>{$item["post_id"]} - {$item["title"]}</h1>
                <div class='buttons'>
                    <a href='manage.php?action=delete&post={$item["post_id"]}' class='delete_btn btn btn-danger'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-circle' viewBox='0 0 16 16'>
      <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
      <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
    </svg></a>
    <a href='manage.php?action=edit&post={$item["post_id"]}' class='edit_btn btn btn-success'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
    </svg></a>
                  <a href='index.php?post={$item["post_id"]}' class='view_btn btn btn-primary'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
                  <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
                  <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
                </svg>
                  </a>
                </div>
            </div>";
        }
      }
    //index sayfasına bütün postları çağırmak için fonksiyonu
      public function getPostList () {
   
        $listele= $this->connect()->query("SELECT * FROM post");
        foreach($listele->fetchAll(PDO::FETCH_ASSOC) as $item) {
          echo "
            <a href='?post={$item["post_id"]}' class='post list'>
                <div class='post_img'>
                    <img src='{$item["post_image"]}' alt='image'>
                </div>
                <h1>{$item["post_id"]} - {$item["title"]}</h1>
            </a>";
        }
      }
      //ilgili postun detayına erişmek için 
      public function getPost() {
        $post_id = $_GET["post"];
        $single_post = $this->connect()->query("SELECT * FROM post WHERE post_id = $post_id");
         //belirtilen id'de makale yoksa hata mesajı verir
        $count=$single_post->rowCount();
         if($count==0){
           
            echo "
            <div  class='alert alert-danger d-flex align-items-center mt-5 mx-5 w-100' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
            <div>
            <strong>Böyle bir makale bulunamadı. Dilerseniz <a href='index.php'>Makaleler</a> sayfasından istediğiniz makaleyi seçebilirsiniz.</strong>
            </div>";
        } else{
        foreach($single_post->fetchAll(PDO::FETCH_ASSOC) as $item) {
      
          echo "
          <div class='title'>
            <h1>{$item["post_id"]} - {$item["title"]}</h1>
          </div>
          <img src='{$item["post_image"]}' alt='image'>
          <div class='desc'>{$item["content"]}</div>
          <div class='post_info'><h3>{$item["date"]}</h3> <h3>{$item["author"]}</h3></div>
          ";
            }
        } 
      }
    
      
//kategori listesini çeker
    public function getCategoryList () {
        $categories = $this->connect()->query("SELECT * FROM category");

        foreach($categories->fetchAll(PDO::FETCH_ASSOC) as $category) {
            echo '<option value="'.$category["category_id"].'">'.$category["name"].'</option>';
        }
    }
//post kaydetmek için kullanılan fonksiyon
    public function create($title, $content, $category_id, $image, $author, $source) {
        $addQuery = "INSERT INTO post (title, content, category_id, post_image, author, source) VALUES('$title', '$content', $category_id, '$image', '$author', '$source')";
        $this->connect()->query($addQuery);
        header("Location:manage.php?action=store");
        exit();
    }
//post düzenlemek için kullanılan fonksiyon
    public function update($post_id, $title, $content, $category_id, $post_image, $author, $source, $removeImage) {
//eğer güncelleme sırasında resim güncellenmicekse olan  güncelleme işlevinin resim istememesi için olan bölüm
        if ($post_image["size"] > 0) {


            $uploads_dir = 'img/posts';
            @$tmp_name = $post_image["tmp_name"];
            @$name = $post_image["name"];
            $refimgyol=$uploads_dir."/".$name;
            //eğer kaynak dosyada resmin adından başka bir postta'da aynı isimli resim varsa son yüklenen resimin sonuna sayı eklenir
            $actual_name = pathinfo($name,PATHINFO_FILENAME); 
            $original_name = $actual_name;
            $extension = pathinfo($name, PATHINFO_EXTENSION);
                $i = 1;
        while(file_exists($uploads_dir."/".$actual_name.".".$extension))
        {       
           
             $actual_name = (string)$original_name.$i;    
            $name = $actual_name.".".$extension;
             $refimgyol=$uploads_dir."/".$name;
            $i++;
        }
            @move_uploaded_file($tmp_name, "$uploads_dir/$name");

            $edit=$this->connect()->prepare("UPDATE post SET
            post_image=:post_image
            WHERE post_id={$post_id}");
            $update=$edit->execute(array(
                'post_image' => $refimgyol,
            ));
            if ($edit) {
                //yerine yüklenen eski resmi siler
                unlink("$removeImage");
            }
            
        }

//diğer değerleri veritabanına kaydetme
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
        if ($update) {
            header("Location:manage.php?action=update&post=$post_id");
            exit();
            }else{
                header("Location:manage.php?action=edit&post=$post_id&status=hata");
                exit();
            }
      
    }
//silme işleminin yapıldığı fonksiyon
    public function delete() {
        //get ile ekstra olarak ilgili resmi çekmemek için önce id ile tanımlı resim dosya konumundan silinir
        $post_id = $_GET["post"];
        
        $query=$this->connect()->prepare("SELECT * FROM post WHERE post_id=:id");
                $row=$query->execute(array(
                    'id'=>$post_id
                ));
                $row=$query->fetch(PDO::FETCH_ASSOC);

                $removeImage=$row['post_image'];
                unlink("$removeImage");
                //veritabanından post silinir
        $remove = $this->connect()->prepare("DELETE FROM post WHERE post_id=:id");

        $delete = $remove->execute(array(
            'id'=> $post_id
        ));
      
    }
}