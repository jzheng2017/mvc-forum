<?php $this->setSiteTitle($this->thread->title); ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?= PROOT ?>css/thread.css" media="screen" title="no title" charset="utf-8">
<?php $this->end() ?>

<?php $this->start('body'); ?>
<div class="container">
    <h1><?= $this->thread->title ?></h1>
    <?php if (UserModel::currentLoggedInUser()) { ?>
        <?php if (($this->thread->created_by == UserModel::currentLoggedInUser()->id) || (UserModel::currentLoggedInUser()->permission > 0)) { ?>
            <form method="post">
                <?php if ($this->thread->closed) { ?>
                    <input type="submit" class="btn blue accent-3 right" name="status" value="Reopen thread">
                <?php } else { ?>
                    <input type="submit" class="btn blue accent-3 right" name="status" value="Close thread">
                <?php } ?>
            </form>
        <?php }
        ?>
        <?php if (UserModel::currentLoggedInUser()->permission > 1) { ?>
            <a href="<?= PROOT ?>action/remove/thread/<?= $this->thread->id ?>"
               class="btn blue accent-3 right thread-action-button">Delete
                thread</a>
        <?php }
    } ?>
    <div class="row">
        <div class="col s12 card">
            <div class="s12 center"><h5>Original post</h5></div>
            <div class="divider"></div>
            <div class="row">
                <div class="col s12 m2 l2">
                    <div class="col s12">
                        <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                    </div>
                    <ul class="thread-user-info">
                        <li>User: <?= $this->thread->user->username ?></li>
                        <li>Reputation: <span
                                    class="<?= $this->thread->user->reputation > 0 ? "green-text" : ($this->thread->user->reputation == 0 ? "" : "red-text") ?>"><?= $this->thread->user->reputation ?></span>
                        </li>
                        <li>Permission: <?= ucwords($this->thread->user->role) ?></li>
                        <li>Posts: <?= $this->thread->user->post_count ?></li>
                        <li>
                            Status: <?= $this->thread->user->status ? '<span class="bold">Online</span>' : "Offline" ?></li>
                    </ul>
                    <div class="divider hide-on-med-and-up"></div>
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

                    <div class="s12 center"><h5>Post #<?= $index ?></h5> <span
                                class="right"><?= $post->date_created ?></span></div>
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
                                        <li>Reputation: <span
                                                    class="<?= $post->user->reputation > 0 ? "green-text" : ($post->user->reputation == 0 ? "" : "red-text") ?>"><?= $post->user->reputation ?></span>
                                        </li>
                                        <li>Permission: <?= ucwords($post->user->role) ?></li>
                                        <li>Posts: <?= $post->user->post_count ?></li>
                                        <li>
                                            Status: <?= $post->user->status ? '<span class="bold">Online</span>' : 'Offline' ?></li>
                                    </ul>
                                    <div class="divider hide-on-med-and-up"></div>
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
                            <div class="row">
                                <a href="<?= PROOT ?>action/report/post/<?= $post->id ?>"
                                   class="col s12 m2 l1 btn blue accent-3 right thread-action-button">Report post</a>

                                <a href="<?= PROOT ?>action/report/user/<?= $post->user_id ?>"
                                   class="col s12 m2 l1 btn blue accent-3 right thread-action-button">Report user</a>

                                <?php if (UserModel::currentLoggedInUser()->permission > 1) { ?>
                                    <a href="<?= PROOT ?>action/ban/user/<?= $post->user_id ?>"
                                       class="col s12 m2 l1 btn blue accent-3 right thread-action-button">Ban user</a>
                                <?php } ?>
                                <?php if (UserModel::currentLoggedInUser()->permission > 0) { ?>
                                    <a href="<?= PROOT ?>action/remove/post/<?= $post->id ?>"
                                       class="col s12 m2 l1 btn blue accent-3 right thread-action-button">Remove
                                        post</a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <?php
                $index++;
            } ?>
        <?php } ?>
        <?php if (UserModel::currentLoggedInUser()) { ?>
            <?php if (UserModel::currentLoggedInUser()->permission >= 0 && !$this->thread->closed) { ?>
                <div class="row">
                    <form method="post" class="col s12 card">
                        <h5>Place a post</h5>
                        <?= $this->errors ?>
                        <div class="input-field">
                        <textarea name="body"
                                  class="materialize-textarea"><?= isset($_POST['body']) ? $_POST['body'] : "" ?></textarea>
                        </div>
                        <div class="input-field right">
                            <input type="submit" value"insert" name="insert" class="btn blue accent-3">
                        </div>
                    </form>
                </div>
            <?php }
        } ?>
    </div>
    <?php $this->end(); ?>


