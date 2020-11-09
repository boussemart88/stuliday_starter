<?php

$title = 'Ajout de produits - stuliday';
require 'includes/header.php';

$sql = 'SELECT * FROM categories';
$res = $conn->query($sql);
$categories = $res->fetchAll();
?>
<div class="row">
    <div class="columns">
        <form action="process.php" method="POST">
        <div class="row">
    <div class="column">
        <table class="table table-dark">
            <thead>
            <tr>
            <div class="field">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                    </figure>
                    <div class="file has-name">
                    <label class="file-label">
                        <input class="file-input" type="file" name="resume">
                        <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <!-- choose picture -->
                        <span class="file-label">
                            Choose a file…
                        </span>
                        </span>
                        <span class="file-name">
                        Screen Shot 2017-07-29 at 15.54.25.png
                        </span>
                    </label>
                </div>
                <div class="column is-offset-1" >
                <!-- title advert -->
                    <label class="label">Title</label>
                        <div class="control">
                            <input class="input is-success" type="text" placeholder="Title" name="advert_name">
                        </div>
                    </div>
                    <div class="column is-11 is-offset-1" >
                    <!-- adress advert -->
                    <label class="label">Address</label>
                        <div class="control">
                            <input class="input is-success" type="text" placeholder="Adress" name="advert_adress">
                        </div>
                    </div>
                    <div class="field">
                    <!-- description advert -->
                    <label class="label column is-11 is-offset-1">Description</label>
                    <div class="control">
                        <textarea class="textarea is-success is-small" placeholder="Description" name="advert_description"></textarea>
                    </div>
                    <div class="column is-11 is-offset-1" >
                    <!-- price advert -->
                    <label class="label">Price</label>
                        <div class="control">
                            <input class="input is-success" type="text" placeholder="Price" name="advert_price">
                        </div>
                    </div>
                    <div class="control">
                <div class="select" >
                <!-- category advert -->
                    <select name="advert_category">
                    <option>Category</option>
                    <option>House</option>
                    <option>Apartment</option>
                    </select>
                </div>
                </div>
                    <div class="field is-grouped is-grouped-centered">
                        <button type="submit" class="control button is-success" name="advert_submit"> 
                        Submit
                        </button>
                        <div class="field is-grouped is-grouped-centered">
                        <button type="cancel" class="control button is-black" name="cancel"> 
                        Cancel
                    </div>
                </tr>
            </thead>
            <tbody>
                <!-- <?php
                    affichageProduitsByUser($user_id);
                ?> -->
            </tbody>
        </table>
    </div>
</div>
</form>
<?php
require 'includes/footer.php';

