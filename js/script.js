//function for the prompt to get the file location
function fileLocation(val) {
	var url_val = val;
    var txt;
    var url_file = prompt("Please enter the file location:",url_val);
    window.location = "html/staticsearch.php?file="+url_file;
}

//for refresh of the iframe
function reload() {
    document.getElementById('iframeid').src += '';
} 