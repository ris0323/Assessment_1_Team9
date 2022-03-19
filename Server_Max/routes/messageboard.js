var express = require('express');
var messageboard = require('../models/messageboard');

var router = express.Router();


router.route('/')
  // 所有
  .get(function (req, res) {
    console.log('pass');
    // res.send('hello world');
    messageboard.lists(req, function (err, results) {
      if (err) {
        res.sendStatus(500);
        return console.error(err);
      }

      if (!results.length) {
        res.sendStatus(404);
        return;
      }

      res.json(results);
    });
  })
  // 新增
  .post(function (req, res) {
    messageboard.add(req, function (err, results) {
      if (err) {
        res.sendStatus(500);
        return console.error(err);
      }

      res.send('Create Message');
    });
  });


router.route('/:id')
  // 取得一筆
  .get(function (req, res) {
    messageboard.list(req, function (err, results) {
      if (err) {
        res.sendStatus(500);
        return console.error(err);
      }

      if (!results.length) {
        res.sendStatus(404);
        return;
      }

      res.json(results);
    });
  })
  // 刪除
  .delete(function (req, res) {
    messageboard.delete(req, function (err, results) {
      if (err) {
        res.sendStatus(500);
        return console.error(err);
      }

      if (!results.affectedRows) {
        res.sendStatus(410);
        return;
      }

      // 成功是沒有內容
      res.sendStatus(204);
    });
  })

module.exports = router;