/**
 *
 *	Create rows of input and select elements.
 *  Row of elements is added to form.
 *  Form is used for adding a flower order or 
 *  editing a flower order.
 * 
 */
// html elements for a row in the order form
const orderFields = [
	{ 'tag' : 'input', 'field' : 'qty' },
	{ 'tag' : 'select', 'field' : 'fname' },
	{ 'tag' : 'select', 'field' : 'variety' },
	{ 'tag' : 'select', 'field' : 'container' },
	{ 'tag' : 'input', 'field' : 'addBtn' }
];
// attributes for quantity field
const qtyAttrs = 
{
	'pattern' : '[0-9]{1,2}',
	'title'   : 'Quantity must be less than 100',
	'size'    :  '3',
	'required' : 'true'
}
// attributes for add button
const addBtnAttrs = {
	'type' : 'button',
	'value' : '(+)'
}

const countRows = () => document.querySelectorAll('input[id*="qty"]').length;

/** 
 *	add attributes to an element
 *	@param	{obj}			el - one html document element 
 *	@param	{obj}			attrs	- attribute name and value pairs
 */	
function addAttrs(el, attrs) {
	for (let prop in attrs) {
		el[prop] = attrs[prop];
	}
};

// create array of elements for new row in order form
const rowCells = orderFields.map((item) => {
	return document.createElement(item.tag);	
})

/**
 * create elements for new row in the order entry form 
 * add the row number to their id and name attributes
 */
const createRowElements = () => {
	const cells = orderFields.map((item) => {
		let el = document.createElement(item.tag);
		let rowCount = countRows();
		el.id = `${item.field}_${rowCount}`;
		el.name = `flower[${rowCount}][${item.field}]`;
		return el;
	});
	return cells;
}

// add an add(+) button to last row of edit order
function addAddBtn() {
	let newAddBtn = document.createElement('input');
	addAttrs(newAddBtn, addBtnAttrs);
	let rowNum = countRows() - 1;
	newAddBtn.id = `addBtn_${rowNum}`;
	newAddBtn.addEventListener('click', addHandler);
	idString = '#row_' + rowNum;
	let row = document.querySelector(idString);
	let cell = row.insertCell(-1);
	cell.appendChild(newAddBtn);
}

// event handler for the add button, adds another input row to the form
const addHandler = () => {
	const newElements = createRowElements(); 
	addAttrs(newElements[0], qtyAttrs);
	addAttrs(newElements[4], addBtnAttrs);
	//  insert row into the form table
	let newRow = document.querySelector('table.order.flowers').insertRow(countRows() + 1);
  newRow.id = "row_" + countRows();	
	// add each element to newly created row
	newElements.forEach((item, index) => {
		newRow.insertCell(index).appendChild(item);
	});
	// ugly, fix it
	// 
	let curRow = countRows() - 1;
	var data = {
		"id" : "#fname_"+ curRow
	}
	callAjax("getFlowers.php", insertOptions, data);
	addEvents(curRow);
}

/**
 *	@param		{string} 	id			id of element event was fired on
 *
 * 	@returns	{number} 	rownum
 */

function getRowNum(id) {
	let i = id.indexOf("_") + 1;
	let l = id.length;
	let rowNum = id.substring(i,l);
	return rowNum;
}

function addEvents(rowNum) {
	$(`input[id="addBtn_${rowNum}"]`).on('click', addHandler);

	$(`#variety_${rowNum}`).change(updateContainer);
	// let el = document.getElementById(`variety_${rowNum}`);
	// el.addEventListener("change", updateContainer);
	
	$(`#fname_${rowNum}`).change(updateVariety);
	$(`#fname_${rowNum}`).trigger("change");
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
	var el = document.querySelector("#orderTotal");
  // is it editOrder.html.php 
	if (el) { 
		addAddBtn();
	}
	// or is it addOrder.html.php
	else { 
		addEvents(0);
	}
});
