@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="GET" action="{{ route('user_list') }}">                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="notification_type" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ request()->get('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="notification_type" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control" name="email" value="{{ request()->get('email') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="notification" class="col-md-4 col-form-label text-md-right">{{ __('notification') }}</label>

                            <div class="col-md-8">
                                <select name="notification" id="notification" class="form-control">
                                    <option value="">Select</option>
                                    <option value="0" {{ (request()->get('notification') == '0' ? "selected":"") }}>Off</option>
                                    <option value="1" {{ (request()->get('notification') == '1' ? "selected":"") }}>On</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Search') }}
                        </button>
                        <a href="{{ route('user_list') }}" class="btn btn-primary" role="button" aria-disabled="true">Refresh</a>
                    </div>
                </div>                
            </form>
            <div class="card">
                <div class="card-header">{{ __('User List') }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Notification Count') }}</th>
                                <th scope="col">{{ __('Notification Setting') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>   
                            @forelse($users as $key=>$user)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{count($user->unreadNotifications)}}</td>
                                    <td>{{($user->notification) ? 'On' : 'Off'}}</td>
                                    <td>
                                        <a href="{{ route('user_dashboard', $user->id) }}" class="btn btn-primary" role="button" aria-disabled="true" target="_blank">Dashboard</a> 
                                        <a href="{{ route('user_edit', $user->id) }}" class="btn btn-primary" role="button" aria-disabled="true">Edit User</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" align="center">{{ __('No record found') }}</td>
                                </tr>
                            @endforelse    
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $users->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
