<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?php echo ($title); ?></title>
  <link rel="stylesheet" href="/Public/layui/css/layui.css">
</head>
<body>
 
<!-- 你的HTML代码 -->
 
<script src="/Public/layui/layui.js"></script>
<script>
//一般直接写在一个js文件中
layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form;
  
  layer.msg('Hello World');
});
</script> 
<include file="Public/footer.html">