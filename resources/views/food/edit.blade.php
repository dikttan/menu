@extends('template.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('food.dashboard') }}">Kembali</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="content">
    <div class="container">
    @foreach($products as $p)
        <form method="post" action="/food/update/{{$p->id}}" enctype="multipart/form-data">
        
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="id_product" value="{{ $p->id }}">

        <div class="form-group">
            <label>Produk</label>
            <input type="text" name="product_name" class="form-control" value="{{ $p->product_name }}">

        </div>

        <div class="form-group">
          <label for="">Category</label>
          <select name="id_category" id="id_category" class="form-control">
            <option value="{{$p->id_category}}">{{$p->category->category_name}}</option>
          </select>
        </div>

        <div class="form-group d-flex flex-column">
          <label for="">Image</label>
          <input type="file" name="image" value="{{$p->image}}">
        </div>
        
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Simpan">
        </div>
  
        </form>
        @endforeach
        </div>
    </div>
</div>



@endsection

