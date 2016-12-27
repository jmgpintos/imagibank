<form id="form1" method="POST" action="">
    <input type="hidden" name="guardar" value="1" />

    <p>Nombre: <br/>
        <input type="text" 
               name="username" 
               value="{if (isset($datos.username))} {$datos.username}{/if}"
               />
    </p>

    <p>Password: <br/>
        <input type="password" 
               name="password"  
               value="{if (isset($datos.password))} {$datos.password}{/if}"
               />
    </p>

    <input type="submit" value="Guardar" />

</form>