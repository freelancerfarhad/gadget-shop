@extends('Layouts.front_app')
@section('frontend_content')
    @section('cssstyle')
    <style>
        * {box-sizing: border-box}
        body {font-family: "Lato", sans-serif;}
        
        /* Style the tab */
        .tab {
          float: left;
          border: 1px solid #ccc;
          background-color: #f1f1f1;
          width: 30%;
          height: 300px;
        }
        
        /* Style the buttons inside the tab */
        .tab button {
          display: block;
          background-color: inherit;
          color: black;
          padding: 22px 16px;
          width: 100%;
          border: none;
          outline: none;
          text-align: left;
          cursor: pointer;
          transition: 0.3s;
          font-size: 17px;
        }
        
        /* Change background color of buttons on hover */
        .tab button:hover {
          background-color: #ddd;
        }
        
        /* Create an active/current "tab button" class */
        .tab button.active {
          background-color: #ccc;
        }
        
        /* Style the tab content */
        .tabcontent {
          float: left;
          padding: 0px 12px;
          border: 1px solid #ccc;
          width: 70%;
          border-left: none;
          height: 300px;
        }
        </style>
    @endsection
@include('components.frontend.menuBar');
{{-- @include('components.frontend.profileForm'); --}}

<div class="container mb-5">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-12">
    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</button>
          <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Orders</button>
       </div>
        <div class="tab-content w-100" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            @include('components.frontend.profileForm')
          </div>
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            @include('components.frontend.userOrder')
          </div>
    </div>
      </div>
    
</div>
</div>
</div>
@include('components.frontend.footer');

<script>
    (async () => {
        await Category();
        await OrderListItem();
        await ProfileDetails();
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');
    })()
</script>

 @endsection