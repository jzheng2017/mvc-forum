<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2>User list</h2>
        <table>
            <thead>
            <tr>
                <th>Username</th>
                <th>Status</th>
                <th>Posts</th>
                <th>Reputation</th>
                <th>Date joined</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->users as $user) { ?>
                <?php $user->getUserInfo($user->id) ?>
                <tr>
                    <td><a href="<?= PROOT ?>user/profile/<?= $user->id ?>"><?= $user->username ?></a></td>
                    <td><?= $user->status > 0 ? "<b class='green-text'>Online</b>" : "Offline" ?></td>
                    <td><a href="<?= PROOT ?>user/posts/<?= $user->id ?>"><?= $user->post_count ?></a></td>
                    <td><a href="<?= PROOT ?>user/reputation/<?= $user->id ?>"
                           class="<?= $user->reputation > 0 ? "green-text" : ($user->reputation == 0 ? "" : "red-text") ?>"><?= $user->reputation ?> </a>
                    </td>
                    <td><?= $user->date_created ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <ul class="pagination right">
        <li <?=$this->currentPage == 1 ? 'class="disabled" onclick="return false"' : "" ?>"><a href="<?=PROOT?>stats/users/<?=$this->currentPage-1?>"><i class="material-icons">chevron_left</i></a></li>
        <li class="<?= $this->currentPage == 1 ? "active" : "" ?>"><a href="<?= PROOT ?>stats/users/1">1</a></li>
        <?php if ($this->currentPage > 3){ ?>
            <li class="dots">...</li>
        <?php } ?>
        <?php if ($this->currentPage-1>1){?>
        <li class="waves-effect "><a href="<?=PROOT?>stats/users/<?=$this->currentPage-1?>"><?=$this->currentPage-1?></a></li>
        <?php }?>
        <?php if ($this->currentPage != 1 && $this->currentPage != $this->maxPage){?>
        <li class="waves-effect active"><a href="<?=PROOT?>stats/users/<?=$this->currentPage?>"><?=$this->currentPage?></a></li>
        <?php }?>
        <?php if ($this->currentPage+1 < $this->maxPage){?>
        <li class="waves-effect"><a href="<?=PROOT?>stats/users/<?=$this->currentPage+1?>"><?=$this->currentPage+1?></a></li>
        <?php }?>
        <?php if ($this->maxPage - $this->currentPage > 2) { ?>
            <li class="dots">...</li>
        <?php } ?>
        <?php if ($this->maxPage != 1){?>
        <li class="waves-effect <?= $this->maxPage == $this->currentPage ? "active" : ""?>"><a href="<?=PROOT?>stats/users/<?=$this->maxPage?>"><?=$this->maxPage?></a></li>
        <?php }?>
        <li class="waves-effect <?= $this->currentPage == $this->maxPage ? "disabled" : "" ?>"><a href="<?=PROOT?>stats/users/<?=$this->currentPage+1?>"><i class="material-icons">chevron_right</i></a></li>
    </ul>

</div>
<?php $this->end() ?>
