@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row d-flex justify-content-between mb-2">
                    <div class=" col-sm-6">
                        <h1>Коди симптомів</h1>
                    </div>
                    <a href="{{route('symptom-codes.create')}}" class="btn btn-primary mr-3">Додати новий</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body" bis_skin_checked="1">
                    @if($tree)
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th class="w10">ID</th>
                                <th class="w10">code_1C</th>
                                <th class="w10">name</th>
                                <th class="w10">parent_id</th>
                                <th class="w10">is_folder</th>
                                <th class="w10">is_deleted</th>
                                <th class="w10">created</th>
                                <th class="w10">edited</th>
                                <th class="w90">Дії</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($tree as $item)
                                <tr class="bg-blue">
                                    <td class="text-center">{{$item['id']}}</td>
                                    <td class="text-center">{{$item['code_1C']}}</td>
                                    <td class="text-center">{{$item['name']}}</td>
                                    <td class="text-center">{{$item['parent_id']}}</td>
                                    <td class="text-center">{{$item['is_folder']}}</td>
                                    <td class="text-center">{{$item['is_deleted']}}</td>
                                    <td class="text-center">{{$item['created']}}</td>
                                    <td class="text-center">{{$item['edited']}}</td>
                                    <th class="justify-content-center d-flex">
                                        <a href="{{route('symptom-codes.edit', $item['id'])}}"><button><i class="fas fa-pencil-alt"></i></button></a>
                                        <form action="{{route('symptom-codes.destroy', $item['id'])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Підтвердіть видалення')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </th>

                                </tr>
                                @if (isset($item['children']) && count($item['children']))
                                    @foreach($item['children'] as $child)
                                    <tr>
                                        <td class="text-center">{{$child['id']}}</td>
                                        <td class="text-center">{{$child['code_1C']}}</td>
                                        <td class="text-center">{{$child['name']}}</td>
                                        <td class="text-center">{{$child['parent_id']}}</td>
                                        <td class="text-center">{{$child['is_folder']}}</td>
                                        <td class="text-center">{{$child['is_deleted']}}</td>
                                        <td class="text-center">{{$child['created']}}</td>
                                        <td class="text-center">{{$child['edited']}}</td>
                                        <th class="justify-content-center d-flex">
                                            <a href="{{route('symptom-codes.edit', $child['id'])}}"><button><i class="fas fa-pencil-alt"></i></button></a>
                                            <form action="{{route('symptom-codes.destroy', $child['id'])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Підтвердіть видалення')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </th>
                                    </tr>
                                    @endforeach
                                @endif
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
