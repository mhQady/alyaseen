<div class="modal fade" id="modal-delete_{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
    aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">@lang('main.are_you_sure')</h4>

                </div>
            </div>
            <div class="modal-footer">
                <form class="col-2" method="post" action="{{ $action }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">@lang('main.ok')</button>
                </form>
                <button type="button" class="btn btn-secondary text-white ml-auto"
                    data-bs-dismiss="modal">@lang('main.close')</button>
            </div>
        </div>
    </div>
</div>