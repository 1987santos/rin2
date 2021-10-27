@extends('layouts.app')

@section('content')

<div class="container">
    <div class="table-responsive justify-content-center">
        <div class="col-md-12">
            <form method="GET" action="{{ route('notification_dashboard') }}">                
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label for="notification_type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-8">
                                <select name="notification_type" id="notification_type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="marketing" {{ (request()->get('notification_type') == 'marketing' ? "selected":"") }}>Marketing</option>
                                    <option value="invoices" {{ (request()->get('notification_type') == 'invoices' ? "selected":"") }}>Invoice</option>
                                    <option value="system" {{ (request()->get('notification_type') == 'system' ? "selected":"") }}>System</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label for="notification_type" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-8">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="read" {{ (request()->get('status') == 'read' ? "selected":"") }}>Read</option>
                                    <option value="unread" {{ (request()->get('status') == 'unread' ? "selected":"") }}>Unread</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="notification_type" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ request()->get('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Search') }}
                        </button>
                        <a href="{{ route('notification_dashboard') }}" class="btn btn-primary" role="button" aria-disabled="true">Refresh</a>
                    </div>
                </div>                
            </form>
            
            <div class="card">
                <div class="card-header">{{ __('Notification List') }}
                    <a href="{{ route('create_notification') }}" class="btn btn-primary float-right" role="button" aria-disabled="true">Send Notification</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Type') }}</th>
                                <th scope="col">{{ __('User Name') }}</th>
                                <th scope="col">{{ __('Message') }}</th>
                                <th scope="col">{{ __('Status / Read at') }}</th>
                                <th scope="col">{{ __('Expiry date') }}</th>
                            </tr>
                        </thead>
                        <tbody>   
                            @forelse($notifications as $key=>$notification)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$notification->type}}</td>
                                <td>{{$notification->notifiable->name}}</td>
                                <td>{{$notification->data['message']}}</td>
                                <td>{{$notification->read_at?? 'Unread'}}</td>
                                <td>{{$notification->expiry_date}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" align="center">{{ __('No record found') }}</td>
                            </tr>
                            @endforelse 
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $notifications->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
