@extends('layouts.app', ['page_title' => 'Welcome!'])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h6 class="border-bottom border-gray pb-2 mb-0">{{ __('User list') }}</h6>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>E-mail</th>
                            <th class="text-center">Удаление чужих сообщений</th>
                        </tr>
                    </thead>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <form method="POST" id="save_prop_form_{{ $user->id }}" action="{{ url('save/'.$user->id) }}">
                                {{ csrf_field() }}
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="save-prop_{{ $user->id }}" name="is_admin" {{ !$user->is_admin ?"":"checked"}}
                                    onchange="event.preventDefault();
                                           document.getElementById('save_prop_form_{{ $user->id }}').submit();">
                                    <label class="custom-control-label" for="save-prop_{{ $user->id }}">&nbsp;</label>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
