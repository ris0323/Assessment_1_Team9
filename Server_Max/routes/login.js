var express = require('express');
var accounts = require('../models/accounts');

var router = express.Router();


router.route('/')

  .post(function (req, res) {
    accounts.check(req, function (err, results) {
      if (err) {
        res.sendStatus(500);
        return console.error(err);
      }

      if (!results.length) {
        res.send('not found');
        return;
      }

      res.send('success');
    });
  })

module.exports = router;