<main>
    <table>
        <tr>
            <th>id</th>
            <th>Bin del carro</th>
            <th>Placa del carro</th>
            <th>Modelo</th>
            <th>Año</th>
            <th> <a href= "index.php?page= Mnt=Carros&mode=INS"></a>Nuevo</th>
        </tr>

        {{foreach Carros}}
        <tr>
            <td>{{id}}</td>
            <td>
                <a href="index.php?page=Mnt-Carros&mode=DSP&id={{id}}">{{bin}}</a>
            </td>
            <td>{{bin}}</td>
            <td>{{placaCarro}}</td>
            <td>{{modeloCarro}}</td>
            <td>{{añoCarro}}</td>
            <td>
                <a href= "index.php?page=Mnt-Carro&mode=UPD&id={{id}}"> Editar</a>&nbsp;<a href="index.php?pageMnt=Carros&mode=DEL&id={{id}}">Eliminar</a>
            </td>
        </tr>
        {{endforeach Carros}}
    </table>
</main>