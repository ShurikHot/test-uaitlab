@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row d-flex justify-content-between mb-2">
                    <div class=" col-sm-6">
                        <h1>Запчастини</h1>
                    </div>
                    <a href="{{route('parts.create')}}" class="btn btn-primary mr-3">Додати новий</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body" bis_skin_checked="1">
                    @if($parts->isNotEmpty())
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th class="w10">ID</th>
                                <th class="w10">code_1C</th>
                                <th class="w10">articul</th>
                                <th class="w10">product</th>
                                <th class="w10">price</th>
                                <th class="w10">discount</th>
                                <th class="w90">Дії</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($parts as $part)
                                <tr>
                                    <td class="text-center">{{$part->id}}</td>
                                    <td class="text-center">{{$part->code_1c}}</td>
                                    <td class="text-center">{{$part->articul}}</td>
                                    <td class="text-center">{{$part->product}}</td>
                                    <td class="text-center">{{$part->price}}</td>
                                    <td class="text-center">{{$part->discount}}</td>
                                    <th class="justify-content-center d-flex">
                                        <a href="{{route('parts.edit', $part->id)}}"><button><i class="fas fa-pencil-alt"></i></button></a>
                                        <form action="{{route('parts.destroy', $part->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Підтвердіть видалення')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>Записів у довіднику поки немає...</div>
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
