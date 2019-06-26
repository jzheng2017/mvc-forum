<?php
$this->start('body') ?>
    <div class="container">
        <div class="row">
            <?php if ($this->sent) { ?>
            <div class="card light-green">
                <div class="card-content">
                    <span class="card-title">Sent successfully!</span>
                    <p>A message has been sent to <?=$this->model->username?></p>
                </div>
            </div>
                <div class="col s12 m6 offset-m3 card">
                    <div class="card-content">
                        <span class="card-title">Title</span>
                        <?= $this->title ?>
                        <span class="card-title">Message</span>
                        <?=$this->message?>
                    </div>
                </div>
            <?php } else { ?>
                <form class="col s12 m6 offset-m3" method="post">
                    <h2>Send a message</h2>
                    <?= $this->errors ?>
                    <div class="row">
                        <div class="col s12">
                            Send message to: <span class="bold"><?= $this->model->username ?></span>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" id="title" name="title" required>
                            <label for="title">Title</label>
                        </div>
                        <div class="input-field col s12">
                            <textarea class="materialize-textarea" id="body" name="body" required></textarea>
                            <label for="body">Message</label>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" class="btn blue accent-3 right">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
<?php $this->end() ?>