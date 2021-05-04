<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
} ?>
<nav class="flex-none w-72 h-screen overflow-auto scrollbar-hidden py-2 space-y-3 pr-2">
    <div class="bg-white rounded-lg shadow-md">
        <div class="rounded-full h-24 flex items-center justify-center">
            <img src="https://avatar.dawnlab.me/qq/349582053?s=0" alt="头像"
                class="h-20 w-20 rounded-full border border-solid border-gray-100 shadow-md">
        </div>
        <div class="flex justify-around mt-3">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            <div class="flex flex-col items-center">
                <span class="text-lg text-black text-opacity-80">文章</span>
                <span class="text-base text-black text-opacity-40">
                    <?php $stat->publishedPostsNum(); ?>
                </span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-lg  text-black text-opacity-80">标签</span>
                <span class="text-base text-black text-opacity-40">
                    <?php echo tagsNum(); ?>
                </span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-lg text-black text-opacity-80">分类</span>
                <span class="text-base text-black text-opacity-40">
                    <?php $stat->categoriesNum(); ?>
                </span>
            </div>
        </div>
        <ul class="py-5">
            <a class="<?php if ($this->is('index')): ?>active <?php endif; ?> btn-menu-list" href="<?php $this->options->siteUrl(); ?>"
                title="回到首页">
                <i class="fa fa-home w-6"></i>
                <div class="w-full pl-7 tracking-wider">首页</div>
            </a>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while ($pages->next()): ?>
            <a class="<?php if ($this->is('page', $pages->slug)): ?>active <?php endif; ?> btn-menu-list"
                href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>">
                <i class="fa fa-list w-6"></i>
                <div class="w-full pl-7 tracking-wider">
                    <?php $pages->title(); ?>
                </div>
            </a>
            <?php endwhile; ?>
            <?php if ($this->user->hasLogin()): ?>
            <a class="btn-menu-list" href="<?php $this->options->siteUrl(); ?>admin" title="后台管理" target="_blank">
                <i class="fa fa-cog w-6"></i>
                <div class="w-full pl-7 tracking-wider">后台管理</div>
            </a>
            <?php endif; ?>
        </ul>
    </div>
    <div class="bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center mb-1 h-8 text-xl text-black text-opacity-60 border-b border-green-400">博客统计</div>
        <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
        <ul class="px-2 py-2">
            <li class="h-8 flex items-center justify-between px-6">
                <span>评论数目</span>
                <span class="font-semibold bg-green-200 px-2 rounded-full"><?php $stat->publishedCommentsNum(); ?></span>
            </li>
            <li class="h-8 flex items-center justify-between px-6">
                <span>访客总数</span>
                <span class="font-semibold bg-green-200 px-2 rounded-full lining-nums"><?php echo theAllViews(); ?></span>
            </li>
            <li class="h-8 flex items-center justify-between px-6">
                <span>运营时间</span>
                <span class="font-semibold bg-green-200 px-2 rounded-full"><?php echo blog_time(); ?></span>
            </li>
            <li class="h-8 flex items-center justify-between px-6">
                <span>加载耗时</span>
                <span class="font-semibold bg-green-200 px-2 rounded-full"><?php echo timer_stop(); ?></span>
            </li>
            <li class="h-8 flex items-center justify-between px-6">
                <span>最后更新</span>
                <span class="font-semibold bg-green-200 px-2 rounded-full"><?php echo get_last_update(); ?></span>
            </li>
        </ul>
    </div>
    <div class="bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center mb-1 h-8 text-xl text-black text-opacity-60 border-b border-green-400">版权信息</div>
        <div class="px-2 py-2">
            <div><span class="flex items-center">© 2013-<?php echo date('Y'); ?> <?php $this->options->title(); ?></span>
            Powered by <a href="http://typecho.org/" target="_blank" rel="external nofollow noopener noreferrer" class="hover:underline text-green-600">Typecho</a> &amp; <a href="https://github.com/curtion/typecho-theme-only" target="_blank" rel="external nofollow noopener noreferrer" class="hover:underline text-green-600">Only</a>
            <br/><a href="https://beian.miit.gov.cn" target="_blank" class="hover:underline text-green-600">蜀ICP备15026623号-1</a></div>
        </div>
    </div>
</nav>