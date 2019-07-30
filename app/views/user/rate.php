<?php $this->start('body') ?>
    <div class="container">
    <div class="row">
<?= $this->errors ?>
    <form method="post" class=" col s12 m6 offset-m3">
        <h2>Rate <?= $this->user->username ?></h2>
        <div class="row">
            <div class="col s12 input-field">
                <select required name="rating" id="rating">
                   <?php for ($i = 1; $i > -2; $i--){?>
                   <option value="<?=$i?>" <?php if (isset($_POST['rating'])){
                       if ($i == $_POST['rating']){
                           echo 'selected';
                       }
                   }else if ($this->reputation->exists()){
                       if ($i == $this->reputation->rating){
                           echo 'selected';
                       }
                   }
                   ?>><?=$i?></option>
                   <?php }?>
                </select>
                <label for="rating">Rating</label>
            </div>
            <div class="col s12 input-field">
                <input type="text" id="comment" name="comment"
                       value="<?php if (isset($_POST['comment'])){
                           echo $_POST['comment'];
                           }else if ($this->reputation->exists()){
                           echo $this->reputation->comment;
                       }
                       ?>">
                <label for="comment">Comment</label>
            </div>
            <div class="col s12 input-field">
                <input type="submit" class="btn blue accent-3 right" name="submit">

            </div>
        </div>
    </form>
    </div>
<?php $this->end() ?>