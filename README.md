This is a performance monkey-patch using runkit for `base64_decode` and `unserialize` for PHP 5.x series.

Context is [https://id-rsa.pub/post/shimming-php-for-fun-and-profit/](here).

## cPanel specific instructions
I suggest that you have CloudLinux, CageFS and PHP Selector setup.

You will need to build runkit from source and follow http://docs.cloudlinux.com/compiling_your_own_extensions.html .

You will need to ensure that `runkit.internal_override = on` s set - follow http://docs.cloudlinux.com/individual_php_ini_files.html .
