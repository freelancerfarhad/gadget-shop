@extends('Layouts.front_app')
@section('frontend_content')
    
@include('components.frontend.menuBar');
@include('components.frontend.ProductDetails');
@include('components.frontend.ProductSpecification');
@include('components.frontend.topBrands');
@include('components.frontend.footer');

<script>
    (async () => {
        await Category();
        await productDetails();
        await productReview();
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        await TopBrands();
    })()
</script>

 @endsection
