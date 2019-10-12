
<a href="contact" class="btn btn-success mb-2">Agregar Contacto</a>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Contactos</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $detail)
                                <tr>
                                    <th scope="row">
                                    <img style="" src="contacts/{{(empty($detail->image))?"default.jpeg":$detail->image}}" class="imagen" alt="">
                                    </th>
                                    <td>{{$detail->name}}</td>
                                    <td>{{$detail->email}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>          
                </div>
            </div>
        </div>
    </div>
</div>
