<?php $this->setSiteTitle(ucwords($this->category->name)); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= PROOT ?>css/category.css" media="screen" title="no title" charset="utf-8">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="container">
    <h1><?= ucwords($this->category->name) ?></h1>
    <div class="row">
        <div class="col s12 card indigo lighten-3">
            <div class="card-content">
                <?= $this->category->description ?>
            </div>
        </div>
        <?php if ($this->category->getChildren()) { ?>
            <h2>Subcategories</h2>
            <?php foreach ($this->category->subcategories as $subcategory) { ?>
                <a href="<?= PROOT ?>category/view/<?= $subcategory->id ?>" class="black-text">
                    <div class="col s12 m4 l4  card">
                        <h5><?= ucwords($subcategory->name) ?></h5>
                        <div class="row">
                            <div class="col s5 m4 l4 hide-on-small-and-down">
                                <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                            </div>
                            <div class="col s7 m8 l8">
                                <?= $subcategory->description ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="row">
        <h2 class="thread-header">Threads</h2>
        <?php if (UserModel::currentLoggedInUser()){?>
        <a href="<?=PROOT?>thread/create/<?=$this->category->id?>" class="btn blue accent-4 waves-effect right">New thread</a>
        <?php }?>
        <?php if ($this->threads) { ?>
            <?php foreach ($this->threads as $thread) { ?>
                <a href="<?= PROOT ?>thread/view/<?= $thread->id ?>" class="black-text">
                    <div class="col s12 card">
                        <h5> <?= $thread->title ?> <?= $thread->closed ? '<span class="new red badge">closed</span>' : "" ?></h5>
                        <div class="row">
                            <div class="col s4">
                              <span class="bold">Created by: </span>  <?= $thread->user->username ?> at  <?= $thread->date_created ?>
                            </div>
                            <div class="col offset-s4 s4 ">
                                <span class="right">
                                    <span class="bold">Latest post by:</span> <?= count($thread->posts) ? end($thread->posts)->user->username . " at " . end($thread->posts)->date_created : "-" ?><span class="bold"> Posts:</span> <?= count($thread->posts)?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        <?php } else { ?>
            <div class="col s12 card indigo lighten-3">
                <div class="card-content">
                    There are no threads in this category.. Will you be the first? ;)
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php $this->end(); ?>

