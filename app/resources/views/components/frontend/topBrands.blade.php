<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>Featured Brands</h2>
                </div>
                <p class="text-center leads">Get Your Desired Product from Featured Brand!.</p>
            </div>
        </div>
        <div id="TopBrandItem" class="row align-items-center">


        </div>
    </div>
</div>


<script>

    async function TopBrands(){
        let res=await axios.get("/brand-list");
        $("#TopBrandItem").empty()
        res.data['data'].forEach((item,i)=>{
            let EachItem= `<div class="p-2 col-2">
                <div class="item">
                    <div class="categories_box">
                        <a href="/by-brand?id=${item['id']}">
                            <img src="${item['brandImg']}" alt="cat_img1"/>
                            <span>${item['brandName']}</span>
                        </a>
                    </div>
                </div>
            </div>`
            $("#TopBrandItem").append(EachItem);
        })
    }
</script>

