@extends('Layouts.front_app')
@section('frontend_content')
    
@include('components.frontend.menuBar');
@include('components.frontend.WishList');

@include('components.frontend.topBrands');
@include('components.frontend.footer');

<script>
    (async () => {
        await Category();
        await WishList();
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        await TopBrands();
    })()
</script>

 @endsection
