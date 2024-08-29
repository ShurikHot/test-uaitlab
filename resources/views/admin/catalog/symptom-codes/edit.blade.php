@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редагування симптому</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body" bis_skin_checked="1">
                    @if($symptomCodeEdit)

                        <form action="{{ route('symptom-codes.update', $symptomCodeEdit['id']) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{ $symptomCodeEdit['id'] ?? '' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="code_1C">Code 1С</label>
                                <input type="text" class="form-control" id="code_1C" name="code_1C" value="{{ old('code_1C', $symptomCodeEdit['code_1C'] ?? '') }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $symptomCodeEdit['name'] ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent ID</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="">No parent</option>
                                    @foreach($tree as $item)
                                        <option value="{{ $item['code_1C'] }}" {{ (old('parent_id', $symptomCodeEdit['parent_id'] ?? '') == $item['code_1C']) ? 'selected' : '' }}>
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="is_folder" name="is_folder" {{ old('is_folder', $symptomCodeEdit['is_folder'] ?? false) ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="is_folder">Folder</label>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="is_deleted" name="is_deleted" {{ old('is_deleted', $symptomCodeEdit['is_deleted'] ?? false) ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="is_deleted">Deleted</label>
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
