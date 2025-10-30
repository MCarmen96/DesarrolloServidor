
    <h1>======EDITAR DEPARTAMENTOS=======</h1>
    <form action="/update" method="post">

        <label for="">ID
            <input type="number" required name="id"  value="<?php echo $dept ?>" readonly>
        </label>
        <label for="">Nombre depart
            <input type="text" required name="name" value="<?php echo $depart ?>">
        </label>

        <label for="">localidad
            <input type="text" required name="loc" value="<?php echo $loc ?>" >
        </label>

        <button type="submit" class="rounded ">Guardar Pizza</button>
    </form>

    <a href="/">Volver</a>
