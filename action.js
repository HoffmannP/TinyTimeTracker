$(document).ready(function() {
	var defaultCSS = {fontStyle: "italic", color: "DimGrey"};
    var normalCSS  = {fontStyle: "normal", color: "Black"};
	var overlay = $("#shaddow").add("#append").hide();
	var col = $("#append input[name=collegue]");
	var prj = $("#append input[name=project]");
	var min = $("#append input[name=minutes]");
	var ifIsEqual = function(equalTo) {
		return function() {
			if ($(this).val() == "<"+equalTo+">") {
				$(this).css(defaultCSS);
			} else {
				$(this).css(normalCSS);
			}
		}
	}
    col.keyup(ifIsEqual("Kollege"));
	prj.keyup(ifIsEqual("Projekt"));
	$("body").keyup(function(e) {
		if (e.keyCode == '13') {
			$("#append input[name=submit]").click();
		}
	});
    var stp = $("#append input[name=stop]");
	var successFunc = function() {
		overlay.hide();
		$("table#time").load("index.php", {"table": ""}, afterTimeTableLoad);
	}
	var sendFunc = function() {
		if (col.val() == "<Kollege>") {
			alert("Bitte den Kollegen angeben");
			return;
		}
		if (col.val() == "<Projekt>") {
			alert("Bitte das Projekt angeben");
			return;
		}
		$.ajax({
			"url": "index.php",
			"type": "POST",
			"data": {
				"collegue": col.val(),
				"project":  prj.val(),
				"minutes":  min.val()
			},
			"success": successFunc
		});
	}
	$("#append input[name=submit]").click(sendFunc);
	var clickFunc = function() {
		min.val("0:00");
		if ($(this).hasClass("free")) {
			col.val("<Kollege>").css(defaultCSS);
			prj.val("<Projekt>").css(defaultCSS);
		} else if ($(this).hasClass("newCollegue")) {
			col.val("<Kollege>").css(defaultCSS);
			prj.val($(this).parent().parent().children(":first").text()).css(normalCSS);
		} else {
			col.val($(this).val().split(",")[0]).css(normalCSS);
			prj.val($(this).parent().parent().children(":first").text()).change().css(normalCSS);
		}
		overlay.show();
		startInc();
	}
	var afterTimeTableLoad = function() {
		$("input.addTime").click(clickFunc);
		$("#filter").click(function() {
			var filter = window.prompt("FilterPrefix");
			$("table#time").load("index.php", {"table": filter}, afterTimeTableLoad);
		});
	}
	var successRecord = function(data) {
		if (data.substr(0, "Duplicate entry".length) == "Duplicate entry") {
			$("#working input[name=name]").val("<Kollege>").css(defaultCSS);
			alert("Dieser Kollege arbeitet bereits,\nhier kann sich keiner zweiteilen!");
			return;
		}
		if (data.substr(0, "Added ".length) == "Added") {
			$("table#time").load("index.php", {"table": ""}, afterTimeTableLoad);
		}
		$("table#working").load("index.php", {"working": ""}, afterWorkerTableLoad);
	}
	var startRecord = function() {
		if ($("#working input[name=name]").val() == "<Kollege>") {
			alert("Bitte den Kollegen angeben");
			return;
		}
		if ($("#working input[name=project]").val() == "<Projekt>") {
			alert("Bitte das Projekt angeben");
			return;
		}
		$.ajax({
			"url": "index.php", 
			"type": "POST",
			"data": {
				"collegue": $("#working input[name=name]").val(),
				"project":  $("#working input[name=project]").val(),
				"start":    "now"
			},
			"success": successRecord
		});
	}
	var endRecord = function(button, doparam) {
		$.ajax({
			"url": "index.php", 
			"type": "POST",
			"data": {
				"collegue": button.parent().parent().children("td:first").text(),
				"project":  doparam
			},
			"success": successRecord
		});
	}
	var afterWorkerTableLoad = function() {
		$("#working input[name=name]").css(defaultCSS).keyup(ifIsEqual("Kollege"));
		$("#working input[name=project]").css(defaultCSS).keyup(ifIsEqual("Projekt"));
		$("#working input.start").click(startRecord);
		$("#working input.abort").click(function(){endRecord($(this), "abort");});
		$("#working input.save" ).click(function(){endRecord($(this), "save");});
	}
    $("table#time").load("index.php", {"table": ""}, afterTimeTableLoad);
    $("table#working").load("index.php", {"working": ""}, afterWorkerTableLoad);
	$("#shaddow").click(function() {
		overlay.hide();
	});


});