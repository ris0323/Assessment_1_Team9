var mysql = require('mysql');
var conf = require('../conf');

var connection = mysql.createConnection(conf.db);
var sql = '';

module.exports = {

  lists: function (req, callback) {
    sql = 'SELECT * FROM messageboard';
    return connection.query(sql, callback);
  },
  list: function (req, callback) {
    sql = mysql.format('SELECT * FROM messageboard WHERE id = ?', [req.params.id]);
    return connection.query(sql, callback);
  },
  add: function (req, callback) {
    sql = mysql.format('INSERT INTO messageboard SET ?', req.body);
    return connection.query(sql, callback);
  },
  delete: function (req, callback) {
    sql = mysql.format('DELETE FROM messageboard WHERE id = ?', [req.params.id]);
    return connection.query(sql, callback);
  },
  
};