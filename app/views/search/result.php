<?php $this->setSiteTitle('Search result') ?>

<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2>Search result</h2>
        <?php if (isset($this->result) && count($this->result)) { ?>
            <?php foreach ($this->result as $result) { ?>
                <div class="card col s12">
                    <div class="card-content">
                        <?php if ($this->type == 'user') { ?>
                            <span class="card-title"><a
                                        href="<?= PROOT ?>user/profile/<?= $result->id ?>"><?= $result->username ?></a></span>
                            <ul>
                                <li>Date joined: <?= $result->date_created ?></li>
                                <li>Verified user: <?= $result->verified ? "Yes" : "No" ?></li>
                            </ul>
                        <?php } else if ($this->type == 'thread') { ?>
                            <?php $result->title = str_replace(Input::get('query'), "<span class='yellow'>".Input::get('query')."</span>",$result->title)?>
                            <span class="card-title"><a
                                        href="<?= PROOT ?>thread/view/<?= $result->id ?>"><?= $result->title ?></a></span>
                            <ul>
                                <?php $result->body = str_replace(Input::get('query'), "<span class='yellow'>".Input::get('query')."</span>",$result->body)?>
                                <li><?=$result->body?></li>
                                <div class="divider"></div>
                                <li>Date created: <?= $result->date_created ?></li>
                            </ul>
                        <?php } else if ($this->type == 'post'){?>
                            <?php $thread = new ThreadModel((int)$result->thread_id)?>
                            <?php $thread->title = str_replace(Input::get('query'), "<span class='yellow'>".Input::get('query')."</span>",$thread->title)?>
                            <span class="card-title"><a href="<?=PROOT?>thread/view/<?=$thread->id?>"><?=$thread->title?></a></span>
                            <ul>
                                <?php $result->body = str_replace(Input::get('query'), "<span class='yellow'>".Input::get('query')."</span>",$result->body)?>
                                <li><?=$result->body?></li>
                                <div class="divider"></div>
                                <li>Date posted: <?= $result->date_created ?></li>
                            </ul>
                        <?php }?>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No results were found.. Try again.</p>
            <a href="<?= PROOT ?>search" class="btn blue accent-3">Return</a>
        <?php } ?>


    </div>
</div>
<?php $this->end() ?>
