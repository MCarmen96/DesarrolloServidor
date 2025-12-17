<form action="/procesarForm" method="post" enctype="multipart/form-data">

    @csrf
    <input type="text" name="name" placeholder="escribe...">
    <label for="">Sube stu foto aqui</label>
    <input type="file" name="image">
    <button type="submit">Enviar</button>

</form>

@if($errors->any())
    <ul>

        @foreach ($errors->all() as $error)
            <li style="color:red">{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if(session ('success'))
    <ul>
        <li style="color:green">
            {{ session('success') }}
        </li>
    </ul>
@endif
