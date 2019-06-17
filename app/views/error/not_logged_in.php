<?php
$this->start('body') ?>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1>Something went wrong..</h1>
                <p>You can not logout while not logged in.</p>
                <a href="<?=PROOT?>" class="btn blue accent-4 waves-effect">Return to homepage</a>
            </div>
        </div>
    </div>
<?php $this->end() ?>