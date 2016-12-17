<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $this->titulo; ?></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css'] ?>normalize.css">
        <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css'] ?>estilos.css">
        <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css'] ?>helpers.css">
        <script src="<?php echo BASE_URL; ?>public/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>public/js/jquery.validate.js" type="text/javascript"></script>        
        <?php if (isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
            <?php for ($i = 0; $i < count($_layoutParams['js']); $i++): ?>
                <script src="<?php echo $_layoutParams['js'][$i] ?>" type="text/javascript"></script>
            <?php endfor; ?>        
        <?php endif ?>        
    </head>
    <body>
        <div id="main">
            <div id="header">
                <div id="logo">
                    <h1><?php echo APP_NAME; ?></h1>
                </div>
            </div>

            <div id="menu_top">
                <ul>
                    <?php if (isset($_layoutParams['menu'])): ?>
                        <?php for ($i = 0; $i < count($_layoutParams['menu']); $i++): ?>
                            <li>
                                <a href="<?php echo $_layoutParams['menu'][$i]['enlace']; ?>">
                                    <?php echo $_layoutParams['menu'][$i]['titulo']; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div id="content">
                <noscript>
                    <p>
                        Para el correcto funcionamiento debe tener javascript habilitado
                    </p>
                </noscript>
                <div id="error">
                    <?php
                    if (isset($this->_error)) {
                        echo $this->_error;
                    }
                    ?>
                </div>