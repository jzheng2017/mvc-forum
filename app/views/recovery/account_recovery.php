<?php $this->start('body') ?>
    <div class="container">
        <div class="row">
            <?= $this->errors ?>
            <h1 class="title center">Account recovery</h1>
            <form method="post" class="col s12 m4 l4 offset-m4 offset-l4 card">
                <p>Enter the code you received in your email. </p>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" id="code" name="code" placeholder="Fill in a code.." required
                               value="<?= $this->code ? $this->code : "" ?>">
                        <label for="code">Code</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 right-align">
                       <a href="<?=PROOT?>recovery" class="bold">No code received? Try again</a>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 center">
                        <input type="submit" class="btn btn-large blue accent-3" name="recover">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $this->end() ?>