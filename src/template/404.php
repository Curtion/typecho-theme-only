<?php

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
}
$this->need('header.php');
$this->need('left.php');
?>

<div class="flex-1 px-4 py-2 overflow-auto h-screen">
    <div class="bg-white rounded-xl shadow-md flex justify-center h-24 items-center text-3xl text-black text-opacity-60">
        404 Not Found
    </div>
</div>

<?php
$this->need('right.php');
$this->need('footer.php');

?>
