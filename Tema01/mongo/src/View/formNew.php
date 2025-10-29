
<h1>======AÑADIR NUEVOS DEPARTAMENTOS=======</h1>
    <form action="/create" method="post">

        <label for="">ID
            <input type="number" required name="id">
        </label>
        <label for="">Nombre Depart
            <input type="text" required name="name">
        </label>

        <label for="">Localidad
            <input type="text" required name="loc">
        </label>


        <button type="submit" class="rounded ">Guardar</button>
    </form>

    <a href="/">Volver al incio</a>