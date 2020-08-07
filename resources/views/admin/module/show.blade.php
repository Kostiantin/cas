@if (!empty($isEditMode))
<form action="{{ route('courses.store') }}">

    @if (!empty($sequence))
        <input type="hidden" name="id" value="{{$sequence->id}}"/>
    @endif

@endif
    <div class="elemContainer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Name:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="name" value="@if (!empty($sequence->name)){{ $sequence->name }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($sequence->name)){{ $sequence->name }} @endif
                        @endif

                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Code:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="code" value="@if (!empty($sequence->code)){{ $sequence->code }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($sequence->code)){{ $sequence->code }} @endif
                        @endif

                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <textarea class="form-control" name="description" rows="3">@if (!empty($sequence->description)){{ $sequence->description }} @endif</textarea>
                            <div class="err-container"></div>
                        @else
                            @if (!empty($sequence->description)){{ $sequence->description }} @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@if (!empty($isEditMode))
</form>
@endif