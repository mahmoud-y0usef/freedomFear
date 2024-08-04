<?php
$title = "Home";
$selected = "home";
include 'inc/header.php';
include 'inc/navbar.php';

$events = $db->get_events();
$communitys = $db->get_community();
$slides = $db->get_service();

?>




<div class="page-content">
    <?php
    include 'inc/sidebar.php';
    ?>


    <main class="page-main">

        <?php 
            if(isset($_GET['success'])){
                echo '<div class="uk-alert-success" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . $_GET['success'] . '</p></div>';
            }
        ?>

        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-2-3@l uk-width-3-3@m uk-width-3-3@s">
                <h3 class="uk-text-lead">Recommended Events</h3>
                <div class="js-recommend">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($events as $event): ?>
                                <div class="swiper-slide">
                                    <div class="recommend-slide">
                                        <div class="tour-slide__box">
                                            <a href="<?= $event['url'] ?>"><img
                                                    src="../assets/img/events/<?= $event['img'] ?>"></a>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>


                        </div>
                        <div class="swipper-nav">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-3@l uk-width-3-3@m uk-width-3-3@s">
                <h3 class="uk-text-lead">News Archive</h3>
                <div class="js-trending">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="game-card --horizontal">
                                    <div class="game-card__box">
                                        <div class="game-card__media"><a href="10_game-profile.html"><img
                                                    src="../assets/img/trending2.jpg" alt="Alien Games" /></a>
                                        </div>
                                        <div class="game-card__info"><a class="game-card__title"
                                                href="10_game-profile.html"> Cyber Games</a>
                                            <div class="game-card__genre">Warring factions have brought the
                                                Origin System to the brink of destruction.</div>

                                            <div class="game-card__bottom">
                                                <a class="uk-button-read-more" href="16_post.html">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="game-card --horizontal">
                                    <div class="game-card__box">
                                        <div class="game-card__media"><a href="10_game-profile.html"><img
                                                    src="../assets/img/trending3.jpg" alt="Warframe" /></a></div>
                                        <div class="game-card__info"><a class="game-card__title"
                                                href="10_game-profile.html">Game of Thrones</a>
                                            <div class="game-card__genre">Warring factions have brought the
                                                Origin System to the brink of destruction.</div>
                                            <div class="game-card__bottom">
                                                <a class="uk-button-read-more" href="16_post.html">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="game-card --horizontal">
                                    <div class="game-card__box">
                                        <div class="game-card__media"><a href="10_game-profile.html"><img
                                                    src="../assets/img/trending.jpg" alt="Warframe" /></a></div>
                                        <div class="game-card__info"><a class="game-card__title"
                                                href="10_game-profile.html"> Historical Games</a>
                                            <div class="game-card__genre">Warring factions have brought the
                                                Origin System to the brink of destruction.</div>
                                            <div class="game-card__bottom">
                                                <a class="uk-button-read-more" href="16_post.html">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="swipper-nav">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-1">
                <h3 class="uk-text-lead">Our Communities</h3>
                <div class="js-popular">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($communitys as $community): ?>
                                <div class="swiper-slide">
                                    <div class="fl-gp-box">
                                        <div class="fl-cover-image">
                                            <img alt="group" src="../assets/img/communities/<?= $community['img'] ?>">
                                            <div class="fl-gp-info-wrap">
                                                <div class="fl-gp-info">
                                                    <div class="fl-gp-title"><a href="<?= $community['url'] ?>"
                                                            class="bp-gp-home-link season-of-the-witch-home-link"><?= $community['name'] ?></a>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="fl-gp-footer">


                                            <div class="fl-gp-action">
                                                <div class="fl-gp-button">
                                                    <a class="fl-gp-button fl-join-group" rel="join"
                                                        href="<?= $community['url'] ?>"><i
                                                            class="gg-icon gg-log-in"></i>join</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>



                        </div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="uk-width-5-5">
                <div class="js-popular2" style="display: flex; justify-content: center;">
                    <div class="rectangle_popular-ac" style="display: flex; justify-content: center;width: 300px;">
                        <a class="uk-button  uk-button-theme-color uk-width-5-5 uk-margin-small-bottom ">Download
                            Now</a>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-1">
                <h3 class="uk-text-lead">Our Store</h3>
                <div class="js-store">
                    <div class="swiper">
                        <div class="swiper-wrapper">



                            <div class="swiper-slide">
                                <div class="game-card">
                                    <div class="game-card__box">
                                        <div class="game-card__media"><a href="10_game-profile.html"><img
                                                    src="../assets/img/game-1.jpg" alt="Struggle of Rivalry" /></a>
                                        </div>
                                        <div class="game-card__info"><a class="game-card__title"
                                                href="10_game-profile.html">t-shirt</a>
                                            <div class="game-card__genre">Clothes</div>
                                            <div class="game-card__rating-and-price">

                                                <div class="game-card__price"><span>$4.99 </span></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="swiper-slide">
                                <div class="game-card">
                                    <div class="game-card__box">
                                        <div class="game-card__media"><a href="10_game-profile.html"><img
                                                    src="../assets/img/game-1.jpg" alt="Struggle of Rivalry" /></a>
                                        </div>
                                        <div class="game-card__info"><a class="game-card__title"
                                                href="10_game-profile.html">Pistol</a>
                                            <div class="game-card__genre">Weapones</div>
                                            <div class="game-card__rating-and-price">

                                                <div class="game-card__price"><span>$4.99 </span></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>




            </div>
            <main class="sl_main">
                <div id="slider">

                    <div class="slider-inner">

                    </div>
                    <?php foreach ($slides as $slide): ?>
                        <img class="img_loaded" style="width: fit-content; height: 80%;"
                            src="../assets/img/slide/<?= $slide['img'] ?>" />
                    <?php endforeach; ?>
                    <div id="pagination">
                        <button class="active" data-slide="0"></button>
                        <button data-slide="1"></button>
                        <button data-slide="2"></button>
                        <button data-slide="3"></button>
                    </div>

                </div>
            </main>

            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-40525870-5"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag() { dataLayer.push(arguments); }
                gtag('js', new Date());

                gtag('config', 'UA-40525870-5');
            </script>

    </main>




</div>
</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>
</body>


</html>