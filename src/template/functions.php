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
?>
