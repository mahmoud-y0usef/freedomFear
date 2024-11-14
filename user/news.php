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
            <!-- Sidebar -->
            <aside class="uk-width-1-4">
                <div class="uk-card uk-card-default uk-card-body">
                    <h3 class="uk-card-title">Categories</h3>
                    <ul class="uk-nav uk-nav-default">
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="news.php?category=<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="uk-width-expand">
                <?php if (isset($blog)): ?>
                    <!-- Blog Details -->
                    <div class="uk-card uk-card-default uk-card-body">
                        <h1 class="uk-card-title"><?php echo htmlspecialchars($blog['address'], ENT_QUOTES, 'UTF-8'); ?></h1>
                        <p><strong>Published on:</strong> <?php echo htmlspecialchars($blog['created_at'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <img src="../assets/img/blogs/<?php echo htmlspecialchars($blog['image'], ENT_QUOTES, 'UTF-8'); ?>"
                             alt="<?php echo htmlspecialchars($blog['address'], ENT_QUOTES, 'UTF-8'); ?>"
                             class="uk-border-rounded" style="width: 100%; height: auto;">
                        <p><?php echo htmlspecialchars($blog['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php else: ?>
                    <div class="uk-grid uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m" data-uk-grid>
                        <?php if (isset($_GET['category'])): ?>
                            <!-- Filtered by Category -->
                            <?php if (!empty($blog_category)): ?>
                                <?php foreach ($blog_category as $blog): ?>
                                    <div>
                                        <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                                            <img src="../assets/img/blogs/<?php echo htmlspecialchars($blog['image'], ENT_QUOTES, 'UTF-8'); ?>"
                                                 alt="<?php echo htmlspecialchars($blog['address'], ENT_QUOTES, 'UTF-8'); ?>"
                                                 class="uk-border-rounded" style="width: 100%; height: auto;">
                                            <h3 class="uk-card-title">
                                                <?php echo htmlspecialchars($blog['address'], ENT_QUOTES, 'UTF-8'); ?>
                                            </h3>
                                            <p>
                                                <?php echo htmlspecialchars(mb_strimwidth($blog['short_description'], 0, 100, "..."), ENT_QUOTES, 'UTF-8'); ?>
                                            </p>
                                            <a href="news.php?blog=<?php echo htmlspecialchars($blog['id'], ENT_QUOTES, 'UTF-8'); ?>"
                                               class="uk-button uk-button-text">Read More</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div>
                                    <center>
                                        <h3>No blogs available for this category.</h3>
                                    </center>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <!-- Default Blog List -->
                            <?php if (!empty($news)): ?>
                                <?php foreach ($news as $blog): ?>
                                    <div>
                                        <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                                            <img src="../assets/img/blogs/<?php echo htmlspecialchars($blog['image'], ENT_QUOTES, 'UTF-8'); ?>"
                                                 alt="<?php echo htmlspecialchars($blog['address'], ENT_QUOTES, 'UTF-8'); ?>"
                                                 class="uk-border-rounded" style="width: 100%; height: auto;">
                                            <h3 class="uk-card-title">
                                                <?php echo htmlspecialchars($blog['address'], ENT_QUOTES, 'UTF-8'); ?>
                                            </h3>
                                            <p>
                                                <?php echo htmlspecialchars(mb_strimwidth($blog['short_description'], 0, 100, "..."), ENT_QUOTES, 'UTF-8'); ?>
                                            </p>
                                            <a href="news.php?blog=<?php echo htmlspecialchars($blog['id'], ENT_QUOTES, 'UTF-8'); ?>"
                                               class="uk-button uk-button-text">Read More</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div>
                                    <center>
                                        <h3>No blogs available </h3>
                                    </center>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </main>
</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>

</body>
</html>
