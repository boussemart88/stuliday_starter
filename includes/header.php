

<?php require 'includes/functions.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stuliday</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
            <img src="images/stuliday-logo-dark.png" width=50 height=50>
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
            data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Home
            </a>

            <a href="placestostay.php"class="navbar-item">
                Places to stay
            </a>
        </div>

        <div class="navbar-end">
            <?php
            if (!empty($_SESSION)) {
                ?>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <?php echo $_SESSION['email']; ?>
                </a>

                <div class="navbar-dropdown">
                    <a href="profil.php" class="navbar-item">
                        Profile page
                    </a>
                    <a href="creatproduct.php"class="navbar-item">
                        Create a new ad
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="?logout">
                        Disconnect
                    </a>
                </div>
            </div>
            <?php
            } else {
                ?>
            <div class=" navbar-item">
                <div class="buttons">
                    <a class="button is-black" href="signin.php">
                        <strong>Sign in</strong>
                    </a>
                </div>
            </div>
            <?php
            }
        ?>
        </div>
    </div>
</nav>
