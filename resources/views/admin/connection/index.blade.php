@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row mb-40">
        <div class="col-md-12 margin-tb">
            <h2>{{ __('Connections') }}</h2>
        </div>
        <div class="col-md-12">
            <div class="releasesWrp" id="releases">
                <ul class="releases">
                    <li>
                        <!-- Release Item -->
                        <ul class="releaseRow releaseHeadings">
                            <li class="rcol rcol_3 tc" data-sortby="release_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                            <li class="rcol rcol_7 tc" data-sortby="release_artwork"><i class="fa fa-picture-o" aria-hidden="true"></i></li>
                            <li class="rcol rcol_20" data-sortby="release_title">Title <i class="fa fa-sort" aria-hidden="true"></i></li>
                            <li class="rcol rcol_10" data-sortby="release_artist">Artist <i class="fa fa-sort" aria-hidden="true"></i></li>
                            <li class="rcol rcol_10 tc" data-sortby="release_type">Type <i class="fa fa-sort" aria-hidden="true"></i></li>
                            <li class="rcol rcol_7 tc" data-sortby="release_date">Date <i class="fa fa-sort" aria-hidden="true"></i></li>
                            <li class="rcol rcol_10 tc" data-sortby="release_label">Label <i class="fa fa-sort" aria-hidden="true"></i></li>
                            <li class="rcol rcol_10 tc" data-sortby="release_isrc">ISRC <i class="fa fa-sort" aria-hidden="true"></i></li>
                            <li class="rcol rcol_5 tc tooltip_bottom_center" data-sortby="release_cps"><i class="fa fa-tachometer" title="Current Piracy Score" aria-hidden="true"></i></li>
                            <li class="rcol rcol_3 tc" data-sortby="release_status">Status <i class="fa fa-sort" aria-hidden="true"></i></li>
                            <li class="rcol rcol_7 tc" data-sortby="release_service">Service <i class="fa fa-sort" aria-hidden="true"></i></li>
                            <li class="rcol rcol_5 tc" data-sortby="release_tracks"><i class="fa fa-plus-circle" aria-hidden="true"></i></li>
                        </ul>

                        <!-- Release Item -->
                        <ul class="releaseRow" data-sort="3">
                            <li class="rcol rcol_3 tc sort" data-sortby="release_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                            <li class="rcol rcol_7 tc img" data-sortby="release_artwork"><img src="//placehold.it/50x50" alt=""/></li>
                            <li class="rcol rcol_20" data-sortby="release_title">Ibiza Classics 2010</li>
                            <li class="rcol rcol_10" data-sortby="release_artist">Judge Jules</li>
                            <li class="rcol rcol_10 tc" data-sortby="release_type">Album</li>
                            <li class="rcol rcol_7 tc" data-sortby="release_date">03/05/2015</li>
                            <li class="rcol rcol_10 tc" data-sortby="release_label">Cream</li>
                            <li class="rcol rcol_10 tc" data-sortby="release_isrc">165893829834582</li>
                            <li class="rcol rcol_5 tc tooltip_bottom_center" title="Current Piracy Score" data-sortby="release_cps">9.24</li>
                            <li class="rcol rcol_3 tc" data-sortby="release_status"><i class="fa fa-level-down" aria-hidden="true"></i></li>
                            <li class="rcol rcol_7 tc" data-sortby="release_service">Watermarked</li>
                            <li class="rcol rcol_5 tc showTracks" data-sortby="release_tracks"><i class="fa fa-plus-circle" aria-hidden="true"></i></li>
                            <li class="releaseTracks">
                                <ul class="trackRow">
                                    <li class="rcol rcol_2 tc sort" data-sortby="track_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_4 tc" data-sortby="track_artwork"><img src="//placehold.it/50x50" alt=""></li>
                                    <li class="rcol rcol_10" data-sortby="track_title">Track 1</li>
                                    <li class="rcol rcol_10" data-sortby="track_artist">Franky Knuckles</li>
                                    <li class="rcol rcol_10 tc" data-sortby="track_type">Album</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_release_date">03/05/2015</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_label">Spinin</li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_isrc">165893829834582</li>
                                    <li class="rcol rcol_5 tc tooltip_bottom_center" title="Current Piracy Score" data-sortby="track_cps">9.24</li>
                                    <li class="rcol rcol_3 tc" data-sortby="track_status"><i class="fa fa-level-up" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_service">Watermarked</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_trash">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-trash fa-stack-1x"></i>
                </span>
                                    </li>
                                </ul>
                                <ul class="trackRow">
                                    <li class="rcol rcol_2 tc sort" data-sortby="track_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_4 tc" data-sortby="track_artwork"><img src="//placehold.it/50x50" alt=""></li>
                                    <li class="rcol rcol_10" data-sortby="track_title">Track 2</li>
                                    <li class="rcol rcol_10" data-sortby="track_artist">Franky Knuckles</li>
                                    <li class="rcol rcol_10 tc" data-sortby="track_type">Album</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_release_date">03/05/2015</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_label">Spinin</li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_isrc">165893829834582</li>
                                    <li class="rcol rcol_5 tc tooltip_bottom_center" title="Current Piracy Score" data-sortby="track_cps">9.24</li>
                                    <li class="rcol rcol_3 tc" data-sortby="track_status"><i class="fa fa-level-up" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_service">Watermarked</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_trash">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-trash fa-stack-1x"></i>
                </span>
                                    </li>
                                </ul>
                                <ul class="trackRow">
                                    <li class="rcol rcol_2 tc sort" data-sortby="track_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_4 tc" data-sortby="track_artwork"><img src="//placehold.it/50x50" alt=""></li>
                                    <li class="rcol rcol_10" data-sortby="track_title">Track 3</li>
                                    <li class="rcol rcol_10" data-sortby="track_artist">Franky Knuckles</li>
                                    <li class="rcol rcol_10 tc" data-sortby="track_type">Album</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_release_date">03/05/2015</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_label">Spinin</li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_isrc">165893829834582</li>
                                    <li class="rcol rcol_5 tc tooltip_bottom_center" title="Current Piracy Score" data-sortby="track_cps">9.24</li>
                                    <li class="rcol rcol_3 tc" data-sortby="track_status"><i class="fa fa-level-up" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_service">Watermarked</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_trash">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-trash fa-stack-1x"></i>
                </span>
                                    </li>
                                </ul>
                                <ul class="trackRow">
                                    <li class="rcol rcol_2 tc sort" data-sortby="track_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_4 tc" data-sortby="track_artwork"><img src="//placehold.it/50x50" alt=""></li>
                                    <li class="rcol rcol_10" data-sortby="track_title">Track 4</li>
                                    <li class="rcol rcol_10" data-sortby="track_artist">Franky Knuckles</li>
                                    <li class="rcol rcol_10 tc" data-sortby="track_type">Album</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_release_date">03/05/2015</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_label">Spinin</li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_isrc">165893829834582</li>
                                    <li class="rcol rcol_5 tc tooltip_bottom_center" title="Current Piracy Score" data-sortby="track_cps">9.24</li>
                                    <li class="rcol rcol_3 tc" data-sortby="track_status"><i class="fa fa-level-up" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_service">Watermarked</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_trash">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-trash fa-stack-1x"></i>
                </span>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <!-- Release Item -->
                        <ul class="releaseRow" data-sort="4">
                            <li class="rcol rcol_3 tc sort" data-sortby="release_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                            <li class="rcol rcol_7 tc img" data-sortby="release_artwork"><img src="//placehold.it/50x50" alt=""/></li>
                            <li class="rcol rcol_20" data-sortby="release_title">Cream Trance Anthems</li>
                            <li class="rcol rcol_10" data-sortby="release_artist">Judge Jules</li>
                            <li class="rcol rcol_10 tc" data-sortby="release_type">Album</li>
                            <li class="rcol rcol_7 tc" data-sortby="release_date">03/05/2015</li>
                            <li class="rcol rcol_10 tc" data-sortby="release_label">Cream</li>
                            <li class="rcol rcol_10 tc" data-sortby="release_isrc">165893829834582</li>
                            <li class="rcol rcol_5 tc tooltip_bottom_center" title="Current Piracy Score" data-sortby="release_cps">9.24</li>
                            <li class="rcol rcol_3 tc" data-sortby="release_status"><i class="fa fa-level-down" aria-hidden="true"></i></li>
                            <li class="rcol rcol_7 tc" data-sortby="release_service">Watermarked</li>
                            <li class="rcol rcol_5 tc showTracks" data-sortby="release_tracks"><i class="fa fa-plus-circle" aria-hidden="true"></i></li>
                            <li class="releaseTracks">
                                <ul class="trackRow">
                                    <li class="rcol rcol_2 tc sort" data-sortby="track_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_4 tc" data-sortby="track_artwork"><img src="//placehold.it/50x50" alt=""></li>
                                    <li class="rcol rcol_10" data-sortby="track_title">Track 1</li>
                                    <li class="rcol rcol_10" data-sortby="track_artist">Franky Knuckles</li>
                                    <li class="rcol rcol_10 tc" data-sortby="track_type">Album</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_release_date">03/05/2015</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_label">Spinin</li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_isrc">165893829834582</li>
                                    <li class="rcol rcol_5 tc tooltip_bottom_center" title="Current Piracy Score" data-sortby="track_cps">9.24</li>
                                    <li class="rcol rcol_3 tc" data-sortby="track_status"><i class="fa fa-level-up" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_service">Watermarked</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_trash">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-trash fa-stack-1x"></i>
                </span>
                                    </li>
                                </ul>
                                <ul class="trackRow">
                                    <li class="rcol rcol_2 tc sort" data-sortby="track_sort"><i class="fa fa-bars" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_4 tc" data-sortby="track_artwork"><img src="//placehold.it/50x50" alt=""></li>
                                    <li class="rcol rcol_10" data-sortby="track_title">Track 2</li>
                                    <li class="rcol rcol_10" data-sortby="track_artist">Franky Knuckles</li>
                                    <li class="rcol rcol_10 tc" data-sortby="track_type">Album</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_release_date">03/05/2015</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_label">Spinin</li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_isrc">165893829834582</li>
                                    <li class="rcol rcol_5 tc tooltip_bottom_center" title="Current Piracy Score" data-sortby="track_cps">9.24</li>
                                    <li class="rcol rcol_3 tc" data-sortby="track_status"><i class="fa fa-level-up" aria-hidden="true"></i></li>
                                    <li class="rcol rcol_7 tc" data-sortby="track_service">Watermarked</li>
                                    <li class="rcol rcol_5 tc" data-sortby="track_trash">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="fa fa-trash fa-stack-1x"></i>
                </span>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@include('universal_modal')

@endsection
