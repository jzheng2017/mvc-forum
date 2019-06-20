<?php $this->setSiteTitle('Error');?>
<?php $this->start('body');?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <h1>Error</h1>
            <p>Something went wrong.. You have tried to access a page that you don't have access to or the page doesn't exist..</p>
            <a href="<?=PROOT?>" class="btn blue accent-4 waves-effect">Return to homepage</a>
        </div>
    </div>
</div>
<?php $this->end(); ?>
