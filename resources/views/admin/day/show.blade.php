@if (!empty($isEditMode))
<form action="{{ route('days.store') }}">

    @if (!empty($day))
        <input type="hidden" name="id" value="{{$day->id}}"/>
    @endif

@endif
    <div class="elemContainer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>{{ __('Day Topic') }}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="name" value="@if (!empty($day->name)){{ $day->name }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($day->name)){{ $day->name }} @endif
                        @endif

                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('Connections') }}:</strong>

                    <div class="column-parent">
                       {{-- @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="value" value="@if (!empty($day->value)){{ $day->value }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($day->value)){{ $day->value }} @endif
                        @endif--}}

                    </div>

                </div>
            </div>
        </div>
    </div>
@if (!empty($isEditMode))
</form>
@endif