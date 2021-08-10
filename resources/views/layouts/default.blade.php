<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
</head>
<body>

    <header>
        @include('includes.header')
    </header>

    <div class="container" style="margin-top:50px">


        <div id="main" class="row">

                @yield('content')

        </div>

    </div>

    <footer id="footer" class="page-footer text-light font-small bg-primary pt-4">
            @include('includes.footer')
    </footer>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {

        let docHeight = $(window).height();
        let footerHeight = $('#footer').height();
        let footerTop = $('#footer').position().top + footerHeight;

        if (footerTop < docHeight)
            $('#footer').css('margin-top', 10+ (docHeight - footerTop) + 'px');
    });
    </script>
</body>
</html>



