<?php
    //error_reporting(1);
    require_once 'db.class.php';
    require_once 'post.class.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php
        $action = $_GET['action'];

        $select = new DB;
        $post = new Post;

        if (isset($_POST['create'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $author = $_POST['author'];
            $source = $_POST['source'];

            $allowed_image_extension = array("png", "jpg", "jpeg");
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

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

                $post->create($title, $content, $category_id, $image, $author, $source);
            }
        }

        if (isset($_POST['update'])) {
            $post_id = $_POST['post_id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $author = $_POST['author'];
            $source = $_POST['source'];
            $post_image = $_FILES["image"];

            $post->update($post_id, $title, $content, $category_id, $post_image, $author, $source);
        }

        if ($action == "delete") {
            $post->delete();
        }

        $post_id = 4;
        $query = $select->connect()->prepare("SELECT * FROM post WHERE post_id=:id");

        $row = $query->execute(array(
            'id'=>$post_id
        ));

        $row = $query->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <h4 class="text-danger">Yazılar</h4>
                    <ul>
                        <?php $post->getPostList(); ?>
                    </ul>
                </div>
            </div>

            <div class="col-6">
                <h4 class="text-danger">Yazı Ekle</h4>

                <form action="manage.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Başlık" required>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" id="content"  name="content" rows="10" placeholder="İçerik" required></textarea>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" name="category_id" id="category_id" required>
                            <option value="" disabled selected>Kategori seçin</option>
                            <?php echo $post->getCategoryList(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="post_image">Resim</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="author" name="author" placeholder="Yazar" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="source" name="source" placeholder="Kaynak" required>
                    </div>

                    <button name="create" type="submit" class="btn btn-primary">Ekle</button>
                </form>
            </div>


        </div>

        <div class="row">
            <div class="col-6">
                <h4 class="text-danger">Yazı Güncelle</h4>

                <form action="manage.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo $row['title'] ?>" value="<?php echo $row['title'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" id="content" name="content" rows="10" value="<?php echo $row['content'] ?>" required><?php echo $row['content'] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <!---
                                                <select class="form-select" name="category_id" id="category_id" required>
                            <option value="" disabled selected>Kategori seçin</option>
                            <?php echo $post->getCategoryList(); ?>

                        </select>
                        -->

                            <?php
                                $post_id = $row['category_id'];
                                $categorySelect = $select->connect()->prepare("SELECT * from category order by category_id");

                                $categorySelect->execute();
                            ?>

                            <select class="form-select" name="category_id" id="category_id" required>

                            <?php
                                while($categoryRow=$categorySelect->fetch(PDO::FETCH_ASSOC)) {
                                    $category_id=$categoryRow['category_id'];
                            ?>
                                <option <?php if ($category_id == $post_id) { echo "selected='select'"; } ?> value="<?php echo $categoryRow['category_id']; ?>"><?php echo $categoryRow['name']; ?></option>

                            <?php } ?>

                            </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="post_image">Resim</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                        <img class="w-25" src="<?php echo $row["post_image"]?>" alt="">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="author" name="author" placeholder="<?php echo $row['author'] ?>" value="<?php echo $row['author'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="source" name="source" placeholder="<?php echo $row['source'] ?>" value="<?php echo $row['source'] ?>" required>
                    </div>

                    <input type="hidden" name="post_id" value="<?php echo $row["post_id"]?>">
                    <input type="hidden" name="oldImage" value="<?php echo $row["post_image"]?>">

                    <button name="update" type="submit" class="btn btn-primary">Güncelle</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
