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

?>
