<!-- Logout form -->

@if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
        <form id="logout-form" action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/logout" method="POST" style="display: none;">
@else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@endif

        @csrf
</form>