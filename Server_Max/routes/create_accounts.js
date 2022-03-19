var express = require('express');
var accounts = require('../models/accounts');

var router = express.Router();


router.route('/')

  .post(function (req, res) {

    // res.send('Create Account!');
    accounts.add(req, function (err, results) {
      if (err) {
        res.sendStatus(500);
        return console.error(err);
      }

      res.send('Create Account!');
    });
  });

module.exports = router;