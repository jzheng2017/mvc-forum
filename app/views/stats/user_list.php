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
                <?php $user->getUserInfo($user->id)?>
                <tr>
                    <td><a href="<?=PROOT?>user/profile/<?=$user->id?>"><?=$user->username?></a></td>
                    <td><?=$user->status > 0 ? "<b class='green-text'>Online</b>" : "Offline" ?></td>
                    <td><?= $user->post_count ?> </td>
                    <td><span class="<?= $user->reputation > 0 ? "green-text" : ($user->reputation == 0 ? "" : "red-text") ?>"><?= $user->reputation ?> </span></td>
                    <td><?=$user->date_created?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->end() ?>
