var crypto = require('crypto'); // 加解密軟體 (內建模組)
 
module.exports = {
    // 加密
    passwdCrypto: function (req, res, next) {
        if (req.body.password) {
            req.body.password = crypto.createHash('md5')
                                .update(req.body.password)
                                .digest('hex');
        }
        next();
    }
};