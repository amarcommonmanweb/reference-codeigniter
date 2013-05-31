/**
 * @author Amar
 */

var error_fields = new Array();

//for usernames -- not blank, alphanumeric, dot, underscore 
function validation0(elem)
{
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isusername(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
} 
 
 //check for not blank, alpha numeric, dot, comma and space
function validation1(elem)
{
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isalphanumeric(elem))
	{
		elem.style.border = '1px solid #00ff00';
		delete error_fields[elem_name];
	}
	else
	{
		elem.style.border = '1px solid #ff0000';		
		error_fields[elem_name] = 1;
	}
}

function validation2(elem)
{
	//for all drop downs and date pickers
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isselected(elem))
	{
		elem.style.border = '1px solid #00ff00';
		delete error_fields[elem_name];
	}
	else
	{
		elem.style.border = '1px solid #ff0000';		
		error_fields[elem_name] = 1;
	}
} 

function validation3(elem)
{
	//for phone numbers
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isnumeric(elem) && (val.length >= 10))
	{
		return 1
	}
	else
	{
		return 0;
	}
}

function validation4(elem)
{
	//for pin code
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isnumeric(elem) && (val.length >= 6))
	{
		elem.style.border = '1px solid #00ff00';
		delete error_fields[elem_name];
	}
	else
	{
		elem.style.border = '1px solid #ff0000';		
		error_fields[elem_name] = 1;
	}
}
 
function validation5(elem)
{
	//for marks
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isnumeric(elem))
	{
		elem.style.border = '1px solid #00ff00';
		delete error_fields[elem_name];
	}
	else
	{
		elem.style.border = '1px solid #ff0000';		
		error_fields[elem_name] = 1;
	}
}

function validation6(elem)
{
	//for email
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isemail(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

/*
*
*  The definition of all the validations follows
*
*/

//All functions doing the testing

function isexists(elem){
	if(elem.value.length == 0){		
		return false;
	}
	return true;
	
}

function isenabled(elem){
	if(elem.diabled == true){
		return false;
	}	
	return true;
}

function isselected(elem){

	if((elem.value == '') || (elem.value == '0') || (elem.value == 0)) {
		return false;
	}else{
		return true;
	}	
}


function isAlphabet(elem, errmsg){
	var alphaExp = /^[a-zA-Z\s]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		error_log += '&nbsp;&nbsp;&nbsp;'+errmsg+'<br>';
		elem.focus();
		return false;
	}	
}

function isnumeric(elem){
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		return false;
	}		
}

function isusername(elem){
	//allowing dot comma and space also
	var alphaExp = /^[0-9a-zA-Z\.\_]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		return false;
	}	
}

function isalphanumeric(elem){
	//allowing dot comma and space also
	var alphaExp = /^[0-9a-zA-Z\s\.\,]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		return false;
	}	
}

function isemail(elem){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		return true;
	}else{
		return false;
	}	
}

function isradiochosen(elem1, elem2){
	
	if(elem1.checked){
		return true;
	}
	else if(elem2.checked){
		return true;
	}
	
	error_log += '&nbsp;&nbsp;&nbsp;'+'Paint type selection missing<br>';
	return false;	
} 
 
