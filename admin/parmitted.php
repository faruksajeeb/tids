<?php

session_start();
if (isset($_SESSION['uid']) == false) {
    ?>
    <script lang="javascript">
        alert('Access denied ! ');
    </script>
    <?php

    echo 'Access denied ! Please login with your account .';
    exit;
    //header('location:index.php');
}