
<html>
<head>
    <title><?= $this->getSiteTitle() ?></title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="<?= PROOT ?>css/materialize.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?= PROOT ?>css/custom.css" media="screen" title="no title" charset="utf-8">

    <!--    Import font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Fake favicon request to reduce payload-->
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">

    <!-- View custom css and javascript-->
    <?= $this->content('head'); ?>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<header>
    <?= View::renderComponent(new NavbarComponent())?>
    <?= View::renderComponent(new MenuComponent())?>
</header>
<main><?= $this->content('body'); ?></main>
<footer class="page-footer indigo darken-3">
    <div class="container">
        <div class="row">
            <div class="col s12 m4 l3">
                <h5 class="white-text">meh</h5>

            </div>
            <div class="col s12 m4 l3">
                <h5 class="white-text">Social Media</h5>
                <a href="//instagram.com/jiankai.ly" target="_blank" class="fa fa-instagram fa-lg social-media"></a>
<!--                <a href="//facebook.com" class="fa fa-facebook fa-lg social-media"></a>-->
                <a href="//twitter.com/Skillaz2015" target="_blank" class="fa fa-twitter fa-lg social-media"></a>
            </div>
            <div class="col s12 m4 l3">
                <h5 class="white-text">Site statistics</h5>
                <?= $this->renderComponent(new StatsComponent())?>
            </div>
        </div>
    </div>
</footer>
<!--JavaScript at end of body for optimized loading-->
<script src="<?= PROOT ?>js/jquery-3.4.1.min.js"></script>
<script src="<?= PROOT ?>js/custom.js"></script>
<script type="text/javascript" src="<?= PROOT ?>js/materialize.min.js"></script>
</body>
</html>
