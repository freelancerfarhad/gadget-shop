<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <div class="modal-content">
                    
                    {{-- <form action="{{route('product.store')}}" method="post"enctype="multipart/form-data"id="save-form">
                        @csrf --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Procudt</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-12 p-1">
                                    <label class="form-label">Brand <span style="color:red;"> *</span></label>
                                    <select type="text" class="form-control form-select" id="pBrand"name="brand_id">
                                        <option disabled selected>Select Brand</option>
                                    </select>
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Category <span style="color:red;"> *</span></label>
                                    <select type="text" class="form-control form-select" id="pCategory"name="category_id">
                                        <option disabled selected>Select Category</option>
                                    </select>
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label"> Price <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="productPrice"name="price">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label"> Discount <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="productDiscount"name="discount">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label"> Discount Price <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="discountPrice"name="discount_price">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label"> In Stock <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="productStock"name="stock">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label"> Rating (star) <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="productRating"name="star">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Product Remark <span style="color:red;"> *</span></label>
                                    <select name="remark" id="remark"class="form-control"name="remark">
                                        <option value=""readonly disabled>Select Product position</option>
                                        <option value="popular">Popular</option>
                                        <option value="new">New</option>
                                        <option value="top">Top</option>
                                        <option value="special">Special</option>
                                        <option value="trending">Trending</option>
                                    </select>
                                </div>
                            </div><!-------end col--------->
                            <div class="col-md-6">
                                <div class="col-12 p-1">
                                    <label class="form-label">Product title <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="productTitle"name="title">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">short description <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="productDes"name="short_des">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Color <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="productColor"name="color">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Size <span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="productSize"name="size">
                                </div>

                                <div class="col-12 p-1">
                                    <label class="form-label">Product Thumbnail <span style="color:red;"> *</span></label>
                                    <img id="showImage"src="https://dummyimage.com/300x400/" width="100"height="100">
                                    <input id="productImg" type="file"oninput="showImage.src=window.URL.createObjectURL(this.files[0])" class="form-control" name="image">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Long Description <span style="color:red;"> *</span></label>
                                    <textarea name="logn_des" id="detailsDes" cols="30" rows="10"class="form-control"></textarea>
                                </div>
                            </div><!-------end col--------->


                      
                        </div><!------------row end------------>
                        <hr>
                        <p>Multipule Image Upload Less Then 4</p>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="col-12 p-1">
                                    <label class="form-label">Product Image select onlly (4) <span style="color:red;"> *</span></label>
                                    <div class="row"id="preview_img"></div>
                                    <input type="file" id="detailsImg1" class="form-control"name="detailsImg[]"multiple="">
                                    
                                </div>
                            </div>

                        </div><!------------row end------------>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                  
                    <button id="create-modal-close"type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>

                    <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            {{-- </form> --}}
            </div>
    </div>
</div>



<script>
    FillBrandDropDown();

    FillCategoryDropDown();

async function FillBrandDropDown(){
    let res = await axios.get("/brand-list")
    res.data.forEach(function (item,i) {
        let option=`<option value="${item['id']}">${item['brandName']}</option>`
        $("#pBrand").append(option);
    })
}
async function FillCategoryDropDown(){
    let res = await axios.get("/category-list")
    res.data.forEach(function (item,i) {
        let option=`<option value="${item['id']}">${item['categoryName']}</option>`
        $("#pCategory").append(option);
    })
}




async function Save() {

    let productBrand=document.getElementById('pBrand').value;
    let productCategory=document.getElementById('pCategory').value;
    let productPrice = document.getElementById('productPrice').value;
    let productDiscount = document.getElementById('productDiscount').value;
    let discountPrice = document.getElementById('discountPrice').value;
    let productStock = document.getElementById('productStock').value;
    let productRating = document.getElementById('productRating').value;
    let remark = document.getElementById('remark').value;
    let productTitle = document.getElementById('productTitle').value;
    let productDes = document.getElementById('productDes').value;
    let productImg = document.getElementById('productImg').files[0];
    let productColor = document.getElementById('productColor').value;
    let productSize = document.getElementById('productSize').value;
    let detailsDes = document.getElementById('detailsDes').value;
    let detailsImg1 = document.getElementById('detailsImg1').files[0];

    if (productBrand.length === 0) {
        errorToast("Product Brand Required !");
    }else if(productCategory.length===0){
        errorToast("Product Category Required !");
    }else if(productPrice.length===0){
        errorToast("Product Price Required !");
    }else if(productDiscount.length===0){
        errorToast("Product duscount Required !");
    }else if(discountPrice.length===0){
        errorToast("Product Discount Price Required !");
    }else if(productStock.length===0){
        errorToast("Product sock  Required !");
    }else if(productRating.length===0){
        errorToast("Product Rating  Required !");
    }else if(remark.length===0){
        errorToast("Product Position  Required !");
    }else if(productTitle.length===0){
        errorToast("Product Title  Required !");
    }else if(productDes.length===0){
        errorToast("Product Des  Required !");
    }else if(productColor.length===0){
        errorToast("Product  color Required !");
    }else if(productSize.length===0){
        errorToast("Product  Size Required !");
    }else if(detailsDes.length===0){
        errorToast("Product  Long Des Required !");
    }else if(!productImg){
        errorToast("Product Image Required !");
    }else if(!detailsImg1){
        errorToast("Product Details Image-only (4) Required !");
    }else {

       

        let formData=new FormData();
        formData.append('image',productImg);
        formData.append('title',productTitle);
        formData.append('short_des',productDes);
        formData.append('price',productPrice);
        formData.append('discount',productDiscount);
        formData.append('discount_price',discountPrice);
        formData.append('stock',productStock);
        formData.append('star',productRating);
        formData.append('remark',remark);
        formData.append('category_id',productCategory);
        formData.append('brand_id',productBrand);
        formData.append('color',productColor);
        formData.append('size',productSize);
        formData.append('logn_des',detailsDes);
        formData.append('detailsImg',detailsImg1);// Multiple Image Select by One Field

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }
        document.getElementById('create-modal-close').click();
        showLoader();
        let res = await axios.post("/create-product",formData,config);
        hideLoader();

        if(res.status===200 && res.data['status']==='success'){
            successToast(res.data['message']);
            document.getElementById("save-form").reset();
            await getList();
        }
        else{
            errorToast("Request fail !");
        }
    }
}

</script>
<script>
    $(document).ready(function(){
     $('#detailsImg1').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
    </script>