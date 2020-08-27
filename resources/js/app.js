
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

// count connections of each lecture
function setNumConnectionsOfLectures(chosen_lecture_id='')
{
    var selector = 'div[data-type="lecture"]';
    var _decrease_num = 1;

    if (chosen_lecture_id != '') {
        _decrease_num = 2;
    }

    if (chosen_lecture_id != '') {
        selector = 'div[data-lectureid="'+chosen_lecture_id+'"]';
    }

    $(selector).each(function(){
        var lecture_id = $(this).data('lectureid');
        //console.log($(this).text());
        var current_lecture_counters = parseInt($('div[data-lectureid="'+lecture_id+'"]').length) - _decrease_num;
        //console.log($('div[data-lectureid="'+lecture_id+'"]').length);

        if ($(this).find('.amount-of-lectures').length > 0) {
            $(this).find('.amount-of-lectures').remove();
            $(' <span class="amount-of-lectures" title="' + $('#title_for_lecture_connections').text() + '"> <strong> (' + current_lecture_counters + ') </strong> </span> ').insertBefore($(this).find('.fa-times'));
        }
        else {
            $(' <span class="amount-of-lectures" title="' + $('#title_for_lecture_connections').text() + '"> <strong> (' + current_lecture_counters + ') </strong> </span> ').insertBefore($(this).find('.fa-times'));
        }

    });
}

setNumConnectionsOfLectures();

$('.drpbl.slot-container').sortable({
    revert: false,
    start: function(event, ui) {
        $(ui.item).addClass('placed-in-sortable');
    }
});

// EDIT elements on the fly
$(document).on('click', '.fa-pencil-square-o.edit-pencil', function(e) {

    e.stopImmediatePropagation();
    e.stopPropagation();

    var _editable_content_text = $(this).parents('.can-be-edited:first').find('.editable-content').hide().text();

    $(this).parents('.can-be-edited:first').find('.amount-of-lectures').hide();
    $(this).parents('.can-be-edited:first').find('.edit-pencil').hide();

    $(this).parents('.can-be-edited:first').append('<input type="text" class="new_editing_element" name="new_editing_element" value="' + _editable_content_text + '"/>');

    $('.new_editing_element').focus().blur(function() {

        var _the_parent = $(this).parents('.can-be-edited:first');
        var _current_val = $(this).val();

        if (_current_val != '') {

            var _create_url = $(_the_parent).data('urlstore');

            var id = '';
            var _item_type = $(_the_parent).data('type');
            var _code = '';

            if (_item_type == 'lecture') {
                id = $(_the_parent).data('lectureid');
            }
            if (_item_type == 'module') {
                id = $(_the_parent).data('moduleid');
                _code = $(_the_parent).data('modulecode');
            }
            $('.new_editing_element').remove();
            $.ajax({
                url: _create_url,
                method: 'POST',
                data: {'name': _current_val, 'id': id, 'code': _code},
                success: function(data) {



                    if (typeof data.success != 'undefined' && data.success != null && data.success != '') {

                        $(_the_parent).find('.editable-content').text(_current_val).show();
                        $(_the_parent).find('.amount-of-lectures').show();
                        $(_the_parent).find('.edit-pencil').show();

                        if (_item_type == 'lecture') {
                            $('div[data-lectureid="'+id+'"]').find('.editable-content').text(_current_val);
                        }

                    }
                }
            });

            // make newly added lecture draggable

        }

    });

});

$( "#modules_accordion, .modules_accordion_lvl_2" ).accordion({
    active: false,
    collapsible: true,
    beforeActivate:function(event, ui ){
        var fromIcon = $(event.originalEvent.target).is('*:not(.fa-pencil-square-o.edit-pencil, .fa-times, .new_editing_element)');
        return fromIcon;
    }
});

// small hook for keyboard hot keys disable for accordion
$.ui.accordion.prototype._keydown = function( event ) {
    // your new code for the "_keydown" function
};

$('#modules_accordion h5').off('dblclick');

$('#c_panel_modules').css({'visibility': 'visible'});

