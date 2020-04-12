@extends('layouts.app')

@section('content')
<div class="container">
    
    <list-component
        :auth="{{$auth}}">
    </list-component>
    
</div>
@endsection
