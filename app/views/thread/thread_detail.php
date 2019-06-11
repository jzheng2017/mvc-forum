<?php $this->setSiteTitle('Test'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <h1>Thread Titel 1</h1>

    <button class="btn blue accent-3 right">Delete thread</button>

    <div class="row">
        <div class="col s12 card">

            <div class="s12"><h5>Post #1</h5></div>
            <div class="row">
                <div class="s2">
                    <div class="col s12 m2 l2">
                        <div class="col s12">
                            <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                        </div>
                        <div class="s12">
                            <ul class="thread-user-info">
                                <li>User: HeavyKong</li>
                                <li>Reputation: <span class="green-text">582</span></li>
                                <li>Permission: Admin</li>
                                <li>Posts: 22,821</li>
                                <li>Status: <span class="bold">Online</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="s12 m10 l10">
                    <p class="post-text">
                        👌👀👌👀👌👀👌👀👌👀 good shit go౦ԁ sHit👌 thats ✔ some good👌👌shit right👌👌there👌👌👌
                        right✔there
                        ✔✔if i do ƽaү so my self 💯 i say so 💯 thats what im talking about
                        right there right there (chorus: ʳᶦᵍʰᵗ ᵗʰᵉʳᵉ) mMMMMᎷМ💯 👌👌 👌НO0ОଠOOOOOОଠଠOoooᵒᵒᵒᵒᵒᵒᵒᵒᵒ👌 👌👌
                        👌 💯 👌 👀 👀 👀 👌👌Good shit
                    </p>
                </div>
            </div>
            <div class="row">

                    <button class="btn blue accent-3 right thread-action-button">Edit post</button>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 card">

            <div class="s12"><h5>Post #2</h5></div>

            <div class="row">
                <div class="s2">
                    <div class="col s12 m2 l2">
                        <div class="col s12">
                            <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
                        </div>
                        <div class="s12">
                            <ul class="thread-user-info">
                                <li>User: SilentGlow</li>
                                <li>Reputation: <span class="red-text">-69</span></li>
                                <li>Permission: User</li>
                                <li>Posts: 22</li>
                                <li>Status: <span class="bold">Online</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="s12 m10 l10">
                    <p class="post-text">
                        As an European it was always hard for me to understand American culture. What was fascinating
                        for me is that they like bragging about their freedom which was weird for me,
                        because I didn't think that I have any less freedom than them. I always thought 'What is the
                        difference'. However after this game I finally understand it. NA is just so fucking free.
                        <br>
                        <br>
                        <br>
                        hallo ik ben adil en ik ben gay
                    </p>
                </div>
            </div>
            <div class="row">
                <button class="col s3 m2 l1 btn blue accent-3 right thread-action-button">Report post</button>
                <button class="col s3 m2 l1 btn blue accent-3 right thread-action-button">Report user</button>
                <button class="col s3 m2 l1 btn blue accent-3 right thread-action-button">Ban user</button>
            </div>
        </div>

        <div class="row">

            <form method="post" class="col s12 card">
                <h5>Place a post</h5>
                <div class="input-field">
                    <textarea class="materialize-textarea"></textarea>
                </div>
                <div class="input-field right">
                    <input type="submit" value"submit" class="btn blue accent-3">
                </div>
            </form>

        </div>
    </div>
    <?php $this->end(); ?>


