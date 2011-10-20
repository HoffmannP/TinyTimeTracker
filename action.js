$(document).ready(function() {
	var defaultCSS = {fontStyle: "italic", color: "DimGrey"};
    var normalCSS  = {fontStyle: "normal", color: "Black"};
	var overlay = $("#shaddow").add("#append").hide();
	var col = $("#append input[name=collegue]");
	var prj = $("#append input[name=project]");
	var min = $("#append input[name=minutes]");
    var add = $("#append input[name=addWork]");
	var nam = $("#working input[name=name]");
	var pro = $("#working input[name=project]");
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
/*
	$("body").keyup(function(e) {
		if (e.keyCode == '13') {
		    if ($("#append").css("display") == "none") {
			    $("#worker input[name=start]").click();
			} else {
			    $("#append input[name=submit]").click();
			}
		}
	});
*/
	var successFunc = function() {
		overlay.hide();
		$("#time").load("index.php", {"table": ""}, afterTimeTableLoad);
	}
	var sendFunc = function() {
		if ((col.val() == "<Kollege>") || (col.val() == "")) {
			alert("Bitte den Kollegen angeben");
			return;
		}
		if ((prj.val() == "<Projekt>") || (prf.val() == "")) {
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
	var clickFunc = function() {
		min.val("0:00");
		var highlight;
		if ($(this).hasClass("free")) {
			col.val("<Kollege>").css(defaultCSS);
			prj.val("<Projekt>").css(defaultCSS);
			highlight = col;
		} else if ($(this).hasClass("newCollegue")) {
			col.val("<Kollege>").css(defaultCSS);
			prj.val($(this).parent().parent().children(":first").text()).css(normalCSS);
			highlight = col;
		} else if ($(this).hasClass("named")) {
			col.val($(this).val()).css(normalCSS);
			prj.val("<Projekt>").focus().css(defaultCSS);
			highlight = prj;
		} else {
			col.val($(this).val().split(",")[0]).css(normalCSS);
			prj.val($(this).parent().parent().children(":first").text()).change().css(normalCSS);
			highlight = $("#append input[name=addWork]");
		}
		overlay.show();
		highlight.focus().select();
	}
	var addWorker = function() {
		if ((col.val() == "<Kollege>") || (col.val() == "")) {
			alert("Bitte den Kollegen angeben");
			return;
		}
		if ((prj.val() == "<Projekt>") || (prj.val() == "")) {
			alert("Bitte das Projekt angeben");
			return;
		}
		$.ajax({
			"url": "index.php", 
			"type": "POST",
			"data": {
				"collegue": col.val(),
				"project":  prj.val(),
				"start":    "now"
			},
			"success": successRecord
		});
		overlay.hide();
	}
	var afterTimeTableLoad = function() {
		$("input.addTime").click(clickFunc);
		$("#filter").click(function() {
			var filter = window.prompt("FilterPrefix");
			if (filter === null) {
				return;
			}
			$("#time").load("index.php", {"table": filter}, afterTimeTableLoad);
		});
	}
	var successRecord = function(data) {
		if (data.substr(0, "Duplicate entry".length) == "Duplicate entry") {
			nam.val("<Kollege>").css(defaultCSS);
			alert("Dieser Kollege arbeitet bereits,\nhier kann sich keiner zweiteilen!");
			return;
		}
		if (data.substr(0, "Added ".length) == "Added ") {
			$("#time").load("index.php", {"table": ""}, afterTimeTableLoad);
		}
		$("#working").load("index.php", {"working": ""}, afterWorkerTableLoad);
	}
	var startRecord = function() {
		if ((nam.val() == "<Kollege>") || (nam.val() == "")) {
			alert("Bitte den Kollegen angeben");
			return;
		}
		if ((pro.val() == "<Projekt>") || (pro.val() == "")) {
			alert("Bitte das Projekt angeben");
			return;
		}
		$.ajax({
			"url": "index.php", 
			"type": "POST",
			"data": {
				"collegue": nam.val(),
				"project":  pro.val(),
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
				"whatDo":  doparam
			},
			"success": successRecord
		});
	}
	var afterWorkerTableLoad = function() {
		nam = $("#working input[name=name]").css(defaultCSS).keyup(ifIsEqual("Kollege"));
		pro = $("#working input[name=project]").css(defaultCSS).keyup(ifIsEqual("Projekt"));
		$("#working input.start").click(startRecord);
		$("#working input.abort").click(function(){endRecord($(this), "abort");});
		$("#working input.save" ).click(function(){endRecord($(this), "save");});
		$("#working input[type=text]").click(function() {
			$(this).focus()
			$(this).select();
		});
	}
	$("#append input[type=text]").click(function(event) {
		$(this).focus()
		$(this).select();
	});
    $("#time").load("index.php", {"table": ""}, afterTimeTableLoad);
    $("#working").load("index.php", {"working": ""}, afterWorkerTableLoad);
    $("#collegues").load("index.php", {"collegues": ""}, afterTimeTableLoad);
	$("#append input[name=submit]").click(sendFunc);
	$("#append input[name=addWork]").click(addWorker);
	$("#shaddow").click(function() {
		overlay.hide();
	});


});
