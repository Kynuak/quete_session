

<?php require 'inc/head.php'; ?>
<?php require 'inc/data/products.php'; ?>


<?php

    if(empty($_SESSION)) {
        header("Location: login.php");
    }

    require 'manageCookie.php';
    $totalPrice = 0;
    if(isset($_POST["id"]) && isset($_POST["quantity"])) {
        searchAndAddCookie($_POST, $catalog);
    }

    if(isset($_POST["delete"])){
       deleteCookie($_POST["id"]);
    }
?>

<section class="cookies container">
        <table class="table">
            <thead>
                <tr>
                    <th>Cookie</th>
                    <th>Quantités</th>
                    <th></th>
                    <th>Prix Unitaire</th>
                    <th>Prix Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($_SESSION["cookies"])): foreach($_SESSION["cookies"] as $cookie): ?>
                    <tr>              
                            <td>
                            <form method="POST">
                                <label><?= $catalog[$cookie["id"]]["name"]; ?></label>
                            </td>
                            <input type="hidden" name="id" value="<?= $cookie["id"]; ?>">
                            <td> 
                                <input name="quantity" type="number" value="<?= $cookie["quantity"]; ?>">
                                <button type="submit">Mettre a jour la quantité</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $cookie["id"]; ?>">
                                    <button type="submit" name="delete">Supprimé du panier</button>
                                </form>
                            </td>
                        <td> <?= $catalog[$cookie["id"]]["price"]; ?> €</td>
                        <td> <?= priceCookie($cookie["quantity"], $catalog[$cookie["id"]]["price"]) ?> €</td>
                    </tr>
                    <?php $totalPrice += priceCookie($cookie["quantity"], $catalog[$cookie["id"]]["price"]) ?>
                <?php endforeach; endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total :</b></td>
                    <td><?= $totalPrice; ?> €</td>
                </tr>
            </tfoot>
        </table>
</section>
<?php require 'inc/foot.php'; ?>
