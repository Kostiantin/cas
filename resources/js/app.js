
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

/******** REMOVE 'ARE YOU SURE' CONFIRMATION *********/
$('.sbmt-delete-form').submit(function() {
    var c = confirm("Are you sure?");
    return c;
});

/************ PREVENT DEFAULT LINKS************/
$('.prevent-default-link').click(function(e){
    e.preventDefault();
});

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

/*************** UNIVERSAL MODAL *****************/
$('#universalModal').on('show.bs.modal', function (event) {

    // empty old modal data holders
    $('#elem-id-holder').val('');

    // use target button to get data from it
    var button = $(event.relatedTarget);
    var _title = button.data('title');
    var _route = button.data('route');
    var _action = button.data('action');
    var _elemid = button.data('elemid');
    var _method = 'GET';

    if (button.data('method')) {
        _method = button.data('method');
    }

    var dataObj = {};

    // assign title and show loading spinner
    var modal = $(this);
    modal.find('.modal-title').text(_title);
    modal.find('.modal-body').html('<div class="text-center"><div class="spinner-border text-success"></div></div>');

    // choose what modal footer buttons will be show or hidden
    if (_action == 'create' || _action == 'edit') {
        modal.find('.btn-edit').hide();
        modal.find('.btn-save').show();


        // ADD SAVE BUTTON BEHAVIOUR


    }
    else {
        modal.find('.btn-edit').show();
        modal.find('.btn-save').hide();
    }

    // collect object to send

    if (_elemid) {
        dataObj.id = _elemid;
        $('#elem-id-holder').val(_elemid);
    }

    // sending ajax request based on received
    if (typeof _route != 'undefined' && _route != null && _route != '') {

        $.ajax({
            url: _route,
            data: dataObj,
            success: function(data) {

                setTimeout(function(){
                    modal.find('.modal-body').html(data);
                }, 400);

            }
        }).done(function() {

        });

    }

});


























