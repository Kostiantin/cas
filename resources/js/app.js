
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/sortable.js';
import 'jquery-ui/ui/widgets/draggable.js';
import 'jquery-ui/ui/widgets/droppable.js';
import 'jquery-ui/ui/widgets/datepicker.js';
import 'jquery-ui/ui/widgets/accordion.js';

/******** REMOVE 'ARE YOU SURE' CONFIRMATION *********/
$('.sbmt-delete-form').submit(function() {
    var c = confirm("Are you sure?");
    return c;
});

/************ PREVENT DEFAULT LINKS************/
$('.prevent-default-link').click(function(e){
    e.preventDefault();
});

// add csrf header to all possible ajax requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

jQuery('body').addClass('js');

/*************** UNIVERSAL MODAL *****************/
$('#universalModal').on('show.bs.modal', function (event) {

    // empty old modal data holders
    $('#elem-id-holder').val('');
    $('.success-message').text('');

    // use target button to get data from it
    var button = $(event.relatedTarget);
    var _title = button.data('title');
    var _route = button.data('route');
    var _action = button.data('action');
    var _elemid = button.data('elemid');
    var _submitroute = button.data('submitroute');
    var _method = 'GET';

    if (button.data('method')) {
        _method = button.data('method');
    }

    var dataObj = {};

    // collect object to send
    if (_elemid) {
        dataObj.id = _elemid;
        $('#elem-id-holder').val(_elemid);
    }

    // assign title and show loading spinner
    var modal = $(this);
    modal.find('.modal-title').text(_title);
    modal.find('.modal-body').html('<div class="text-center"><div class="spinner-border text-success"></div></div>');

    // choose what modal footer buttons will be show or hidden
    if (_action == 'create' || _action == 'edit') {

        modal.find('.btn-edit').hide();
        modal.find('.btn-save').show();

        // ADD SAVE BUTTON BEHAVIOUR
        $(document).off('click', '#universalModal .btn-save');
        $(document).on('click', '#universalModal .btn-save', function(e) {

            // at first we need to remove all prev validation errors and red borders from inputs
            $('#universalModal form input, #universalModal form textarea').removeClass('errorInput');
            $('#universalModal form .err-container').text('');

            var _serializedForm = $('#universalModal form').serialize();

            // send submitted create / edit form
            if (typeof _serializedForm != 'undefined' && _serializedForm != '' && _serializedForm != null) {

                $.ajax({
                    url: _submitroute,
                    method: 'POST',
                    data: _serializedForm,
                    success: function(data) {

                        if (typeof data.success != 'undefined' && data.success != null && data.success != '') {

                            $('.success-message').text(data.success);

                            setTimeout(function(){
                                location.reload();
                            }, 1000);

                        }
                        if (typeof data.error != 'undefined') {

                            for (var errFieldName in data.error) {
                                //console.log(data.error[errFieldName]);
                                $('#universalModal form').find('[name="'+errFieldName+'"]').addClass('errorInput');
                                $('#universalModal form').find('[name="'+errFieldName+'"]').parents('.column-parent:first').find('.err-container').text(data.error[errFieldName]);
                            }
                        }

                    }
                });

            }
        });

    }
    else {
        modal.find('.btn-edit').show();
        modal.find('.btn-save').hide();

        $(document).off('click', '#universalModal .btn-edit');
        $(document).on('click', '#universalModal .btn-edit', function(e) {
            console.log('edit-clicked');
            $('#universalModal .close.close-modal').click();
            setTimeout(function() {
                console.log(button);
                $(button).parents('form:first').find('.edit-elem').click();
            }, 300);

        });

    }



    // sending ajax request to show based on _route

    if (typeof _route != 'undefined' && _route != null && _route != '') {

        $.ajax({
            url: _route,
            data: dataObj,
            success: function(data) {

                setTimeout(function(){
                    modal.find('.modal-body').html(data);
                }, 400);

            }
        });

    }

});


/* BULK FUNCTIONS*/

/*************** BULK CHECKBOX CLICK *****************/
$('#bulk_all').click(function(){
    var all_bulk_checkboxes = $(this).parents('.rows-list:first').find('.bulk_check');
    if ($(this).is(":checked")) {
        all_bulk_checkboxes.each(function(){
            $(this).prop('checked', true);
        });
    }
    else {
        all_bulk_checkboxes.each(function(){
            $(this).prop('checked', false);
        });
    }

});

