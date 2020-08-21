@if (!empty($isEditMode))
<form action="{{ route('modules.store') }}">

    @if (!empty($module))
        <input type="hidden" name="id" value="{{$module->id}}"/>
    @endif

@endif
    <div class="elemContainer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>{{__('Name')}}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="name" value="@if (!empty($module->name)){{ $module->name }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($module->name)){{ $module->name }} @endif
                        @endif

                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('Code')}}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="code" value="@if (!empty($module->code)){{ $module->code }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($module->code)){{ $module->code }} @endif
                        @endif

                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('Description')}}:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <textarea class="form-control" name="description" rows="3">@if (!empty($module->description)){{ $module->description }} @endif</textarea>
                            <div class="err-container"></div>
                        @else
                            @if (!empty($module->description)){{ $module->description }} @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@if (!empty($isEditMode))
</form>
@endif