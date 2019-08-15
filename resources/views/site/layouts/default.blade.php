@include('site.layouts.header')
<?php
if (!empty($message)){
    if (key($message)=="error"){
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $message["error"] }}
        </div>
        <?php
    }
    if (key($message)=="info"){
        ?>
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $message["info"] }}
        </div>
        <?php
    }
}
?>
@include('site.block.menu_top')
@yield('content')
@include('site.layouts.footer')