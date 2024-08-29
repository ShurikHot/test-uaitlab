@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Створення нового коду дефекту</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body" bis_skin_checked="1">
                        <form action="{{ route('defect-codes.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $defectCodeEdit['name'] ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent ID</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="">No parent</option>
                                    @foreach($tree as $item)
                                        <option value="{{ $item['code_1C'] }}" {{ (old('parent_id', $defectCodeEdit['parent_id'] ?? '') == $item['code_1C']) ? 'selected' : '' }}>
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
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
