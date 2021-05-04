<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
} ?>
<?php
$textarea = Helper::options()->commentsHTMLTagAllowed;
function threadedComments($comments, $options)
{
    $commentClass = '游客'; // authorId 文章作者ID ，// ownerId 评论作者ID
    if ($comments->authorId && $comments->authorId == 1) {
        $commentClass = '博主';
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels + 1;
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"target="_blank" class="cursor-pointer rounded-lg py-0.5 text-black text-sm" rel="external nofollow" tooltip="' . $comments->author . '">' . $comments->author . '</a>';
    } else {
        $author = '<span class="cursor-pointer rounded-lg py-0.5 text-black text-sm">' . $comments->author . '</span>';
    }
    ?>
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($depth > 1 && $depth < 3) {
    echo ' comment-child ';
    $comments->levelsAlt('comment-level-odd', ' comment-level-even');
} elseif ($depth > 2) {
    echo ' comment-child2';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
?>">
    <div id="<?php $comments->theId(); ?>">
         <?php
         $host = '//avatar.dawnlab.me';
         $url = '/gravatar/';
         $size = '100';
         $rating = Helper::options()->commentsAvatarRating;
         $hash = md5(strtolower($comments->mail));
         $email = strtolower($comments->mail);
         $sjtx = Typecho_Widget::widget('Widget_Options')->motx;
         $qq = str_replace('@qq.com', '', $email);
         if (strstr($email, 'qq.com') && is_numeric($qq)) {
             $avatar = '//avatar.dawnlab.me/qq/' . $qq;
         } else {
             $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=' . $sjtx;
         }
         ?>
        <div class="px-1 py-1 flex">
            <div class="">
                <img class="h-16 w-16 rounded-full border border-solid border-gray-100 shadow-md" src="<?php echo $avatar; ?>">
            </div>
            <div class="flex-1 ml-2">
                <div class="text-base flex space-x-1">
                    <span class="text-white text-opacity-70 flex"><?php echo $author; ?>
                        <?php if ($comments->authorId && $comments->authorId == 1): ?>
                        <span class="cursor-pointer rounded-lg py-0.5 text-black text-sm">
                            <span class="text-green-400">
                            [<?php echo $commentClass; ?>]
                            </span>
                        </span>
                        <?php endif; ?>
                    </span>
                    <span class="cursor-pointer rounded-lg py-0.5 text-sm" title="<?php $comments->date('Y-m-d H:i'); ?>"><?php $comments->date('n月j日'); ?></span>
                    <?php if ($depth < 5): ?>       
                        <span class="text-white text-opacity-70 bg-blue-400 rounded-lg px-2 text-sm flex items-center" data-no-instant><?php $comments->reply('回复'); ?></span>
                    <?php endif; ?>
                </div>
                <div class="text-base comment-content">
                <?php
                comment_at($comments->coid);
                $cos1 = preg_replace('#<p>#', '', $comments->content);
                $cos2 = preg_replace('#</p>#', '', $cos1);
                echo $cos2;
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>
<?php
}
?>


<div class="comment">
    <h1 class="w-full h-8 border-t flex justify-center items-center pt-2 text-2xl">
        <span><?php $this->commentsNum('%d'); ?> 评论</span>
    </h1>
    <?php $this->comments()->to($comments); ?>
    <?php if ($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>">
        <div data-no-instant>
            <?php $comments->cancelReply(); ?>
        </div>
    	<form method="post" action="<?php $this->commentUrl(); ?>" role="form">
            <div class="w-full px-2 py-2 relative">
                <textarea style="resize:none" name="text" id="textarea" class="rounded-lg px-2 py-1 h-28 w-full border focus:outline-none focus:ring-1 focus:ring-green-400" placeholder='输入评论...'：<?php echo $textarea; ?>' required><?php $this->remember(
    'text'
); ?></textarea>
            <button class="absolute bottom-4 right-4" type="submit" id="comment-btn"><i class="fa fa-paper-plane">发表留言</i></button>
            </div>
            <?php if ($this->user->hasLogin()): ?>
            <?php else: ?>
            <div class="px-2 py-2">
    		    <input class="px-2 mb-2 border rounded-sm focus:outline-none focus:ring-1 focus:ring-green-400" type="text" name="author" id="author" placeholder="称呼*" value="<?php $this->remember('author'); ?>" required>
    	        <input class="px-2 mb-2 border rounded-sm focus:outline-none focus:ring-1 focus:ring-green-400" type="email" name="mail" id="mail" placeholder="Email*" value="<?php $this->remember('mail'); ?>" <?php if (
    $this->options->commentsRequireMail
): ?> required<?php endif; ?>>
    		    <input class="px-2 mb-2 border rounded-sm focus:outline-none focus:ring-1 focus:ring-green-400" type="url" name="url" id="url" placeholder="http://" value="<?php $this->remember('url'); ?>" <?php if (
    $this->options->commentsRequireURL
): ?> required<?php endif; ?>>
            </div>
            <?php endif; ?>
    	</form>
    </div>
    
    <?php else: ?>
    <h1 class="text-2xl"><?php _e('评论已关闭'); ?></h1>
    <?php endif; ?>
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
    <?php endif; ?>
</div><!-- .comment -->

