<?php $this->setSiteTitle('Login'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <?= $this->errors ?>
    <h1 class="title center">Login</h1>
    <div class="row">
        <form class="col s12 m4 l4 offset-m4 offset-l4 card indigo" method="post">
            <div class="row indigo card-content">
                <div class="input-field col s12">
                    <input class="validate" type="text" name="username" id="username" value="" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-field col s12">
                    <input class="validate" type="password" name="password" id="password" value="" required>
                    <label for="password">Password</label>
                </div>
                <div class="col s12">
                    <div class="row">
                        <label class="input-field col s12 m6 l6" for="remember">
                            <input class="validate" type="checkbox" name="remember" id="remember" value="">
                            <span>Remember me</span>
                        </label>
                        <div class="input-field col s12 m6 l6">
                            <a class="black-text right" href="<?= PROOT?>forgot-password"><b>Forgot password?</b></a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col center s12">
                    <input type="submit" class="btn btn-large blue accent-3 " value="Login">
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>

