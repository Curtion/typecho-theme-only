<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
} ?>
<nav class="hidden lg:block flex-none w-72 h-screen overflow-auto scrollbar-hidden py-2 space-y-3 pl-3">
    <div class="bg-white rounded-lg shadow-md">
        <div class="py-2 px-2">
            <form class="flex" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <input type="text" id="s" name="s" class="py-1 px-3 block appearance-none placeholder-red-300 border border-red-400 rounded-md text-gray-700 leading-5 focus:outline-none focus:ring-2 focus:ring-red-200" placeholder="输入关键字搜索" />
                <button type="submit" class="w-full bg-red-400 hover:bg-red-500 ml-2 rounded-md shadow-md text-white text-opacity-75 tracking-wider">搜索</button>
            </form>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center mb-1 h-8 text-xl text-black text-opacity-60 border-b border-green-400">文章分类</div>
        <div class="py-2 px-2 grid grid-cols-2 gap-4">
            <?php $this->widget('Widget_Metas_Category_List')->to($mates); ?>
            <?php while ($mates->next()): ?>
                <a class="flex justify-center" href="<?php $mates->permalink(); ?>" title="<?php $mates->name(); ?>">
                    <span class="hover:underline"><?php $mates->name(); ?>(<?php $mates->count(); ?>)</span>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center mb-1 h-8 text-xl text-black text-opacity-60 border-b border-green-400">最新评论</div>
        <div class="py-2 px-2">
            <?php
            $this->widget('Widget_Comments_Recent', 'ignoreAuthor=true')->to($comments);
            if ($comments->have()):
                while ($comments->next()): ?>
                    <span class="truncate flex">
                        <span class="comments-author"><?php CommentAuthor($comments); ?></span>
                        <span>：</span>
                        <a class="hover:text-red-400 block" href="<?php $comments->permalink(); ?>" title="<?php $comments->text(); ?>">
                            <?php $comments->text(); ?>
                        </a>
                    </span>
                <?php endwhile;
            endif;
            ?>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center mb-1 h-8 text-xl text-black text-opacity-60 border-b border-green-400">标签云</div>
        <div class="py-2 flex flex-wrap">
            <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=30')->to($tags); ?>
            <?php if ($tags->have()): ?>
            <?php while ($tags->next()): ?>
            <a href="<?php $tags->permalink(); ?>" rel="tag" class="tracking-wider label my-1 mx-1 rounded-xl py-1.5 px-2 <?php echo randomColor(); ?> text-black text-opacity-70" title="<?php $tags->count(); ?> 个话题">
                <?php $tags->name(); ?>
            </a>
            <?php endwhile; ?>
            <?php else: ?>
            <a>
                <?php _e('没有任何标签'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center mb-1 h-8 text-xl text-black text-opacity-60 border-b border-green-400">文章归档</div>
        <div class="py-2">
            <ul>
                <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 m 月')->parse('
                    <li class="flex justify-between items-center h-8 hover:bg-gray-100 px-4"><a href="{permalink}" class="hover:underline text-base">{date}</a><span class="font-semibold bg-red-100 px-4 rounded-full">{count}</span></li>
                '); ?>
            </ul>
        </div>
    </div>
</nav>