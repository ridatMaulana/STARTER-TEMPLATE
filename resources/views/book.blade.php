@extends('adminlte::page')

@section('title', 'Book')

@section('content_header')
    <h1 class="m-0 text-dark">Data Buku</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            {{ __('Data Buku') }}
        </div>
        <div class="card-body">
            @php
            $no = 0;
           @endphp
            @foreach ($books as $item)
            @if ($no % 3 == 0 || $no == 0)
            <div class="row">
            @endif
            <div class="card card-primary col-md-3 mr-auto">
                <div class="card-header">
                  <h2 class="card-title">{{ $item->judul }}</h2>

                  <div class="card-tools">
                    <!-- This will cause the card to collapse when clicked -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <!-- This will cause the card to be removed when clicked -->
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                @if ($item->cover !== null)
                <img src="{{ asset('storage/cover/'.$item->cover) }}" alt="" srcset="" width="100px">
                @else
                    [Gambar tidak tersedia]
                @endif
                  <h5>Penulis :{{ $item->penulis }}</h5>
                  <h5>Penerbit :{{ $item->penerbit }}</h5>
                  <h5>Tahun :{{ $item->tahun }}</h5>
                </div>
                <!-- /.card-body -->
            </div>
            @if ($no%3 == 2)
            </div>
            @endif
            @php
            $no++;
            @endphp
            @endforeach
        </div>
    </div>
</div>
@stop
