<?php

        runkit_function_rename("base64_decode", "__base64_decode_original__");
        runkit_function_rename("unserialize", "__unserialize_original__");

        $b64_cache = array();
        $new_base64_decode = <<<'EOD'
global $b64_cache;
if(strlen($data) > 1000000) {
        $ck = strlen($data);
        if(array_key_exists($ck, $b64_cache)) {
                return $b64_cache[$ck];
        }
        $b64_cache[$ck] = __base64_decode_original__($data,$strict);
        return $b64_cache[$ck];
} else {
        return __base64_decode_original__($data,$strict);
}
EOD;
        runkit_function_add("base64_decode", '$data,$strict = false', $new_base64_decode);


        $unserialize_cache = array();
        $new_unserialize = <<<'EOD'
global $unserialize_cache;
if(strlen($data) > 1000000) {
        $ck = strlen($data);
        if(array_key_exists($ck, $unserialize_cache)) {
                return $unserialize_cache[$ck];
        }
        $unserialize_cache[$ck] = __unserialize_original__($data);
        return $unserialize_cache[$ck];
} else {
        return __unserialize_original__($data);
}
EOD;
        // second ($options) argument to serialize was added in 7.0, so in 5.5 (our taget) only one argument
        runkit_function_add("unserialize", '$data', $new_unserialize);
?>
