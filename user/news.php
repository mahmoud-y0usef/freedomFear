<?php
$title = "News";
$selected = "news";
include 'inc/header.php';
include 'inc/navbar.php';

$news = $db->get_all_blogs();
$categories = $db->get_all_category_blog();

// Handle category or blog details
if (isset($_GET['blog'])) {
    $blog = $db->get_blog_by_id(htmlspecialchars($_GET['blog'], ENT_QUOTES, 'UTF-8'));
} elseif (isset($_GET['category'])) {
    $blog_category = $db->get_blog_by_category(htmlspecialchars($_GET['category'], ENT_QUOTES, 'UTF-8'));
}
?>

<div class="page-content">
    <?php include 'inc/sidebar.php'; ?>
    <main class="page-main">

        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-3-4@l uk-width-3-5@m">

                <div class="uk-grid uk-grid-medium uk-child-width-1-2@l uk-child-width-2-2@m uk-child-width-1-1@s"
                    uk-grid="masonry: true">

                    <?php if (isset($blog)): ?>
                        <style>
                            .uk-child-width-1-2\@l>* {
                                width: 100%;
                            }
                        </style>
                        <section width="100%" class="b-post b-post-full b-post-single clearfix">
                            <div class="entry-media">
                                <img class="img-fluid" src="../assets/img/blogs/<?= $blog['image']?>" alt="Foto">
                                <div class="entry-meta">
                                    <span class="entry-meta__item">
                                        <a class="entry-meta__link" href="blog-main.html">
                                            <img class="fl-post-avatar" width="100" height="100" alt="Profile Photo"
                                                src="../assets/img/blogs/<?= $blog['image']?>">
                                        </a>
                                    </span>
                                    <span class="entry-meta__item"><?= $blog['created_at']?></span>


                                </div>

                            </div>
                            <div class="entry-main">
                                <div class="entry-content">


                                    <h1 class="entry-title"><a href="#"><?= $blog['address']?></a></h1>
                                    <p><?= $blog['description']?></p>



                                    <blockquote cite="#">
                                        <p class="uk-margin-small-bottom"><?= $blog['short_description']?></p>
                                        <footer>Freedom Fear</footer>
                                    </blockquote>



                                   




                                </div>

                            </div>
                        </section>


                    <?php elseif (isset($blog_category)): ?>
                        <?php if (empty($blog_category)): ?>
                            <div class="uk-alert uk-alert-warning" uk-alert>
                                <a class="uk-alert-close" uk-close></a>
                                <p>No news available</p>
                            </div>
                        <?php endif; ?>
                        <?php foreach ($blog_category as $blog): ?>
                            <section class="b-post b-post-full b-post-cover  clearfix">
                                <div class="entry-media">
                                    <span class="decore-lt"></span>
                                    <span class="decore-rt"></span>
                                    <span class="decore-rb"></span>
                                    <a href="news.php?blog=<?php echo $blog['id']; ?>"><img class="img-fluid"
                                            src="../assets/img/blogs/<?php echo $blog['image']; ?>" alt="Foto"></a>
                                    <div class="entry-meta">
                                        <h1 class="entry-title"> <a
                                                href="news.php?blog=<?php echo $blog['id']; ?>"><?php echo $blog['address']; ?></a>
                                        </h1>

                                        <span
                                            class="entry-meta__item"><?php echo date('F j, Y', strtotime($blog['created_at'])); ?></span>
                                    </div>

                                </div>
                            </section>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <?php if (empty($news)): ?>
                            <div class="uk-alert uk-alert-warning" uk-alert>
                                <a class="uk-alert-close" uk-close></a>
                                <p>No news available</p>
                            </div>
                        <?php endif; ?>
                        <?php foreach ($news as $blog): ?>
                            <section class="b-post b-post-full b-post-cover  clearfix">
                                <div class="entry-media">
                                    <span class="decore-lt"></span>
                                    <span class="decore-rt"></span>
                                    <span class="decore-rb"></span>
                                    <a href="news.php?blog=<?php echo $blog['id']; ?>"><img class="img-fluid"
                                            src="../assets/img/blogs/<?php echo $blog['image']; ?>" alt="Foto"></a>
                                    <div class="entry-meta">
                                        <h1 class="entry-title"> <a
                                                href="news.php?blog=<?php echo $blog['id']; ?>"><?php echo $blog['address']; ?></a>
                                        </h1>

                                        <span
                                            class="entry-meta__item"><?php echo date('F j, Y', strtotime($blog['created_at'])); ?></span>
                                    </div>

                                </div>
                            </section>
                        <?php endforeach; ?>
                    <?php endif; ?>


                </div>


            </div>

            <div class="uk-width-1-4@l uk-width-2-5@m">

                <aside class="l-sidebar">

                    <!-- end .widget-->
                    <section class="widget section-sidebar bg-light">
                        <h3 class="widget-title bg-dark">categories</h3>
                        <div class="widget-content">
                            <div class="widget-inner">
                                <ul class="widget-list list list-mark-4">



                                    <?php foreach ($categories as $category): ?>
                                        <li class="widget-list__item"><a class="widget-list__link"
                                                href="news.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </section>

                </aside>
            </div>

        </div>

    </main>
</div>
</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>

</body>

</html>