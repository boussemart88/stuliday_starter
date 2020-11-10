<?php
$title = 'Produits user - stuliday';
require 'includes/header.php';
?>
<?php
$id = $_SESSION['id'];
$sql = 'SELECT * FROM categories';
$res = $conn->query($sql);
$categories = $res->fetchAll();
if (isset($_POST['search_form'])) {
    $category = intval(strip_tags($_POST['advert_category']));
    $search_text = strip_tags($_POST['search_text']);
    $sql2 = "SELECT * FROM advert WHERE category_id LIKE '%{$category}%' AND advert_name LIKE '%{$search_text}%' AND user_id = {$id}";
    $res2 = $conn->query($sql2);
    $search = $res2->fetchAll();
}
?>
<div class="container">
    <div class="columns">
        <div class="column">
            <form action="myadvert.php" method="post">
                <div class="form-inline">
                    <div class="form-group">
                        <!-- <label for="InputCategory">Rechercher par nom</label> -->
                        <input type="text" name="search_text" id="InputText" placeholder="Rechercher par nom"
                            class="form-control mb-2 mx-2">
                    </div>
                    <div class="form-group">
                        <select class="form-control mb-2 mx-2" id="InputCategory" name="advert_category">
                            <option value="" selected> -- Filtrer par catégorie -- </option>
                            <?php foreach ($categories as $category) { ?>
                            <option
                                value="<?php echo $category['categories_id']; ?>">
                                <?php echo $category['categories_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="submit" value="Recherche" name="search_form" class=" mb-2 btn btn-info">
                    <?php if (isset($search)) {
    echo '<a href="myadvert.php" class="btn btn-danger mx-2 mb-2">Reset</a>';
    foreach ($search as $advert) {?>

                    <div class="column is-4">
                        <div class="card large" style="width: 18rem;">
                            <div class="card-content">
                                <h5 class="card-title"><?php echo $advert['advert_name']; ?>
                                </h5>
                                <h6 class="card-subtitle"><?php echo $advert['adress']; ?>
                                </h6>
                                <p class="card-text"><?php echo $advert['description']; ?>
                                </p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><?php echo $advert['price']; ?>
                                        €</li>
                                    <li class="list-group-item"><?php echo $advert['adress']; ?>
                                    </li>
                                </ul>
                                <a href="advert.php?id=<?php echo $advert['advert_id']; ?>"
                                    class="card-link btn btn-primary">Afficher article</a>
                            </div>
                            <button class="button is-danger">Delete</button>
                        </div>
                    </div>
                    <?php
            }
} else {
    affichageProduitsByUser($id);
}
        ?>
                </div>
        </div>

    </div>
    </form>
</div>
</div>
<?php
require 'includes/footer.php';
