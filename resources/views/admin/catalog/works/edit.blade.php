@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редагування виду робіт</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body" bis_skin_checked="1">
                    @if($work)

                        <form action="{{ route('works.update', $work->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{$work->id}}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="code_1c">Code 1С</label>
                                <input type="text" class="form-control" id="code_1c" name="code_1c" value="{{ old('code_1c', $work->code_1c ?? '') }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="product">Name</label>
                                <input type="text" class="form-control" id="product" name="product" value="{{ old('product', $work->product ??'') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Зберегти</button>
                        </form>
                    @endif
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
