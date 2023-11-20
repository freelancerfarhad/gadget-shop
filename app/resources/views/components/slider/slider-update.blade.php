<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Updated Slider</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                    <div class="container">
                        <div class="row">

                            <div class="col-12 p-1">
                                <label class="form-label">Slider Title <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="title">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Slider Short_des <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="short_des">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Product Discount (%) <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="price">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Slider Image <span style="color:red;"> *</span></label>
                                <img id="oldImg"src="https://dummyimage.com/300x400/" width="100"height="100">
                                <input type="file"oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" class="form-control" id="sliderImgUpdate">
                                <input type="text" class="d-none" id="updateID">
                                <input type="text" class="d-none" id="filePath">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Product Links <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="product_id">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                  
                    <button id="update-modal-close"type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>

                    <button onclick="Update()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>
    
    async function FillUpUpdateForm(id,filePath){

document.getElementById('updateID').value=id;
document.getElementById('filePath').value=filePath;
document.getElementById('oldImg').src=filePath;


showLoader();
let res=await axios.post("/slider_by_id",{id:id})
hideLoader();

document.getElementById('title').value=res.data['title'];
document.getElementById('short_des').value=res.data['short_des'];
document.getElementById('price').value=res.data['price'];
document.getElementById('product_id').value=res.data['product_id'];

}

  async function Update() {

    let sliderNameUpdate = document.getElementById('title').value;
    let shortDes = document.getElementById('short_des').value;
    let Price = document.getElementById('price').value;
    let ProductLinks=document.getElementById('product_id').value;
    let updateID=document.getElementById('updateID').value;
    let filePath=document.getElementById('filePath').value;
    let sliderImgUpdate = document.getElementById('sliderImgUpdate').files[0];


        if (sliderNameUpdate.length === 0) {
            errorToast("Slider Name Required !")
        }else if (shortDes.length === 0) {
            errorToast("Slider Short_Des Required !")
        }
        if (Price.length === 0) {
            errorToast("Slider Discount (%) Required !")
        }
        if (ProductLinks.length === 0) {
            errorToast("Slider Product Links Required !")
        }
         else{
            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('image',sliderImgUpdate)
            formData.append('id',updateID)
            formData.append('title',sliderNameUpdate)
            formData.append('short_des',shortDes)
            formData.append('price',Price)
            formData.append('product_id',ProductLinks)
            formData.append('file_path',filePath)



            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/update-slider",formData,config)
            hideLoader();

            if(res.status===200 && res.data['status']==='success'){
                        document.getElementById("update-form").reset();
                        successToast(res.data['message']);
                        await SlidergetList();
                    }
                    else{
                        errorToast(res.data['message']);
                    }
                        


    }



}



</script>