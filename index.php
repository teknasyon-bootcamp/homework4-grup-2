<?php include "layouts/header.php" ?>
    
    <?php
    // İndex'e postların listesinin görüldüğü yer
    if(!isset($_GET["post"])){
        echo "<div class='posts'>";
            $deneme = new Post;
            $deneme->getPostList();
        echo "</div>";
    }elseif(isset($_GET["post"])){
        //Post detayının görülme sayfası
        echo "<div class='single_post'>";
            $single_post = new Post;
            $single_post->getPost();
        echo "</div>";
    }
    ?>

<?php include "layouts/footer.php" ?>