<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <?= $this->errors ?>
        <h1 class="title center">Account recovery</h1>
        <form method="post" class="col s12 m4 l4 offset-m4 offset-l4 card">
          <p>To recover your account fill in the username or email associated with the relevant account.</p>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="identifier" name="identifier" placeholder="Fill in an username or email.." required>
                    <label for="identifier">Username or email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 center">
                    <input type="submit" class="btn btn-large blue accent-3">
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->end() ?>
