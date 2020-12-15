<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <div class="text-center"> {{Session::get('success')}}</div>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">
                    <div class="text-center"> {{Session::get('error')}}</div>
                </div>
            @elseif(Session::has('warning'))
                <div class="alert alert-warning">
                    <div class="text-center"> {{Session::get('warning')}}</div>
                </div>
            @endif
        </div>
    </div>
</div>
