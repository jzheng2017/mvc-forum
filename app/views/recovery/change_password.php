<?php $this->start('body') ?>
<?php if ($this->valid) { ?>
    <div class="container">
        <div class="row">
            <?= $this->errors ?>
            <h1 class="title center">Account recovery</h1>
            <form method="post" class="col s12 m4 l4 offset-m4 offset-l4 card">
                <p>You can now change the password of your account. </p>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="password" id="password" name="password" placeholder="Fill in password" required
                               value="<?= $this->password ? $this->password : "" ?>">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required
                               value="<?= $this->confirm ? $this->confirm : "" ?>">
                        <label for="confirm_password">Confirm password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 center">
                        <input type="submit" class="btn btn-large blue accent-3" name="change">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <?= $this->errors ?>
    </div>
<?php } ?>
<?php $this->end() ?>