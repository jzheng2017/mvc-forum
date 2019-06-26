<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <h2 class="center">Users online right now</h2>
            <div class="col s12 m8 offset-m2">
                <ul class="collapsible">
                    <?php foreach ($this->users as $user){?>
                    <li>
                        <div class="collapsible-header"><?= $user->username?></div>
                        <div class="collapsible-body">
                            <p><span class="bold">Currently viewing:</span> <?= Util::userCurrentPage($user->type, $user->action, $user->object_id)?></p>
                            <a href="<?= PROOT?>user/profile/<?=$user->user_id?>" class="btn blue accent-3">view user</a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>
