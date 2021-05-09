<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
}
$this->need('header.php');
$this->need('left.php');
?>

<div class="flex-1 pl-2 pr-1 py-2 overflow-auto h-screen" id="scrollWrapper">
    <section class="space-y-3">
        <div class="bg-white rounded-xl shadow-md">
            <a href="<?php $this->permalink(); ?>" class="black">
                <div class=""> 
                    <?php if ($this->fields->Cover) { ?>
                        <img src="<?php echo $this->fields->Cover; ?>" class="w-full h-80 rounded-t-xl object-cover border-b-2">
                    <?php } else { ?>
                        <img src="<?php echo $this->options->background; ?>" class="w-full h-80 rounded-t-xl object-cover border-b-2">
                    <?php } ?>
                    <h1 class="text-xl hover:text-red-400 px-3 py-1 font-bold"><?php $this->title(); ?></h1>
                </div>
            </a>
            <div class="px-2 title-label flex flex-wrap">
                <a><i class="fa fa-calendar-o pr-1"></i><?php $this->date('Y年n月d日'); ?></a>
                <a><?php echo artCount($this->cid); ?> 汉字</a>
                <a><?php echo post_view($this); ?> 围观</a>
                <a><?php $this->commentsNum('%d'); ?> 评论</a>
                <?php $this->category(','); ?>
                <?php $this->tags(' ', true); ?>
            </div>
            <article class="px-3 pt-2 pb-3 max-w-none typo line-numbers" id="article">
                <?php $this->content(); ?>
            </article>
            <div id="comments">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>
    </section>
</div>

<?php
$this->need('toc.php');
$this->need('footer.php');


?>
