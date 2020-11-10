<?php

    $title = 'Processing - suliday_starter-master';
    require 'includes/header.php';

    // Verrouiller l'accès à la page process aux méthodes POST.
    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        echo "<div class='alert alert-danger'> La page à laquelle vous tentez d'accéder n'existe pas </div>";
    // Le elseif va servir au traitement du formulaire de création de produits
    } elseif (isset($_POST['advert_submit'])) {
        // Vérification back-end du remplissage du formulaire
        if (!empty($_POST['advert_name']) && !empty($_POST['advert_description']) && !empty($_POST['advert_price']) && !empty($_POST['advert_adress']) && !empty($_POST['advert_category'])) {
            // Définition des variables
            $name = strip_tags($_POST['advert_name']);
            $description = strip_tags($_POST['advert_description']);
            $price = intval(strip_tags($_POST['advert_price']));
            $city = strip_tags($_POST['advert_adress']);
            $category = strip_tags($_POST['advert_category']);
            // Assigne la variable user_id à partir du token de session
            $user_id = $_SESSION['id'];
            // Lancement de la fonction d'ajout de produits
            ajoutProduits($name, $description, $price, $city, $category, $user_id);
        }
        // 2nd elseif pour le formulaire de modification
    } elseif (isset($_POST['advert_edit'])) {
        // Vérification back-end du formulaire d'édition
        if (!empty($_POST['advert_name']) && !empty($_POST['advert_description']) && !empty($_POST['advert_price']) && !empty($_POST['advert_adress']) && !empty(['advert_category'])) {
            // Définition des variables
            $name = strip_tags($_POST['advert_name']);
            $description = strip_tags($_POST['advert_description']);
            $price = intval(strip_tags($_POST['advert_price']));
            $city = strip_tags($_POST['advert_adress']);
            $category = strip_tags($_POST['advert_category']);
            // Assigne la variable user_id à partir du token de session
            $user_id = $_SESSION['id'];
            $id = strip_tags($_POST['advert_id']);

            modifAdvert($name, $description, $price, $city, $category, $id, $user_id);
        }
    } elseif (isset($_POST['advert_delete'])) {
        // echo "<div class='alert alert-danger'> Vous tentez de supprimer l'article n°".$_POST['product_id'].'</div>';

        try {
            $sth = $conn->prepare('DELETE FROM advert WHERE advert_id = :advert_id AND user_id =:user_id');
            $sth->bindValue(':advert_id', $_POST['advert_id']);
            $sth->bindValue(':user_id', $_SESSION['id']);
            $sth->execute();

            echo "<div class='alert alert-danger'> Vous avez supprimé l'article n°".$_POST['advert_id'].'</div>';
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
    require 'includes/footer.php';
