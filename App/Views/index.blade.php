@extends('Layouts.basetemplate')

@section('stylesheets')
<style>
    body {
        height:100%;
    }

    .cover_screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black */
        z-index: 1000; /* Ensure it's above other content */
    }

</style>
@endsection

@section('main')   
<div class="d-flex align-items-center mx-auto cover_screen">
    <div class="container">
        <div class="row text-center">
            <h1 class="text-success text-lg">Sybre MVC Framework</h1>
            <p>A framework project for learning about MVC</p>
        </div>
        <div class="row">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Sybre MVC Framework</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Documentation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">View Source</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('Parts.stickyfooter')
@endsection