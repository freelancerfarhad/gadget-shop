@extends('Layouts.front_app')
@section('cssstyle')
    <style>
        
    </style>
@endsection
@section('frontend_content')
@include('components.frontend.menuBar');
@include('components.frontend.byProductCart');
@include('components.frontend.paymentMEthod');
@include('components.frontend.footer');

<script>
    (async () => {
        await Category();

        await byProductCart();
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');


    })()

</script>

 @endsection