/****************** BULK DELETE ********************/
$('#delete_chosen').click(function() {

    var removeElementsName = $(this).data('removeelementsname');
    var removeElementsUrl = $(this).data('removeelementsurl');


    if ($('.bulk_check:checked').length > 0) {

        var c = confirm($('#are_you_sure_text').text());

        if (c == true) {

            var removeElementsIds = '';

            $('.bulk_check:checked').each(function() {

                var _entity_id = $(this).attr('id').replace('bulk_', '');
                removeElementsIds += (removeElementsIds == '' ? '' : '&') + 'removeElementsIds[]=' + _entity_id;

            });

            var _finalString = 'removeElementsName='+removeElementsName + '&' + removeElementsIds;

            $.ajax({
                url: removeElementsUrl,
                method: 'POST',
                data: _finalString,
                success: function (data) {
                    if (typeof data.success != 'undefined' && data.success != null && data.success != '') {
                        $('.bulk_check:checked').each(function() {
                            $(this).parents('.r-actions:first').remove();
                        });
                    }
                }
            });
        }
    }
    else {
        $('#noItemsChosenModalTrigger').click();
    }

});

/********* CONNECTIONS PAGE SORTABLE ACCORDIONS ***********/

$('.drpbl.slot-container').sortable();

$( "#modules_accordion, #modules_accordion_lvl_2" ).accordion({
    active: false,
    collapsible: true
});

$('#c_panel_modules').css({'visibility': 'visible'});

// drag and drop lectures in modules
function makeDraggableLectures(selector) {
    $(selector).draggable({
        appendTo: "body",
        helper: "clone",
        start: function( event, ui ) {
            $('.ui-accordion-header').mouseover( function() {

                // auto open accordion elements when drag and move over accordion
                if ($(this).hasClass('ui-accordion-header-collapsed')) {
                    $(this).click();
                }

            });
        },
        stop: function( event, ui ) {
            // unset click on accord elem on mouseover
            $('.ui-accordion-header').unbind('mouseover');
        }
    });

    $(selector).removeClass('newly-created-lecture');
}

makeDraggableLectures(".drg-elem-lecture");

function makeDroppableModulesDaySlots(selector)
{
    $(selector).droppable({
        accept: ".drg-elem-lecture",
        hoverClass: 'highlight-droppable',
        drop: function (event, ui) {

            // change id and classes of ui elem
            var _clone_ = $(ui.draggable).clone();
            var _new_ui_id = $(_clone_).data('lectureid');

            var counter_of_existing_elms = $(this).find('.drg-elem').length;
            var number_of_max_lectures_in_slot = parseInt($('#max_amount_of_lectures_in_slot').data('max_amount_of_lectures_in_slot'));

            if ($(this).find('div[data-lectureid="'+_new_ui_id+'"]').length == 0 && counter_of_existing_elms < number_of_max_lectures_in_slot) {
                $(this).append(_clone_);
                $(this).sortable();
            }

        }
    });

    $(selector).removeClass('newly-created-module-slot');
}

makeDroppableModulesDaySlots(".drpbl-module");

// add lecture
$('.add-lecture').click(function() {
    $('#c_panel_lectures .dragging-parent').append('<div class="drg-elem drg-elem-lecture"><input type="text" value="" name="new_lecture_name" class="new_lecture_name"></div>');

    $('.new_lecture_name').focus();

    // on focus out add new lecture if name is not empty
    $('.new_lecture_name').blur(function() {

        var _the_parent = $(this).parents('.c_panel:first');
        var _current_val = $(this).val();

        $('.new_lecture_name').parent().remove();

        if (_current_val != '') {

            var _create_url = $(_the_parent).data('urlstore');


            $.ajax({
                url: _create_url,
                method: 'POST',
                data: {'name': _current_val},
                success: function(data) {

                    if (typeof data.success != 'undefined' && data.success != null && data.success != '') {

                        $('.success-message').text(data.success);

                    }

                    if (typeof data.id != 'undefined' && data.id != null && data.id != '') {

                        $('#c_panel_lectures .dragging-parent').append('<div data-type="lecture" data-lectureid="'+data.id+'" class="drg-elem drg-elem-lecture newly-created-lecture can-be-deleted">'+_current_val+'<i class="fa fa-times" aria-hidden="true"></i></div>');

                        makeDraggableLectures('.newly-created-lecture');
                    }

                }
            });

            // make newly added lecture draggable

        }

    });
});

