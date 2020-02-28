<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.include.link')
    </head>
    <body id="page-top">

        <div id="wrapper">
            @if(session('status'))
                <div class="alert alert-primary status" role="alert">
                    {{session('status')}}
                </div>
            @endif

            @if(session('danger'))
                <div class="alert alert-danger danger" role="alert">
                    {{session('danger')}}
                </div>
            @endif

            @include('admin.include.sidebar')

            @include('admin.include.top')
        </div>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        @include('admin.include.script')

    </body>
</html>
