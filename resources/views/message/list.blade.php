@extends('layouts.app', ['page_title' => 'Welcome!'])

@section('html_header')
        <!-- Additional header tags -->
@endsection

@section('content')
<div class="container">
    @auth
    <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <form method="POST" action="{{ url('add') }}" aria-label="{{ __('Add new message') }}">
                @csrf
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Ошибка!</strong> {{ $errors->first() }}
                    </div>
                @endif
                <h6 class="border-bottom border-gray pb-2 mb-0">{{ __('Add new message') }}</h6>
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea id="text" class="form-control" name="text" autofocus>{{ old('text') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send message') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endauth
    <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="border-bottom border-gray pb-2 mb-0">{{ __('List of messages') }}</h6>
        @if (count($messages) > 0)
            @foreach ($messages->all() as $message)
            <div class="media text-muted pt-3">
                <img data-src="" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="{{ \App\Models\User::find($message->user_id)->gravatar }}" data-holder-rendered="true">
                <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                    <strong class="d-block float-right text-gray-dark small">{{ date('d.m.Y H:i:s', strtotime($message->created_at)) }}</strong>
                    <strong class="d-block text-gray-dark">{{ $message->name }}</strong>
                    <div class="text-muted">{{ html_entity_decode($message->text) }}</div>
                    @auth
                    @if(Auth::user()->id == $message->user_id)
                        <div class="float-right">
                            <form action="{{ url('message/'.$message->id) }}" method="POST" onsubmit="if(!confirm('Удалить сообщение?')) return false;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Удалить
                                </button>
                            </form>
                        </div>
                    @endif
                    @endauth
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center text-muted">
                {{ __('no messages were found') }}
            </div>
        @endif
        </div>
    </div>
</div>

@endsection
