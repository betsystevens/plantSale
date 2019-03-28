var rows = function () {
	var theCount;
	return {
		setCount : function(value) {
			theCount = value;
		},
		incCount : function() {
			theCount += 1;
		},
		getCount : function() {
			return theCount;
		}
	}
}();

// Add a row to the entry form to enter flowers for ordering 
function addRow() {
	let rowNum = rows.getCount();
	$("#addSign").remove();
	$("#submitRow").before("<tr>" +
		   	"<td>" +
				"<input id='qty_"+rowNum+"'" +
				" name='flower["+rowNum+"][qty]' pattern='[0-9]{1,2}'" + 
				"title='Quantity must be less than 100' size='3' required>" +
			"</td>" +
			"<td><select id='fname_"+rowNum+"'" +
				" name='flower["+rowNum+"][fname]'></select></td>" +
			"<td><select id='variety_"+rowNum+"'" +
				"name='flower["+rowNum+"][variety]'></select></td>" +
			"<td><select id='container_"+rowNum+"'" +
			"name='flower["+rowNum+"][container]'></select></td>" +
			"<td id='addSign'><input id='addBtn' type='button' value='(+)'></td>" +
			"</tr>");
	var data = {
		"id" : "#fname_"+rowNum
	}
	callAjax("getFlowers.php", insertOptions, data);
	// insertOptions.call(data, flowers);
	addEvents(rowNum);
	rows.incCount();
};

function addAddBtn() {
	let rowNum = rows.getCount();
	rowNum--;
	$("#td_"+rowNum).after("<td id='addSign'>" + 
		"<input id='addBtn' type='button' value='(+)'></td>");
}

function getRowNum(id) {
	let i = id.indexOf("_") + 1;
	let l = id.length;
	let rowNum = id.substring(i,l);
	return rowNum;
}

function addEvents(rowNum) {
	console.log("add events row: " + rowNum);
	$('#addBtn').on('click', addRow);
	$('#variety_'+rowNum).change(updateContainer);
	$('#fname_'+rowNum).change(updateVariety);
	$("#fname_"+rowNum).trigger("change");
}

function updateVariety() {
	var rowNum = getRowNum(this.id);
	var id = "#variety_"+rowNum;
	var data = {
		"id" : id,
		"fname" : this.value
	};
	callAjax("getVarieties.php", insertOptions, data);
};
function updateContainer() {
	var rowNum = getRowNum(this.id);
	var id = "#container_"+rowNum;
	var fname = $("#fname_"+rowNum).val();
	var data = {
		"id" : id,
		"fname" : fname,
		"fvariety" : this.value
	};
	callAjax("getContainers.php", insertOptions, data);
}
function insertOptions(options) {
	var id = this.id;
	$(id).empty();
	$.each(options, function(index,value){
		$(id).append($('<option>', {
			value: value[0],
			text: value[0]
		}));
	});
	if (id.charAt(1) !== "c") {
		$(id).trigger("change");
	}
}

function callAjax(url, handler, data) {
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'json',
		data: data,
		context: data,
		success: handler,
		error: function(xhr, textStatus, thrownError) {
			alert("from: order.js, " + thrownError);
			console.log("readState: ", + xhr.readyState);
			console.log("responseText: " + xhr.responseText);
			console.log("status: " + xhr.status);
			console.log("text status: " + textStatus);
		}
	});
};

$("document").ready(function() {
	// $("form > *").css("font-style", "italic");
	
	var el = document.querySelector("#orderTotal");

	if (el) { 
		var inputNodes = document.querySelectorAll('input[id*="qty"]');
		rows.setCount(inputNodes.length);
		addAddBtn();
		$('#addBtn').on('click', addRow);
		// addEvents(rows.getCount()-1);
	}
	else { 
		rows.setCount(1);
		addEvents(0);
	}
});

