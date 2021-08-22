<div>
    @if(session()->has('message'))
        <div aria-live="polite" aria-atomic="true" class="show" style="position: relative;z-index: 1000">
            <div style="position: absolute; top: 1rem; right: 0;">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{session()->get('message')}}
                </div>
            </div>
        </div>
    @elseif(session()->has('error'))
            <div aria-live="polite" aria-atomic="true" class="show" style="position: relative;z-index: 1000">
                <div style="position: absolute; top: 1rem; right: 0;">
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{session()->get('error')}}
                    </div>
                </div>
            </div>
    @endif
</div>

<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3000);

</script>
