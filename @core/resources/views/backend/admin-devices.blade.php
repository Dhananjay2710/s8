@extends('backend.admin-master')
@section('site-title')
    {{__('All Devices')}}
@endsection

@section('style')
    <style>
    .bg_card_color_one{
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(65,107,125,1) 35%, rgba(0,212,255,1) 100%); 
    }
    .bg_card_color_two{
        background: rgb(34,193,195);
        background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(50,120,119,1) 100%);  
    }

    .orders-child:nth-child(4n+2) .single-orders {
      background: #1dbf73;
    }
    .orders-child:nth-child(4n+2) .single-orders .icon {
      color: #1dbf73;
    }
    
    .orders-child:nth-child(4n+3) .single-orders {
      background: #C71F66;
    }
    .orders-child:nth-child(4n+3) .single-orders .icon {
      color: #C71F66;
    }
    
    .orders-child:nth-child(4n+4) .single-orders {
      background: #6560FF;
    }
    .orders-child:nth-child(4n+4) .single-orders .icon {
      color: #6560FF;
    }
      
    .single-orders {
      background: #f3733c;
      padding: 35px 30px;
      border-radius: 10px;
      position: relative;
      z-index: 0;
      overflow: hidden;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders {
        padding: 20px 20px;
      }
    }
    .single-orders .orders-shapes img {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
    .single-orders .orders-flex-content {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      gap: 30px;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders .orders-flex-content {
        display: block;
        text-align: center;
      }
    }
    .single-orders .orders-flex-content .icon {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      height: 67px;
      width: 67px;
      font-size: 40px;
      background: #fff;
      color: var(--main-color-three);
      border-radius: 50%;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders .orders-flex-content .icon {
        margin: 0 auto;
        text-align: center;
      }
    }
    .single-orders .orders-flex-content .contents .order-titles {
      font-size: 35px;
      font-weight: 700;
      line-height: 55px;
      color: #fff;
      margin: 0;
    }
    .single-orders .orders-flex-content .contents .order-para {
      font-size: 18px;
      font-weight: 500;
      line-height: 20px;
      color: #fff;
    }
    
    @media (min-width: 1400px) and (max-width: 1730px) {
      .single-orders {
        padding: 20px 20px;
      }
    
      .single-orders .orders-flex-content {
        display: block;
        text-align: center;
      }
    
      .single-orders .orders-flex-content .icon {
        margin: 0 auto;
        text-align: center;
      }
    }
         
</style>
@endsection

@section('content')
    <button class="btn btn-primary" id="openWindowBtn">
        View All Devices
    </button>

    <script>
        document.getElementById("openWindowBtn").addEventListener("click", function() {
            let url = "https://bank.ariticapp.com/ma/s/contacts?contentOnly=1";
            let windowFeatures = "width=1200,height=800,top=100,left=100,resizable=yes,scrollbars=yes";
            let newWindow = window.open(url, "ContactsWindow", windowFeatures);

            if (!newWindow || newWindow.closed || typeof newWindow.closed === "undefined") {
                alert("Popup blocked! Please allow popups for this site.");
            }
        });
    </script>
@endsection
