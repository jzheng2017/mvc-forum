<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2><?= $this->user->username ?>'s posts</h2>
        <?php if (!empty($this->posts)) { ?>
            <?php foreach ($this->posts as $post) { ?>
                <div class="card">
                    <a href="<?= PROOT ?>thread/view/<?= $post->thread_id ?>#<?= $post->id ?>">
                        <div class="card-content">
                            <?php $post->getParent()?>
                            <span class="card-title"><?=$post->parent->title?></span>
                            <p><?= $post->body ?></p>
                            <div class="divider"></div>
                            <p>Posted at: <?=$post->date_created?></p>
                        </div>
                    </a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>This user has no posts.</p>
            <a href="<?= PROOT ?>user/profile/<?= $this->user->id ?>" class="btn blue accent-3">Return to profile</a>
        <?php } ?>
    </div>
</div>
<?php $this->end() ?>
