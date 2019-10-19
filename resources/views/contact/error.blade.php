@if(session()->get("msj")!="")
<div class="alert {{session()->get("error")}}" role="alert">
    {{session()->get("msj")}}
</div>
@endif