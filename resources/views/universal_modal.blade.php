<!-- universalModal -->
<div class="modal fade " id="universalModal" tabindex="-1" role="dialog" aria-labelledby="universalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <input type="hidden" value="" id="elem-id-holder">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <span class="success-message"> </span>

                <button type="button" class="btn btn-primary btn-edit">{{ __('Edit') }}</button>
                <button type="button" class="btn btn-primary btn-save">{{ __('Save') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>

            </div>
        </div>
    </div>
</div>

<!-- No Items Chosen Modal -->
<a class="btn prevent-default-link show-elem elem-hidden" id="noItemsChosenModalTrigger" href="#" data-toggle="modal" data-target="#noItemsChosenModal"  >
    &nbsp;
</a>
<div class="modal fade " id="noItemsChosenModal" tabindex="-1" role="dialog" aria-labelledby="noItemsChosenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Please choose items for bulk function') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>

    </div>
</div>

<div id="are_you_sure_text" class="elem-hidden">{{ __('Are you sure?') }}</div>