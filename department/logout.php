<?php

session_start();
session_destroy();
?>

<script>
    alert('Logout successfully!');
    document.location = "./../index.php";
</script>