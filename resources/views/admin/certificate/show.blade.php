@if (!empty($isEditMode))
<form action="{{ route('modules.store') }}">

    @if (!empty($certificate))
        <input type="hidden" name="id" value="{{$certificate->id}}"/>
    @endif

@endif
    <div class="elemContainer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Title:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="title" value="@if (!empty($certificate->title)){{ $certificate->title }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($certificate->title)){{ $certificate->title }} @endif
                        @endif

                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <strong>Sub Title:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <input type="text" class="form-control" name="sub_title" value="@if (!empty($certificate->sub_title)){{ $certificate->sub_title }} @endif" />
                            <div class="err-container"></div>
                        @else
                            @if (!empty($certificate->sub_title)){{ $certificate->sub_title }} @endif
                        @endif

                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>

                    <div class="column-parent">
                        @if (!empty($isEditMode))
                            <textarea class="form-control" name="description" rows="3">@if (!empty($certificate->description)){{ $certificate->description }} @endif</textarea>
                            <div class="err-container"></div>
                        @else
                            @if (!empty($certificate->description)){{ $certificate->description }} @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@if (!empty($isEditMode))
</form>
@endif