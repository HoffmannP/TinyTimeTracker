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
        "":      'table',
        "new":   'new',
        "catch": 'catch',
        "entry": 'entry',
        "show/:name":  'show'
    },
    table: function () {
        $('dialog').removeAttr("open");
        $('.time').show();
        $('.projekt').hide();
        tables['time'].ajax.reload();
    },
    show: function (name) {
        $('dialog').removeAttr("open");
        $('.projekt').show();
        $('.time').hide();
        tables['projekt'].ajax.url('?action=projekt&name='+encodeURIComponent(name)).load();
        $('.projekt h3').text(name);
    },
    new: function () {
        $('dialog').removeAttr("open");
        $('dialog.new').attr("open", true);
    },
    catch: function () {
        $('dialog').removeAttr("open");
        $('dialog.catch').attr("open", true);
    },
    entry: function () {
        $('dialog').removeAttr("open");
        $('dialog.entry').attr("open", true);
    }
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
    Backbone.history.start();
}
