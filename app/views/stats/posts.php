<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <h2 class="center">Most recent posts today</h2>
            <div class="col s12 m8 offset-m2">
                <ul class="collapsible">
                    <?php foreach ($this->posts as $post) { ?>
                        <li class="collection-item">
                            <div class="collapsible-header">
                                <span>Thread: <?= $post->title ?> | by: <?= $post->username ?></span>
                            </div>
                            <div class="collapsible-body">
                                <h5>Post</h5>
                                <div class="divider"></div>
                                <p><?= $post->body ?></p>
                                <a href="<?= PROOT ?>thread/view/<?= $post->thread_id ?>" class="btn blue accent-3">View thread</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>
