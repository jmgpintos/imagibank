<?php
/* Smarty version 3.1.30, created on 2016-12-27 22:37:52
  from "/var/www/html/imagibank/views/registro/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5862df3025d045_13218665',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '186f2f7e9ef70f7494b1cb67e2add16d3e736579' => 
    array (
      0 => '/var/www/html/imagibank/views/registro/index.tpl',
      1 => 1482874670,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5862df3025d045_13218665 (Smarty_Internal_Template $_smarty_tpl) {
?>
<h2>Registro</h2>

<form name="form1" method="post" action="">

    <input type="hidden" value="1" name="enviar" />

    <p>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php if ((isset($_smarty_tpl->tpl_vars['datos']->value['nombre']))) {?> <?php echo $_smarty_tpl->tpl_vars['datos']->value['nombre'];
}?>">
    </p>

    <p>
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" value="<?php if ((isset($_smarty_tpl->tpl_vars['datos']->value['usuario']))) {?> <?php echo $_smarty_tpl->tpl_vars['datos']->value['usuario'];
}?>">
    </p>



    <p>
        <label for="email">email</label>
        <input type="text" name="email" id="email" value="<?php if ((isset($_smarty_tpl->tpl_vars['datos']->value['email']))) {?> <?php echo $_smarty_tpl->tpl_vars['datos']->value['email'];
}?>">
    </p>

    <p>
        <label for="password">password</label>
        <input type="text" name="password" id="password" value="<?php if ((isset($_smarty_tpl->tpl_vars['datos']->value['password']))) {?> <?php echo $_smarty_tpl->tpl_vars['datos']->value['password'];
}?>">
    </p>

    <p>
        <label for="confirmar">confirmar</label>
        <input type="text" name="confirmar" id="confirmar" value="">
    </p>

    <p>
        <input type="submit" value="enviar">
    </p>


</form><?php }
}
