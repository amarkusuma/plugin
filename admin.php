<?php
/*
Plugin Name: Admin
Description: Membuat Halaman Admin
Author: Ammar
*/
require_once('form.php');
require_once('widget.php');

add_action('admin_menu', 'my_plugin_menu');

/** Step 1. */
function my_plugin_menu()
{
    add_options_page('My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options');
}

/** Step 3. */
function my_plugin_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    global $wpdb;
    if (isset($_GET['id'])) {
        $wpdb->delete('komentar', array('ID' =>  $_GET['id']));
    }

    $myrows = $wpdb->get_results("SELECT * from komentar ");
?>
    <br><br>
    <p>
    </p>
    <table border="1" cellpadding="0" cellspacing="0">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Testimonial</th>
            <th>Action</th>
        </tr>

        <?php
        foreach ($myrows as $data) {
        ?>
            <tr>
                <td><?php echo $data->name; ?></td>
                <td><?php echo $data->email; ?></td>
                <td><?php echo $data->phone; ?></td>
                <td><?php echo $data->testimonial; ?></td>
                <td>

                    <a>Update</a> |
                    <a href="<?php echo admin_url('options-general.php?page=my-unique-identifier') . '&id=' . $data->id ?>">delete</a>
                </td>
                <!-- data terdelete setelah di refress -->
            </tr>
        <?php
        }
        ?>

    </table>

<?php
}
?>