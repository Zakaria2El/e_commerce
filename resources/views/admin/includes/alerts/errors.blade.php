@if(Session::has('error'))
    <div class="row ml-2 mr-2">
        <button type="text" class="btn btn-lg btn-block btn-outline-danger" id="type-error">
            {{Session::get('error')}}
        </button>

    </div>
@endif

