<?php
/* Smarty version 4.1.0, created on 2022-02-25 14:51:57
  from 'Z:\7\hw\smarty\templates\test.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_6218defdbe9df6_66054778',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d210c25ae473e04b857c9ea5bcd146c28cd0477' => 
    array (
      0 => 'Z:\\7\\hw\\smarty\\templates\\test.tpl',
      1 => 1645797114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6218defdbe9df6_66054778 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
<body>
<form action="../../test.php">
<span>Логин: </span><input type="text" name="login" size="10" value="<?php echo $_smarty_tpl->tpl_vars['login']->value;?>
">
<input type="submit" value="Отправить">
<p><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
</p>
</form>
<!--
<p>
    <?php if ($_smarty_tpl->tpl_vars['name']->value == 'JetSaus') {?>
        Переданная переменная - <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

    <?php } else { ?>
        Другая переменная
    <?php }?>
</p>
-->
</body>
</html><?php }
}
