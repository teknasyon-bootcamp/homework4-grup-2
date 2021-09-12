<?php include "layouts/header.php" ?>

<?php

// db ve post sayfaları dahil ediliyor
 require_once 'db.class.php';
 require_once 'post.class.php';
 $action = $_GET['action'];


 $select = new DB;
 $post = new Post;
//delete işleminin çağırıldığı yer
 if ($action == "delete") {
    $post->delete();
}
    



 // post_id ye göre veritabanından veri çekme işlevi
   $post_id=$_GET['post'];
   $query=$select->connect()->prepare("SELECT * FROM post WHERE post_id=:id");
           $row=$query->execute(array(
               'id'=>$post_id
           ));
           $row=$query->fetch(PDO::FETCH_ASSOC);
//create methodu çağırılıyor
    if($action=="create"){
     

   if (isset($_POST['add'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $source = $_POST['source'];

    $allowed_image_extension = array("png", "jpg", "jpeg");
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
// image için koşul bağlantıları dosya türleri boyut gibi koşullarla denetleme
    if (! file_exists($_FILES["image"]["tmp_name"])) {
        $response = array(
            "type" => "error",
            "message" => "Bir resim seçin."
        );
    } else if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Dosya türü sadece jpg, jpeg ve png uzantılı olabilir."
        );
    } else if (($_FILES["image"]["size"] > 2000000)) {
        $response = array(
            "type" => "error",
            "message" => "Resim 2 MB'dan büyük olamaz."
        );
    } else {
        $image = "img/posts/" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
// create fonksiyonuna parametler gönderilir
        $post->create($title, $content, $category_id, $image, $author, $source);
    }
}
    
?>

<form class="create_post" action="" method="POST" enctype="multipart/form-data">

    <h1>Yazı Ekle</h1>
<!-- yükleme sırasında gelen hatanın gösterildiği yer -->
    <?php if(!empty($response)) { ?>
    <div role="alert" class="alert alert-danger">
        <?php echo $response["message"]; ?>
    </div>
    <?php }?>

    <input type="text" class="form-control" id="title" name="title" placeholder="Başlık" required>

    <textarea class="form-control" id="content" name="content" rows="10" placeholder="İçerik" required></textarea>


    <div class="category_and_image_selector">
        <select class="form-select" name="category_id" id="category_id" required>
            <option value="" disabled selected>Kategori seçin</option>
            <?php echo $post->getCategoryList(); ?>
        </select>
        <div class="img_input">
            <input type="file" accept="image/*" class="form-control" id="image" name="image" required>
        </div>
    </div>


    <input type="text" class="form-control" id="author" name="author" placeholder="Yazar" required>

    <input type="text" class="form-control" id="source" name="source" placeholder="Kaynak" required>

    <button name="add" type="submit" class="btn btn-success">Ekle</button>
</form>

<?php }
// update fonksiyonunun çağırıldığı yer
elseif($action=="edit"){
    
   if (isset($_POST['update'])) {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $source = $_POST['source'];
    $removeImage = $_POST['oldImage'];
    $post_image = $_FILES["image"];
// update fonksiyonuna parametreler gönderilir
    $post->update($post_id, $title, $content, $category_id, $post_image, $author, $source, $removeImage);
}

 ?>

<form class="create_post" action="" method="POST" enctype="multipart/form-data">

    <h1>Yazı Düzenle</h1>
    <!-- Güncelleme sırasında hata oluşursa verilecek mesaj -->
    <?php if($_GET['status']=="hata") { ?>
        <div class="alert alert-danger d-flex align-items-center mt-5 " role="alert">
        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
        <div>
        <strong><?php echo "Güncelleme yapılırken bir hata meydana geldi!"; ?></strong>
        </div>
    </div>
    <?php } ?>
<!-- Yazı düzenleme formu -->
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo $row['title'] ?>" value="<?php echo $row['title'] ?>" required>
    <label for="floatingInput">Makale Başlığı</label>
    </div>
    <div class="form-floating">
    <textarea class="form-control" id="content" name="content" style="height: 150px" rows="10" placeholder="<?php echo $row['content'] ?>" value="<?php echo $row['content'] ?>" required><?php echo $row['content'] ?></textarea>
    <label for="floatingTextarea2">Makale İçeriği</label>
    </div>

<!-- post'un tanımlı olduğu id'ye göre kategorinin seçili gelmesi -->
    <?php
                                $post_id = $row['category_id'];
                                $categorySelect = $select->connect()->prepare("SELECT * from category order by category_id");

                                $categorySelect->execute();
                            ?>
<div class="form-floating">
    <select class="form-select" name="category_id" id="category_id" required>

        <?php
                                while($categoryRow=$categorySelect->fetch(PDO::FETCH_ASSOC)) {
                                    $category_id=$categoryRow['category_id'];
                            ?>
        <option <?php if ($category_id == $post_id) { echo "selected='select'"; } ?>
            value="<?php echo $categoryRow['category_id']; ?>"><?php echo $categoryRow['name']; ?></option>

        <?php } ?>

    </select>
    <label for="floatingSelect">Makale Kategorisi</label>
    </div>

    <div class="img_input">
        <input type="file" class="form-control" id="image" name="image" value="dsa">
        <img class="w-25" src="<?php echo $row["post_image"]?>" alt="<?php echo $row['title'] ?>">
    </div>

    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="author" name="author" placeholder="<?php echo $row['author'] ?>" value="<?php echo $row['author'] ?>" required>
    <label for="floatingInput">Makale Yazarı</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="source" name="source" placeholder="<?php echo $row['source'] ?>" value="<?php echo $row['source'] ?>" required>
    <label for="floatingInput">Makale Kaynağı</label>
    </div>
    <!-- post_id ve image value'leri hidden olarak gönderilir -->
    <input type="hidden" name="post_id" value="<?php echo $row["post_id"]?>">
    <input type="hidden" name="oldImage" value="<?php echo $row["post_image"]?>">
    <button name="update" type="submit" class="btn btn-success">Düzenle</button>
</form>

<?php }else{ ?>

<div>
    <!-- yaoılan işlerde dönen başarılı değerlere göre başarı mesajı gösterilir -->
    <?php if($action=="store") { ?>
        <div class="alert alert-success d-flex align-items-center mt-5 mx-5 w-100" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
        <strong><?php echo  "Makaleniz başarılı bir şekilde yüklendi!"; ?></strong>
        </div>
    </div>
    <?php } else if($action=="update") { ?>
        <div class="alert alert-success d-flex align-items-center mt-5 mx-5 w-100" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
        <strong><?php echo $row['title']." adlı makaleniz başarılı bir şekilde güncellendi!"; ?></strong>
    </div>
    </div>
    <?php } else if($action=="delete") { ?>
        <div class="alert alert-success d-flex align-items-center mt-5 mx-5 w-100" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
        <strong><?php echo "Makaleniz başarılı bir şekilde silindi!"; ?></strong>
        </div>
    </div>
    <?php } 
    // makale sayfasındaki post listesi
    echo "<div class='posts'>";

    $deneme = new Post;
    $deneme->getPostListAdmin();
    echo "</div>";

    }?>
</div>


<?php include "layouts/footer.php" ?>