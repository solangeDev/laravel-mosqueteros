
@include('contact.error')
<a href="contact" class="btn btn-success mb-2">Agregar Contacto</a>
<a href="contact/pdf" class="btn btn-warning mb-2">Lista de Contactos</a>
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
                            @if(!empty($data->all()))
                            @foreach ($data as $detail)
                                <tr>
                                    <th scope="row">
                                        <img style="" src="contacts/{{(empty($detail->image))?"default.jpeg":$detail->image}}" class="imagen" alt="">
                                    </th>
                                    <td>{{$detail->name}}</td>
                                    <td>{{$detail->email}}</td>
                                    <td>
                                    <a href="contact/edit/{{$detail->id}}" class="btn btn-primary">Modificar</a>
                                    <form action="{{route("contact_delete",$detail->id)}}" method="post">
                                        <button class="btn btn-danger">Eliminar</button>
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr colspan="4"><td>No hay registros</td></tr>
                            @endif
                        </tbody>
                    </table>          
                </div>
            </div>
        </div>
    </div>
</div>
