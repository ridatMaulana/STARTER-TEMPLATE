@extends('adminlte::page')

@section('title', 'Book')

@section('content_header')
    <h1 class="m-0 text-dark">Data Buku</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                {{ __('Pengelolaan Buku') }}
            </div>
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
                <hr>
                <table id="table-data" class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>JUDUL</th>
                            <th>PENULIS</th>
                            <th>TAHUN</th>
                            <th>PENERBIT</th>
                            <th>COVER</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                         $no = 1;
                        @endphp
                        @foreach ($books as $book)
                            <td>{{ $no++ }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->tahun }}</td>
                            <td>{{ $book->penerbit }}</td>
                            <td>
                                @if ($book->cover !== null)
                                    <img src="{{ asset('storage/cover/'.$book->cover) }}" alt="" srcset="" width="100px">
                                @else
                                    [Gambar tidak tersedia]
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" id="btn-edit" class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#edit" data-id="1"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" title="Hapus" onclick="deleteConfirm('{{ $book->id }}', '{{ $book->judul }}')"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.book.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul Buku</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" name="penulis" id="penulis" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="year" name="tahun" id="tahun" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cover">Cover</label>
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('book.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-judul">Judul Buku</label>
                                    <input type="text" name="judul" id="edit-judul" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-penulis">Penulis</label>
                                    <input type="text" name="penulis" id="edit-penulis" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-tahun">Tahun</label>
                                    <input type="year" name="tahun" id="edit-tahun" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-penerbit">Penerbit</label>
                                    <input type="text" name="penerbit" id="edit-penerbit" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="image-area"></div>
                                <div class="form-group">
                                    <label for="edit-cover">Cover</label>
                                    <input type="file" name="cover" id="edit-cover" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="hidden" name="old-cover" id="edit-old-cover">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
<script>
    $(()=>{
        $(document).on('click', '#btn-edit', function(){
            let id = $(this).data("id");
            $('#image-area').empty();

            $.ajax({
                type: "get",
                url: "{{ url('/ajax/databuku') }}/"+id,
                dataType: 'json',
                success: (res)=>{
                    $('#edit-judul').val(res.judul);
                    $('#edit-penerbit').val(res.penerbit);
                    $('#edit-penulis').val(res.penulis);
                    $('#edit-tahun').val(res.tahun);
                    $('#edit-id').val(res.id);
                    $('#edit-old-cover').val(res.old-cover);

                    if(res.cover !== null){
                        $('#image-area').append(
                            "<img src='/storage/cover/"+res.cover+"' width='200px'>"
                        );
                    }else{
                        $('#image-area').append(
                           '[Gambar tidak tersedia]'
                        );
                    }
                },
            });
        });
    });

    function deleteConfirm(npm, judul) {
        swal.fire({
            title: "Hapus??",
            icon: 'warning',
            text: "Apakah anda yakin ingin menghapus data dengan judul "+judul+"?!",
            showCancelButton: !0,
            confirmButtonText: "Ya, lakukan!!",
            cancelButtonText: "Tidak, Batalkan!!",
            reverseButtons: !0,
        }).then((e)=>{
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{ url('buku/hapus') }}/"+npm,
                    data: {_token: CSRF_TOKEN},
                    dataType:'JSON',
                    success: (result)=>{
                        if(result.success === true){
                            swal.fire("Done!", result.message, "success");

                            setTimeout(() => {
                            location.reload();
                            }, 1000);
                        }else{
                            swal.fire("Error!", result.message, "error");
                        }
                    },
                });
            }else{
                e.dismiss;
            }
        },  (dismiss)=>{
            return false;
        });
    }
</script>
@stop
