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

    <!--    Import font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="<?= PROOT ?>js/jquery-3.4.1.min.js"></script>
    <script src="<?= PROOT ?>js/materialize.min.js"></script>
    <script src="<?= PROOT ?>js/custom.js"></script>
    <?= $this->content('head'); ?>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<header>
    <nav class="indigo darken-3">
        <div class="container">
            <div class="nav-wrapper">
                <div>
                    <a href="<?= PROOT ?>" class="brand-logo">
                        Logo
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <?php if (UserModel::currentLoggedInUser()) { ?>
                            <li><a href="<?= PROOT ?>user/logout">Logout</a></li>
                            <li><a href="<?= PROOT ?>user/inbox"><i class="material-icons">notifications</i></a></li>
                            <li><a href="<?= PROOT ?>user/profile/" class="btn blue accent-4 waves-effect">My
                                    Profile</a>
                            </li>
                        <?php } else { ?>
                            <li><a href="<?= PROOT ?>user/registration">Create an account</a></li>
                            <li><a href="<?= PROOT ?>user/login/" class="btn blue accent-4 waves-effect">Login</a></li>
                        <?php } ?>
                    </ul>
                    <?php Component::get('sidenav') ?>
                </div>
            </div>
        </div>
    </nav>
</header>
<main><?= $this->content('body'); ?></main>
<footer class="page-footer indigo darken-3">
    <div class="container">
        <div class="row">
            <div class="col s12 m4 l3">
                <h5 class="white-text">Footer Content</h5>
                <a class="top-link white-text popout" href="<?= PROOT ?>PrivacyVerklaring">Privacy Verklaring</a>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer
                    content.</p>
            </div>
            <div class="col s12 m4 l3">
                <h5 class="white-text">Social Media</h5>
                <a href="//instagram.com/jiankai.ly" class="fa fa-instagram fa-lg social-media"></a>
                <a href="//facebook.com" class="fa fa-facebook fa-lg social-media"></a>
                <a href="//twitter.com/Skillaz2015" class="fa fa-twitter fa-lg social-media"></a>
            </div>
            <div class="col s12 m4 l3">
                <h5 class="white-text">Support</h5>
                <ul>
                    <li><a href="<?= PROOT ?>contact-us">Contact us</a></li>
                    <li><a href="<?= PROOT ?>contact-us">Contact us</a></li>


                </ul>
            </div>
        </div>
    </div>
</footer>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
