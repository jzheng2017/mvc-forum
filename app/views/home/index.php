<?php $this->setSiteTitle('Homepage'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <h1>Forum</h1>
    <div class="row">
        <?php foreach ($this->categories as $category) {

                $category->getChildren(); ?>
                <div class="col s12 card">
                    <h2><?= ucwords($category->name) ?></h2>
                    <div class="row">
                        <div class="col s12 m1 l1">
                            <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                        </div>
                        <div class="col s12 m1 l11">
                            <?= $category->description ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s12 m10 l10 offset-m2 offset-l2">
                            <div class="row">
                                <?php $index = 1;
                                foreach ($category->subcategories as $subcategory) {

                                    ?>

                                    <div class="col s6 m3 l3">
                                        <a href="<?= PROOT ?>category/view/<?= $subcategory->id ?>"
                                           class="black-text bold"><i
                                                    class="material-icons">filter_<?= $index ?></i><span
                                                    class="subcategory-link"> <?= ucwords($subcategory->name) ?></span></a>
                                    </div>
                                    <?php $index++;
                                } ?>

                            </div>
                        </div>
                        <div class="col s12">
                            <a href="<?= PROOT ?>category/view/<?= $category->id ?>" class="btn blue accent-3 waves-effect right">Go
                                to
                                <?= $category->name ?></a>
                        </div>
                    </div>

                </div>
        <?php } ?>
    </div>
</div>
<?php $this->end(); ?>


