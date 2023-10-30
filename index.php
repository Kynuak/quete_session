

<?php require 'inc/data/products.php'; ?>
<?php require 'inc/head.php'; ?>
<?php require 'manageCookie.php'; ?>

<?php

if(empty($_SESSION)) {
    header("Location: login.php");
}

if(!empty($_POST)) {
    
    $_POST["quantity"] = 1;
    searchAndAddCookie($_POST, $catalog);
    header("Location: cart.php");

}

?>

<section class="cookies container-fluid">
    <div class="row">
        <?php foreach ($catalog as $id => $cookie) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <figure class="thumbnail text-center">
                    <img src="assets/img/product-<?= $id; ?>.jpg" alt="<?= $cookie['name']; ?>" class="img-responsive">
                    <figcaption class="caption">
                        <h3><?= $cookie['name']; ?></h3>
                        <p><?= $cookie['description']; ?></p>
                        <p><?= $cookie['price']; ?> €</p>
                        <form action="" method="POST">
                            <button type="submit" name="id" value="<?= $id ?>" class="btn btn-primary" aria-hidden="true"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add to Cart</button>
                        </form>
                    </figcaption>
                </figure>
            </div>
        <?php } ?>
    </div>
</section>
<?php require 'inc/foot.php'; ?>
