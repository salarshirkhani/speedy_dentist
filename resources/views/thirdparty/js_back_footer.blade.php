<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

<script>
    @if(Session::has('demo_error'))
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.error('{{ Session::get('demo_error') }}')
    @endif

    @if(Session::has('info'))
        toastr.success('{{ Session::get('info') }}')
    @endif

    @if(Session::has('success'))
        toastr.success('{{ Session::get('success') }}')
    @endif

    @if(Session::has('warning'))
        toastr.warning('{{ Session::get('warning') }}')
    @endif

    @if(Session::has('error'))
        toastr.error('{{ Session::get('error') }}')
    @endif

    @if(isset($errors)&&count($errors) > 0)
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}')
        @endforeach
    @endif

</script>
