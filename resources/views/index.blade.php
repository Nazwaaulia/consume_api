<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>consume REST API students</title>
</head>
<body>
  <form action=""method="get">
    @csrf
    <input type="text"name="search"placeholder="cari nama...">
    <button type="sumbit">cari</button>
  </form>
  <br>
  <a href="{{route('add')}}">Tambah data</a>
  <a href="{{route('trash')}}"style="background: orange;color: white;">Lihat data terhapus </a>
  @if (Session::get('success'))
  <p style="padding: 5px 10px; background:green; color:white; margin: 10px;">
    {{{Session::get('success')}}}</p>
  @endif

        @foreach ($students as $student)
        <ol>
            <li>NIS : {{ $student['nis'] }}</li>
            <li>Nama : {{ $student['nama'] }}</li>
            <li>Rayon : {{ $student['rayon'] }}</li>
            <li>Aksi : <a href="{{route('edit',$student['id'])}}">Edit</a></li>
            <form action="{{route('delete',$student['id'])}}" method="POST">
              @csrf
              @method('DELETE')
              <input type="submit" value="Hapus">
            </form>

        </ol>
        @endforeach
</body>
</html>