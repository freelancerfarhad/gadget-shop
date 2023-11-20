<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Wish List</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{url("/")}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">This Page</a></li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>



{{-- <div class="mt-5">
    <div class="container my-5">
        <div id="byList" class="row">
        </div>
    </div>
</div> --}}
<div class="section">
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive wishlist_table">
                	<table class="table"id="emptyTable">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-stock-status">Stock Status</th>
                                <th class="product-add-to-cart"></th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        @if (Cookie::get('token') !==null)
                        <tbody id="TableData">

                        </tbody>
                        @else
                        <h1 class="text-danger">Wishlist Not added</h1>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    async function WishList(){
        try{
            let res=await axios.get(`/wishlist`);
        $("#TableData").empty();
        res.data['data'].forEach((item,i)=>{
            let EachItem=`<tr>
                            	<td class="product-thumbnail"><a href="/details?id=${item['product']['id']}"><img src="${item['product']['image']}" alt="product1"></a></td>
                                <td class="product-name" data-title="Product"><a href="#">${item['product']['title']}</a></td>
                                <td class="product-price" data-title="Price">$ ${item['product']['price']}</td>
                                <td class="product-price" data-title="Price"> ${item['product']['stock']}</td>
                                <td class="product-add-to-cart"><a href="/details?id=${item['product']['id']}" class="btn btn-fill-out btn-sm"><i class="icon-basket-loaded"></i> Add Product</a></td>
                                <td class="product-remove" data-title="Remove"><a class='remove' href="#"data-id="${item['product']['id']}"><i class="ti-close"></i></a></td>
                            </tr>`
            $("#TableData").append(EachItem);
        })

     
        $(".remove").on('click',function () {
            let id= $(this).data('id');
            RemoveWishList(id);
        })
        }catch (e) {
            if(e.response.status===401){
               
            }
        }



    }

  async function RemoveWishList(id){
      $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
        let res=await axios.get("/deletewishlist/"+id);
      $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        if(res.status===200) {
            await WishList();
            await GetWishList();
        }
        else{
            alert("Request Fail")
        }
    }

</script>
