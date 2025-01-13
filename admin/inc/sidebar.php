<aside class="sidebar" id="sidebar">
    <div class="sidebar-hider">
        <i class="icon-arrow-left"></i>
        <i class="icon-arrow-right"></i>
    </div>

    <div class="sidebar-box">
        <ul class="uk-nav">
            <li class="<?= $selected == 'home' ? "uk-active" : '' ?>"><a href="../admin/"><i class="ico_home"></i><span data-translate-key="home">Home</span></a></li>

            <li class="uk-nav-header"><i class="uk-nav-devider"></i><span data-translate-key="main">Main</span></li>
            <li class="<?= $selected == 'news' ? "uk-active" : '' ?>"><a href="news.php"><i class="icon-feed"></i><span data-translate-key="news">News</span></a></li>
            <li class="<?= $selected == 'streams' ? "uk-active" : '' ?>"><a href="streams.php"><i class="ico_streams"></i><span data-translate-key="streams">Streams</span></a></li>
            <li class="uk-nav-header"><i class="uk-nav-devider"></i><span data-translate-key="admin_dashboard">Admin</span></li>
            <li class="<?= $selected == 'users' ? "uk-active" : '' ?>"><a href="users.php"><i class="icon-user"></i><span data-translate-key="users">Users</span></a></li>
            <li class="<?= $selected == 'admins' ? "uk-active" : '' ?>"><a href="admins.php"><i class="icon-user"></i><span data-translate-key="admins">Admins</span></a></li>
            <li class="<?= $selected == 'blogs' ? "uk-active" : '' ?>"><a href="blogs.php"><i class="icon-feed"></i><span data-translate-key="blogs">Blogs</span></a></li>
            <li class="<?= $selected == 'charges' ? "uk-active" : '' ?>"><a href="charges.php"><i class="icon-ico fa-solid fa-bolt"></i><span data-translate-key="charges">Sharges</span></a></li>
            <li class="<?= $selected == 'communities' ? "uk-active" : '' ?>"><a href="communities.php"><i class="icon-ico fa-solid fa-satellite-dish"></i><span data-translate-key="communities">Communities</span></a></li>
            <li class="<?= $selected == 'events' ? "uk-active" : '' ?>"><a href="events.php"><i class="icon-ico fa-regular fa-calendar-days"></i><span data-translate-key="events">Events</span></a></li>
            
        </ul>
    </div>
</aside>