<?php
/**
 * Only
 *
 * @package Only
 * @author Curtion
 * @version 1.0.0
 * @link https://blog.3xgk.net
 */

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
}
$this->need('header.php');
$this->need('left.php');
?>

<div class="flex-1 px-4 py-2 overflow-auto h-screen">
    <section class="nexmoe-posts" id="brand-waterfall">
        <?php while ($this->next()): ?>
        <div class="nexmoe-post">
            <a href="<?php $this->permalink(); ?>">
                <div class="nexmoe-post-cover mdui-ripple"> 
                    <?php if ($this->fields->Cover) { ?>
                        <img src="<?php echo $this->fields->Cover; ?>" class="a">
                    <?php } else { ?>
                        <img src="<?php echo $this->options->background; ?>" class="b">
                    <?php } ?>
                    <h1><?php $this->title(); ?></h1>
                </div>
            </a>
            <div class="nexmoe-post-meta">
                <a><i class="nexmoefont icon-calendar-fill"></i><?php $this->date('Y年n月d日'); ?></a>
                <a><?php echo artCount($this->cid); ?> 汉字</a>
                <a><?php echo post_view($this); ?> 围观</a>
                <a><?php $this->commentsNum('%d'); ?> 评论</a>
                <?php $this->category(','); ?>
                <?php $this->tags(' ', true); ?>
            </div>
            <article>
                <?php $this->content('阅读更多'); ?>
            </article>
        </div>
        <?php endwhile; ?>
    </section>
    <!-- <div class="bg-white rounded-xl shadow-sm">
    测试
    </div> -->
</div>

<?php
$this->need('right.php');
$this->need('footer.php');


?>
