<?php $this->setSiteTitle('Test'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <h1>Forum</h1>
    <div class="row">
        <?php for ($i = 0; $i < 10; $i++) { ?>
            <div class="col s12 card">
                <h2>Category <?= $i ?></h2>
                <div class="row">
                    <div class="col s12 m2 l2">
                        <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                    </div>
                    <div class="col s12 m10 l10">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                        Aenean commodo ligula eget dolor. Aenean massa.
                        Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper
                        ultricies nisi. Nam eget dui.
                    </div>

                </div>
                <div class="row">
                    <div class="col s12 m8 l8 offset-m2 offset-l2">
                        <div class="row">
                          <?php for ($j = 1; $j <= 3; $j++){?>
                            <div class="col s6 m4 l4">
                               <a href="" class="black-text"><i class="material-icons">filter_<?=$j?></i><span class="subcategory-link"> Subcategory <?= $j ?></span></a>
                            </div>
                            <?php }?>
                        </div>
                    </ul>
                    </div>
                    <div class="col s12">
                        <a href="<?= PROOT ?>category/view/<?=$j?>" class="btn blue accent-3 right">Go to category</a>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>
</div>
<?php $this->end(); ?>


