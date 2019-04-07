<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Ajax &mdash; Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <br>
            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">Tambah Data</a>
        <br>
        <br>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody id="dataTable">
            
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="formSave" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="modalTambahTitle">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="closeModalTambah" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
        </div>
    </div>

    <button id="openEditModal" data-toggle="modal" data-target="#modalEdit"></button>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="modalEditTitle">Edit Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <img id="img-data" src="" alt="" width="30" height="30"><br>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto_edit" name="foto">
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" class="form-control" id="nis_edit" name="nis">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama_edit" name="nama">
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas_edit" name="kelas">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="closeModalEdit" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <span id="id_data" id__="" style="display: none;"></span>
        </form>
        </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        function loadDataTable(){
            $.ajax({
                url: "{{ url('siswa/getDataTable') }}",
                success:function(data){
                    $('#dataTable').html(data);
                }
            })
        }
        loadDataTable();
        $('#formSave').submit(function(e){
            e.preventDefault();
            var request = new FormData(this);
            $.ajax({
                url: "{{ url('siswa/simpanData') }}",
                method: "POST",
                data: request,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    if(data == "sukses"){
                        $('#closeModalTambah').click();
                        $('#formSave')[0].reset();
                        alert('berhasil menambah data');
                        loadDataTable();
                    }
                }
            });
        });

        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ url('siswa/getDataSiswa') }}/"+id,
                method: "GET",
                dataType: "JSON",
                success:function(data){
                    if(data != ""){
                        $('#openEditModal').click();
                        $('#nis_edit').val(data.nis);
                        $('#nama_edit').val(data.nama);
                        $('#kelas_edit').val(data.kelas);
                        $('#id_data').attr("id__", data.id);
                        $('#img-data').attr('src', "{{ asset('UploadedFile/foto/') }}/"+data.foto);
                    }
                }
            });
        });
        $('#formEdit').submit(function(e){
            e.preventDefault();
            var request = new FormData(this);
            var id = $('#id_data').attr('id__');
            $.ajax({
                url: "{{ url('siswa/EditData') }}/"+id,
                method: "POST",
                data: request,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    if(data == "sukses"){
                        $('#closeModalEdit').click();
                        $('#formSave')[0].reset();
                        alert('berhasil memperbarui data');
                        loadDataTable();
                    }
                }
            });
        });

        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ url('siswa/hapusData') }}/"+id,
                method: "GET",
                success:function(data){
                    if(data == "sukses"){
                        alert('berhasil menghapus data');
                        loadDataTable();
                    }
                }
            })
        });
    </script>
</body>
</html>