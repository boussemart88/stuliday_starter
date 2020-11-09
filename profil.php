<?php

$title = 'Page de profil - stuliday_starter-master';
require 'includes/header.php';
$user_id = $_SESSION['id'];
?>
<div class="row">
    <div class="col-8">
        <table class="table table-dark">
            <thead>
            <tr>
            <div class="field">
                <div class="card">
                    <div class="card-image">
                    
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
                        <!-- Name file -->
                        <span class="file-name">
                        Screen Shot 2017-07-29 at 15.54.25.png
                        </span>
                    </label>
                </div>
                <div class="column is-half is-offset-one-quarter" >
                <!-- User name -->
                    <label class="label">Name</label>
                        <div class="control">
                            <input class="input is-success" type="text" placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="column is-half is-offset-one-quarter">
                <div class="field">
                <!-- Username -->
                    <label class="label">Username</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-success" type="text" placeholder="Username">
                        <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                        </span>
                        <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                        </span>
                    </div>
                    </div>
                </div>
                <div class="column is-half is-offset-one-quarter"> 
                <!-- user e-mail -->
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-success" type="text" placeholder="Email">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                                </span>
                                <span class="icon is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                            </div>
                    </div>
                </div>   
                    <div class="field">
                    <div class="column is-half is-offset-one-quarter">
                    <!-- user adress -->
                        <label class="label">Address</label>
                        <div class="control">
                        <input class="input is-success" type="text" placeholder="address">
                    </div>
                </div>
            </div>
                    
                    <div class="field">
                    <!-- about user -->
                    <label class="label">Message</label>
                    <div class="control">
                        <textarea class="textarea is-success is-small" placeholder="Textarea"></textarea>
                    </div>
                    </div>
                    <div class="field is-grouped is-grouped-centered">
                        <button type="submit" class="control button is-success is-success name="advert_submit"> 
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

<?php
require 'includes/footer.php';