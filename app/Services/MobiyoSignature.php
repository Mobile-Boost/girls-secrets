<?php

// namespace App\Services;

// class MobiyoSignature
// {
//     public static function verify(array $params, string $secret): bool
//     {
//         $received = $params['api_sig'] ?? null;
//         if (!$received) return false;

//         $algo = strtolower($params['api_hash'] ?? 'sha1');
//         unset($params['api_sig']);

//         ksort($params, SORT_STRING);

//         $toCompute = '';
//         foreach ($params as $k => $v) {
//             $toCompute .= $k . $v;
//         }

//         $computed = $algo === 'md5'
//             ? md5($toCompute . $secret)
//             : sha1($toCompute . $secret);

//         // comparaison en temps constant
//         return hash_equals($received, $computed);
//     }
// }

// app/Services/MobiyoSignature.php
namespace App\Services;

class MobiyoSignature
{
    public static function verify(array $params, string $secret): bool
    {
        // Bypass local si ?test=true (aucune signature requise)
        if (config('mobiyo.bypass_signature') && app()->isLocal() && ($params['test'] ?? 'false') === 'true') {
            return true;
        }

        $received = $params['api_sig'] ?? null;
        if (!$received) return false;

        $algo = strtolower($params['api_hash'] ?? 'sha1');
        unset($params['api_sig']);

        ksort($params, SORT_STRING);
        $toCompute = '';
        foreach ($params as $k => $v) { $toCompute .= $k . $v; }

        $computed = $algo === 'md5'
            ? md5($toCompute . $secret)
            : sha1($toCompute . $secret);

        return hash_equals($received, $computed);
    }
}
