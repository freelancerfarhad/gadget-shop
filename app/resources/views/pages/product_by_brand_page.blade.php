@extends('Layouts.front_app')
@section('frontend_content')
    
@include('components.frontend.menuBar');
@include('components.frontend.byBrandList');

@include('components.frontend.topBrands');
@include('components.frontend.footer');

<script>
    (async () => {
        await Category();

        await ByBrand();
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');

        await TopBrands();
    })()

</script>

 @endsection
