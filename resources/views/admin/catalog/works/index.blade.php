@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row d-flex justify-content-between mb-2">
                    <div class=" col-sm-6">
                        <h1>Види робіт</h1>
                    </div>
                    <a href="{{route('works.create')}}" class="btn btn-primary mr-3">Додати новий</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body" bis_skin_checked="1">
                    @if($works->isNotEmpty())
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th class="w10">ID</th>
                                <th class="w10">code_1C</th>
                                <th class="w10">name</th>
                                <th class="w90">Дії</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($works as $work)
                                <tr>
                                    <td class="text-center">{{$work->id}}</td>
                                    <td class="text-center">{{$work->code_1c}}</td>
                                    <td class="text-center">{{$work->product}}</td>
                                    <th class="justify-content-center d-flex">
                                        <a href="{{route('works.edit', $work->id)}}"><button><i class="fas fa-pencil-alt"></i></button></a>
                                        <form action="{{route('works.destroy', $work->id)}}" method="post">
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
