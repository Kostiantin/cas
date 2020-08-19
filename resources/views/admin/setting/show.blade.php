@if (!empty($isEditMode))
<form action="{{ route('settings.store') }}">

    @if (!empty($setting))
        <input type="hidden" name="id" value="{{$setting->id}}"/>
    @endif

@endif
    <div class="elemContainer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>{{ __('Name') }}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="name" value="@if (!empty($setting->name)){{ $setting->name }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($setting->name)){{ $setting->name }} @endif
                        @endif

                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('Value') }}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="value" value="@if (!empty($setting->value)){{ $setting->value }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($setting->value)){{ $setting->value }} @endif
                        @endif

                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('Description') }}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <textarea class="form-control" name="description" rows="3">@if (!empty($setting->description)){{ $setting->description }} @endif</textarea>
                            <div class="err-container"></div>
                        @else
                            @if (!empty($setting->description)){{ $setting->description }} @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@if (!empty($isEditMode))
</form>
@endif