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

require __DIR__ . '/Models/Customer.php';
require __DIR__ . '/Models/Account.php';
require __DIR__ . '/Models/Product.php';
require __DIR__ . '/Models/Category.php';
require __DIR__ . '/Models/Type.php';
require __DIR__ . '/Data/db.php';

/* $new_product = new Product('Cibo per cani', 19.9943434, 'ciao.jpg', 3.68, new Category('Cani'), new Type('cibo'));
var_dump($new_product);
var_dump($new_product->image); 
var_dump($new_product->getPrice());
var_dump($new_product->getRating()); */
$new_customer = new Customer(new Account('Guest', ''), [new Product('Cesar', 9.9943434, 'https://imgs.search.brave.com/5R7WDAYBfq-IT5OsjGtPW8y1BgRicZiyjehEcXuTxaY/rs:fit:1200:1200:1/g:ce/aHR0cHM6Ly93d3cu/c29sb2ltaWdsaW9y/aS5pdC93cC1jb250/ZW50L3VwbG9hZHMv/MjAyMC8wNC9jZXNh/ci1jaWJvLXBlci1j/YW5pLmpwZw', 4, new Category('Dogs'), new Type('Food'))]);
$logged = false;
if (!empty($_GET)) {
    $password = $_GET['password'];
    $username = $_GET['userName'];
    try {
        isAccountValid($username, $password);
        $logged = true;
        $new_customer->getAccount()->setDiscount();
        if (isset($password) && isset($username)) {
            $new_customer->getAccount()->setUsername($username);
            $new_customer->getAccount()->setPassword($password);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getTotal($array, $discount)
{
    $sum = 0;
    foreach ($array as $product) {
        $sum += $product->getPrice() - $product->getPrice() * $discount / 100;
    }
    return $sum;
}

function isAccountValid($username, $password)
{
    if (empty($username) || empty($password)) {
        throw new Exception('Invalid Account');
    }
}

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
    .login {
        display: flex;
        align-items: center;
    }

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
    <header id="site_header" class="px-5 pt-3">
        <div class="container-fluid">
            <div class="row row-cols-2">
                <div class="col account">
                    Ur logged as <?= $new_customer->getAccount()->getUsername() ?>
                    <div class="total">Il totale é : <?= getTotal($new_customer->getProducts(), $new_customer->getAccount()->getDiscount()) ?></div>
                </div>

                <?php if (!$logged) : ?>
                    <form class="col login justify-content-end" action="index.php" method="GET">
                        <span class="mx-3">Login for 20% discount</span>
                        <div class="mb-3 mx-3">
                            <label for="userName" class="form-label">Username</label>
                            <input type="text" class="form-control" name="userName" id="userName" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">exampleUser</small>
                        </div>
                        <div class="mb-3 mx-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">pass1234</small>
                        </div>
                        <button class="btn btn-primary" type="submit">Log In</button>
                    </form>
                <?php endif ?>
            </div>

        </div>

    </header>
    <!-- /#site_header -->
    <main id="site_main">
        <div class="container py-5">
            <h1 class="text-center pb-3">Our Products</h1>
            <div class="row row-cols-1 row-cols-lg-3 gy-4">
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
                                <span class="card-text fw-bold text-success d-block"><?= $product->getFormattedPrice() ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </main>
    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>