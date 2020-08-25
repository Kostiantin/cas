@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row mb-40">
        <div class="col-md-12 margin-tb">
            <h2>{{ __('Connections') }}</h2>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="card c_panel" id="c_panel_modules">
                <div class="card-header"><h4><strong>{{ __('Modules') }}</strong></h4></div>
                <div class="card-body">

                    <div id="modules_accordion">

                        @if (!empty($modules))

                            @foreach ($modules as $module)
                                <h5>{{$module->name}}</h5>
                                <div class="acc_lvl_2 module-container" id="module-container-{{$module->id}}">

                                    <div id="modules_accordion_lvl_2">

                                        @if (!empty($settings))

                                            @php
                                                $max_amount_of_module_days = 1;
                                                $max_amount_of_lecture_slots = 1;
                                                $max_amount_of_lectures_in_slot = 1;
                                            @endphp

                                            @foreach ($settings as $setting)
                                                  @if ($setting->name == 'max_amount_of_module_days')
                                                      @php
                                                        $max_amount_of_module_days=$setting->value;
                                                      @endphp
                                                  @endif

                                                  @if ($setting->name == 'max_amount_of_lecture_slots')
                                                      @php
                                                          $max_amount_of_lecture_slots=$setting->value;
                                                      @endphp
                                                  @endif

                                                  @if ($setting->name == 'max_amount_of_lectures_in_slot')
                                                      @php
                                                          $max_amount_of_lectures_in_slot=$setting->value;
                                                      @endphp
                                                  @endif
                                            @endforeach



                                            @for ($i = 1; $i <= $max_amount_of_module_days; $i++)
                                                <h6>{{ __('Day') }} {{$i}}</h6>
                                                <div class="acc_lvl_2_content day-container" id="day-container-{{$module->id}}-{{$i}}">

                                                    @for ($z = 1; $z <= $max_amount_of_lecture_slots; $z++)
                                                        <small>{{ __('Lecture Slot') }} {{$z}}</small>
                                                        <div class="acc_lvl_3_content drpbl drpbl-module slot-container" id="slot-container-{{$module->id}}-{{$i}}-{{$z}}">
                                                            <span class="droppable-area-text">{{ __('Droppable Area') }}</span>
                                                        </div>
                                                    @endfor

                                                </div>
                                            @endfor

                                        @endif

                                    </div>

                                </div>
                            @endforeach

                        @endif

                    </div>

                </div>
                <div class="card-footer">
                    <span id="max_amount_of_lectures_in_slot" data-max_amount_of_lectures_in_slot="{{$max_amount_of_lectures_in_slot}}"></span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="card c_panel" id="c_panel_lectures">
                <div class="card-header"><h4><strong>{{__('Lectures')}}</strong></h4></div>
                <div class="card-body">

                    @if (!empty($lectures))

                      <div class="dragging-parent">
                          @foreach ($lectures as $lecture)
                            <div class="drg-elem drg-elem-lecture" data-lectureid="{{$lecture->id}}">{{ $lecture->name }}</div>
                          @endforeach
                      </div>

                    @endif

                </div>
                <div class="card-footer text-right">
                    <i title="{{ __('Add Lecture') }}" class="fa fa-plus add-lecture" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@include('universal_modal')

@endsection
