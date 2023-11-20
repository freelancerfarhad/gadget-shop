@extends('Layouts.front_app')
@section('frontend_content')
    
@include('components.frontend.menuBar');
@include('components.frontend.verify');
@include('components.frontend.footer');

<script>
    (async () => {
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');
    })()
</script>

 @endsection
