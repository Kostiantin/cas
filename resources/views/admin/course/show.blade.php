@if (!empty($isEditMode))
<form action="{{ route('modules.store') }}">

    @if (!empty($course))
        <input type="hidden" name="id" value="{{$course->id}}"/>
    @endif

@endif
    <div class="elemContainer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Title:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="title" value="@if (!empty($course->title)){{ $course->title }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($course->title)){{ $course->title }} @endif
                        @endif

                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <textarea class="form-control" name="description" rows="3">@if (!empty($course->description)){{ $course->description }} @endif</textarea>
                            <div class="err-container"></div>
                        @else
                            @if (!empty($course->description)){{ $course->description }} @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@if (!empty($isEditMode))
</form>
@endif