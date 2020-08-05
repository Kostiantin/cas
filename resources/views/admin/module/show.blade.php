@if (!empty($module->id))
<form action="{{ route('modules.store',$module->id) }}">
@endif
    <div class="elemContainer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Name:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="name" value="@if (!empty($module->name)){{ $module->name }} @endif" />
                        @else
                            @if (!empty($module->name)){{ $module->name }} @endif
                        @endif
                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Code:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="code" value="@if (!empty($module->code)){{ $module->code }} @endif" />
                        @else
                            @if (!empty($module->code)){{ $module->code }} @endif
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <textarea class="form-control" name="description" rows="3">@if (!empty($module->description)){{ $module->description }} @endif</textarea>
                        @else
                            @if (!empty($module->description)){{ $module->description }} @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@if (!empty($module->id))
</form>
@endif