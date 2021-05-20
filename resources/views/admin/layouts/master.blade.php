
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thememinister.com/crm/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:06:57 GMT -->
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title') - Way Shop</title>
<meta name="csrf-token" content="{{csrf_token()}}">
      <link rel="shortcut icon" href="{{asset('admin-assets/dist/img/ico/favicon.png')}}" type="image/x-icon">
      <link href="{{asset('admin-assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('admin-assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('admin-assets/plugins/lobipanel/lobipanel.min.css')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('admin-assets/plugins/pace/flash.css')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('admin-assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('admin-assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('admin-assets/themify-icons/themify-icons.css')}}" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
      <link href="{{asset('admin-assets/plugins/emojionearea/emojionearea.min.css')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('admin-assets/plugins/monthly/monthly.css')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('admin-assets/dist/css/stylecrm.css')}}" rel="stylesheet" type="text/css"/>
   </head>
   <body class="hold-transition sidebar-mini">
       <div class="wrapper">
       @include('sweetalert::alert')

         @include('admin.layouts.header')
         @include('admin.layouts.sidebar')
         @yield("content")
         @include('admin.layouts.footer')
       </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="{{asset('admin-assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}" type="text/javascript"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
       minDate:0,
       dateFormat:'yy-mm-dd'
    });
  } );
    </script>

    <script>
$(document).ready(function(){
      //product status start
   $('.ProductStatus').change(function(){
      var id = $(this).attr('rel');
          if($(this).prop("checked")==true){
             $.ajax({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'post',
                url : '{{URL("productstatus")}}',
                data : {status:'1',id:id},
                success:function(data){
                   $("#message_success").show();
                  setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000);
                },error:function(){
                   alert("Error");
                }
             });

          }else{
            $.ajax({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'post',
                url : '{{URL("productstatus")}}',
                data : {status:'0',id:id},
                success:function(data){
                   $("#message_error").show();
                   setTimeout(function() { $("#message_error").fadeOut('slow'); }, 2000);
                },error:function(){
                   alert("Error");
                }
             });

          }
            });
         //product status end
         //category status start
         $('.CategoryStatus').change(function(){
      var id = $(this).attr('rel');
          if($(this).prop("checked")==true){
             $.ajax({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'post',
                url : '{{URL("categoriesstatus")}}',
                data : {status:'1',id:id},
                success:function(data){
                   $("#message_success").show();
                  setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000);
                },error:function(){
                   alert("Error");
                }
             });

          }else{
            $.ajax({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'post',
                url : '{{URL("categoriesstatus")}}',
                data : {status:'0',id:id},
                success:function(data){
                   $("#message_error").show();
                   setTimeout(function() { $("#message_error").fadeOut('slow'); }, 2000);
                },error:function(){
                   alert("Error");
                }
             });

          }
            });
            ///Coupons Status start
            $('.CouponStatus').change(function(){
      var id = $(this).attr('rel');

          if($(this).prop("checked")==true){
             $.ajax({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'post',
                url : '{{URL("couponstatus")}}',
                data : {status:'1',id:id},
                success:function(data){
                   $("#message_success").show();
                  setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000);
                },error:function(){
                   alert("Error");
                }
             });

          }else{
            $.ajax({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'post',
                url : '{{URL("couponstatus")}}',
                data : {status:'0',id:id},
                success:function(data){
                   $("#message_error").show();
                   setTimeout(function() { $("#message_error").fadeOut('slow'); }, 2000);
                },error:function(){
                   alert("Error");
                }
             });

          }
            });


})

</script>
<script>
  $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="display:flex;"><input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;"/><input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;"/><input type="text" name="price[]" id="price" placeholder="Price" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;"/><input type="text" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;"/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
      <script src="{{asset('admin-assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/lobipanel/lobipanel.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript">    </script>
      <script src="{{asset('admin-assets/plugins/fastclick/fastclick.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/dist/js/custom.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/modals/classie.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/modals/modalEffects.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/chartJs/Chart.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/counterup/waypoints.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/plugins/monthly/monthly.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin-assets/dist/js/dashboard.js')}}" type="text/javascript"></script>
         <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
         <script>
         $(document).ready( function () {
         $('#table_id').DataTable({
               "paging":false,

         });


   </body>
</html>