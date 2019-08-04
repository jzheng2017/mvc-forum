<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2><?= $this->rank->title ?> ranking list</h2>
        <div class="card">
            <div class="card-content">
                <p>
                    Requirement: <?= $this->rank->requirement ?>
                    <br>
                    Amount of users that have achieved this rank: <?= count($this->users) ?>
                </p>
            </div>
        </div>
        <?php if ($this->users) { ?>
            <table>
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Points</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->users as $user) { ?>
                    <tr>
                        <td><?= $user->username ?></td>
                        <td><?= isset($user->getPoints()->points) ? $user->points->points : "Unknown" ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="card">
                <div class="card-content">
                    <p>No user has achieved this rank yet.</p>
                </div>
            </div>
            <a href="<?= PROOT ?>ranks/list" class="btn blue accent-3">Return to ranking list</a>
        <?php } ?>
    </div>
</div>
<?php $this->end() ?>
