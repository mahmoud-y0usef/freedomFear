<aside class="sidebar" id="sidebar">
    <div class="sidebar-hider">
        <i class="icon-arrow-left"></i>
        <i class="icon-arrow-right"></i>
    </div>

    <div class="sidebar-box">
        <ul class="uk-nav">
            <li class="<?= $selected == 'home' ? "uk-active" : '' ?>"><a href="../user/"><i class="ico_home"></i><span data-translate-key="home">Home</span></a></li>

            <li class="uk-nav-header"><i class="uk-nav-devider"></i><span data-translate-key="main">Main</span></li>
            <li class="<?= $selected == 'news' ? "uk-active" : '' ?>"><a href="news.php"><i class="icon-feed"></i><span data-translate-key="news">News</span></a></li>
            <li class="<?= $selected == 'wallet' ? "uk-active" : '' ?>"><a href="wallet.php"><i class="icon-wallet"></i><span data-translate-key="wallet">Wallet</span></a></li>
            <li class="<?= $selected == 'streams' ? "uk-active" : '' ?>"><a href="streams.php"><i class="ico_streams"></i><span data-translate-key="streams">Streams</span></a></li>
            <li class="uk-nav-header"><i class="uk-nav-devider"></i><span data-translate-key="support">Support</span></li>
            <li><a href="#modal-report" data-uk-toggle><i class="ico_report"></i><span data-translate-key="report">Report</span></a>
            </li>
            <li><a href="#modal-help" data-uk-toggle><i class="ico_help"></i><span data-translate-key="help">Help</span></a></li>
        </ul>
    </div>
</aside>