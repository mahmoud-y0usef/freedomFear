<div class="page-wrapper">
        <header class="page-header">
            <div class="page-header__inner">
                <div class="page-header__sidebar">

                    <div class="page-header__menu-btn">

                        <button
                            class="menu-mobile-button visible-xs-block js-toggle-mobile-slidebar toggle-menu-button menu-btn">
                            <span class="toggle-menu-button-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                    <div class="page-header__logo"><img src="../assets/img/logo.png" alt="logo"><span
                            class="page-header__logo_text">Freedom Fear</span></div>
                </div>
                <div class="page-header__content">
                    <div class="page-header__search">
                        <div class="search">
                            <!-- <div class="search__input"><i class="ico_search"></i><input type="search" name="search" placeholder="Search"></div>
                                <div class="search__btn"><button type="button"><i class="ico_microphone"></i></button></div> -->

                        </div>
                    </div>
                    <div class="page-header__action">

                        <ul class="uk-subnav uk-nav-lang  uk-subnav-pill" uk-margin>

                            <li>
                                <a href="#">
                                    <img src="../assets/img/flags/united-kingdom.png" alt="profile" class="profile">
                                    English
                                    <span uk-icon="icon: triangle-down"></span>

                                </a>
                                <div uk-dropdown="mode: hover">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li><a href="#"> <img src="../assets/img/flags/arabic.png" alt="profile"
                                                    class="profile">Arabic</a></li>
                                        <li><a href="#"> <img src="../assets/img/flags/germany.png" alt="profile"
                                                    class="profile">Germany</a></li>
                                        <li><a href="#"> <img src="../assets/img/flags/china.png" alt="profile"
                                                    class="profile">China</a></li>
                                        <li><a href="#"> <img src="../assets/img/flags/India.png" alt="profile"
                                                    class="profile">India</a></li>
                                        <li><a href="#"> <img src="../assets/img/flags/french.png" alt="profile"
                                                    class="profile">French</a></li>

                                    </ul>
                                </div>
                            </li>
                        </ul>



                        <a class="action-btn" href="06_chats.html"><i class="ico_message"></i><span
                                class="animation-ripple-delay1"></span></a>
                        <a class="action-btn" href="07_friends.html"><i class="ico_notification"></i><span
                                class="animation-ripple-delay2"></span></a>

                        <ul class="uk-subnav uk-subnav-pill" uk-margin>

                            <li>
                                <a href="#">
                                    <img src="../assets/img/profile.png" alt="profile" class="profile">
                                    Hi, <?php echo $_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']?>
                                    <span uk-icon="icon: triangle-down"></span></a>
                                <div uk-dropdown="mode: click">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li><a href="#">My account</a></li>
                                        <li><a href="#">My Password</a></li>
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="function/logout.php">Log Out</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>