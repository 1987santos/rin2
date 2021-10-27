@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Send Notification') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('send_notification') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="notification_type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select name="notification_type" id="notification_type" class="form-control @error('notification_type') is-invalid @enderror">
                                    <option value="">Select</option>
                                    <option value="marketing" {{ (old("notification_type") == 'marketing' ? "selected":"") }}>Marketing</option>
                                    <option value="invoices" {{ (old("notification_type") == 'invoices' ? "selected":"") }}>Invoice</option>
                                    <option value="system" {{ (old("notification_type") == 'system' ? "selected":"") }}>System</option>
                                </select>
                                @error('notification_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                            <div class="col-md-6">
                                <input id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}">

                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiry_date" class="col-md-4 col-form-label text-md-right">{{ __('Expiry Date') }}</label>

                            <div class="col-md-6">
                                <input id="expiry_date" type="expiry_date" class="datepicker form-control @error('expiry_date') is-invalid @enderror" value="{{ old('expiry_date') }}" name="expiry_date" readonly>

                                @error('expiry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notify_to" class="col-md-4 col-form-label text-md-right">{{ __('Notify to') }}</label>

                            <div class="col-md-6">
                                <select name="notify_to[]" id="notify_to" multiple class="form-control @error('notify_to') is-invalid @enderror">
                                   @foreach( $users as $user )
                                        <option value="{{$user['id']}}" {{ (collect(old('notify_to'))->contains($user['id'])) ? 'selected':'' }}>{{$user['name']}}</option>
                                    @endforeach
                                </select>

                                @error('notify_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Notification') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
