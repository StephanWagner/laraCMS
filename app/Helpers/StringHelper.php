<?php

namespace App\Helpers;

class StringHelper
{
    // Encryption key for openssl
    private static $encryptionKey = 'hKbYVb2C';

    // 16-byte IV for AES-128-CTR
    private static $iv = '1503236205612866';

    /**
     * Remove multiple, leading or trailing spaces
     */
    public static function removeSpaces($value = '', $all = false)
    {
        return preg_replace('/\s+/', ($all ? '' : ' '), trim($value));
    }

    /**
     * Sanitise input
     */
    public static function sanitise($html)
    {
        if (empty($html)) {
            return $html;
        }
        $html = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $html);
        return $html;
    }

    /**
     * Get readable exception string
     */
    public static function getReadableExceptionString($e, $stackTrace = false)
    {
        $readableErrorString = "Exception caught: " . $e->getMessage() .
            " in " . $e->getFile() .
            " on line " . $e->getLine() .
            " with code " . $e->getCode();

        if ($stackTrace) {
            $readableErrorString .= "\nStack trace: " . $e->getTraceAsString();
        }

        return $readableErrorString;
    }

    /**
     * Encrypt a given string using AES-128-CTR with OpenSSL.
     *
     * @param string $value The string to encrypt.
     * @return string The encrypted string encoded for URL usage.
     */
    public static function encrypt($value)
    {
        $encryptedString = openssl_encrypt($value, 'AES-128-CTR', self::$encryptionKey, 0, self::$iv);
        return rtrim(strtr(base64_encode($encryptedString), '+/', '-_'), '=');
    }

    /**
     * Decrypt a given encrypted string back to the original.
     *
     * @param string $encryptedString The URL-encoded, encrypted string.
     * @return string The decrypted original string.
     */
    public static function decrypt($encryptedString)
    {
        $encryptedString = str_pad(strtr($encryptedString, '-_', '+/'), strlen($encryptedString) % 4, '=');
        $encryptedString = base64_decode($encryptedString);
        return openssl_decrypt($encryptedString, 'AES-128-CTR', self::$encryptionKey, 0, self::$iv);
    }
}
