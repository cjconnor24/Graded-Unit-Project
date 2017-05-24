<noscript>
    <style type="text/css">
        .bg-container {display:none;}
    </style>
    <div class="noscriptmsg">
        <div class="col-md-6 col-md-offset-3">
        @component('components.panel',['colour'=>'danger'])
            @slot('title')
                Warning
            @endslot
        <p class="lg-icon"><span class="glyphicon glyphicon-warning-sign required"></span></p>
        <h1>Warning</h1>
        <p>You don't have javascript enabled.  Please enable to use this application.</p>
            @endcomponent
        </div>
    </div>
</noscript>
