<?php
if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
?>
<div class="content home">
    <aside>
        <h1>Home</h1>
    </aside>
</div>
