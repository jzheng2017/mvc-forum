<?php $this->start('head')?>
<link rel="stylesheet" href="<?= PROOT ?>css/reputation.css" media="screen" title="no title" charset="utf-8">
<?php $this->end()?>
<?php $this->start('body') ?>
<div class="container">
    <h2>Reputation</h2>
    <h3><?= $this->user->username?></h3>
    <div class="row">
        <?php if ($this->id != UserModel::currentLoggedInUser()->id){?>
        <a href="<?=PROOT?>user/rate/<?=$this->id?>"class="btn blue accent-3 right">Rate user</a>
        <?php }?>
        <?php echo Util::generateReputationView($this->reputations)?>
    <?php foreach ($this->reputations as $reputation){?>
        <?php $reputation->getUser() ?>
        <div class="col s12 card">
            <div class="card-content">
            <a href="<?=PROOT?>user/profile/<?=$reputation->given_by?>" class="card-title"><?=$reputation->user->username?></a>
                <span class="block">Rating: <span class="<?= $reputation->rating > 0 ? "green-text" : ($reputation->rating < 0 ? "red-text" : "") ?>"><?=$reputation->rating?></span></span>
                <span class="block"><?=$reputation->date_created?></span>
            <p>
                <?= $reputation->comment?>
            </p>
            </div>
        </div>
    <?php }?>
    </div>
</div>
<?php $this->end() ?>
