@foreach($siswas as $res)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td><img src="{{ asset('UploadedFile/foto/'.$res->foto) }}" alt="foto" width="30" height="30"></td>
        <td>{{ $res->nis }}</td>
        <td>{{ $res->nama }}</td>
        <td>{{ $res->kelas }}</td>
        <td>
            <a href="" id="{{ $res->id }}" class="btn btn-warning btn-sm edit">Edit</a>
            <a href="#" id="{{ $res->id }}" class="btn btn-danger btn-sm delete">Hapus</a>
        </td>
    </tr>
@endforeach