// add module
$('.add-module').click(function() {
    $('#modules_accordion').append('<h5 class="ui-accordion-header ui-corner-top ui-state-default ui-accordion-icons" role="tab" id="ui-id-4" aria-controls="module-container-4" aria-selected="true" aria-expanded="true" tabindex="0"><input type="text" value="" name="new_module_name" class="new_module_name" placeholder="module name"><input type="text" value="" name="new_module_code" class="new_module_code" placeholder="module code"></h5>');

    $('.new_module_name').focus();

    // on focus out add new lecture if name is not empty
    $('.new_module_code').blur(function() {

        var _the_parent = $(this).parents('.c_panel:first');
        var _current_name_val = $('.new_module_name').val();
        var _current_code_val = $(this).val();

        $('.new_module_name').parent().remove();

        if (_current_name_val != '' && _current_code_val != '') {

            var _create_url = $(_the_parent).data('urlstore');

            console.log('_create_url');
            console.log(_create_url);

            $.ajax({
                url: _create_url,
                method: 'POST',
                data: {'name': _current_name_val, 'code' : _current_code_val},
                success: function(data) {

                    if (typeof data.success != 'undefined' && data.success != null && data.success != '') {

                        $('.success-message').text(data.success);

                    }

                    if (typeof data.id != 'undefined' && data.id != null && data.id != '') {

                        var max_amount_of_module_days = parseInt($('#max_amount_of_module_days').data('max_amount_of_module_days'));
                        var max_amount_of_lectures_in_slot = parseInt($('#max_amount_of_lectures_in_slot').data('max_amount_of_lectures_in_slot'));
                        var _module_days_and_slots = '';

                        if (max_amount_of_module_days && max_amount_of_lectures_in_slot) {

                            for (var i=1; i <= max_amount_of_module_days; i++ ) {

                                _module_days_and_slots += '<h6 >Day ' + i + '</h6><div class="acc_lvl_2_content day-container" id="day-container-' + data.id + '-' + i + '">';

                                for (var z=1; z <= max_amount_of_lectures_in_slot; z++ ) {
                                    _module_days_and_slots += '<small>Lecture Slot '+z+'</small><div class="acc_lvl3_parent"><span class="droppable-area-text">Droppable Area</span><div class="acc_lvl_3_content drpbl drpbl-module slot-container newly-created-module-slot" id="slot-container-' + data.id + '-' + i + '-' + z + '"></div></div>';
                                }

                            }

                            $('#modules_accordion').append('<h5 class="module-header can-be-deleted a-tmp-hidden" data-moduleid="' + data.id + '" data-type="module">' + _current_name_val + '<i class="fa fa-times" aria-hidden="true"></i></h5><div class="acc_lvl_2 module-container" id="module-container-' + data.id + '"><div id="modules_accordion_lvl_2 a-tmp-hidden">'+_module_days_and_slots+'</div></div>');

                            $( "#modules_accordion, #modules_accordion_lvl_2" ).accordion( "refresh" );

                            makeDroppableModulesDaySlots(".newly-created-module-slot");

                            $('.a-tmp-hidden').removeClass('a-tmp-hidden');
                        }
                    }
                }
            });
            // make newly added lecture draggable
        }
    });
});

// handle enter press during lecture creating
$(document).on('keypress', '.new_lecture_name', function(e) {
    if(e.which == 13) {
        $('.new_lecture_name').blur();
        setTimeout(function() {
            $('.add-lecture').click();
        }, 1000);

    }
});

// handle enter press during module creating
$(document).on('keypress', '.new_module_code', function(e) {
    if(e.which == 13) {
        $('.new_module_code').blur();
        setTimeout(function() {
            $('.add-module').click();
        }, 1300);

    }
});

// delete element
$(document).on('click', '.can-be-deleted .fa-times', function(e) {

    e.stopPropagation();

    var _item_type = $(this).parent().data('type');
    var _id = '';
    var _current_obj = this;
    if (_item_type == 'lecture') {
        _id = $(this).parent().data('lectureid');
    }

    if (_item_type == 'module') {
        _id = $(this).parent().data('moduleid');
    }

    if (_id != '') {

        var _urlremove = $(this).parents('.c_panel:first').data('urlremove');
        _urlremove = _urlremove.replace('0', _id);

        $.ajax({
            url: _urlremove,
            method: 'POST',
            data: {'_method':'DELETE'},
            success: function (data) {
                if (typeof data.success != 'undefined' && data.success != null && data.success != '') {
                    $(_current_obj).parents('.can-be-deleted:first').remove();
                }
            }
        });

    }
});













