@if($errors->any())
    @if(get_static_option('dashboard_variant_buyer') == '02')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @foreach($errors->all() as $error)
                <li> {{$error}}</li>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger">
            <ul class="list-none">
                <button type="button btn-sm" class="close" data-dismiss="alert">×</button>
                @foreach($errors->all() as $error)
                    <li> {{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif

