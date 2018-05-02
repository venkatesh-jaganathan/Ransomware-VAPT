var http = require('http');
http.createServer(function (req, res) {

  // initialize the php parser factory class
var fs = require('fs');
var path = require('path');
var engine = require('php-parser');
// initialize a new parser instance
var parser = new engine({
  // some options :
  parser: {
    extractDoc: true,
    php7: true
  },
  ast: {
    withPositions: true
  }
});
 

//to get the url parameters
var url_request = req.url.slice(1);


// Retrieve the AST from the specified source
var eval = parser.parseEval('echo "Hello World";');
 
// Retrieve an array of tokens (same as php function token_get_all)
var tokens = parser.tokenGetAll('<?php echo "Hello World";');
 
// Load a static file (Note: this file should exist on your computer)
var phpFile = fs.readFileSync( url_request );

const log4js = require('log4js');
log4js.configure({
  appenders: { ast: { type: 'file', filename: 'ast_file.txt' } },
  categories: { default: { appenders: ['ast'], level: 'error' } }
});

 // Log out results
console.log( 'Eval parse:', eval );
console.log( 'Tokens parse:', tokens );
console.log( 'File parse:', parser.parseCode(phpFile) );

fs.writeFile('ast_file.txt', '', function(){console.log('done')})

const logger = log4js.getLogger('ast');

logger.error(parser.parseCode(phpFile));

    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write("<b>File Source</b>&nbsp;&nbsp;");
    res.write(url_request+"<br/>");
    res.write("<b>AST Generated for the Code</b>&nbsp;&nbsp;");
    var base_url = 'http://localhost/phase2/html/staticsearch.php?file=';
    var ast_true = '&ast=1';
    var full_url = base_url.concat(url_request,ast_true);
    res.write("<a  target='_parent' href='"+full_url+"'>Click here</a>")
    res.end();
}).listen(8080);



