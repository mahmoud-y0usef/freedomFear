<?php 

    require_once 'DB.php';
    $db = new DB();
    $search = htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');
    $search_users = $db->search_admin($search); 
    foreach ($search_users as $user) {
        echo '<tr data-id="' . $user['id'] . '">
                <td>' . htmlspecialchars($user['name']) . '</td>
                <td>' . htmlspecialchars($user['email']) . '</td>
                <td>
                    <button style="display: inline;width: 40px;" class="uk-button uk-button-primary editUserButton" data-id="' . $user['id'] . '"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button style="display: inline;width: 40px;" class="uk-button uk-button-danger deleteUserButton" data-id="' . $user['id'] . '"><i class="fa-solid fa-delete-left"></i></button>
                </td>
            </tr>';
    }
    


?>