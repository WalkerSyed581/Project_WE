var addDrugButton = document.querySelector('#addDrugs');
addDrugButton.addEventListener('click',function(e){
	addDrugButton.insertAdjacentHTML('beforebegin',"<div class='form-row'><div class='form-group col-md-6'><label for='drugName'>Drug Name</label><input type='text' class='form-control' id='drugName' name='drugName'></div><div class='form-group col-md-6'><label for='dose'>Dose</label><input type='text' class='form-control' name='dose' id='dose'><div class='alert alert-danger'>{{ $message }}</div></div></div>");
},false)