@extends('template.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Menu Makanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('food.add') }}">Tambah Data</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="content">
    <div class="container">
        <div class="row">
        @foreach($products as $p)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                            <h5 class="m-0">{{ $p->category->category_name }}</h5>
                        </div>
                        <div class="card-body">
                            {{ $p->product_name }} <br>
                            @if($p->image)
                            <img src="{{ asset('storage/uploads/'.$p->image) }}" alt="" class="img-thumbnail"> <br>
                           @endif
                            <a href="/food/delete/{{$p->id}}" class="btn btn-success">Delete</a>
                            <a href="/food/edit/{{$p->id}}" class="btn btn-success">Edit</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



@endsection