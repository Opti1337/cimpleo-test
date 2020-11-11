@php
$user = auth()->user();
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">{{ __('Parameters') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('user.updateParameters', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                @foreach ($user->parameters as $key => $parameter)
                                    <div class="form-check">
                                        <input type="hidden" name="{{ $key }}" value="0">
                                        <input id="{{ $key }}" class="form-check-input" type="checkbox" name="{{ $key }}"
                                            {{ $parameter ? 'checked' : '' }} value="1">
                                        <label class="form-check-label" for="{{ $key }}">{{ __('user_parameters.' . $key) }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            @if ($user->isAdmin())
                <div class="col-md-8 mb-4">
                    <h2>{{ __('Writers') }}</h2>
                    <users-parameters-table :users="{{ \App\Models\User::writers()->get()->toJson() }}" />
                </div>
                <div class="col-md-8 mb-4">
                    <h2>{{ __('Suppliers') }}</h2>
                    <users-parameters-table :users="{{ \App\Models\User::suppliers()->get()->toJson() }}" />
                </div>
                <div class="col-md-8">
                    <h2>{{ __('Admins') }}</h2>
                    <users-parameters-table :users="{{ \App\Models\User::admins()->get()->toJson() }}" />
                </div>
            @endif
        </div>
    </div>
@endsection
