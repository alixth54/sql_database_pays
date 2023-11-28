//equivalant html onchange="this.form.submit()" mais moins secure

document.getElementById('selectcontinent').addEventListener("change",function() {
    if (document.getElementById('selectregion')!=undefined) {
        document.getElementById('selectregion').value="";
    }
    
	document.getElementById('formfiltres').submit();
});
if (document.getElementById('selectregion')!=undefined) {
document.getElementById('selectregion').addEventListener("change",function() {
	document.getElementById('formfiltres').submit();
});
}
