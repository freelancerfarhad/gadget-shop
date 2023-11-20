<h2  class="form-text text-danger">Update your profile than buy product.</h2>


<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputEmail1">Customer Name <span style="color:red;">*</span></label>
            <input type="text" id="cus_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Customer City <span style="color:red;">*</span></label>
            <input type="text"id="cus_city" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Customer Number <span style="color:red;">*</span></label>
            <input type="text"id="cus_phone" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Customer State <span style="color:red;">*</span></label>
            <input type="text"id="cus_state" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Customer Address <span style="color:red;">*</span></label>
            <input type="text" id="cus_add"class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Customer Country <span style="color:red;">*</span></label>
            <input type="text" id="cus_country"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Customer Fax <span style="color:red;">*</span></label>
            <input type="text"id="cus_fax" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Customer Post Code <span style="color:red;">*</span></label>
            <input type="text"id="cus_postcode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputEmail1">Shipping Name <span style="color:red;">*</span></label>
            <input type="text"id="ship_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Shipping City <span style="color:red;">*</span></label>
            <input type="text"id="ship_city" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Shipping Number <span style="color:red;">*</span></label>
            <input type="text"id="ship_phone" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Shipping State <span style="color:red;">*</span></label>
            <input type="text"id="ship_state" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Shipping Address <span style="color:red;">*</span></label>
            <input type="text"id="ship_add" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Shipping Country <span style="color:red;">*</span></label>
            <input type="text" id="ship_country"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    </div>
    <div class="col-md-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Shipping Post Code <span style="color:red;">*</span></label>
            <input type="text"id="ship_postcode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
    <div class="form-group">
      <button type="submit" onclick="CreateProfileOrUpdate()" class="btn btn-danger">Save Changes</button></div>
    </div>
</div>


  <script>
    async function CreateProfileOrUpdate(){
        let cus_name = document.getElementById('cus_name').value;
        let cus_city = document.getElementById('cus_city').value;
        let cus_phone = document.getElementById('cus_phone').value;
        let cus_state = document.getElementById('cus_state').value;
        let cus_add = document.getElementById('cus_add').value;
        let cus_country = document.getElementById('cus_country').value;
        let cus_fax = document.getElementById('cus_fax').value;
        let cus_postcode = document.getElementById('cus_postcode').value;

        let ship_name = document.getElementById('ship_name').value;
        let ship_city = document.getElementById('ship_city').value;
        let ship_phone = document.getElementById('ship_phone').value;
        let ship_state = document.getElementById('ship_state').value;
        let ship_add = document.getElementById('ship_add').value;
        let ship_country = document.getElementById('ship_country').value;
        let ship_postcode = document.getElementById('ship_postcode').value;

        let postBody={
            "cus_name":cus_name,
            "cus_city":cus_city,
            "cus_phone":cus_phone,
            "cus_state":cus_state,
            "cus_add":cus_add,
            "cus_country":cus_country,
            "cus_fax":cus_fax,
            "cus_postcode":cus_postcode,
            "ship_name":ship_name,
            "ship_city":ship_city,
            "ship_phone":ship_phone,
            "ship_state":ship_state,
            "ship_add":ship_add,
            "ship_country":ship_country,
            "ship_postcode":ship_postcode,
        }
        $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
        let res=await axios.post("/createProfile",postBody);
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');

        if(res.data['msg']==='success'){
            alert('success');
    }
    else{
        alert('fails');
    }

    }
    async function ProfileDetails() {

let res = await axios.get("/readProfile");
if (res.data['data'] !== null) {

    document.getElementById('cus_name').value = res.data['data']['cus_name']
    document.getElementById('cus_add').value = res.data['data']['cus_add']
    document.getElementById('cus_city').value = res.data['data']['cus_city']
    document.getElementById('cus_state').value = res.data['data']['cus_state']
    document.getElementById('cus_postcode').value = res.data['data']['cus_postcode']
    document.getElementById('cus_phone').value = res.data['data']['cus_phone']
    document.getElementById('cus_country').value = res.data['data']['cus_country']
    document.getElementById('cus_fax').value = res.data['data']['cus_fax']
    document.getElementById('ship_name').value = res.data['data']['ship_name']
    document.getElementById('ship_add').value = res.data['data']['ship_add']
    document.getElementById('ship_city').value = res.data['data']['ship_city']
    document.getElementById('ship_state').value = res.data['data']['ship_state']
    document.getElementById('ship_postcode').value = res.data['data']['ship_postcode']
    document.getElementById('ship_country').value = res.data['data']['ship_country']
    document.getElementById('ship_phone').value = res.data['data']['ship_phone']


}


}

    
  </script>