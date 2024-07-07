<?php   

function jobseekers_user_list() {
    global $wpdb;
    $users = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}jobseekers_users");

    ob_start(); ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->role; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    return ob_get_clean();
}

add_shortcode('jobseekers_user_list', 'jobseekers_user_list');

?>