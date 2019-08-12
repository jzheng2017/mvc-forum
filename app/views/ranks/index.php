<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2>Ranking</h2>
        <div class="card">
            <div class="card-content">
                <p> The ranking list is ordered by users with the highest rank.</p>
            </div>
        </div>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">Frequently Asked Questions</div>
                <div class="collapsible-body">
                    <ul>
                        <li>
                            <div class="bold">What are points?</div>
                            <div>Points are things you can earn on this website.</div>
                        </li>
                        <li>
                            <div class="bold">How do I earn points?</div>
                            <div>The points can be earned by performing actions on this website, such as:
                                logging in
                                daily, posting, giving/receiving feedback etc.
                            </div>
                        </li>
                        <li>
                            <div class="bold">What can we do with the points?</div>
                            <div>There are many uses for the points. You can use them to play games, or unlock
                                some
                                achievements by reaching or spending the points.
                            </div>
                        </li>
                        <li>
                            <div class="bold">How do I achieve higher ranks?</div>
                            <div>You can go up a rank by reaching the minimum requirement for the said rank. <a
                                        href="<?= PROOT ?>ranks/list" class="blue-text">Click here</a> to view
                                the requirements for each rank.
                            </div>
                        </li>
                        <li>
                            <div class="bold">Does reaching higher ranks give me more benefits?</div>
                            <div>
                                Yes, absolutely! Each higher rank gives you more benefits! For example it unlocks certain pages or it gives you the ability to post more often (lower cooldown).
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <?php if ($this->users) { ?>
            <table>
                <thead>
                <tr>
                    <th>User</th>
                    <th>Rank</th>
                    <th>Points</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->users as $user) { ?>
                    <tr>
                        <td><a href="<?= PROOT ?>user/profile/<?= $user->id ?>"><?= $user->username ?></a></td>
                        <td><?= $user->title ?></td>
                        <td><?= $user->points ?></td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>The ranking list is currently not available..</p>
            <a href="<?= PROOT ?>" class="btn blue accent-3">Return to homepage</a>
        <?php } ?>
    </div>
</div>
<?php $this->end() ?>
