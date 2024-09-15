@extends('Admin.layouts.master')
@section('content')
<div class="row">
    @if(Auth::check() && Auth::user()->role == 'marketing')
    <div class="col-xl-4 col-12">
        <div class="small-box box-inverse bg-img bg-danger" data-overlay="5">
            <div class="inner">
                <h3>{{ $total_produk }}</h3>
                <div class="text-white fw-600 fs-18 mb-2 mt-5">Produk</div>
            </div>
            <div class="icon text-white">
                <span class="icon-Cart2"><span class="path1"></span><span class="path2"></span></span>
            </div>
            <a href="{{route('produk.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-xl-4 col-12">
        <div class="small-box box-inverse bg-img bg-success" data-overlay="5">
            <div class="inner">
                <h3>{{ $total_pesanan }}</h3>
                <div class="text-white fw-600 fs-18 mb-2 mt-5">Pesanan</div>
            </div>
            <div class="icon text-white">
                <span class="icon-Equalizer"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
            </div>
            <a href="{{route('pesanan.pesanan')}}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    @endif

    @if(Auth::check() && Auth::user()->role == 'supervisor')
    <div class="col-xl-4 col-12">
        <div class="small-box box-inverse bg-img bg-danger" data-overlay="5">
            <div class="inner">
                <h3>{{ $total_produk }}</h3>
                <div class="text-white fw-600 fs-18 mb-2 mt-5">Produk</div>
            </div>
            <div class="icon text-white">
                <span class="icon-Cart2"><span class="path1"></span><span class="path2"></span></span>
            </div>
            <a href="{{route('produk.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-xl-4 col-12">
        <div class="small-box box-inverse bg-img bg-success" data-overlay="5">
            <div class="inner">
                <h3>{{ $total_pesanan }}</h3>
                <div class="text-white fw-600 fs-18 mb-2 mt-5">Pesanan</div>
            </div>
            <div class="icon text-white">
                <span class="icon-Equalizer"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
            </div>
            <a href="{{route('pesanan.pesanan')}}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-xl-4 col-12">
        <div class="small-box box-inverse bg-img bg-info" data-overlay="5">
            <div class="inner">
                <h3>{{ $total_penjualan }}</h3>
                <div class="text-white fw-600 fs-18 mb-2 mt-5">Penjualan</div>
            </div>
            <div class="icon text-white">
                <span class="icon-Chart-line"><span class="path1"></span><span class="path2"></span></span>
            </div>
            <a href="{{route('penjualan.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="col-xl-4 col-12">
        <div class="small-box box-inverse bg-img bg-warning" data-overlay="5">
            <div class="inner">
                <h3>{{ $total_user }}</h3>
                <div class="text-white fw-600 fs-18 mb-2 mt-5">Pengguna</div>
            </div>
            <div class="icon text-white">
                <span class="icon-User"><span class="path1"></span><span class="path2"></span></span>
            </div>
            <a href="{{route('pengguna.tablePengguna')}}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    @endif

    @if(Auth::check() && Auth::user()->role == 'owner')
    <div class="col-xl-4 col-12">
        <div class="small-box box-inverse bg-img bg-info" data-overlay="5">
            <div class="inner">
                <h3>{{ $total_penjualan }}</h3>
                <div class="text-white fw-600 fs-18 mb-2 mt-5">Penjualan</div>
            </div>
            <div class="icon text-white">
                <span class="icon-Chart-line"><span class="path1"></span><span class="path2"></span></span>
            </div>
            <a href="{{route('penjualan.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    @endif
</div>
@endsection