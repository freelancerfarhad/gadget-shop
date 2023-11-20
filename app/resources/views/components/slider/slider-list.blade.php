<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Product Slider</h4>
                </div>
                <div class="align-items-center col">
                    <button data-toggle="modal" data-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>

                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead class="">
                <tr class="bg-light">
                    <th>No</th>
                    <th>Slider Image</th>
                    <th>Slider Title</th>
                    <th>Slider Des</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>

SlidergetList();


async function SlidergetList() {

    showLoader();
    let res = await axios.get("/ListProductBySlider");
    hideLoader();

    let tableList =$("#tableList");
    let tableData =$("#tableData");

    tableData.DataTable().destroy();
    tableList.empty();


    res.data['data'].forEach(function(item,index){
        let row = 
        `<tr>
            <td>${index+1}</td>
            <td><img src="${item['image']}" width="20"></td>
            <td>${item['title'].length > 10 ? item['title'].substring(0, 10) + ' ...' : item['title']}</td>
            <td>${item['short_des'].length > 20 ? item['short_des'].substring(0, 20) + ' ...' : item['short_des']}</td>
            <td>${new Date(item['created_at']).toLocaleDateString('us-US', {year:'numeric',month:'long',day:'numeric'})}</td>
            <td>
               <button data-path="${item['image']}"  data-id="${item['id']}"class="btn EditBtn btn-outline-success">edit</button> 
               <button data-path="${item['image']}"  data-id="${item['id']}"class="btn DeleteBtn btn-sm btn-outline-danger">delete</button> 
            </td>
         </tr>`
         tableList.append(row);
    });
    $('.EditBtn').on('click', async function () {
           let id= $(this).data('id');
           let filePath= $(this).data('path');
           await FillUpUpdateForm(id,filePath);
           $("#update-modal").modal('show');
    })

    $('.DeleteBtn').on('click',function () {
        let id= $(this).data('id');
        let path= $(this).data('path');

        $("#deleted-modal").modal('show');
        $("#deleteID").val(id);
        $("#deleteFilePath").val(path)

    })
 

    new DataTable('#tableData',{
        order:[[0,'asc']],
        lengthMenu:[5,10,15,20,30]
    });
 

    

}


</script>
