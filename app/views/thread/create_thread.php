<?php $this->start('body'); ?>
<div class="container">
    <div class="row">
        <h2>Create a thread</h2>
        <form class="col s12" method="post">
            <?= $this->errors ?>
            <div class="row">
                <div class="input-field col s12 m6">
                    <h5>Title</h5>
                    <input type="text" name="title" id="title" value="<?= isset($this->fields['title']) ? $this->fields['title'] : ""?>" required>
                    <label for="title"></label>
                </div>
                <div class="input-field col s12">
                    <h5>Body</h5>
                    <input type="text" name="body" id="body" value="<?= isset($this->fields['body']) ? $this->fields['body'] : ""?>"required>
                    <label for="body"></label>
                </div>
                <div class="input-field col s6">
                    <h5>Category</h5>
                    <select name="category" id="category" required>
                        <option value="" selected disabled>Select a category</option>
                        <?php foreach ($this->categories as $category) { ?>
                            <option value="<?= $category->id ?>" <?= isset($this->fields['category']) ? $this->fields['category'] == $category->id ? "selected" : "" : $category->id == $this->id ? "selected" : ""?>><?= ucwords($category->name) ?></option>
                            <?php $category->getChildren(); ?>
                            <?php foreach ($category->subcategories as $subcategory) { ?>
                                <option value="<?= $subcategory->id?>"<?= isset($this->fields['category']) ? $this->fields['category'] == $subcategory->id ? "selected" : "" : $subcategory->id == $this->id ? "selected" : ""?>>- <?=ucwords($subcategory->name)?></option>
                            <?php } ?>
                        <?php } ?>
                        <label for="category"></label>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" class="btn blue accent-3" value="Create thread">
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>
