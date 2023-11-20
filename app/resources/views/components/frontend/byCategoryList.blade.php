<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                {{-- <div class="page-title">
                    <h1>Category: <span id="CatName"></span></h1>
                </div> --}}
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{url("/")}}">Home</a></li>
                    <li class="breadcrumb-item this-page"><a href="#">This Page-</a></li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<div class="mt-5">
    <div class="container-fluid my-5">
        <div  class="row">
            <div class="col-sx-6 col-sm-6 col-md-3 col-lg-3 col-xl-3"style=" box-shadow: 1px -1px 15px -15px black;">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="middle">
                            <div id="multi_range">
                                <span id="left_value">25</span><span> ~ </span><span id="right_value">75</span>
                            </div>
                            <div class="multi-range-slider my-2">
                                <input type="range" id="input_left" class="range_slider" min="0" max="100" value="25" onmousemove="left_slider(this.value)">
                                <input type="range" id="input_right" class="range_slider" min="0" max="100" value="75" onmousemove="right_slider(this.value)">
                                <div class="slider">
                                    <div class="track"></div>
                                    <div class="range"></div>
                                    <div class="thumb left"></div>
                                    <div class="thumb right"></div>
                                </div>
                            </div>
                        </div>
                    </div><!---end col-->
                </div>
            </div><!---edn col--->
            <div class="col-sx-6 col-sm-6 col-md-9 col-lg-9 col-xl-9">
                <div class="row byCategoryList"id="byCategoryList">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    async function ByCategory(){
        let searchParams=new URLSearchParams(window.location.search);
        let id=searchParams.get('id');


        let res=await axios.get(`/ListProductByCategory/${id}`);
        $("#byCategoryList").empty();
        res.data['data'].forEach((item,i)=>{
            let EachItem=`<div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="/details?id=${item['id']}">
                                            <img src="${item['image']}" alt="product_img9">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li><a href="/details?id=${item['id']}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="/details?id=${item['id']}">${item['title']}</a></h6>
                                        <div class="product_price">
                                            <span class="price">$ ${item['price']}</span>
                                        </div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:${item['star']}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
            $("#byCategoryList").append(EachItem);

            // $("#CatName").text( res.data['data'][0]['category']['categoryName']);
            $(".this-page").text( res.data['data'][0]['category']['categoryName']);
        })
    }

</script>
<script>
        $(document).ready(function(e){
           $('.range_slider').on('change',function(){
               let left_value = $('#input_left').val();
               let right_value = $('#input_right').val();
               // alert(left_value+right_value);
               $.ajax({
                   url:"{{ route('search.products') }}",
                   method:"GET",
                   data:{left_value:left_value, right_value:right_value},
                   success:function(res){
                      $('#byCategoryList').html(res);
                   }
               });
           });
        });
</script>
