<div class="section">
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive shop_cart_table">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="TableData">

                        </tbody>
                        <tfoot>
                        	<tr>
                            	<td colspan="6" class="px-0">
                                	<div class="row g-0 align-items-center">

                                    	<div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                            {{-- <div class="coupon field_form input-group">
                                                <input type="text" value="" class="form-control form-control-sm" placeholder="Enter Coupon Code..">
                                                <div class="input-group-append">
                                                	<button class="btn btn-fill-out btn-sm" type="submit">Apply Coupon</button>
                                                </div>
                                            </div> --}}
                                    	</div>
                                        {{-- <div class="col-lg-8 col-md-6  text-start  text-md-end">
                                            <button class="btn btn-line-fill btn-sm" type="submit">Update Cart</button>
                                        </div> --}}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>
            	<div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
            	<div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6">
            	<div class="heading_s1 mb-3">
            		<h6>Your Profile Set Up Then Checkout</h6>
                </div>
                {{-- <form class="field_form shipping_calculator">
                    <div class="form-row">
                        <div class="form-group col-lg-12 mb-3">
                            <div class="custom_select">
                                <select class="form-control first_null not_chosen">
                                    <option value="">Choose a option...</option>
                                    <option value="ZW">BD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6 mb-3">
                            <input required="required" placeholder="State / Country" class="form-control" name="name" type="text">
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            <input required="required" placeholder="PostCode / ZIP" class="form-control" name="name" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12 mb-3">
                            <button class="btn btn-fill-line" type="submit">Update Totals</button>
                        </div>
                    </div>
                </form> --}}
            </div>
            <div class="col-md-6">
            	<div class="border p-3 p-md-4">
                    <div class="heading_s1 mb-3">
                        <h6>Cart Totals</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">Cart Subtotal</td>
                                    <td class="cart_total_amount"id="">$<strong id="total">$349.00</strong></td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">Shipping</td>
                                    <td class="cart_total_amount">Free Shipping</td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">Total</td>
                                    <td class="cart_total_amount">$<strong id="totals">$349.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button onclick="CheckOut()"class="btn btn-fill-out" type="submit">Proceed To CheckOut</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    async function byProductCart(){
        try{
        let res=await axios.get(`/list-product-cart`);
        $("#TableData").empty();
        res.data['data'].forEach((item,i)=>{
            let EachItem=`<tr>
                            	<td class="product-thumbnail"><a href="/details?id=${item['product']['id']}"><img src="${item['product']['image']}" alt="product1"></a></td>
                                <td class="product-name" data-title="Product"><a href="#">${item['product']['title']}</a></td>
                                <td class="product-price" data-title="Price"> ${item['qty'] } </td>
                                <td class="product-price" data-title="Price">$ ${item['price']}</td>
                                <td class="product-remove" data-title="Remove"><a class='remove' href="#"data-id="${item['product']['id']}"><i class="ti-close"></i></a></td>
                            </tr>`
            $("#TableData").append(EachItem);
        })
        await CartTotal(res.data['data']);

        $(".remove").on('click',function () {
            let id= $(this).data('id');
            RemoveCart(id);
        })

    }catch (e) {
            if(e.response.status===401){
                sessionStorage.setItem("last_location",window.location.href)
                window.location.href="/login"
            }
        }
    }
    async function CartTotal(data){
        let total =0;
        data.forEach((item)=>{
            total=total+parseFloat(item['price']);
        })
        $('#total').text(total);
        $('#totals').text(total);
    }

  async function RemoveCart(id){
      $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
        let res=await axios.get("/remove-product-cart/"+id);
      $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        if(res.status===200) {
            await byProductCart();
            await GetCartQty();
            
        }
        else{
            alert("Request Fail")
        }
}


$('.plus').on('click', function() {
        if ($(this).prev().val()) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.minus').on('click', function() {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });
 async function CheckOut(){
    try{
        $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
        $("#paymentList").empty();
        let res=await axios.get("/create-invoice");
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');

        if(res.status===200) {
            $("#paymentMethodModal").modal('show');
            res.data['data'][0]['paymentMethod'].forEach((item,i)=>{
            let EachItem= `<tr>
                            <td><img class="w-50"src="${item['logo']}"alt="prouct"></td>
                            <td><p>${item['name']}</p></td>
                            <td><a class="btn btn-danger btn-sm"href="${item['redirectGatewayURL']}">Pay</a></td>
                          </tr>`
            $("#paymentList").append(EachItem);
        })
        await RemoveCart(id);
        }
   
  
    } catch (e) {
            
        }

    }

</script>