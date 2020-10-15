@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}<br>
                    <input type="hidden" name="search_url" id="search_url" value="{{ route('search-connection') }}">
                    Search Connection<input type="textbox" name="search" id="search_data">
                    <table id="searched_data">
                        <thead>
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                             <th>
                                Action
                            </th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection
