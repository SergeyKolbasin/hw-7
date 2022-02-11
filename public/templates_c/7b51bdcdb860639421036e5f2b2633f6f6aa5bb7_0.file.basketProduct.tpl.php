<?php
/* Smarty version 4.1.0, created on 2022-02-11 10:43:06
  from 'Z:\7\hw\smarty\templates\basketProduct.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_62062faa121f16_53551487',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b51bdcdb860639421036e5f2b2633f6f6aa5bb7' => 
    array (
      0 => 'Z:\\7\\hw\\smarty\\templates\\basketProduct.tpl',
      1 => 1644572578,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62062faa121f16_53551487 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина покупок</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h3>Корзина покупок:</h3>
    <table>
        <tr>
            <th>Вид</th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Удаление</th>
        </tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['basket']->value, 'basketItem');
$_smarty_tpl->tpl_vars['basketItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['basketItem']->value) {
$_smarty_tpl->tpl_vars['basketItem']->do_else = false;
?>
            <tr>
                <td><img width="100px" src="<?php echo $_smarty_tpl->tpl_vars['basketItem']->value['url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['basketItem']->value['name'];?>
"></td>
                <td><?php echo $_smarty_tpl->tpl_vars['basketItem']->value['name'];?>
</td>
                <td><?php echo sprintf("%01.2f",$_smarty_tpl->tpl_vars['basketItem']->value['price']);?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['basketItem']->value['amount'];?>
<a href="editBasketItem.php?id=<?php echo $_smarty_tpl->tpl_vars['basketItem']->value['id'];?>
"> - Изменить</a></td>
                <td><a href="deleteBasketItem.php?id=<?php echo $_smarty_tpl->tpl_vars['basketItem']->value['id'];?>
&productid=<?php echo $_smarty_tpl->tpl_vars['basketItem']->value['productid'];?>
">Удалить</a></td>>
            <!--
            <td>
                <form action="" method="post">
                    <input type="number" size="3" min="0" max="999" step="1" name="amount" value="<?php echo '<?'; ?>
= $amount <?php echo '?>'; ?>
">
                </form>
            </td>
            <td><?php echo '<?php'; ?>
 printf("%01.2f", $price * $amount) <?php echo '?>'; ?>
</td>
            -->
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>




</body>
</html>
<!--
foreach($basket as $product) {
echo $product['name'] . ' ' . $product['price'] . ' ' . $product['amount'] . ' ';
echo '<a href="editBasketItem.php?id=' . $product['id'] . '">Изменить</a>';
echo $product['price'] * $product['amount'];
echo '';
echo '<br>';
}
--><?php }
}
