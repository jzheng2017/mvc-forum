<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2>Ranks</h2>
        <?php if ($this->ranks) { ?>
            <table>
                <thead>
                <tr>
                    <th>Rank</th>
                    <th>Requirement</th>
                    <th>Achieved</th>
                    <?php if (UserModel::currentLoggedInUser()) { ?>
                        <th></th>
                    <?php } ?>
                </tr>
                </thead>
                <?php foreach ($this->ranks as $rank) { ?>
                    <tr>
                        <td><?= $rank->title ?></td>
                        <td><?= $rank->requirement ?></td>
                        <td><a href="<?= PROOT ?>ranks/list/<?= $rank->rank ?>"><?= $rank->achieved()[0]->amount ?></a>
                        </td>
                        <?php if (UserModel::currentLoggedInUser()) { ?>
                            <td>
                                <?php if (UserModel::currentLoggedInUser()->rank > $rank->rank) { ?>
                                    You have surpassed this rank.
                                <?php } else if (UserModel::currentLoggedInUser()->rank == $rank->rank) { ?>
                                    You are currently this rank.
                                <?php } else if (UserModel::currentLoggedInUser()->getPoints()->points >= $rank->requirement) { ?>
                                    <form method="post" class="margin-bottom-zero">
                                        <input type="hidden" id="rank" name="rank" value="<?= $rank->rank ?>">
                                        <input type="submit" class="btn blue accent-3" value="rank up">
                                    </form>

                                <?php } else { ?>
                                    You do not meet the requirements.
                                <?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>There are currently no ranks.</p>
            <a href="<?= PROOT ?>" class="btn blue accent-3">Return to homepage</a>
        <?php } ?>
    </div>
</div>
<?php $this->end() ?>
