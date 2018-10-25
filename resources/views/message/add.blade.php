@extends('layouts.app', ['page_title' => 'Welcome!'])

@section('html_header')
        <!-- Additional header tags -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add new message') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('add') }}" aria-label="{{ __('Add new message') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <textarea id="text" class="form-control" name="text" autofocus>{{ old('text') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send message') }}
                                </button>
                            </div>
                            <div class="col-sm-6 text-right text-muted">автор: {{ Auth::user()->name }}</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
