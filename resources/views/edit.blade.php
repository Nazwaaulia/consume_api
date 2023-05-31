<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume REST API Student || Edit</title>
</head>
<body>
    <h2>Edit data siswa baru</h2>
    @if (Session::get('errors'))
    <p style="color:red">{{Session::get('errors')}}</p>
    @endif
    
    <form action="{{route('update', $student['id'])}}" method="POST">
        @csrf
        @method('PATCH')
        <div style="display: :flex; margin-bottom:15px;">
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="{{$student['nama']}}" id="nama" placeholder="nama anda...">
        </div>
        <div style="display:flex; margin button:15px">
            <label for="nis">Nis</label>
            <input type="number" name="nis" value="{{$student['nis']}}" id="nis" placeholder="NIS anda...">
        </div>

        <div style="display:flex; margin button:15px">
            <label for="rombel">Rombel</label>
            <select name="rombel"id="rombel">
                <option value="PPLG X" {{$student['rombel'] == 'PPLG X'? 'selected': ''}}>PPLG X</option>
                <option value="PPLG XI" {{$student['rombel'] == 'PPLG XI'? 'selected': ''}}>PPLG XI</option>
                <option value="PPLG XII" {{$student['rombel'] == 'PPLG XII'? 'selected': ''}}>PPLG XII</option>
            </select>
        </div>

         <div style="display:flex; margin button:15px">
            <label for="rayon">Rayon</label>
            <input type="text" name="rayon" value="{{$student['rayon']}}" id="rayon" placeholder="contoh : cib 1">
         </div>
            <button type="submit">kirim</button>
    </form>
</body>
</html>