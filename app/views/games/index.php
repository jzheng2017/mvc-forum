<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2>Games</h2>
        <div class="card">
            <div class="card-content">
                There are various games to play on this page! Go find your favorite game and become the best!
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
                            <div>The points can be earned by performing actions on this website, such as: logging in
                                daily, posting, giving/receiving feedback etc.
                            </div>
                        </li>
                        <li>
                            <div class="bold">Why are there games?</div>
                            <div>The games make the site more interesting and fun. It gives the user more reason to come
                                back to the site besides just the forum.
                            </div>
                        </li>
                        <li>
                            <div class="bold">Can we play with other users?</div>
                            <div>Yes, of course! There are games that can be played with two or more players, some games
                                even have highscores to keep the game more competive!
                            </div>
                        </li>
                        <li>
                            <div class="bold">Why should we play games?</div>
                            <div>Besides that playing games is fun, you can also earn more points by playing some
                                games.
                            </div>
                        </li>
                        <li>
                            <div class="bold">What can we do with the points?</div>
                            <div>There are many uses for the points. You can use them to play games, or unlock some
                                achievements by reaching or spending the points.
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <div class="divider"></div>

    <div class="row">
        <h3>List of games</h3>
        <?php foreach ($this->games as $game) { ?>
            <div class="col s12 m6">
                <h4 class="header"><?= $game->name ?></h4>
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="https://lorempixel.com/100/190/nature/6">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p><?=$game->description?></p>
                        </div>
                        <div class="card-action">
                            <a href="<?=PROOT?>games/<?=$game->link?>" class="btn blue accent-3">Play game</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
<?php $this->end() ?>
