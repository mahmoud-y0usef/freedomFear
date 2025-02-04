<?php
$title = "admin";
$selected = "admins";
include 'inc/header.php';
include 'inc/navbar.php';

$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Current page
$totalUsers = $db->get_total_admin(); // Total users
$totalPages = ceil($totalUsers / $limit); // Total pages
$users = $db->get_admin($page, $limit); // Fetch paginated users

?>

<div class="page-content">
    <?php
    include 'inc/sidebar.php';
    ?>

    <main class="page-main">
        <?php
        if (isset($_GET['success'])) {
            echo '<div class="uk-alert-success" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . filter_var($_GET['success'], FILTER_SANITIZE_SPECIAL_CHARS) . '</p></div>';
        }

        if (isset($_GET['error'])) {
            echo '<div class="uk-alert-danger" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . filter_var($_GET['error'], FILTER_SANITIZE_SPECIAL_CHARS) . '</p></div>';
        }
        ?>

        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-1">
                <!-- search -->
                <div class="uk-margin">
                    <div class="search__input"><i class="ico_search"></i><input type="search" name="search"
                            placeholder="Search">
                    </div>
                    <button class="uk-button uk-button-primary" style="width:200px;"
                        data-uk-toggle="target: #addUserModal" data-translate-key="add_admin">Add Admin</button>

                </div>

                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                    <h3 class="uk-panel-title" data-translate-key="admins">Admins</h3>
                    <table class="uk-table uk-table">
                        <thead>
                            <tr>
                                <th data-translate-key="username">Username</th>
                                <th data-translate-key="email">Email</th>
                                <th data-translate-key="actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <?php foreach ($users as $user): ?>
                                <tr data-id="<?= $user['id'] ?>">
                                    <td><?= htmlspecialchars($user['name']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td>
                                        <button style="display: inline;width: 40px;"
                                            class="uk-button uk-button-primary editUserButton"
                                            data-id="<?= $user['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button style="display: inline;width: 40px;"
                                            class="uk-button uk-button-danger deleteUserButton"
                                            data-id="<?= $user['id'] ?>"><i class="fa-solid fa-delete-left"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="paginationControls" class="uk-margin-top">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>"
                        class="uk-button <?= $i == $page ? 'uk-button-primary' : 'uk-button-default' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </main>
    <div class="page-modals">
        <?php include 'inc/modals.php'; ?>
    </div>
    </body>
</div>



<!-- Modals -->

<!-- add admin -->
<div id="addUserModal" class="uk-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 data-translate-key="add_admin">Add Admin</h2>
        <form id="addUserForm">
            <div class="uk-margin">
                <input class="uk-input" type="text" name="name" data-translate-key="username" placeholder="Username"
                    required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="email" name="email" data-translate-key="email" placeholder="Email"
                    required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="password" name="password" data-translate-key="password"
                    placeholder="Password" required>
            </div>
            <button type="submit" class="uk-button uk-button-primary" data-translate-key="add">Add</button>
        </form>
    </div>
</div>

<div id="editUserModal" class="uk-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 data-translate-key="edit_admin">Edit Admin</h2>
        <form id="editUserForm">
            <input type="hidden" name="id">
            <div class="uk-margin">
                <input class="uk-input" type="text" name="name" data-translate-key="username" placeholder="Username"
                    required>
            </div>

            <div class="uk-margin">
                <input class="uk-input" type="email" name="email" data-translate-key="email" placeholder="Email"
                    required>
            </div>

            <button type="submit" class="uk-button uk-button-primary" data-translate-key="update">Save</button>
        </form>
    </div>
</div>

<div id="detailsUserModal" class="uk-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 data-translate-key="admin_details">Admin Details</h2>
        <div id="userDetails">


        </div>

    </div>
</div>

<!-- JavaScript for AJAX -->
<script>
    $(document).ready(function () {

        // Edit user
        $('.editUserButton').click(function () {
            const id = $(this).data('id');
            $.post('get_admin_details.php', { id }, function (data) {
                const user = JSON.parse(data);
                const modal = UIkit.modal('#editUserModal');
                modal.show();
                $('#editUserForm [name="id"]').val(user.id);
                $('#editUserForm [name="name"]').val(user.name);
                $('#editUserForm [name="email"]').val(user.email);
            });
        });

        $('#editUserForm').submit(function (e) {
            e.preventDefault();
            $.post('edit_admin.php', $(this).serialize(), function (response) {

                location.reload();

            });
        });

        // Delete user
        $('.deleteUserButton').click(function () {
            if (confirm('Are you sure you want to delete this admin?')) {
                const id = $(this).data('id');
                $.post('delete_admin.php', { id }, function (response) {
                    location.reload(); // Reload to update table
                });
            }
        });

        // add user
        $('#addUserForm').submit(function (e) {
            e.preventDefault();
            $.post('add_admin.php', $(this).serialize(), function (response) {
                location.reload();
            });
        });


        // search real time
        $('.search__input input').on('input', function () {
            const search = $(this).val();
            $.get('../function/search_admin.php', { search }, function (data) {
                $('#userTableBody').html(data);
            });
        });

    });
</script>