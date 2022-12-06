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
                            <td></td>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
