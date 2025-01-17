<?php
$title = "Streams";
$selected = "streams";
include 'inc/header.php';
include 'inc/navbar.php';

$lang = $db->get_type_lang_stream();

$streams = $db->get_streams();

?>




<div class="page-content">
    <?php
    include 'inc/sidebar.php';
    ?>


    <main class="page-main">
    <?php
        if (isset($_GET['success'])) {
            echo '<div class="uk-alert-success" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . filter_var($_GET['success'] , FILTER_SANITIZE_SPECIAL_CHARS) . '</p></div>';
        } else if (isset($_GET['error'])) {
            echo '<div class="uk-alert-danger" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . filter_var($_GET['error'] , FILTER_SANITIZE_SPECIAL_CHARS) . '</p></div>';
        }
        ?>
        <div class="uk-page-heading uk-height-medium uk-height-max-medium uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-background-cover uk-light"
            data-src="#" uk-img uk-parallax="bgy: -70">
            <div class="fl-hd-cover">
                <span class="decore-lt"></span>
                <span class="decore-lb"></span>
                <span class="decore-rt"></span>
                <span class="decore-rb"></span>
            </div>
            <h1 class="uk-page-heading-h" data-translate-key="ourstreams">Our Streams</h1>
        </div>

        <!-- add stream button -->
        <div class="uk-container uk-margin-top uk-margin-bottom" style="width:200px"> 
            <a href="ads.php" class="uk-button uk-button-primary" data-translate-key="addstream">Add Stream</a>
        </div>
        <div data-uk-filter="target: .js-filter">
            <div class="fl-subnav">
                <ul class=" uk-subnav uk-subnav-pill">
                    <li class="uk-active" data-uk-filter-control><a href="#" data-translate-key="all">All</a></li>
                    <?php foreach ($lang as $l): ?>
                        <li data-uk-filter-control="[data-type='<?php echo $l['name']; ?>']"><a
                                href="#" data-translate-key="<?php echo $l['name']; ?>"><?php echo $l['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <ul class="js-filter uk-grid-small uk-child-width-1-1 uk-child-width-1-5@xl uk-child-width-1-4@l uk-child-width-1-3@m uk-child-width-1-2@s"
                data-uk-grid>


                <?php foreach ($streams as $stream): ?>
                    <?php
                    foreach ($lang as $l) {
                        if ($l['id'] == $stream['lang']) {
                            $stream['lang'] = $l['name'];
                        }
                    }
                    ?>
                    <li data-type="<?php echo $stream['lang']; ?>">
                        <div class="stream-item">
                            <div class="stream-item__box">
                                <div class="stream-item__media" data-uk-lightbox="video-autoplay: true"><a
                                        href="<?php echo $stream['embed']; ?>" data-attrs="width: 1280; height: 720;"
                                        data-caption="<?php echo $stream['address']; ?>"><img
                                            src="../assets/img/streams/<?php echo $stream['img']; ?>"
                                            alt="<?php echo $stream['address']; ?>" /></a>

                                </div>
                                <div class="stream-item__body">
                                    <div class="stream-item__title"><?php echo $stream['address']; ?></div>
                                    <div class="stream-item__nicname"><?php echo $stream['name']; ?></div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </main>




</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>

</body>


</html>