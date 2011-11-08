scrollTable = function(table) {
	(function($) {
		$.fn.columns = function() {
			return $(this).children(":first").children(":first").children();
		}
		$.fn.widths = function(widths) {
			if (widths === undefined) {
				var widths = [];
				$(this).each(
					function() {
						widths.push($(this).width());
					}
				);
				return widths;
			} else {
				return $(this).each(
					function(i) {
						$(this).width(widths[i]);
					}
				);
			}
		}
	})(jQuery);

	var widths = table.columns().widths();

	var tHead = $("<table>").append(table.children("thead").clone());
	tHead.columns().widths(widths);	
	var tBody = $("<table>").append(table.children("tbody").clone())
	tBody.columns().widths(widths);
	var tBodyDiv = $("<div>").append(tBody);
	var tFoot = $("<table>").append(table.children("tfoot").clone());
	tFoot.columns().widths(widths);	
	table.parent().append(tHead, tBodyDiv, tFoot);
	table.remove();
}

/*
$(document).ready(
	function(){
		scrollTable($("table"));
	}
);
*/