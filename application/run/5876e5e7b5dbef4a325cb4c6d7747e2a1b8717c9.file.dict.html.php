<?php /* Smarty version Smarty-3.1.19, created on 2016-07-29 10:53:03
         compiled from "/data/home/qyu1988070001/htdocs/application/views/home/dict.html" */ ?>
<?php /*%%SmartyHeaderCode:1596141682573d6ae96d87b2-03230593%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5876e5e7b5dbef4a325cb4c6d7747e2a1b8717c9' => 
    array (
      0 => '/data/home/qyu1988070001/htdocs/application/views/home/dict.html',
      1 => 1469760780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1596141682573d6ae96d87b2-03230593',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_573d6ae97fccc1_02598920',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_573d6ae97fccc1_02598920')) {function content_573d6ae97fccc1_02598920($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Webonly IT Search</title>
<link href="public/styles/bootstrap.css" rel="stylesheet">
<link href="public/styles/font-awesome.css" rel="stylesheet">
<link href="public/styles/bootstrap-theme.css" rel="stylesheet">
<script src="public/scripts/jquery-1.10.2.js"></script>
<script src="public/scripts/bootstrap.js"></script>
<script src="public/scripts/dict.js"></script>
<style>
	body{
		min-height:520px;
	}
	.container,.row{
		min-height:520px;
	}
	.frame{
		min-height:520px;
		width:100%;
		/* border:1px solid green; */
	}
	.search{
		/* border:1px solid red; */
		min-height:480px;
		
	}
	.search  .input-group{
		width:80%;
		margin:auto;
		/* border:1px solid green; */
		margin-top:70px;
	}
	.input-group  .form-control:first-child, .input-group-addon:first-child, .input-group-btn:first-child > .btn, .input-group-btn:first-child > .btn-group > .btn, .input-group-btn:first-child > .dropdown-toggle, .input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle), .input-group-btn:last-child > .btn-group:not(:last-child) > .btn {
		border:1px solid rgb(92,184,92); 
		border-top-right-radius: 0;
    		border-bottom-right-radius: 0;
	}
	.search h1{
		margin-top:80px;
		text-align:center;
		color:rgb(92,184,92);
	}
	#content{
		border:1px solid rgb(92,184,92);
		width:80%;
		height:auto;
		margin:auto;
		display:none;
		border: 1px solid #ccc;
    		box-shadow: 1px 1px 3px #ededed;
		border-radius:0;
		border-top:0;
		margin-top:-5px;
		padding:0;
		padding-top:5px;
	}
	#content ul{
		margin:0;
		padding:0;
	}
	#content li{
		list-style:none;
		padding:3px;
		padding-left:15px;
	}
	#entry,#report{
		/* border:1px solid rgb(92,184,92); */
		width:80%;
		margin:auto;
		margin-top:50px;
		/* border: 1px solid #ccc; */
    		box-shadow: 0px 0px 8px rgba(92,184,92,.5);
		border-radius:0;
		/* padding:5px; */
		display:none;
	}
	#report{
		padding-top:10px;
		padding-bottom:10px;
		text-align:center;
	}
	#report h1{
		margin:0;
		padding:0;
	}
	#report button{
		margin:5px auto;
	}
	#reportModal{
		
	}
</style>
</head>
<body>
<!-- feedbackModal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-top:5px;padding-bottom:5px;text-align:center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h6 class="modal-title" id="myModalLabel">感谢您的提交</h6>
      </div>
      <div class="modal-body" style="padding-bottom:5px;text-align:center;">
        <span id="feedbackMsg"></span><i class="fa fa-spin fa-spinner" style="color:red;font-size:50px;"></i>
      </div>
      <div class="modal-footer" style="padding-top:5px;padding-bottom:5px;">
        <a>Thanks For Your Submission</a>
      </div>
    </div>
  </div>
</div>
<!-- feedbackModal -->
<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-top:5px;padding-bottom:5px;text-align:center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel">感谢您的提交</h2>
      </div>
      <div class="modal-body" style="padding-bottom:5px;">
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="glyphicon glyphicon-user"></i>
				</span>
				<input class="form-control" placeholder="用户名"	id="username" name="loginname" type="text" autofocus>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">
				<i class="glyphicon glyphicon glyphicon-envelope"></i>
				</span> 
				<input class="form-control" placeholder="任意的联系方式" id="contact" name="password" type="text" value="">
			</div>
		</div>
		<div class="form-group" style="margin-bottom:5px;">
			<div class="input-group">
				<span class="input-group-addon">
				<i class="glyphicon glyphicon glyphicon-book"></i>
				</span> 
				<textarea class="form-control" id="reportWord" style="height:50px;"></textarea>
			</div>
		</div>
		<div class="form-group" style="margin-bottom:0;">
			<div class="input-group" style="margin:auto;">
				<span class="">
				<i></i>
				</span> 
				<button class="btn btn-primary" id="reportBar">提 交</button>
			</div>
		</div>
      </div>
      <div class="modal-footer" style="padding-top:5px;padding-bottom:5px;">
        <a>Thanks For Your Submission</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="container">
	<div class="row">
		<div class="col-md-12 frame">
			<header></header>
			<div class='search'>
				<h1>Webonly IT Search</h1>
				<div class="input-group">
      				<input type="text" class="form-control" placeholder="HTML、CSS、JavaScript、jQuery、PHP" id="search" autofocus>
      				<span class="input-group-btn">
        					<button class="btn btn-success" type="button" id="searchBtn">搜一下</button>
      				</span>
    				</div>
		       <div id="content" class="form-control"></div>
		       <div id="entry"></div>
		       <div id="report">
		       	<h1>很抱歉，没有要查找的单词</h1>
<button type="button" class="btn btn-danger" id="modalBar">
  提交新词
</button> 
		       </div>
			</div>
			<footer></footer>
		</div>
	</div>
</div>
</body>
</html><?php }} ?>
