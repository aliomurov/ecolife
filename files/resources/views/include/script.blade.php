<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{asset('js/all.js')}}"></script>

<script type="text/javascript" src="{{asset('js/slick.js')}}"></script>

<script src="{{asset('js/star-rating.js')}}" type="text/javascript"></script>
<script src="{{asset('js/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('js/ru.js')}}" type="text/javascript"></script>


@yield('script')


<script>
    $('.multiple-items').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 3,
        dots: true,
    });
</script>

<script>
    $('.multiple-item').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 3,
        dots: true,
        autoplay: true
    });
</script>

<script>
    setTimeout(function () {
        $('.message').hide('slow')
    }, 1500);
</script>
