<?php
require 'includes/config.php';

function inscription($email, $password1, $password2)
{
    global $conn;

    try {
        $sql1 = "SELECT * FROM users WHERE email = '{$email}'";
        $res1 = $conn->query($sql1);
        $count_email = $res1->fetchColumn();
        if (!$count_email) {
            if ($password1 === $password2) {
                $password1 = password_hash($password1, PASSWORD_DEFAULT);
                $sth = $conn->prepare('INSERT INTO users (email, password) VALUES (:email,:password)');
                $sth->bindValue(':email', $email);
                $sth->bindValue(':password', $password1);
                $sth->execute();
                echo "<div class='alert alert-success mt-2'> L'utilisateur a bien été enregistré, vous pouvez désormais vous connecter</div>";
            } else {
                echo 'Les mots de passe ne concordent pas !';
                unset($_POST);
            }
        } elseif ($count_email > 0) {
            echo 'Cette adresse mail existe déja !';
            unset($_POST);
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}

function connexion($email, $password)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $res = $conn->query($sql);
        $user = $res->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $db_password = $user['password'];
            if (password_verify($password, $db_password)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                echo 'Vous êtes désormais connectés !';
                header('Location: index.php');
            } else {
                echo 'Le mot de passe est erroné !';
                unset($_POST);
            }
        } else {
            echo "L'email utilisé n'est pas connu !";
            unset($_POST);
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}

function affichageProduits()
{
    global $conn;
    $sth = $conn->prepare('SELECT p.*,c.categories_name,u.fullname FROM advert AS p INNER JOIN categories AS c ON p.category_id = c.categories_id INNER JOIN users AS u ON p.user_id = u.id');
    $sth->execute();

    $products = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        ?>
<tr>
    <th scope="row"><?php echo $product['advert_id']; ?>
    </th>
    <td><?php echo $product['advert_name']; ?>
    </td>
    <td><?php echo $product['description']; ?>
    </td>
    <td><?php echo $product['price']; ?>
    </td>
    <td><?php echo $product['adress']; ?>
    </td>
    <td><?php echo $product['categories_name']; ?>
    </td>
    <td><?php echo $product['fullname']; ?>
    </td>
    <td> <a
            href="advert.php/?id=<?php echo $product['advert_id']; ?>">Afficher
            article</a>
    </td>
</tr>
<?php
    }
}

function affichageProduitsByUser($id)
{
    global $conn;
    $sth = $conn->prepare("SELECT p.*,c.categories_name,u.fullname FROM advert AS p INNER JOIN categories AS c ON p.category_id = c.categories_id INNER JOIN users AS u ON p.user_id = u.id WHERE p.user_id={$id}");
    $sth->execute();

    $products = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        ?>
<tr>
    <th scope="row"><?php echo $product['advert_id']; ?>
    </th>
    <td><?php echo $product['advert_name']; ?>
    </td>
    <td><?php echo $product['description']; ?>
    </td>
    <td><?php echo $product['price']; ?>
    </td>
    <td><?php echo $product['adress']; ?>
    </td>
    <td><?php echo $product['categories_name']; ?>
    </td>
    <td><?php echo $product['fullname']; ?>
    </td>
    <td> <a
            href="advert.php/?id=<?php echo $product['advert_id']; ?>">Afficher
            article</a>
    </td>
</tr>
<?php
    }
}
function affichageProduit($id)
{
    global $conn;
    $sth = $conn->prepare("SELECT p.*,c.categories_name,u.username FROM products AS p LEFT JOIN categories AS c ON p.category_id = c.categories_id LEFT JOIN users AS u ON p.user_id = u.id WHERE p.products_id = {$id}");
    $sth->execute();

    $product = $sth->fetch(PDO::FETCH_ASSOC); ?>
<div class="row">
    <div class="col-12">
        <h1><?php echo $product['advert_name']; ?>
        </h1>
        <p><?php echo $product['description']; ?>
        </p>
        <p><?php echo $product['adress']; ?>
        </p>
        <button class="btn btn-danger"><?php echo $product['price']; ?> </button>
    </div>
</div>
<?php
}

function ajoutProduits($name, $description, $price, $adress, $category, $user_id)
{
    global $conn;
    // Vérification du prix (doit être un entier, et inférieur à 1 million d'euros)
    if (is_int($price) && $price > 0 && $price < 1000000) {
        // Utilisation du try/catch pour capturer les erreurs PDO/SQL
        try {
            // Création de la requête avec tous les champs du formulaire
            $sth = $conn->prepare('INSERT INTO advert (advert_name,description,price,adress,category_id,user_id) VALUES (:advert_name, :description, :price, :adress, :category_id, :user_id)');
            $sth->bindValue(':advert_name', $name, PDO::PARAM_STR);
            $sth->bindValue(':description', $description, PDO::PARAM_STR);
            $sth->bindValue(':price', $price, PDO::PARAM_INT);
            $sth->bindValue(':adress', $adress, PDO::PARAM_STR);
            $sth->bindValue(':category_id', $category, PDO::PARAM_INT);
            $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);

            // Affichage conditionnel du message de réussite
            if ($sth->execute()) {
                echo "<div class='alert alert-success'> Votre article a été ajouté </div>";
                header('Location: myadvert.php');
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}

function suppProduits($user_id, $ad_id)
{
    global $conn;
    // Tentative de la requête de suppression.
    try {
        $sth = $conn->prepare('DELETE FROM advert WHERE ad_id = :ad_id AND user_id =:user_id');
        $sth->bindValue(':user_id', $user_id);
        $sth->bindValue(':ad_id', $ad_id);
        if ($sth->execute()) {
            header('Location:profil.php?s');
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}

// function getCreatAt(): \DateTime {
//     return new \DateTime($this->created_at);
// }
