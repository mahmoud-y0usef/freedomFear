<?php 
require_once 'DB.php';

// Sanitize the search input to prevent SQL injection
$search = htmlspecialchars($_POST['search'], ENT_QUOTES, 'UTF-8');

$db = new DB();
$blogs = $db->search_blog($search);

if (!empty($blogs)) {
    foreach ($blogs as $blog) {
        // Use proper concatenation for the variables in the echo statement
        echo '<li><a href="news.php?blog=' . htmlspecialchars($blog['id'], ENT_QUOTES, 'UTF-8') . '">'
            . htmlspecialchars($blog['address'], ENT_QUOTES, 'UTF-8') . '</a></li>';
    }
} else {
    echo '<li data-translate-key="noblogsfound">No blogs found.</li>';
}
?>
