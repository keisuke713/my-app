@extends('layouts.community')
@section('title', 'コミュニティトップ')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="detail">
                <div class="list-group item">
                    {{ str_limit($community->detail) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
