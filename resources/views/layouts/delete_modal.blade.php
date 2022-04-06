<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $ApplicationSetting->item_name }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p class="my-0 font-weight-bold">{{ __('Are You Sure You Want To Delete This Data ???') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                    <form class="btn-ok" action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
