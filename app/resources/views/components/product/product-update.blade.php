<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="" method="post"enctype="multipart/form-data"id="save-form">
                    @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Procudt</h5>
            </div>
            <div class="modal-body">
                {{-- <form id="save-form"> --}}
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-12 p-1">
                                <label class="form-label">Brand <span style="color:red;"> *</span></label>
                                <select type="text" class="form-control form-select" id="pBrand"name="brand_id"required>
                                    <option disabled selected>Select Brand</option>
                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Category <span style="color:red;"> *</span></label>
                                <select type="text" class="form-control form-select" id="pCategory"name="category_id"required>
                                    <option disabled selected>Select Category</option>
                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label"> Price <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="productPrice"name="price"required>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label"> Discount <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="productDiscount"name="discount"required>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label"> Discount Price <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="discountPrice"name="discount_price"required>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label"> In Stock <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="productStock"name="stock"required>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label"> Rating (star) <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="productRating"name="star"required>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Product Remark <span style="color:red;"> *</span></label>
                                <select name="remark" id="remark"class="form-control"name="remark"required>
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
                                <input type="text" class="form-control" id="productTitle"name="title"required>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">short description <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="productDes"name="short_des"required>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Color <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="productColor"name="color"required>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Size <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="productSize"name="size"required>
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Product Thumbnail <span style="color:red;"> *</span></label>
                                <img id="showImage"src="https://dummyimage.com/300x400/" width="100"height="100">
                                <input id="productImg" type="file"oninput="showImage.src=window.URL.createObjectURL(this.files[0])" class="form-control" name="image"required>
                                <input type="text" class="d-none" id="updateID">
                                <input type="text" class="d-none" id="filePath">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Long Description <span style="color:red;"> *</span></label>
                                <textarea name="logn_des" id="detailsDes" cols="30" rows="10"class="form-control"required></textarea>
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
                                <input type="file" id="detailsImg1" class="form-control"name="detailsImg[]"multiple=""required>
                                
                            </div>
                        </div>

                    </div><!------------row end------------>
                </div>
            {{-- </form> --}}
            </div>
            <div class="modal-footer">
              
                <button id="create-modal-close"type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>

                <button  id="save-btn" class="btn btn-sm  btn-success" >Save</button>
            </div>
        </form>
            </div>
    </div>
</div>


<script>
    FillCategoryDropDown();

    async function FillCategoryDropDown(){
    let res = await axios.get("/category-list")
    res.data.forEach(function (item,i) {
        let option=`<option value="${item['id']}">${item['categoryName']}</option>`
        $("#pCategory").append(option);
    })
}
async function FillUpUpdateForm(id,filePath){

    document.getElementById('updateID').value=id;
    document.getElementById('filePath').value=filePath;
    document.getElementById('showImage').src=filePath;


    showLoader();
    await FillCategoryDropDown();

    let res=await axios.post("/product_by_id",{id:id})
    hideLoader();

    document.getElementById('productTitle').value=res.data['title'];
    document.getElementById('productPrice').value=res.data['price'];
    document.getElementById('productDes').value=res.data['short_des'];
    document.getElementById('pCategory').value=res.data['category_id'];

}



</script>