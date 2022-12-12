<?php
/* 
Immaginare quali sono le classi necessarie per creare uno shop online con le seguenti caratteristiche:
- L'e-commerce vende prodotti per animali.
- I prodotti sono categorizzati, le categorie sono Cani o Gatti.
- I prodotti saranno oltre al cibo, anche giochi, cucce, etc.
Stampiamo delle card contenenti i dettagli dei prodotti, come immagine, titolo, prezzo, icona della categoria ed il tipo di articolo che si sta visualizzando (prodotto, cibo, gioco, cuccia).
BONUS (Opzionale):
Il cliente potrà sia comprare i prodotti come ospite, senza doversi registrarsi nello store, oppure può iscriversi e creare un account per ricevere cosi il 20% di sconto.
Il cliente effettua il pagamento dei prodotti nel carrello con la carta di credito, che non deve essere scaduta.
*/


require __DIR__ . '/Models/Product.php';
require __DIR__ . '/Models/Category.php';
require __DIR__ . '/Models/Type.php';
require __DIR__ . '/Data/db.php';

/* $new_product = new Product('Cibo per cani', 19.9943434, 'ciao.jpg', 3.68, new Category('Cani'), new Type('cibo'));
var_dump($new_product);
var_dump($new_product->image); 
var_dump($new_product->getPrice());
var_dump($new_product->getRating()); */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals Products Shop Online</title>
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<style>
    .card.ms_card img {
        height: 300px;
        object-fit: cover;
    }

    .card-text.ms_details>* {
        padding-right: 0.5rem;
    }

    .card-text.ms_details {
        font-size: 1.2rem;
    }
</style>

<body>
    <header id="site_header"></header>
    <!-- /#site_header -->
    <main id="site_main">
        <div class="container py-5">
            <h1 class="text-center pb-3">Our Products</h1>
            <div class="row row-cols-3 gy-4">
                <?php foreach ($products as $product) : ?>
                    <div class="col">
                        <div class="card ms_card">
                            <img class="card-img-top" src=<?= $product->getImage() ?> alt=<?= $product->getTitle() ?>>
                            <div class="card-body">
                                <h4 class="card-title"><?= $product->getTitle() ?></h4>
                                <div class="card-text ms_details py-2">
                                    <?php if ($product->getCategory()->getName() == 'Dogs') : ?>
                                        <i class="fa-solid fa-dog"></i>
                                    <? else : ?>
                                        <i class="fa-solid fa-cat"></i>
                                    <?php endif ?>
                                    <?= $product->getType()->getName() ?>
                                </div>
                                <span class="card-text fw-bold text-success d-block"><?= $product->getPrice() ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </main>
    <!-- /#site_main -->
    <footer id="site_footer"></footer>
    <!-- /#site_footer -->
    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>