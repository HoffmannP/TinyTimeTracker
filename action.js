var tables = {},
displayCalendar = function (data) {
    return moment(data).calendar();
},
displayHumanDuration = function (data) {
    return moment.duration(+data, 'm').preciseHumanize();
},
projectLink = function (data) {
    return '<a href="#show/'+encodeURIComponent(data)+'">'+data+'</a>';
},
columnsTime = [
{ 'render': {
    'display': projectLink
}},
{},
{ 'render': {
    'filter': displayHumanDuration,
    'display': displayHumanDuration
}},
{ 'render': {
    'filter': displayCalendar,
    'display': displayCalendar
}},
{ 'render': {
    'filter': displayCalendar,
    'display': displayCalendar
}}
],
columnsProjekt = [
{},
{ 'render': {
    'display': projectLink
}},
{ 'render': {
    'filter': displayHumanDuration,
    'display': displayHumanDuration
}},
{ 'render': {
    'filter': displayCalendar,
    'display': displayCalendar
}}
],
TTTRouting = Backbone.Router.extend({
    routes: {
        "": 'table',
        "add": 'add',
        "show/:name": 'show'
    },
    table: function () {
        $('div.modal').modal('hide');
        tables['time'].ajax.reload();
        $('.time').show();
        $('.projekt').hide();
    },
    show: function (name) {
        $('div.modal').modal('hide');
        tables['projekt'].ajax.url('?action=projekt&name='+encodeURIComponent(name)).load();
        $('.projekt').show();
        $('.time').hide();
        $('.projekt h3').text(name);
    },
    add: function () {
        $('div.modal').modal('show');
    },
}),
route = new TTTRouting();

function start() {
    moment.locale(window.navigator.language);
    tables['time'] = $('.time table').DataTable({
        'ajax': '?action=time',
        'paging': false,
        'columns': columnsTime
    });
    tables['projekt'] = $('.projekt table').DataTable({
        'ajax': '?action=projekt&name=',
        'paging': false,
        'columns': columnsProjekt
    });
    $('div.modal')
    .modal({'show': false})
    .on('hidden.bs.modal', function () {
        route.navigate('');
    });
    Backbone.history.start();
}
