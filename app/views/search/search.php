<?php $this->setSiteTitle('Search') ?>

<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h2>Search</h2>
        <form method="get" class="">
            <?= $this->errors ?>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="query" name="query" placeholder="Search query..">
                    <label for="query">Search</label>
                </div>
                <div class="input-field col s12">
                    <p>
                        <label>
                            <input class="with-gap" name="type" type="radio" value="thread" checked>
                            <span>Thread</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input class="with-gap" name="type" type="radio" value="post">
                            <span>Post</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input class="with-gap" name="type" type="radio" value="user">
                            <span>User</span>
                        </label>
                    </p>
                </div>
                <div class="input-field col s12">
                    <input type="submit" class="btn blue accent-3 right" value="search">
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->end() ?>
