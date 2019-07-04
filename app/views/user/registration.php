<?php $this->setSiteTitle('Registration'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= PROOT ?>css/registration.css" media="screen" title="no title" charset="utf-8">
<script src="<?= PROOT ?>js/registration.js"></script>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container">
    <div class="row">
        <h1 class="center">Registration</h1>
        <form class="col s12 m4 offset-m4 card " method="post">
            <?= $this->errors ?>
            <div class="card-content">
                <div class="row">
                    <div class="input-field col s12 ">
                        <input type="text" id="username" name="username" value="<?= isset($this->fields['username']) ? $this->fields['username'] : "" ?>" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="password" id="password" name="password" value="<?= isset($this->fields['password']) ? $this->fields['password'] : "" ?>" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="password" id="confirm_password" name="confirm_password" value="<?= isset($this->fields['confirm_password']) ? $this->fields['confirm_password'] : "" ?>"required>
                        <label for="confirm_password">Confirm password</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="email" id="email" name="email" value="<?= isset($this->fields['email']) ? $this->fields['email'] : "" ?>" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="email" id="confirm_email" name="confirm_email" value="<?= isset($this->fields['confirm_email']) ? $this->fields['confirm_email'] : "" ?>" required>
                        <label for="confirm_email">Confirm email</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="first_name" name="first_name" value="<?= isset($this->fields['first_name']) ? $this->fields['first_name'] : "" ?>" required>
                        <label for="first_name">First name</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="last_name" name="last_name" value="<?= isset($this->fields['last_name']) ? $this->fields['last_name'] : "" ?>" required>
                        <label for="last_name">Last name</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="street" name="street" value="<?= isset($this->fields['street']) ? $this->fields['street'] : "" ?>" required>
                        <label for="street">Street</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="number" id="street_nr" name="street_nr" min="0" value="<?= isset($this->fields['street_nr']) ? $this->fields['street_nr'] : "" ?>" required>
                        <label for="street_nr">Street number</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="zipcode" name="zipcode" value="<?= isset($this->fields['zipcode']) ? $this->fields['zipcode'] : "" ?>" required>
                        <label for="zipcode">Zipcode</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <select name="country" id="country" required>
                            <option value="" disabled selected>Select a country</option>
                            <?php foreach ($this->countries as $country){?>
                                <option value="<?= $country->country_code?>" <?= isset($this->fields['country']) ? ($country->country_code == $this->fields['country']) ? "selected" : "" : ""?> ><?=$country->country_name?></option>
                           <?php } ?>
                        </select>
                        <label for="country">Country</label>
                    </div>

                </div>
                <div class="row">
                    <div class="input=field col s12 center ">
                        <input type="submit" class="btn btn-large blue accent-3" value="Register">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->end(); ?>

