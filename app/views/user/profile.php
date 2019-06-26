<?php $this->start('head') ?>
<link rel="stylesheet" href="<?= PROOT ?>css/profile.css" media="screen" title="no title" charset="utf-8">
<?php $this->end() ?>
<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <h1>Profile</h1>
        <div class="col s12 m4 l4">
            <img class="responsive-img" src="https://dummyimage.com/600x400/000/fff.jpg">
            <div class="hide-on-small-and-down profile-buttons">
                <?php if ($this->model->id != UserModel::currentLoggedInUser()->id) { ?>
                    <a href="<?= PROOT ?>user/mail/<?= $this->model->id ?>" class="btn blue accent-3">Send
                        message</a>
                    <a href="<?= PROOT ?>user/report/<?= $this->model->id ?>" class="btn blue accent-3">Report user</a>
                <?php } ?>
            </div>
        </div>
        <div class="col s12 m8 l8">
            <h4 class="">User info</h4>
            <div class="divider"></div>
            <table>
                <tbody>
                <tr>
                    <td>Username</td>
                    <td><?= $this->model->username ?></td>
                </tr>
                <tr>
                    <td>First name</td>
                    <td><?= $this->model->first_name ?></td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td><?= $this->model->last_name ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= $this->model->email ?></td>
                </tr>
                <tr>
                    <td>Street</td>
                    <td><?= $this->model->street ?></td>
                </tr>
                <tr>
                    <td>Street Number</td>
                    <td><?= $this->model->street_nr ?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td><?= $this->model->zipcode ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?= $this->model->country ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col s12 hide-on-med-and-up profile-buttons">
            <div class="row">
                <?php if ($this->model->id != UserModel::currentLoggedInUser()->id) { ?>
                    <div class="col s6">
                        <a href="<?= PROOT ?>user/mail/<?= $this->model->id ?>" class="btn blue accent-3">Send
                            message</a>
                    </div>
                    <div class="col s6">
                        <a href="<?= PROOT ?>user/report/<?= $this->model->id ?>" class="btn blue accent-3">Report
                            user</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
<?php $this->end() ?>
