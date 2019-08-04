<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <span class="black-text">Logo</span>
            <div class="divider"></div>
        </div>
    </li>
    <li>
        <a><i class="material-icons">Person</i>User list</a>
        <a><i class="material-icons">chevron_right</i>Link 2</a>
        <a><i class="material-icons">chevron_right</i>Link 3</a>
        <a><i class="material-icons">chevron_right</i>Link 4</a>
    </li>
    <li>
        <div class="divider"></div>
    </li>
    <?php if (UserModel::currentLoggedInUser()) { ?>
        <li><a href="<?= PROOT ?>user/logout"><i class="material-icons">backspace</i>Logout</a></li>
        <li><a href="#!"><i class="material-icons">contact_mail</i>Inbox</a></li>
        <li><a href="<?= PROOT ?>user/profile" class=""><i class="material-icons">person</i>My Profile</a>
        </li>
    <?php } else { ?>
        <li><a href="<?= PROOT ?>user/registration"><i class="material-icons">add</i>Create an account</a></li>
        <li><a href="<?= PROOT ?>user/login" class=""><i class="material-icons">person</i>Login</a></li>
    <?php } ?>
</ul>
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
