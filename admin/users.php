<?php
$title = "users";
$selected = "users";
include 'inc/header.php';
include 'inc/navbar.php';

$limit = 10; 
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Current page
$totalUsers = $db->get_total_users(); // Total users
$totalPages = ceil($totalUsers / $limit); // Total pages
$users = $db->get_users($page, $limit); // Fetch paginated users

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
                    <div  class="search__input"><i class="ico_search"></i><input type="search" name="search"
                            placeholder="Search"></div>
                </div>

                <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                    <h3 class="uk-panel-title">Users</h3>
                    <table class="uk-table uk-table">
                        <thead>
                        <tr>
                                <th data-translate-key="username">Username</th>
                                <th data-translate-key="nickname">Nickname</th>
                                <th data-translate-key="email">Email</th>
                                <th data-translate-key="ip">IP</th>
                                <th data-translate-key="active">Active</th>
                                <th data-translate-key="actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody  id="userTableBody">
                            <?php foreach ($users as $user): ?>
                                <tr data-id="<?= $user['id'] ?>">
                                    <td><?= htmlspecialchars($user['name']) ?></td>
                                    <td><?= htmlspecialchars($user['nick']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td><?= htmlspecialchars($user['ip']) ?></td>
                                    <td><?= $user['active'] == 1 ? "Activated" : "Not" ?></td>
                                    <td>
                                        <button style="display: inline;width: 40px;" class="uk-button uk-button-primary editUserButton"
                                            data-id="<?= $user['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button style="display: inline;width: 40px;" class="uk-button uk-button-danger deleteUserButton"
                                            data-id="<?= $user['id'] ?>"><i class="fa-solid fa-delete-left"></i></button>
                                        <button style="display: inline;width: 40px;" class="uk-button uk-button detailsUserButton"
                                            data-id="<?= $user['id'] ?>"><i class="fa-solid fa-circle-info"></i></button>
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

<div id="editUserModal" class="uk-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 data-translate-key="edit_user">Edit User</h2>
        <form id="editUserForm">
            <input type="hidden" name="id">
            <div class="uk-margin">
                <input class="uk-input" type="text" name="name" data-translate-key="username" placeholder="Username" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nick" data-translate-key="nickname" placeholder="Nickname" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="email" name="email" data-translate-key="email" placeholder="Email" required>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="active" required>
                    <option value="1">Activated</option>
                    <option value="0">Not Activated</option>
                </select>
            </div>
            <button type="submit" class="uk-button uk-button-primary" data-translate-key="update">Save</button>
        </form>
    </div>
</div>

<div id="detailsUserModal" class="uk-modal" data-uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 data-translate-key="user_details">User Details</h2>
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
            $.post('../function/get_user.php', { id }, function (data) {
                const user = JSON.parse(data);
                const modal = UIkit.modal('#editUserModal');
                modal.show();
                $('#editUserForm [name="id"]').val(user.id);
                $('#editUserForm [name="name"]').val(user.name);
                $('#editUserForm [name="nick"]').val(user.nick);
                $('#editUserForm [name="email"]').val(user.email);
                $('#editUserForm [name="active"]').val(user.active);
            });
        });

        $('#editUserForm').submit(function (e) {
            e.preventDefault();
            $.post('edit_user.php', $(this).serialize(), function (response) {
                
                    location.reload();
                
            });
        });

        // Delete user
        $('.deleteUserButton').click(function () {
            if (confirm('Are you sure you want to delete this user?')) {
                const id = $(this).data('id');
                $.post('delete_user.php', { id }, function (response) {
                    location.reload(); // Reload to update table
                });
            }
        });

        // Show user details
        $('.detailsUserButton').click(function () {
            const id = $(this).data('id');

            // Ensure the ID is valid before proceeding
            if (!id) {
                alert('User ID is missing.');
                return;
            }

            // Fetch user details via AJAX
            $.post('get_user_details.php', { id: id }, function (data) {
                try {
                    // Parse the response to ensure it's a valid JSON
                    const user = JSON.parse(data);

                    // Check if user data exists and populate the modal
                    if (user && user.name) {
                        $('#userDetails').html(`
                            <p><strong data-translate-key="username">Username:</strong> ${user.name}</p>
                            <p><strong data-translate-key="nickname">Nickname:</strong> ${user.nick}</p>
                            <p><strong data-translate-key="nickname">email:</strong> ${user.email}</p>
                            <p><strong data-translate-key="ip">IP:</strong> ${user.ip}</p>
                            <p><strong data-translate-key="active">Active:</strong> ${user.active == 1 ? "Activated" : "Not"}</p>
                            <p><strong data-translate-key="created_at">Created At:</strong> ${user.user_date}</p>
                        `);

                        // Show the modal
                        UIkit.modal('#detailsUserModal').show();
                    } else {
                        alert('Failed to fetch user details.');
                    }
                } catch (error) {
                    console.error('Error parsing response:', error);
                    alert('Invalid response from server.');
                }
            }).fail(function () {
                alert('An error occurred while fetching user details.');
            });
        });


        // search real time
        $('.search__input input').on('input', function () {
            const search = $(this).val();
            $.get('../function/search_user.php', { search }, function (data) {
                $('#userTableBody').html(data);
            });
        });

    });
</script>
