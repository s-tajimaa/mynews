@extends('layouts.profile')

@section('title', 'プロフィールページ')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィールページ</h2>
            </div>
        </div>
    </div>
@endsection