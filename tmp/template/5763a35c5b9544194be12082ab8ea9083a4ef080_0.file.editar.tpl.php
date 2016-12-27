<?php
/* Smarty version 3.1.30, created on 2016-12-27 22:30:22
  from "/var/www/html/imagibank/views/usuario/editar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5862dd6e732bd8_49511647',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5763a35c5b9544194be12082ab8ea9083a4ef080' => 
    array (
      0 => '/var/www/html/imagibank/views/usuario/editar.tpl',
      1 => 1482874160,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5862dd6e732bd8_49511647 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form id="form1" method="POST" action="">
    <input type="hidden" name="guardar" value="1" />

    <p>Nombre: <br/>
        <input type="text" 
               name="username" 
               value="<?php if ((isset($_smarty_tpl->tpl_vars['datos']->value['username']))) {?> <?php echo $_smarty_tpl->tpl_vars['datos']->value['username'];
}?>"
               />
    </p>

    <p>Password: <br/>
        <input type="password" 
               name="password"  
               value="<?php if ((isset($_smarty_tpl->tpl_vars['datos']->value['password']))) {?> <?php echo $_smarty_tpl->tpl_vars['datos']->value['password'];
}?>"
               />
    </p>

    <input type="submit" value="Guardar" />

</form><?php }
}
