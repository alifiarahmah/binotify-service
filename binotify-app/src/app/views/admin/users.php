<div>
    <h1>
        User List
    </h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>Username</th>
            <th>Admin</th>
        </tr>
        <?php
        foreach ($data as $user) {
        ?>
        <tr>
            <td><?= $user['user_id'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['isAdmin'] ? 'yes' : 'no' ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>