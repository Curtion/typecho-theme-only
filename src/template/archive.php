<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
}
$this->need('header.php');
$this->need('left.php');
?>

<div class="flex-1 px-4 py-2 overflow-auto">
    <div class="bg-white rounded-xl shadow-sm">
    测试
    </div>
</div>

<?php
$this->need('right.php');
$this->need('footer.php');


?>
