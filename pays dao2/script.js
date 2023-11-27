//equivalant html onchange="this.form.submit()" mais moins secure

document.getElementById('selectcontinent').addEventListener("change",function() {
	document.getElementById('formfiltres').submit();
});

document.getElementById('selectregion').addEventListener("change",function() {
	document.getElementById('formfiltres').submit();
});