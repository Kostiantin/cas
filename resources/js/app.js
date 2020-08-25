
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

$(function() {
    $('#releases ul li').sortable({ // #releases ul li
        containment: "document",
        items: '> ul',
        handle: '.sort',
        cursor: 'move',
        connectWith: '.releaseRow', // #releases ul
        placeholder: 'holder',
        tolerance: "pointer",
        revert: 300,
        forcePlaceholderSize: true,
        opacity: 0.5,
        helper: "clone",
        scroll: false,
        dropOnEmpty: true
    });

    $('.releaseTracks').sortable({ // #releases ul li
        containment: "document",
        items: '> ul',
        handle: '.sort',
        cursor: 'move',
        helper: "clone",
        revert: 300,
        connectWith: '.releaseTracks', // #releases ul
        placeholder: 'holder',
        tolerance: "pointer",
        forcePlaceholderSize: true,
        opacity: 0.5,
        scroll: true,
        dropOnEmpty: true
        // start: function(e, ui) {
        //   ui.placeholder.height(ui.helper.outerHeight());
        // }
    });

    $('.showTracks').on('click', function(){
        $(this).closest('.releaseRow').find('.releaseTracks').slideToggle();
    });

    $(".tooltip_bottom_center").tooltip({
        tooltipClass: "tooltipBox",
        show: {
            effect: "slideDown",
            delay: 100
        },
        position: {
            my: "center",
            at: "bottom+10"
        }
    });





    var releaseItem = $('.releases li ul.releaseRow');
    releaseItem = releaseItem.slice(1);
    var container = $('.releases > li ul.releaseRow:gt(0)');
    var order = [3,4];
    var release_id = null;

    $(document).one('ready', function () {
        setOrder(order);
    });

    // Set releases order
    function setOrder(order)
    {
        // console.log(order);
        if(order !== undefined && order !== null && order.length !== 0)
        {
            // console.log('A - ' + 'Order: ' + order);
            render(order);
        }
        else
        {
            // TODO update to be actual release id's of default value being used on page load.
            $.each(releaseItem, function(i,v){

                // var release_id = i; // update to use actual release ID.
                // $(this).attr('data-sort', release_id);
                order.push($(this).data('sort'));
                var items = $(this).children('li');

                $.each(items, function(i,v){
                    $(this).attr('data-sort', $(this).parent().data('sort') + '.' + i++);
                });

            });
            // console.log('B');
            render(order);
        }
    }


    // Get releases order
    function getOrder()
    {
        if(order !== undefined && order !== null && order.length !== 0)
        {
            return order;
        }
        else
        {
            return 0;
        }
    }

    // Sort releases order based on sort selction
    function sortReleases(sortby) // string
    {
        // Get current order
        var currentOrder = getOrder();
        // console.log(currentOrder);

        var dataValue = [];
        var sortValue = Array();
        var toSort = [];
        var newOrder = [];

        $.each(releaseItem, function(){
            dataValue.push($(this).children('li').not('li.releaseTracks'));
        });

        $.each(dataValue, function(k,v){
            $.each(v, function(){
                if($(this).data('sortby') === sortby)
                {
                    var rId = 'release_' + $(this).parent().data('sort');
                    // console.log(rId + ' ' + $(this).text());
                    sortValue[rId] = $(this).text();
                }
            });
        });
        // console.log(sortValue);

        var alpha = /[^a-zA-Z]/g;
        var numeric = /[^0-9]/g;

        function sortAlphaNum(a,b) {
            console.log(a);
            console.log(b);
            var aA = a.replace(alpha, "");
            var bA = b.replace(alpha, "");
            if(aA === bA) {
                var aN = parseInt(a.replace(numeric, ""), 10);
                var bN = parseInt(b.replace(numeric, ""), 10);
                return aN === bN ? 0 : aN > bN ? 1 : -1;
            } else {
                return aA > bA ? 1 : -1;
            }
        }
        // console.log(sortValue);
        sortValue.sort(sortAlphaNum);
        // sortAlphaNum(sortValue);
        console.log(sortValue);
        render(sortValue);
    }

    // Event, listen for releases order selection
    $('.releaseHeadings .fa-sort').on('click', function(){
        var sortby = $(this).parent().data('sortby');
        sortReleases(sortby);
    });

    function render(order)
    {
        console.log('Output HTML of releases in new order: ' + order);
    }


}); // end of document.ready
















