<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Slider</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Slider Title <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="sliderTitle">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">product short Des <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="sliderSehortDes">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Discount (%) <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="sliderPrice">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label"> Image <span style="color:red;"> *</span></label>
                                <img id="showImage"src="https://dummyimage.com/300x400/" width="100"height="100">
                                <input type="file"oninput="showImage.src=window.URL.createObjectURL(this.files[0])" class="form-control" id="slicerImg">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Product <span style="color:red;"> *</span></label>
                                <select type="text" class="form-control form-select" id="Products"name="product_id"required>
                                    <option disabled selected>Select Product</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                  
                    <button id="modal-close"type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>

                    <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>
    FillProductDropDown();
async function FillProductDropDown(){
    let res = await axios.get("/product-list")
    res.data.forEach(function (item,i) {
        let option=`<option value="${item['id']}">${item['title']}</option>`
        $("#Products").append(option);
    })
}
    async function Save() {

        let sliderTitle = document.getElementById('sliderTitle').value;
        let sliderSehortDes = document.getElementById('sliderSehortDes').value;
        let sliderPrice = document.getElementById('sliderPrice').value;
        let Products = document.getElementById('Products').value;
        let slicerImg = document.getElementById('slicerImg').files[0];

        if (sliderTitle.length === 0) {
            errorToast("Slider Name Required !")
        }else if (sliderSehortDes.length === 0) {
            errorToast("Short Des Required !")
        }else if (sliderPrice.length === 0) {
            errorToast("Discount (%) Required !")
        }else if (Products.length === 0) {
            errorToast("Product Links Required !")
        }
        else if(!slicerImg){
        errorToast("Slider Image Required !");
    }
        else {
            let formData=new FormData();
        formData.append('image',slicerImg);
        formData.append('title',sliderTitle);
        formData.append('short_des',sliderSehortDes);
        formData.append('price',sliderPrice);
        formData.append('product_id',Products);
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }

        document.getElementById('modal-close').click();
        showLoader();
        let res = await axios.post("/create-slider",formData,config);
        hideLoader();

        if(res.status===200 && res.data['status']==='success'){
            successToast(res.data['message']);
            document.getElementById("save-form").reset();
            await SlidergetList();
        }
        else{
            errorToast("Request fail !");
        }
        }
    }

</script>