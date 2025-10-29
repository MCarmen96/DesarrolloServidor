 <h1>Lista depart</h1>
    <?php 

        foreach($lista as $element){
            echo "<li> {$element ['dnombre']}, {$element ['loc']}, {$element ['depart_no']}</li>"."<a href='/delete?id={$element['depart_no']}'>Eliminar</a>". " <a href='/edit?id={$element['depart_no']}'>Editar</a>";

        }

    ?>
<br><br>
<a href="/departNew">Añadir departamentos</a>