// drag and drop lectures in modules
function makeDraggableLectures(selector) {
    $(selector).draggable({
        appendTo: "body",
        helper: "clone",
        drag: function( event, ui ) {
            /*$('.ui-accordion-header').mouseover( function() {

                // auto open accordion elements when drag and move over accordion
                if ($(this).hasClass('ui-accordion-header-collapsed')) {
                    $(this).click();
                }

            });*/
        },
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
        tolerance: 'touch',
        drop: function (event, ui) {

            // change id and classes of ui elem
            if (!$(ui.draggable).hasClass('placed-in-sortable')) {
                var _lecture_to_add_ = $(ui.draggable).clone().addClass('placed-in-sortable');
            }
            else {
                var _lecture_to_add_ = $(ui.draggable);
            }

            $(_lecture_to_add_).find('.edit-pencil').remove();

            var _new_ui_id = $(_lecture_to_add_).data('lectureid');

            var counter_of_existing_elms = $(this).find('.drg-elem').length;
            var number_of_max_lectures_in_slot = parseInt($('#max_amount_of_lectures_in_slot').data('max_amount_of_lectures_in_slot'));


            if ($(this).find('div[data-lectureid="'+_new_ui_id+'"]').length == 0 && counter_of_existing_elms < number_of_max_lectures_in_slot) {

                $(this).append(_lecture_to_add_);

                if ($(this).find('div[data-lectureid="'+_new_ui_id+'"]').length > 1) {
                    $(this).find('div[data-lectureid="'+_new_ui_id+'"]:nth-child(2)').remove();
                }

                if (selector != '.newly-created-module-slot') {
                    $( this ).sortable( "refresh" );
                }


                setNumConnectionsOfLectures(_new_ui_id);
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

                        $('#c_panel_lectures .dragging-parent').append('<div data-type="lecture" data-lectureid="'+data.id+'" class="drg-elem drg-elem-lecture newly-created-lecture can-be-deleted can-be-edited" data-urlstore="'+$('#lecture_store_url').data('urlstore')+'"><span class="editable-content">'+_current_val+'</span><i class="fa fa-pencil-square-o edit-pencil" aria-hidden="true"></i><i class="fa fa-times" aria-hidden="true"></i></div>');

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
                        var max_amount_of_lecture_slots = parseInt($('#max_amount_of_lecture_slots').data('max_amount_of_lecture_slots'));
                        var _module_days_and_slots = '';

                        if (max_amount_of_module_days && max_amount_of_lecture_slots) {

                            for (var i=1; i <= max_amount_of_module_days; i++ ) {

                                _module_days_and_slots += '<h6 class="can-be-edited" data-urlstore="'+$('#day_store_url').data('urlstore')+'" data-dayid="'+i+'" data-type="day"><span class="editable-content">Day ' + i + '</span><i class="fa fa-pencil-square-o edit-pencil" aria-hidden="true"></i></h6><div class="acc_lvl_2_content day-container" id="day-container-' + data.id + '-' + i + '">';

                                for (var z=1; z <= max_amount_of_lecture_slots; z++ ) {
                                    _module_days_and_slots += '<small>Lecture Slot '+z+'</small><div class="acc_lvl3_parent"><span class="droppable-area-text">Droppable Area</span><div class="acc_lvl_3_content drpbl drpbl-module slot-container newly-created-module-slot" id="slot-container-' + data.id + '-' + i + '-' + z + '"></div></div>';
                                }
                                _module_days_and_slots += '</div>';
                            }

                            $('#modules_accordion').append('<h5 class="module-header can-be-deleted can-be-edited a-tmp-hidden" data-urlstore="'+_create_url+'" data-moduleid="' + data.id + '" data-type="module" data-modulecode="' + data.code + '"><span class="editable-content" >' + _current_name_val + '</span><i class="fa fa-pencil-square-o edit-pencil" aria-hidden="true"></i><i class="fa fa-times" aria-hidden="true"></i></h5><div class="acc_lvl_2 module-container" id="module-container-' + data.id + '"><div class="modules_accordion_lvl_2 a-tmp-hidden">'+_module_days_and_slots+'</div></div>');


                            $("#modules_accordion").accordion("refresh");

                            $('.modules_accordion_lvl_2.a-tmp-hidden').accordion({
                                active: false,
                                collapsible: true
                            });

                            makeDroppableModulesDaySlots(".newly-created-module-slot");

                            $('.module-header, .modules_accordion_lvl_2').removeClass('a-tmp-hidden');



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

    if ($(this).parent().parent().hasClass('slot-container')) {
        $(this).parent().remove();
//console.log('removed connection');
        setNumConnectionsOfLectures();
        // HERE SHOULD BE SAVE FUNCTION CALL
        return false;
    }
    var _item_type = $(this).parent().data('type');
    var _id = '';
    var _current_obj = this;
    var _current_parent = $(_current_obj).parent();
    var _current_parent_next = $(_current_parent).next('.module-container');
    var _urlremove = $(_current_obj).parents('.c_panel:first').data('urlremove');

    if (_item_type == 'lecture') {
        _id = $(this).parent().data('lectureid');
    }

    if (_item_type == 'module') {
        _id = $(_current_obj).parent().data('moduleid');
        $(_current_parent).remove();
        $(_current_parent_next).remove();
    }

    if (_id != '') {

        _urlremove = _urlremove.replace('0', _id);

        $.ajax({
            url: _urlremove,
            method: 'POST',
            data: {'_method':'DELETE'},
            success: function (data) {
                if (typeof data.success != 'undefined' && data.success != null && data.success != '') {
                    $(_current_obj).parents('.can-be-deleted:first').remove();

                    if (_item_type == 'lecture') {
                        $('div[data-lectureid="'+_id+'"]').remove();
                    }

                    $(_current_obj).parents('.can-be-deleted:first').next('.module-container').remove();
                }
            }
        });

    }
});







