<div class="modal" id="deleted-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deleted Category !</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <p>Are You Sure to Deleted Category !</p>
                                <input class="d-none" id="deleteID">
                                <input class="d-none" id="deleteFilePath"/>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                  
                    <button id="delete-modal-close"type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>

                    <button onclick="itemDelete()" id="save-btn" class="btn btn-sm  btn-danger" >Deleted</button>
                </div>
            </div>
    </div>
</div>

<script>

    async  function  itemDelete(){
                let id=document.getElementById('deleteID').value;
                let deleteFilePath=document.getElementById('deleteFilePath').value;
                document.getElementById('delete-modal-close').click();
                showLoader();
                let res=await axios.post("/delete-category",{id:id,file_path:deleteFilePath})
                hideLoader();
                if(res.data===1){
                    successToast("Request completed")
                    await CategorygetList();
                }
                else{
                    errorToast("Request fail!")
                }
         }
    
    
    </script>