<?php $this->setSiteTitle($this->game->name) ?>
<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <?= $this->errors?>
        <h2 class="center"><?= $this->game->name ?></h2>
        <form method="post" class="card col s12 m6 offset-m3">
         <?=$this->message?>
            <div class="card">
                <div class="card-content">
                    <p>Bigger the difference between min and max, the higher the reward.</p>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <ul>
                        <li>Winstreak: <?= $this->data->winstreak?></li>
                        <li>Number of times played: <?= $this->data->played?> </li>
                    </ul>
                </div>
                <div class="input-field col s6">
                    <input type="number" name="min" id="min" value="0">
                    <label for="min">Min</label>
                </div>
                <div class="input-field col s6">
                    <input type="number" name="max" id="max" value="10">
                    <label for="max">Max</label>
                </div>
                <div class="input-field col s12">
                    <input type="number" name="input" id="input">
                    <label for="input">Pick a number</label>
                </div>
                <div class="input-field col s12 center">
                    <input type="submit" class="btn blue accent-3" value="Throw">
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->end() ?>
