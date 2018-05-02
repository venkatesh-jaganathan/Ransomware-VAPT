var http = require('http');
var server = http.createServer(function(req,res){
	res.writeHead(200,{"content-Type":"text/html"});
	res.end('<p><h1>hI</h1>this is good</p>');
});

server.listen(8080);