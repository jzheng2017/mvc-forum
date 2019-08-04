<?php $this->setSiteTitle($this->thread->title); ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?= PROOT ?>css/thread.css" media="screen" title="no title" charset="utf-8">
<?php $this->end() ?>

<?php $this->start('body'); ?>
<div class="container">
    <h1><?= $this->thread->title ?></h1>
    <?php if (UserModel::currentLoggedInUser() && UserModel::currentLoggedInUser()->exists()) { ?>
        <a class='dropdown-trigger btn blue accent-3 right' href='#' data-target='thread-actions'><span class="user">Thread Actions</span>
        </a>
        <ul id="thread-actions" class="dropdown-content">
            <?php if (UserModel::currentLoggedInUser()->id == $this->thread->created_by){?>
            <li>
                <a href="<?= PROOT ?>thread/edit/<?= $this->thread->id ?>">Edit thread</a>
            </li>
            <?php }?>
            <?php if (((UserModel::currentLoggedInUser()->permission > 0 || $this->thread->created_by == UserModel::currentLoggedInUser()->id))) { ?>
                <li>
                    <?php if ($this->thread->closed) { ?>
                        <a onclick="document.getElementById('status').submit();">Reopen thread</a>
                    <?php } else { ?>
                        <a onclick="document.getElementById('status').submit();">Close thread</a>
                    <?php } ?>
                </li>
                <form id="status" method="post" class="hide">
                    <input type="hidden" name="status" value="value"/>
                </form>
            <?php }
            ?>
            <?php if (UserModel::currentLoggedInUser()->permission > 1) { ?>
                <li>
                    <a href="<?= PROOT ?>action/remove/thread/<?= $this->thread->id ?>">Delete thread</a>
                </li>
            <?php } ?>
            <?php if (UserModel::currentLoggedInUser()->permission > 1) { ?>
                <li>
                    <?php if ($this->thread->important) { ?>
                        <a onclick="document.getElementById('important').submit();">Undo important</a>
                    <?php } else { ?>
                        <a onclick="document.getElementById('important').submit();">Make important</a>
                    <?php } ?>
                </li>
                <form id="important" method="post" class="hide">
                    <input type="hidden" name="important" value="value"/>
                </form>
            <?php } ?>
        </ul>
    <?php } ?>
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
                        <li>User: <a
                                    href="<?= PROOT ?>user/profile/<?= $this->thread->user->id ?>"><?= $this->thread->user->username ?></a>
                        </li>
                        <li>Reputation: <a href="<?= PROOT?>user/reputation/<?=$this->thread->user->id?>"
                                    class="<?= $this->thread->user->reputation > 0 ? "green-text" : ($this->thread->user->reputation == 0 ? "" : "red-text") ?>"><?= $this->thread->user->reputation ?></a>
                        </li>
                        <li>Permission: <?= ucwords($this->thread->user->role) ?></li>
                        <li>Rank: <?= ucwords($this->thread->user->rank_title) ?></li>
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
                <?php if ($this->thread->created_by == UserModel::currentLoggedInUser()->id && !$this->thread->closed) { ?>
                    <div class="row">
                        <a href="<?=PROOT?>thread/edit/<?=$this->thread->id?>" class="btn blue accent-3 right thread-action-button">Edit post</a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <?php if ($this->thread->posts) {
            $index = 1; ?>
            <?php foreach ($this->thread->posts as $post) { ?>
                <div class="col s12 card" id="<?=$post->id?>">
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
                                        <li>User: <a
                                                    href="<?= PROOT ?>user/profile/<?= $post->user->id ?>"><?= $post->user->username ?></a>
                                        </li>
                                        <li>Reputation: <a href="<?= PROOT?>user/reputation/<?=$post->user->id?>"
                                                    class="<?= $post->user->reputation > 0 ? "green-text" : ($post->user->reputation == 0 ? "" : "red-text") ?>"><?= $post->user->reputation ?></a>
                                        </li>
                                        <li>Permission: <?= ucwords($post->user->role) ?></li>
                                        <li>Rank: <?= ucwords($post->user->rank_title) ?></li>
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
                                <!-- Dropdown Trigger -->
                                <a class='dropdown-trigger btn blue accent-3  right' href='#'
                                   data-target='dropdown<?= $index ?>'><span class="user">User Actions</span> </a>

                                <!-- Dropdown Structure -->
                                <ul id='dropdown<?= $index ?>' class='dropdown-content'>
                                    <?php if ($post->user_id == UserModel::currentLoggedInUser()->id){?>
                                    <li>
                                        <a href="<?= PROOT ?>thread/edit/<?= $this->thread->id.'/'.$post->id ?>">Edit post</a>
                                    </li>
                                    <?php }?>
                                    <li>
                                        <a href="<?= PROOT ?>action/report/post/<?= $post->id ?>">Report post</a>
                                    </li>
                                    <li>
                                        <a href="<?= PROOT ?>action/report/user/<?= $post->user_id ?>">Report user</a>
                                    </li>

                                    <?php if (UserModel::currentLoggedInUser()->permission > 1) { ?>
                                        <li>

                                            <a href="<?= PROOT ?>action/ban/user/<?= $post->user_id ?>">Ban user</a>
                                        </li>
                                    <?php } ?>
                                    <?php if (UserModel::currentLoggedInUser()->permission > 0) { ?>
                                        <li>

                                            <a href="<?= PROOT ?>action/remove/post/<?= $post->id ?>">Remove post</a>
                                        </li>
                                    <?php } ?>
                                </ul>


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


