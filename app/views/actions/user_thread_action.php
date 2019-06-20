<?php
$this->start('body') ?>
    <div class="container">
        <div class="row">

            <div class="col s12 m4">
                <h1><?= ucwords($this->action) . " " . $this->type ?></h1>
                <table>
                    <tbody>
                    <tr>
                        <td class="bold">Post ID</td>
                        <td><?= $this->object->id ?></td>
                    </tr>
                    <tr>
                        <td class="bold">Posted by</td>
                        <td><?= $this->object->user->username ?></td>
                    </tr>
                    <tr>
                        <td class="bold">Content</td>
                        <td class="scrolling"><?= $this->object->body ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col s12 m4 offset-m1">
                <div class="row">
                    <h1>Reason for removal</h1>
                    <?php if (isset($this->model->id)) { ?>
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Action done by: <?= $this->model->user->username ?> - <?= $this->model->date_created ?></span>
                                <p><?= $this->model->comment ?></p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <form method="post">
                            <div class="row">
                                <?= $this->errors ?>
                                <div class="input-field col s12">
                                    <input type="text" name="comment" id="comment" placeholder="Fill this in..">
                                    <label for="comment">Comment</label>
                                </div>
                                <div class="input-field col s12">
                                    <input type="submit" class="btn blue accent-3">
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->end() ?>