<?php $this->start('body') ?>
<div class="container">
    <h2>Message</h2>
    <div class="row">
        <div class="card col s12">
            <div class="card-content">
                <span class="card-title"><?= $this->message->title ?></span>
                <div class="divider"></div>
                from: <?= $this->message->senderModel->exists() ? '<a href="' . PROOT . 'user/profile/' . $this->message->senderModel->id . '" class="bold">' . $this->message->senderModel->username . '</a>' : "<b>unknown</b>" ?>
                <div class="divider"></div>
                <p><?= $this->message->body ?></p>
            </div>
        </div>
        <?php if ($this->message->sender != UserModel::currentLoggedInUser()->id) { ?>
            <form method="post" class="card col s12">
                <h5>Reply to message</h5>
                <?=$this->errors?>
                <div class="input-field">
                    <textarea class="materialize-textarea" id="body" name="body" required></textarea>
                    <label for="body">Message</label>
                </div>
                <div class="input-field right">
                    <input type="submit" class="btn blue accent-3" value="Send message">
                </div>

            </form>
        <?php } ?>
    </div>
</div>
<?php $this->end() ?>
