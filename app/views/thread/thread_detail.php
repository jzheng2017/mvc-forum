<?php $this->setSiteTitle($this->thread->title); ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?= PROOT ?>css/thread.css" media="screen" title="no title" charset="utf-8">
<?php $this->end() ?>

<?php $this->start('body'); ?>
<div class="container">
    <h1><?= $this->thread->title ?></h1>

    <?php if (UserModel::currentLoggedInUser()) { ?>
        <?php if ($this->thread->created_by == UserModel::currentLoggedInUser()->id) { ?>
            <button class="btn blue accent-3 right">Delete thread</button>
        <?php }
    } ?>
    <div class="row">
        <div class="col s12 card">
            <div class="s12 center"><h5>Original post</h5></div>
            <div class="divider"></div>
            <div class="row">
                <div class="s2">
                    <div class="col s12 m2 l2">
                        <div class="col s12">
                            <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                        </div>
                        <div class="s12">
                            <ul class="thread-user-info">
                                <li>User: <?= $this->thread->user->username ?></li>
                                <li>Reputation: <span class="<?= $this->thread->user->reputation > 0 ? "green-text" : ($this->thread->user->reputation == 0 ? "" : "red-text") ?>"><?= $this->thread->user->reputation ?></span></li>
                                <li>Permission: User</li>
                                <li>Posts: <?= $this->thread->user->post_count?></li>
                                <li>Status: <span class="bold">Online</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="s12 m10 l10">
                    <p class="post-text">
                        <?= $this->thread->body ?>
                    </p>
                </div>
            </div>
            <?php if (UserModel::currentLoggedInUser()) { ?>
                <?php if ($this->thread->created_by == UserModel::currentLoggedInUser()->id) { ?>
                    <div class="row">

                        <button class="btn blue accent-3 right thread-action-button">Edit post</button>

                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <?php if ($this->thread->posts) {
            $index = 1; ?>
            <?php foreach ($this->thread->posts as $post) { ?>
                <div class="col s12 card">

                    <div class="s12 center"><h5>Post #<?= $index ?></h5></div>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="s2">
                            <div class="col s12 m2 l2">
                                <div class="col s12">
                                    <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                                </div>
                                <div class="s12">
                                    <ul class="thread-user-info">
                                        <li>User: <?= $post->user->username ?></li>
                                        <li>Reputation: <span class="<?= $post->user->reputation > 0 ? "green-text" : ($post->user->reputation == 0 ? "" : "red-text") ?>"><?= $post->user->reputation ?></span></li>
                                        <li>Permission: User</li>
                                        <li>Posts: <?= $post->user->post_count?></li>
                                        <li>Status: <span class="bold">Online</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="s12 m10 l10">
                            <p class="post-text">
                                <?= $post->body ?>
                            </p>
                        </div>
                    </div>

                    <?php if (UserModel::currentLoggedInUser()) { ?>
                        <div class="col s12">
                            <form method="post" class="row">
                                <button class="col s6 m2 l1 btn blue accent-3 right thread-action-button" name="post"
                                        value="<?= $post->user_id ?>">Report post
                                </button>
                                <button class="col s6 m2 l1 btn blue accent-3 right thread-action-button" name="user"
                                        value="<?= $post->user_id ?>">Report user
                                </button>

                                <?php if (UserModel::currentLoggedInUser()->permission > 1) { ?>
                                    <button class="col s6 m2 l1 btn blue accent-3 right thread-action-button" name="ban"
                                            value="<?= $post->user_id ?>">Ban user
                                    </button>
                                <?php } ?>
                                <?php if (UserModel::currentLoggedInUser()->permission > 0) { ?>
                                    <button class="col s6 m2 l1 btn blue accent-3 right thread-action-button" name="remove"
                                            value="<?= $post->id ?>">Remove post
                                    </button>
                                <?php } ?>
                            </form>
                        </div>
                    <?php } ?>

                </div>
                <?php
                $index++;
            } ?>
        <?php } ?>
        <?php if (UserModel::currentLoggedInUser()) { ?>
            <div class="row">
                <form method="post" class="col s12 card">
                    <h5>Place a post</h5>
                    <?php if ($this->errors){?>
                        <div class="card red lighten-2">
                            <div class="card-content">
                                <ul>
                                    <?php foreach ($this->errors as $error){?>
                                        <li><?= $error ?></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    <?php }?>
                    <div class="input-field">
                        <textarea name="body" class="materialize-textarea"><?= isset($_POST['body']) ? $_POST['body'] : ""  ?></textarea>
                    </div>
                    <div class="input-field right">
                        <input type="submit" value"insert" name="insert" class="btn blue accent-3">
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
    <?php $this->end(); ?>


