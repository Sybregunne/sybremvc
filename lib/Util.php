<?php
    namespace lib;

    class Util {
        static function abort($message, $code = 404) {
            http_response_code($code);
            echo $message;
            exit();
        }

        static function dataGet($arr, $key) {

            if (!is_array($arr) || empty($key)) {
                return null;
            }

            $keysArr = explode(".", $key);
            $searchedKey = $keysArr[count($keysArr) - 1];

            $i = 0;

            if(array_key_exists($keysArr[$i], $arr)) {

                $nextArr = $arr[$keysArr[$i]];

                while($i < count($keysArr)) {

                    $i++;

                    if(!array_key_exists($keysArr[$i], $nextArr)) break;

                    if($keysArr[$i] === $searchedKey) return $nextArr[$keysArr[$i]];

                    $nextArr = $nextArr[$keysArr[$i]];
                }
            }

            return null;
        }

        static function encryptData($data, $key) {
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
            return base64_encode($iv . $encrypted);
        }

        static function decryptData($encryptedData, $key) {
            $encryptedData = base64_decode($encryptedData);
            $ivLength = openssl_cipher_iv_length('aes-256-cbc');
            $iv = substr($encryptedData, 0, $ivLength);
            $encrypted = substr($encryptedData, $ivLength);
            return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
        }
    }