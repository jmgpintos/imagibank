<?php
/* Smarty version 3.1.30, created on 2016-12-27 22:14:48
  from "/var/www/html/imagibank/views/layout/default/template.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5862d9c8f22e97_56260658',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '772c2f1b594a8226512cad1a4f70d9fd0d395bf4' => 
    array (
      0 => '/var/www/html/imagibank/views/layout/default/template.tpl',
      1 => 1482873287,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5862d9c8f22e97_56260658 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['titulo']->value)===null||$tmp==='' ? "Sin título" : $tmp);?>
</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
normalize.css">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
estilos.css">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
helpers.css">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
paginacion.css">
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/jquery.js" type="text/javascript"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/jquery.validate.js" type="text/javascript"><?php echo '</script'; ?>
> 

        <?php if (isset($_smarty_tpl->tpl_vars['_layoutParams']->value['js']) && count($_smarty_tpl->tpl_vars['_layoutParams']->value['js'])) {?>
            <?php echo '<?php ';?>for ($i = 0; $i < count($_layoutParams['js']); $i++): <?php echo '?>';?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_layoutParams']->value['js'], 'js');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['js']->value) {
?>
                <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
" type="text/javascript"><?php echo '</script'; ?>
>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php echo '<?php ';?>endfor; <?php echo '?>';?>        
        <?php }?>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <div id="logo">
                    <div class="padding-lg bg-info bb">
                        <h1><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_name'];?>
</h1>
                    </div>
                </div>
            </div>

            <div id="menu_top">
                <ul>
                    <?php if (isset($_smarty_tpl->tpl_vars['_layoutParams']->value['menu'])) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_layoutParams']->value['menu'], 'it');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['it']->value) {
?>
                            <li>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['it']->value['enlace'];?>
"><?php echo $_smarty_tpl->tpl_vars['it']->value['titulo'];?>
</a>
                            </li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <?php }?>
                </ul>
            </div>
            <div id="content">
                <noscript>
                <p>
                    Para el correcto funcionamiento debe tener javascript habilitado
                </p>
                </noscript>

                <?php if (isset($_smarty_tpl->tpl_vars['_error']->value)) {?>
                    <div id="error"><?php echo $_smarty_tpl->tpl_vars['_error']->value;?>
</div>
                <?php }?>

                <?php if (isset($_smarty_tpl->tpl_vars['_mensaje']->value)) {?>
                    <div id="mensaje"><?php echo $_smarty_tpl->tpl_vars['_mensaje']->value;?>
</div>
                <?php }?>

                <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['_contenido']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>



            </div>
            <div id="footer">
                Copyright &copy;<?php echo date('Y');?>
 <?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_company'];?>

            </div>
        </div>
    </body>
</html>

<?php }
}
