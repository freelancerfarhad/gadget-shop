@section('cssstyle')
<style>
    .wishlist_count {
        position: relative;
        top: -3px;
        left: 0;
        font-size: 11px;
        background-color: #FF324D;
        border-radius: 50px;
        height: 16px;
        line-height: 16px;
        color: #fff;
        min-width: 16px;
        text-align: center;
        padding: 0 5px;
        display: inline-block;
        vertical-align: top;
        margin-left: -5px;
        margin-right: -5px;
    }
    </style>
@endsection
<header class="header_wrap fixed-top header_with_topbar">

    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <ul class="contact_detail text-center text-lg-start">
                            <li><i class="ti-mobile"></i><span>123-456-7890</span></li>
                            <li><i class="ti-email"></i><span>info@apple.com</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center text-md-end">
                        <ul class="header_list">
                            <li><a href="/policy?type=about">About</a></li>
                            @if (Cookie::get('token') !==null)
                            <li><a href="{{route('profile')}}"><i class="linearicons-user"></i>Account</a></li>
                            <li><a class="btn btn-outline-danger btn-sm " href="{{route('UserLogout')}}">Logout</a></li>
                            @else
                            <li><a class="btn btn-outline-danger btn-sm " href="{{url('login')}}">Login</a></li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom_header dark_skin main_menu_uppercase">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{url("/")}}">
                    <img class="logo_dark" src="assets/images/logo_dark.png" alt="logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-expanded="false">
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li><a class="nav-link nav_item" href="{{url("/")}}">Home</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Products</a>
                            <div class="dropdown-menu">
                                <ul id="CategoryItem">

                                </ul>
                            </div>
                        </li>
                        <li><a class="nav-link nav_item" href="{{route('wishlist')}}"><i class="ti-heart"></i> Wish <span class="wishlist_count"id="totlaWishList">0</span></a></li>
                        {{-- <li><a class="nav-link nav_item" href="{{route('cart')}}"><i class="linearicons-cart"></i> Cart <span class="cart_count">0</span></a></li> --}}
                        <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-bs-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count"id="totlaCartQty">0</span></a>
                            <div class="cart_box dropdown-menu dropdown-menu-right">
                                <ul class="cart_list">
                                    <li id="minicart">

                                    </li>
                                </ul>
                                <div class="cart_footer">
                                    <p class="cart_buttons"><a href="{{route('cart')}}" class="btn btn-fill-line view-cart">View Cart</a></p>
                                </div>
                            </div>
                        </li>
                        <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i> Search</a>
                            <div class="search_wrap">
                                <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                                <form>
                                    <input type="text" placeholder="Search" class="form-control" id="search_input">
                                    <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                                </form>
                            </div><div class="search_overlay"></div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>


<script>

    async function Category(){
        let res=await axios.get("/category-list");
        $("#CategoryItem").empty()
        res.data['data'].forEach((item,i)=>{
            let EachItem= ` <li><a class="dropdown-item nav-link nav_item" href="/by-category?id=${item['id']}">${item['categoryName']}</a></li>`
            $("#CategoryItem").append(EachItem);
        })
    }

    GetWishList();
    async function GetWishList() {
            let res=  await axios.get('{{ route('total-wishlist') }}');
            $("#totlaWishList").empty()
             document.getElementById('totlaWishList').innerText = res.data['wishlists'];
             if(res.status===200) {
            // await WishList();
        }
        else{
            alert("Request Fail")
        }
};
GetCartQty();

    async function GetCartQty() {
            let res=  await axios.get('{{ route('total-cartQty') }}');
            $("#totlaCartQty").empty()
             document.getElementById('totlaCartQty').innerText = res.data['cartqty'];
             if(res.status===200) {
            // await byProductCart();
        }
        else{
            alert("Request Fail")
        }
};
byProductMiniCart();
async function byProductMiniCart(){
        let res=await axios.get(`/list-product-cart`);
        $("#minicart").empty();
        res.data['data'].forEach((item,i)=>{
            let EachItem=`<a href="#" class="item_remove remove"data-id="${item['product']['id']}"><i class="ion-close"></i></a>
                         <a href="#"><img src="${item['product']['image']}" alt="cart_thumb1">${item['product']['title']}</a>
                        <span class="cart_quantity"> ${item['qty']} x <span class="cart_amount"> <span class="price_symbole">$</span></span>${item['price']}</span>`
            $("#minicart").append(EachItem);
        })


        $(".remove").on('click',function () {
            let id= $(this).data('id');
            RemoveCart(id);
        })


    }

  async function RemoveCart(id){
      $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
        let res=await axios.get("/remove-product-cart/"+id);
      $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        if(res.status===200) {
            await GetCartQty();
            await byProductMiniCart();
            
        }
        else{
            alert("Request Fail")
        }
}

</script>
