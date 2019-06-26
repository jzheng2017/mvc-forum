<nav class="indigo darken-3">
    <div class="container">
        <div class="nav-wrapper">
            <div>
                <a href="<?= PROOT ?>" class="brand-logo">
                    Logo
                </a>
                <ul class="right hide-on-med-and-down">
                    <?php if (UserModel::currentLoggedInUser()) { ?>
                        <li><a href="<?= PROOT ?>user/logout">Logout</a></li>
                        <li><a href="<?= PROOT ?>user/inbox"><span>Inbox</span><?= $this->inbox ? '<span class="badge white-text">'.$this->inbox.'</span>' : "" ?></a></li>
                        <li><a href="<?= PROOT ?>user/profile" class="btn blue accent-4 waves-effect">My
                                Profile</a>
                        </li>
                    <?php } else { ?>
                        <li><a href="<?= PROOT ?>user/registration">Create an account</a></li>
                        <li><a href="<?= PROOT ?>user/login" class="btn blue accent-4 waves-effect">Login</a></li>
                    <?php } ?>
                </ul>
                <?= View::renderComponent(new SidenavComponent('sidenav')) ?>
            </div>
        </div>
    </div>
</nav>
