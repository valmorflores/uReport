<!DOCTYPE html>
<html lang="en">
<head>
<?php
    echo view('Design/head_load');
?>
</head>
<body class="p-3 mb-2 app-body"> <!--  bg-dark text-white  bg-gradient -->
<?php
    echo view($content);
?>
<footer>
<?php
    echo view('Design/foot_content');
    echo view('Design/foot_load');
?>
</footer>
</body>
</html>