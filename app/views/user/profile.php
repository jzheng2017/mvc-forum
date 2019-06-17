<?php $this->start('head') ?>
<link rel="stylesheet" href="<?= PROOT ?>css/profile.css" media="screen" title="no title" charset="utf-8">
<?php $this->end() ?>
<?php $this->start('body') ?>
<div class="container">
    <?php if (UserModel::currentLoggedInUser()) { ?>
        <div class="row">
            <h1>Profile</h1>
            <div class="col s12 m4 l4">
                <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
            </div>
            <div class="col s12 m8 l8">
                <h4 class="">User info</h4>
                <div class="divider"></div>
                <table>

                    <tbody>
                    <tr>
                        <td>Username</td>
                        <td><?= UserModel::currentLoggedInUser()->username ?></td>
                    </tr>
                    <tr>
                        <td>First name</td>
                        <td><?= UserModel::currentLoggedInUser()->first_name ?></td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td><?= UserModel::currentLoggedInUser()->last_name ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= UserModel::currentLoggedInUser()->email ?></td>
                    </tr>
                    <tr>
                        <td>Street</td>
                        <td><?= UserModel::currentLoggedInUser()->street ?></td>
                    </tr>
                    <tr>
                        <td>Street Number</td>
                        <td><?= UserModel::currentLoggedInUser()->street_nr ?></td>
                    </tr>
                    <tr>
                        <td>Zipcode</td>
                        <td><?= UserModel::currentLoggedInUser()->zipcode ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?= UserModel::currentLoggedInUser()->country ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col s12">
                <h1>Access denied</h1>
                <p>You don't have access to this page. You're not logged in.</p>
                <a href="<?= PROOT ?>user/login" class="btn blue accent-4 waves-effect">Click here to login</a>
            </div>
        </div>
    <?php } ?>
</div>
<?php $this->end() ?>
