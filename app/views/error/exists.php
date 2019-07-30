<?php
$this->start('body') ?>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1>You have already performed this action</h1>
                <p>Something went wrong.. The action you're trying to perfom can not be done currently.</p>
                <a href="<?=PROOT?>" class="btn blue accent-4 waves-effect">Return to homepage</a>
            </div>
        </div>
    </div>
<?php $this->end() ?>