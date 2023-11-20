@extends('Layouts.front_app')
@section('cssstyle')
    <style>
   
        .middle {
    position: relative;
    width: 100%;
    max-width: 500px;
    margin-top: 10px;
    display: inline-block;
}
.slider {
    position: relative;
    z-index: 1;
    height: 10px;
    margin: 0 15px;
}
.slider>.track {
    position: absolute;
    z-index: 1;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    border-radius: 5px;
    background-color: #b5d7f1;
}
.slider>.range {
    position: absolute;
    z-index: 2;
    left: 25%;
    right: 25%;
    top: 0;
    bottom: 0;
    border-radius: 5px;
    background-color: #27a0ff;
}
.slider>.thumb {
    position: absolute;
    z-index: 3;
    width: 30px;
    height: 30px;
    background-color: #27a0ff;
    border-radius: 50%;
}

.slider>.thumb.left {
    left: 25%;
    transform: translate(-15px, -10px);
}
.slider>.thumb.right {
    right: 25%;
    transform: translate(15px, -10px);
}
.range_slider {
    position: absolute;
    pointer-events: none;
    -webkit-appearance: none;
    z-index: 2;
    height: 10px;
    width: 100%;
    opacity: 0;
}
.range_slider::-webkit-slider-thumb {
    pointer-events: all;
    width: 30px;
    height: 30px;
    border-radius: 0;
    border: 0 none;
    background-color: red;
    cursor: pointer;
    -webkit-appearance: none;
}
#multi_range {
    margin: 0 auto;
    background-color: #27a0ff;
    border-radius: 20px;
    margin-top: 20px;
    text-align: center;
    width: 90px;
    font-weight: 500;
    font-size: 1.25em;
    color: #fff;
}
    </style>
@endsection
@section('frontend_content')
    
@include('components.frontend.menuBar');
@include('components.frontend.byCategoryList');

@include('components.frontend.topBrands');
@include('components.frontend.footer');

<script>
    (async () => {
        await Category();

        await ByCategory();
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');

        await TopBrands();
    })()

</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 </script>
<script>
    
const input_left = document.getElementById("input_left");
const input_right = document.getElementById("input_right");

const thumb_left = document.querySelector(".slider > .thumb.left");
const thumb_right = document.querySelector(".slider > .thumb.right");
const range = document.querySelector(".slider > .range");

const set_left_value = () => {
    const _this = input_left;
    const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

    _this.value = Math.min(parseInt(_this.value), parseInt(input_right.value) - 1);

    const percent = ((_this.value - min) / (max - min)) * 100;
    thumb_left.style.left = percent + "%";
    range.style.left = percent + "%";
};

const set_right_value = () => {
    const _this = input_right;
    const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

    _this.value = Math.max(parseInt(_this.value), parseInt(input_left.value) + 1);

    const percent = ((_this.value - min) / (max - min)) * 100;
    thumb_right.style.right = 100 - percent + "%";
    range.style.right = 100 - percent + "%";
};

input_left.addEventListener("input", set_left_value);
input_right.addEventListener("input", set_right_value);

function left_slider(value) {
    document.getElementById('left_value').innerHTML = value;
}
function right_slider(value) {
    document.getElementById('right_value').innerHTML = value;
}
</script>

 @endsection
