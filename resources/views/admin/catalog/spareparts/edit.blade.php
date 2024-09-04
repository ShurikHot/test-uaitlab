@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редагування запчастини</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body" bis_skin_checked="1">
                    @if($part)

                        <form action="{{ route('parts.update', $part->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{$part->id}}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="code_1c">Code 1С</label>
                                <input type="text" class="form-control" id="code_1c" name="code_1c" value="{{ old('code_1c', $part->code_1c ?? '') }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="articul">Articul</label>
                                <input type="text" class="form-control" id="articul" name="articul" value="{{ old('articul', $part->articul ??'') }}">
                            </div>

                            <div class="form-group">
                                <label for="product">Name</label>
                                <input type="text" class="form-control" id="product" name="product" value="{{ old('product', $part->product ??'') }}">
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $part->price ??'') }}">
                            </div>

                            <div class="form-group">
                                <label for="discount">Discount(%)</label>
                                <input type="text" class="form-control" id="discount" name="discount" value="{{ old('discount', $part->discount ??'') }}">
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
