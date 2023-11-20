<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Brand</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Brand Name <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="brandName">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Brand Image <span style="color:red;"> *</span></label>
                                <img id="showImage"src="https://dummyimage.com/300x400/" width="100"height="100">
                                <input type="file"oninput="showImage.src=window.URL.createObjectURL(this.files[0])" class="form-control" id="brandImg">
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

    async function Save() {

        let brandName = document.getElementById('brandName').value;
        let brandImg = document.getElementById('brandImg').files[0];

        if (brandName.length === 0) {
            errorToast("Brand Name Required !")
        }else if(!brandImg){
        errorToast("Brand Image Required !");
    }
        else {
            let formData=new FormData();
        formData.append('brandImg',brandImg);
        formData.append('brandName',brandName);
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }

        document.getElementById('modal-close').click();
        showLoader();
        let res = await axios.post("/create-brand",formData,config);
        hideLoader();

        if(res.status===200 && res.data['status']==='success'){
            successToast(res.data['message']);
            document.getElementById("save-form").reset();
            await BrandgetList();
        }
        else{
            errorToast("Request fail !");
        }
        }
    }

</script>