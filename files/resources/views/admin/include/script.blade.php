<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/ruang-admin.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

@yield('script')

<script>
    setTimeout(function () {
        $('.status').fadeOut('slow')
    }, 1500);
</script>


<script>
    setTimeout(function () {
        $('.danger').fadeOut('slow')
    }, 1500);
</script>

<script type="text/javascript">
    $("select[name='category_id']").change(function(){
        var category_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "{{route('select-ajax')}}",
            method: 'POST',
            data: {category_id:category_id, _token:token},
            success: function(data) {
                if (category_id == '')
                {
                    $('.block-hide').hide();
                    $('.block-cat-hide').hide();
                } else {
                    $('.block-hide').show();
                }
                $("select[name='subcategory_id']").html('');
                $("select[name='subcategory_id']").html(data.options);
            }
        });
    });
</script>

<script type="text/javascript">
    $("select[name='subcategory_id']").change(function(){
        var subcategory_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "{{route('select-ajax')}}",
            method: 'POST',
            data: {subcategory_id:subcategory_id, _token:token},
            success: function(data) {
                if (subcategory_id == '')
                {
                    $('.block-cat-hide').hide();
                } else {
                    $('.block-cat-hide').show();
                }
                $("select[name='categoryproduct_id']").html('');
                $("select[name='categoryproduct_id']").html(data.options);
            }
        });
    });
</script>
