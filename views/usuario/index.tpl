<h2>Usuarios</h2>

{if (isset($usuarios) && count($usuarios))}
    <table>
        {foreach item=usuario from=$usuarios}
            <tr>
                <td>{$usuario.id}</td>
                <td>{$usuario.username}</td>
                <td>{$usuario.email}</td>
                <td><a href="{$_layoutParams.root}usuario/editar/{$usuario.id}">Editar</a></td>
                <td><a href="{$_layoutParams.root}usuario/eliminar/{$usuario.id}">Eliminar</a></td>
            </tr>
        {/foreach}
    </table>
    <h3>Total usuarios: {count($usuarios)}</h3>
    {else}
    <p><strong>No hay usuarios</strong></p>
{/if}


<div>
    {if (Session::accesoViewEstricto(array('admin')))}
    <a class="btn btn-aviso" href="{$_layoutParams.root}usuario/nuevo">Agregar usuario</a>
    {/if}
    <a class="btn btn-exito" href="{$_layoutParams.root}usuario/crear">Crear usuario AUTO</a>
    <a class="btn btn-exito" href="{$_layoutParams.root}usuario/editarCodigo">Editar código usuario</a>
</div>
    
{if (isset($paginacion))}{$paginacion}{/if}

<pre>

    {$usuarios|@print_r}
</pre>