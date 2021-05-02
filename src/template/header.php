<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit();
} ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="<?php $this->options->charset(); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>
    <?php
    $this->archiveTitle(
        [
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章'),
        ],
        '',
        ' - '
    );
    $this->options->title();
    ?>
  </title>
  <!-- inject:css -->
  <!-- endinject -->
  <?php $this->header(); ?>
</head>

<body class="bg-gray-100 ">
  <!-- content-start -->
  <div class="container mx-auto min-h-screen rounded-xl flex">