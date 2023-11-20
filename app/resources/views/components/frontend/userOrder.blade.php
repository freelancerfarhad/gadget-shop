<div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No:</th>
                        <th>Payable</th>
                        <th>Shipping</th>
                        <th>Delivery</th>
                        <th>Payment</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody id="OrderList">

                </tbody>
            </table>
 </div>
 <div class="modal" id="invoiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                    {{-- <button id="modal-close"type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button> --}}
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="productLists"></tbody>
                    </table>
                </div>
            </div>
    </div>
</div>


<script>

</script>
<script>
 
    async function OrderListItem() {
        let res=await axios.get("/invoice-list");
        let json= res.data
        $("#OrderList").empty()

        if(json.length!==0){
            json.forEach((item,i)=>{
            let EachItem= 
            `<tr>
                <td>${item['id']}</td>
                <td>${item['payable']}</td>
                <td>${item['ship_details']}</td>
                <td>${item['delivery_status']}</td>
                <td>${item['payment_status']}</td>
                <td> <button data-id="${item['id']}"class="btn moreBtn btn-danger">more</button> 
             </td>
             </tr>`
            $("#OrderList").append(EachItem);
        })
   
        $('.moreBtn').on('click', async function () {
           let id= $(this).data('id');
           InvoiceProductList(id);
   
    });
    }
}

async function InvoiceProductList(id){
    $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
        let res=await axios.get("/invoice-product-list/"+id);
        $("#invoiceModal").modal('show');
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');

        $("#productLists").empty();
        res.data.forEach((item,i)=>{
            let EachProductItem= 
            `<tr>
                <td><img src="${item['product']['image']}"alt="${item['product']['title']}"width="50"height="50"></td>
                <td>${item['product']['title']}</td>
                <td>${item['qty']}</td>
                <td>${item['sale_price']}</td>
                
             </tr>`
            $("#productLists").append(EachProductItem);
        });
}


</script>