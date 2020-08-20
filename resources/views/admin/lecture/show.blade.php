@if (!empty($isEditMode))
<form action="{{ route('lectures.store') }}">

    @if (!empty($lecture))
        <input type="hidden" name="id" value="{{$lecture->id}}"/>
    @endif

@endif
    <div class="elemContainer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>{{ __('Name') }}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="name" value="@if (!empty($lecture->name)){{ $lecture->name }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($lecture->name)){{ $lecture->name }} @endif
                        @endif

                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('Duration') }}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="number" class="form-control" name="duration" value="@if(!empty($lecture->duration)){{$lecture->duration}}@endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($lecture->duration)){{ $lecture->duration }} @endif
                        @endif

                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('Description') }}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <textarea class="form-control" name="description" rows="3">@if (!empty($lecture->description)){{ $lecture->description }} @endif</textarea>
                            <div class="err-container"></div>
                        @else
                            @if (!empty($lecture->description)){{ $lecture->description }} @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@if (!empty($isEditMode))
</form>
@endif