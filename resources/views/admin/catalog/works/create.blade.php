@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Створення виду робіт</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body" bis_skin_checked="1">
                        <form action="{{ route('works.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="product">Name</label>
                                <input type="text" class="form-control" id="product" name="product" value="{{ old('product') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Зберегти</button>
                        </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer mb-2">

                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    @section('title', $customTitle ?? '')
@endsection