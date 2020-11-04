<?php

require 'includes/header.php';
$title = 'Processing -Le Chouette coin';

if ('POST' != $_SERVER['REQUEST_METHOD']) {
    echo "<div class='alert alert-danger'>ERROR La page à laquell vous tentez d'accéder n'existe pas</div>";
} elseif (isset($_POST['product_submit'])) {
    if (!empty($_POST['product_name']) && !empty($_POST['product_description']) && !empty($_POST['product_price']) && !empty($_POST['product_city']) && !empty($_POST['product_category'])) {
        $name = strip_tags($_POST['product_name']);
        $description = strip_tags($_POST['product_description']);
        $price = intval(strip_tags($_POST['product_price']));
        $city = strip_tags($_POST['product_city']);
        $category = strip_tags($_POST['product_category']);
        $user_id = $_SESSION['id'];
        // if (is_int($price) && $price > 0 && $price < 1000000) {
        //     try {
        //         $sth = $conn->prepare('INSERT INTO products (products_name,description,price,city,category_id,user_id) VALUES (:products_name, :description, :price, :city, :category_id, :user_id)');
        //         $sth->bindValue(':products_name', $name, PDO::PARAM_STR);
        //         $sth->bindValue(':description', $description, PDO::PARAM_STR);
        //         $sth->bindValue(':price', $price, PDO::PARAM_INT);
        //         $sth->bindValue(':city', $city, PDO::PARAM_STR);
        //         $sth->bindValue(':category_id', $category, PDO::PARAM_INT);
        //         $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        //         if ($sth->execute()) {
        //             echo "<div class='alert alert-success'>Votre article a été ajouté à la base de données</div>";
        //             header('Location: products.php');
        //         }
        //     } catch (PDOException $e) {
        //         echo 'Error'.$e->getMessage();
        //     }
        // }
        ajoutProduit($name, $description, $price, $city, $category, $user_id);
    }
}

require 'includes/footer.php';
