var bodyparser = require('body-parser');
var express = require('express');

var conf = require('./conf');
var functions = require('./functions');//加密
var create_accounts = require('./routes/create_accounts');
var login = require('./routes/login');
var messageboard = require('./routes/messageboard');

var app = express();

app.use(bodyparser.urlencoded({ extended: false }));
app.use(bodyparser.json());

var cors = require("cors");
app.use(cors());

// CORS config here
// app.all("/*", function (req, res, next) {
//     // CORS headers
//     res.header("Access-Control-Allow-Origin", "*"); // restrict it to the required domain
//     res.header("Access-Control-Allow-Methods", "GET,PUT,POST,DELETE,OPTIONS");
//     // Set custom headers for CORS
//     res.header(
//         "Access-Control-Allow-Headers",
//         "Content-type,Accept,X-Access-Token,X-Key"
//     );
//     if (req.method == "OPTIONS") {
//         res.status(200).end();
//     } else {
//         next();
//     }
// });

app.use(functions.passwdCrypto);//加密
app.use('/create_accounts', create_accounts);
app.use('/login', login);
app.use('/messageboard', messageboard);

app.listen(conf.port, function () {
    console.log('listening port ' + conf.port + '...');
});