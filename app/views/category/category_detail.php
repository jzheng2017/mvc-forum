<?php $this->setSiteTitle('Registration'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="container">
    <div class="row">
        <h2>Subcategories</h2>
        <?php for ($i = 1; $i <= 3; $i++) { ?>
            <a href="<?= PROOT ?>category/view/<?= $i ?>" class="black-text">
                <div class="col s6 m4 l4  card">
                    <h5>Category <?= $i ?></h5>
                    <div class="row">
                        <div class="col s12 m3 l3">
                            <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                        </div>
                        <div class="col s12 m9 l9">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor. Aenean massa.
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
    <div class="row">
        <h2>Threads</h2>
        <?php for ($i = 1; $i <= 3; $i++) { ?>
            <a href="<?= PROOT ?>thread/view/<?= $i ?>" class="black-text">
                <div class="col s12 card">
                    <h5>Thread Titel <?= $i ?></h5>
                    <div class="row">
                        <div class="col s12 m2 l2">
                            <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                        </div>
                        <div class="col s12 m10 l10">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor. Aenean massa.   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor. Aenean massa.   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor. Aenean massa.   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor. Aenean massa.   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor. Aenean massa.   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor. Aenean massa.
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>
<?php $this->end(); ?>

