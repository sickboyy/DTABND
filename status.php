<html>
<body>
<script type="text/javascript">
   
	function getHashUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('#') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = unescape(hash[1]);
    }
    	return vars;
	}

var image = getHashUrlVars()["serverResponse"];	
var status = getHashUrlVars()["status"];
var picID = getHashUrlVars()["picID"];
var url = "photo.php?photo="+ image +"&status="+status+"&picID="+picID;

//redirect the page to php script to be accessed using $_REQUEST
 
window.location = url;

</script>
</body>
</html>