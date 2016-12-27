<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{$titulo|default:"Sin título"}</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="{$_layoutParams.ruta_css}normalize.css">
        <link rel="stylesheet" href="{$_layoutParams.ruta_css}estilos.css">
        <link rel="stylesheet" href="{$_layoutParams.ruta_css}helpers.css">
        <link rel="stylesheet" href="{$_layoutParams.ruta_css}paginacion.css">
        <script src="{$_layoutParams.root}public/js/jquery.js" type="text/javascript"></script>
        <script src="{$_layoutParams.root}public/js/jquery.validate.js" type="text/javascript"></script> 

        {if isset($_layoutParams.js) && count($_layoutParams.js)}
            <?php for ($i = 0; $i < count($_layoutParams['js']); $i++): ?>
            {foreach item=js from=$_layoutParams.js }
                <script src="{$js}" type="text/javascript"></script>
            {/foreach}
            <?php endfor; ?>        
        {/if}
    </head>
    <body>
        <div id="main">
            <div id="header">
                <div id="logo">
                    <div class="padding-lg bg-info bb">
                        <h1>{$_layoutParams.configs.app_name}</h1>
                    </div>
                </div>
            </div>

            <div id="menu_top">
                <ul>
                    {if isset($_layoutParams.menu)}
                        {foreach item=it from=$_layoutParams.menu}
                            <li>
                                <a href="{$it.enlace}">{$it.titulo}</a>
                            </li>
                        {/foreach}
                    {/if}
                </ul>
            </div>
            <div id="content">
                <noscript>
                <p>
                    Para el correcto funcionamiento debe tener javascript habilitado
                </p>
                </noscript>

                {if isset($_error)}
                    <div id="error">{$_error}</div>
                {/if}

                {if isset($_mensaje)}
                    <div id="mensaje">{$_mensaje}</div>
                {/if}

                {include file=$_contenido}


            </div>
            <div id="footer">
                Copyright &copy;{'Y'|date} {$_layoutParams.configs.app_company}
            </div>
        </div>
    </body>
</html>

