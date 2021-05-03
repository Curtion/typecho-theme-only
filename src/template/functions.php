<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
}

/**
 * 获取标签数目
 * https://github.com/typecho/typecho/blob/master/var/Widget/Stat.php
 * @return integer
 */
function tagsNum()
{
    $db = Typecho_Db::get();
    return $db->fetchObject(
        $db
            ->select(['COUNT(mid)' => 'num'])
            ->from('table.metas')
            ->where('table.metas.type = ?', 'tag')
    )->num;
}

// 访客总数
function theAllViews()
{
    $db = Typecho_Db::get();
    $row = $db->fetchAll('SELECT SUM(VIEWS) FROM `typecho_contents`');
    echo number_format($row[0]['SUM(VIEWS)']);
}

// 耗时计算
function timer_start()
{
    global $timestart;
    $mtime = explode(' ', microtime());
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
function timer_stop($display = 0, $precision = 3)
{
    global $timestart, $timeend;
    $mtime = explode(' ', microtime());
    $timeend = $mtime[1] + $mtime[0];
    $timetotal = number_format($timeend - $timestart, $precision);
    $r = $timetotal < 1 ? $timetotal * 1000 . ' ms' : $timetotal . ' s';
    if ($display) {
        echo $r;
    }
    return $r;
}

// 博客建立时间
function blog_time()
{
    $date1 = time();
    $date2 = strtotime('2013-01-01 00:00:00');
    $diff = $date1 - $date2;
    $days = abs(round($diff / 86400));
    return floor($days / 365) . '年' . $days % 365 . '天';
}

// 最后更新时间
function get_last_update()
{
    $num = '1';
    //取最近的一笔就好了
    $now = time();
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $create = $db->fetchRow(
        $db
            ->select('created')
            ->from('table.contents')
            ->limit($num)
            ->order('created', Typecho_Db::SORT_DESC)
    );
    $update = $db->fetchRow(
        $db
            ->select('modified')
            ->from('table.contents')
            ->limit($num)
            ->order('modified', Typecho_Db::SORT_DESC)
    );
    if ($create >= $update) {
        echo Typecho_I18n::dateWord($create['created'], $now);
    } else {
        echo Typecho_I18n::dateWord($update['modified'], $now);
    }
}

// 标签云随机颜色
function randomColor()
{
    $color = ['bg-yellow-200', 'bg-blue-200', 'bg-gray-200', 'bg-green-200', 'bg-indigo-200', 'bg-purple-200', 'bg-pink-200'];
    $hoverColor = ['bg-yellow-400', 'bg-blue-400', 'bg-gray-400', 'bg-green-400', 'bg-indigo-400', 'bg-purple-400', 'bg-pink-400'];
    return $color[array_rand($color, 1)] . ' hover:' . $hoverColor[array_rand($color, 1)];
}

// 字体次数统计
function artCount($cid)
{
    $db = Typecho_Db::get();
    $rs = $db->fetchRow(
        $db
            ->select('table.contents.text')
            ->from('table.contents')
            ->where('table.contents.cid=?', $cid)
            ->order('table.contents.cid', Typecho_Db::SORT_ASC)
            ->limit(1)
    );
    $text = preg_replace('/[^\x{4e00}-\x{9fa5}]/u', '', $rs['text']);
    return mb_strlen($text, 'UTF-8');
}

// 文章阅读数量
function post_view($archive)
{
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('viewsNum', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `viewsNum` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow(
        $db
            ->select('viewsNum')
            ->from('table.contents')
            ->where('cid = ?', $cid)
    );
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_viewsNum');
        if (empty($views)) {
            $views = [];
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query(
                $db
                    ->update('table.contents')
                    ->rows(['viewsNum' => (int) $row['viewsNum'] + 1])
                    ->where('cid = ?', $cid)
            );
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_viewsNum', $views);
        }
    }
    return $row['viewsNum'];
}

// 发布文章时填写的子字段
function themeFields($layout)
{
    $Cover = new Typecho_Widget_Helper_Form_Element_Text('Cover', null, null, '自定义缩略图', '输入缩略图地址');
    $layout->addItem($Cover);
}

// 主题设置功能
function themeConfig($form)
{
    // 背景图
    $background = new Typecho_Widget_Helper_Form_Element_Text(
        'background',
        null,
        'https://cdn.jsdelivr.net/gh/nexmoe/nexmoe.github.io@latest/images/cover/compress/5c3aec85a4343.jpg',
        '博客默认封面图',
        '在这里填入一个图片URL地址, 给博客添加一个默认封面图'
    );
    $form->addInput($background);
}

// 新标签打开评论者网页
function CommentAuthor($obj, $autoLink = null, $noFollow = null)
{
    $options = Helper::options();
    $autoLink = $autoLink ? $autoLink : $options->commentsShowUrl;
    $noFollow = $noFollow ? $noFollow : $options->commentsUrlNofollow;
    if ($obj->url && $autoLink) {
        echo '<a href="' . $obj->url . '"' . ($noFollow ? ' rel="external nofollow"' : null) . (strstr($obj->url, $options->index) == $obj->url ? null : ' target="_blank"') . '>' . $obj->author . '</a>';
    } else {
        echo $obj->author;
    }
}
?>
