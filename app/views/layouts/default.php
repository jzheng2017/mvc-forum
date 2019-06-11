<!DOCTYPE html>
<html>
<head>
    <title><?= $this->getSiteTitle() ?></title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="<?= PROOT ?>css/materialize.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?= PROOT ?>css/custom.css" media="screen" title="no title" charset="utf-8">
    <script src="<?= PROOT ?>/js/jquery-3.4.1.min.js"></script>
    <script src="<?= PROOT ?>/js/materialize.min.js"></script>

    <?= $this->content('head'); ?>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<header>
    <nav class="indigo darken-3">
        <div class="nav-wrapper">
            <a href="<?= PROOT?>" class="brand-logo">Jiankai's Forum</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?= PROOT ?>user/registration">Create an account</a></li>
                <li><a href="<?=PROOT ?>user/login/" class="btn blue accent-4">Login</a></li>
            </ul>
        </div>
    </nav>
</header>
<main><?= $this->content('body'); ?></main>
<footer class="page-footer indigo darken-3">
    <div class="container">
        <div class="row">
            <div class="col">
                <h5 class="white-text">Footer Content</h5>
                <a class="top-link white-text popout" href="<?= PROOT ?>PrivacyVerklaring">Privacy Verklaring</a>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer
                    content.</p>
            </div>
            <div class="col">
                <h5 class="white-text">Links</h5>
            </div>
        </div>
    </div>
</footer>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
