<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2>Inbox</h2>
        <div class="col s12 m2">
            <ul class="collection">
                <a href="<?=PROOT?>user/inbox">  <li class="collection-item <?= $this->page == 'received' ? "grey-text" : "" ?>">Received</li></a>
                <a href="<?=PROOT?>user/inbox/sent"><li class="collection-item <?= $this->page == 'sent' ? "grey-text" : "" ?>">Sent</li></a>
                <a href="<?=PROOT?>user/inbox/trashcan"> <li class="collection-item <?= $this->page == 'trashcan' ? "grey-text" : "" ?>">Trashcan</li></a>
            </ul>
        </div>
        <div class="col s12 m10">
            <ul class="collection with-header">
                <li class="collection-header"><h4><?=ucwords($this->page)?></h4></li>
                <?php if ($this->messages){?>
               <?php foreach($this->messages as $message){?>
               <a href="<?=PROOT?>user/message/<?=$message->id?>"><li class="collection-item <?=!$message->opened ? "bold" : ""?>"><?=$message->title?></li></a>
                <?php }?>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
<?php $this->end() ?>
