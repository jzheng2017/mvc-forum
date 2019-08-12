<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <span class="black-text">Logo</span>
            <div class="divider"></div>
        </div>
    </li>
    <li>
        <a href="<?=PROOT?>stats/users"><i class="material-icons">person</i>User list</a>
        <a href="<?=PROOT?>stats/posts"><i class="material-icons">comment</i>Recent posts</a>
        <a href="<?=PROOT?>search"><i class="material-icons">search</i>Search</a>
        <a href="<?=PROOT?>games"><i class="material-icons">videogame_asset</i>Games</a>
        <a href="<?=PROOT?>ranks"><i class="material-icons">trending_up</i>Rankings</a>
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
