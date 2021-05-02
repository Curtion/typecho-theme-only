<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
} ?>
<nav class="flex-none w-72">
    <div class="bg-white rounded-xl shadow-sm">
        <div class="rounded-full h-24 flex items-center justify-center">
            <img src="https://avatar.dawnlab.me/qq/349582053?s=0" alt="头像"
                class="h-20 w-20 rounded-full border border-solid border-gray-100 shadow-md">
        </div>
        <div class="flex justify-around mt-3">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            <div class="flex flex-col items-center">
                <span class="text-lg text-black text-opacity-80">文章</span>
                <span class="text-base text-black text-opacity-20">
                    <?php $stat->publishedPostsNum(); ?>
                </span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-lg  text-black text-opacity-80">标签</span>
                <span class="text-base text-black text-opacity-20">
                    <?php echo tagsNum(); ?>
                </span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-lg text-black text-opacity-80">分类</span>
                <span class="text-base text-black text-opacity-20">
                    <?php $stat->categoriesNum(); ?>
                </span>
            </div>
        </div>
        <ul class="py-5">
            <a class="<?php if ($this->is('index')): ?>active <?php endif; ?> btn-menu-list" href="<?php $this->options->siteUrl(); ?>"
                title="回到首页">
                <i class="fa fa-home w-6"></i>
                <div class="w-full pl-5">首页</div>
            </a>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while ($pages->next()): ?>
            <a class="<?php if ($this->is('page', $pages->slug)): ?>active <?php endif; ?> btn-menu-list"
                href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>">
                <i class="fa fa-list w-6"></i>
                <div class="w-full pl-5">
                    <?php $pages->title(); ?>
                </div>
            </a>
            <?php endwhile; ?>
            <?php if ($this->user->hasLogin()): ?>
            <a class="btn-menu-list" href="<?php $this->options->siteUrl(); ?>admin" title="后台管理" target="_blank">
                <i class="fa fa-cog w-6"></i>
                <div class="w-full pl-5">后台管理</div>
            </a>
            <?php endif; ?>
        </ul>
    </div>
</nav>