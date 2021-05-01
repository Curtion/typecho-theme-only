# 说明

此项目既是脚手架，也是 only 主题，如果想要使用主题请在 releases 中下载。

项目使用 TailWindCSS 进行页面样式开发，脚手架是是 gulp+rollup+babel，建议使用 VSCode 进行开发，并且安装[Tailwind CSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss) 扩展.
同时安装 [livereload](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei?hl=zh-CN) 浏览器扩展可以实现浏览器自动刷新，gulp 已经配置了 livereload 服务。

开发方式参考官方文档[Typecho 文档](http://docs.typecho.org/doku.php)，此项目无需手动导入 CSS 和 JS，脚手架会自动处理。

css 入口文件在`./src/css/base.css`中，js 入口文件在`./src/index.js`，模板代码在`./src/template`

如果要进行二次开发请自行删除`./src/template` 中的代码，但是请注意下面注释不可删除：

```
  <!-- inject:css -->
  <!-- endinject -->

```

```
  <!-- inject:js -->
  <!-- endinject -->

```

# 命令

1. 安装依赖：yarn
2. 开发： yarn dev
3. 构建： yarn build
