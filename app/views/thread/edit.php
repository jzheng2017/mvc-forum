<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <?= $this->errors ?>
        <form method="post" class="col s12 m6 offset-m3">
            <h1>Edit <?= $this->model instanceof ThreadModel ? "thread" : "post" ?></h1>
            <h2><?= isset($this->model->title) ? $this->model->title : $this->model->parent->title ?></h2>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="body" name="body"
                              class="materialize-textarea"><?= $this->model->exists() ? $this->model->body : "" ?></textarea>
                    <label for="body">Content</label>
                </div>
            </div>
            <div class="row right">
                <div class="input-field col s12">
                    <input type="submit" class="btn blue accent-3">
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->end() ?>
