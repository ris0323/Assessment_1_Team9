var mysql = require('mysql');
var conf = require('../conf');

var connection = mysql.createConnection(conf.db);
var sql = '';

module.exports = {

  add: function (req, callback) {
    sql = mysql.format('INSERT INTO accounts SET ?', req.body);
    return connection.query(sql, callback);
  },
  check: function (req, callback) {
    sql = mysql.format('SELECT * FROM accounts WHERE username = ? AND password = ?', [req.body.username , req.body.password]);
    return connection.query(sql, callback);
  }
  
};