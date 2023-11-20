<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1><span id="ContentList"></span></h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{url("/")}}">Home</a></li>
                    <li class="breadcrumb-item this-page"><a href="#">This Page</a></li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<div class="mt-5">
    <div class="container my-5">
        <div  class="row">
            <div class="col-sx-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"id="Policy">

            </div><!---edn col--->
        </div>
    </div>
</div>
<script>


    async function ByPolicy(){
        let searchParams=new URLSearchParams(window.location.search);
        let type=searchParams.get('type');
        if(type==="about"){
            $("#ContentList").text('About Us');
        }else if(type==="refund"){
            $("#ContentList").text('Refunds');
        }else if(type==="terms"){
            $("#ContentList").text('Terms & Condition');
        }else if(type==="how to buy"){
            $("#ContentList").text('How To Buy');
        }else if(type==="contact"){
            $("#ContentList").text('Contact Me');
        }else if(type==="complain"){
            $("#ContentList").text('Complains');
        }
        let res=await axios.get("/PolicyByType/"+type);
        let des=res.data['des'];
        $("#Policy").html(des);
    }

</script>
