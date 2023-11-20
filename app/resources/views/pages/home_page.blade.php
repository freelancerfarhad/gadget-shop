@extends('Layouts.front_app')
@section('frontend_content')
    
@include('components.frontend.menuBar');
@include('components.frontend.heroSlider');
@include('components.frontend.topCategories');
@include('components.frontend.excluveProducteds');
@include('components.frontend.topBrands');
@include('components.frontend.footer');

<script>
    (async () => {
        await Category();
        await Hero();
        await TopCategory();
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        await Popular();
        await New();
        await Top();
        await Special();
        await Trending();
        await TopBrands();
    })()

</script>

 @endsection
