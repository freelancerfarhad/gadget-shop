<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name <span style="color:red;"> *</span></label>
                                <input type="text" class="form-control" id="categoryName">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Category Image <span style="color:red;"> *</span></label>
                                <img id="showImage"src="https://dummyimage.com/300x400/" width="100"height="100">
                                <input type="file"oninput="showImage.src=window.URL.createObjectURL(this.files[0])" class="form-control" id="categoryImg">
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

let categoryName = document.getElementById('categoryName').value;
let categoryImg = document.getElementById('categoryImg').files[0];

    if (categoryName.length === 0) {
        errorToast("category Name Required !")
    }else if(!categoryImg){
    errorToast("category Image Required !");
    }
    else {
        let formData=new FormData();
    formData.append('categoryImg',categoryImg);
    formData.append('categoryName',categoryName);
    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
    }

    document.getElementById('modal-close').click();
    showLoader();
    let res = await axios.post("/create-category",formData,config);
    hideLoader();

    if(res.status===200 && res.data['status']==='success'){
        successToast(res.data['message']);
        document.getElementById("save-form").reset();
        await CategorygetList();
    }
    else{
        errorToast("Request fail !");
    }
    }
}


</script>