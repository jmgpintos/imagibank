<?php
/* Smarty version 3.1.30, created on 2016-12-27 22:25:09
  from "/var/www/html/imagibank/views/usuario/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5862dc35e38067_60196401',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '203866ef500c791a9f31b865f08d94994ed8c86d' => 
    array (
      0 => '/var/www/html/imagibank/views/usuario/index.tpl',
      1 => 1482873906,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5862dc35e38067_60196401 (Smarty_Internal_Template $_smarty_tpl) {
?>
<h2>Usuarios</h2>

<?php if ((isset($_smarty_tpl->tpl_vars['usuarios']->value) && count($_smarty_tpl->tpl_vars['usuarios']->value))) {?>
    <table>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['usuarios']->value, 'usuario');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['usuario']->value) {
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['usuario']->value['id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['usuario']->value['username'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['usuario']->value['email'];?>
</td>
                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
usuario/editar/<?php echo $_smarty_tpl->tpl_vars['usuario']->value['id'];?>
">Editar</a></td>
                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
usuario/eliminar/<?php echo $_smarty_tpl->tpl_vars['usuario']->value['id'];?>
">Eliminar</a></td>
            </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </table>
    <h3>Total usuarios: <?php echo count($_smarty_tpl->tpl_vars['usuarios']->value);?>
</h3>
    <?php } else { ?>
    <p><strong>No hay usuarios</strong></p>
<?php }?>


<div>
    <?php if ((Session::accesoViewEstricto(array('admin')))) {?>
    <a class="btn btn-aviso" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
usuario/nuevo">Agregar usuario</a>
    <?php }?>
    <a class="btn btn-exito" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
usuario/crear">Crear usuario AUTO</a>
    <a class="btn btn-exito" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
usuario/editarCodigo">Editar código usuario</a>
</div>
    
<?php if ((isset($_smarty_tpl->tpl_vars['paginacion']->value))) {
echo $_smarty_tpl->tpl_vars['paginacion']->value;
}?>

<pre>

    <?php echo print_r($_smarty_tpl->tpl_vars['usuarios']->value);?>

</pre><?php }
}
