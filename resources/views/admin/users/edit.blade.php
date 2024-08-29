@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редагування користувача:</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="card-body" bis_skin_checked="1">
            <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row" bis_skin_checked="1">
                    <div class="col-sm-3" bis_skin_checked="1">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="name">Ім'я*</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Введідь ім'я користувача" value="{{ old('name', $user->name ?? '') }}">
                        </div>
                    </div>
                    <div class="col-sm-3" bis_skin_checked="1">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="name">E-mail*</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Введідь e-mail користувача" value="{{ old('email', $user->email ?? '') }}">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Оновити</button>
            </form>
        </div>

    @section('title', $customTitle ?? '')
@endsection
