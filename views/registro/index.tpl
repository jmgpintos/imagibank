<h2>Registro</h2>

<form name="form1" method="post" action="">

    <input type="hidden" value="1" name="enviar" />

    <p>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{if (isset($datos.nombre))} {$datos.nombre}{/if}">
    </p>

    <p>
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" value="{if (isset($datos.usuario))} {$datos.usuario}{/if}">
    </p>



    <p>
        <label for="email">email</label>
        <input type="text" name="email" id="email" value="{if (isset($datos.email))} {$datos.email}{/if}">
    </p>

    <p>
        <label for="password">password</label>
        <input type="text" name="password" id="password" value="{if (isset($datos.password))} {$datos.password}{/if}">
    </p>

    <p>
        <label for="confirmar">confirmar</label>
        <input type="text" name="confirmar" id="confirmar" value="">
    </p>

    <p>
        <input type="submit" value="enviar">
    </p>


</form>