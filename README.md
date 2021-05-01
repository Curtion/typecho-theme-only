此项目既是脚手架，也是only主题，如果想要使用主题请在releases中下载。
# 说明
项目使用TailWindCSS进行页面样式开发，脚手架是是gulp+rollup+babel，建议使用VSCode进行开发，并且安装[Tailwind CSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss) 扩展



开发方式参考官方文档[Typecho文档](http://docs.typecho.org/doku.php)，此项目无需手动导入CSS和JS，脚手架会自动处理。

css入口文件在`./src/css/base.css`中，js入口文件在`./src/index.js`，模板代码在`./src/template`



# 命令

1. 安装依赖：yarn
2. 开发： yarn dev
3. 构建： yarn build