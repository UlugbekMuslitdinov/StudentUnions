<?php

namespace PHPMaker2022\project2;

use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

/**
 * Two Factor Authentication class (Google Authenticator only)
 */
class TwoFactorAuthentication
{
    /**
     * Get QR Code URL
     */
    public static function getQrCodeUrl($usr, $secret, $issuer = null, $size = 0)
    {
        $issuer = $issuer ?? Config("TWO_FACTOR_AUTHENTICATION_ISSUER");
        $size = $size ?: Config("TWO_FACTOR_AUTHENTICATION_QRCODE_SIZE");
        return GoogleQrUrl::generate($usr, $secret, $issuer, $size);
    }

    /**
     * Check code
     *
     * @param string $secret Secret
     * @param string $code Code
     */
    public static function checkCode($secret, $code): bool
    {
        $g = new GoogleAuthenticator(Config("TWO_FACTOR_AUTHENTICATION_PASS_CODE_LENGTH"));
        return $g->checkCode($secret, $code, Config("TWO_FACTOR_AUTHENTICATION_DISCREPANCY"));
    }

    /**
     * Generate secret
     */
    public static function generateSecret(): string
    {
        $g = new GoogleAuthenticator(Config("TWO_FACTOR_AUTHENTICATION_PASS_CODE_LENGTH"));
        return $g->generateSecret();
    }

    /**
     * Generate backup codes
     */
    public static function generateBackupCodes(): array
    {
        $length = Config("TWO_FACTOR_AUTHENTICATION_BACKUP_CODE_LENGTH");
        $count = Config("TWO_FACTOR_AUTHENTICATION_BACKUP_CODE_COUNT");
        $ar = [];
        for ($i = 0; $i < $count; $i++) {
            $ar[] = Random($length);
        }
        return $ar;
    }

    // Show QR Code URL
    public function showQrCodeUrl()
    {
        $user = CurrentUserName(); // Must be current user
        $profile = Container("profile");
        if (!$profile->hasUserSecret($user, true)) {
            $secret = $profile->getUserSecret($user); // Get Secret
            WriteJson(["url" => self::getQrCodeUrl($user, $secret), "success" => true]);
            return;
        }
        WriteJson(["success" => false]);
    }

    public function getBackupCodes()
    {
        $user = CurrentUserName(); // Must be current user
        $profile = Container("profile");
        $codes = $profile->getBackupCodes($user);
        WriteJson(["codes" => $codes, "success" => is_array($codes)]);
    }

    // Get new backup codes
    public function getNewBackupCodes()
    {
        $user = CurrentUserName(); // Must be current user
        $profile = Container("profile");
        $codes = $profile->getNewBackupCodes($user);
        WriteJson(["codes" => $codes, "success" => is_array($codes)]);
    }

    // Verify
    public function verify($code)
    {
        $user = CurrentUserName(); // Must be current user
        $profile = Container("profile");
        if ($code === null) { // Verify if user has secret only
            if ($profile->hasUserSecret($user, true)) {
                WriteJson(["success" => $success]);
                return;
            }
        } else { // Verify user code
            if ($profile->hasUserSecret($user)) { // Verified, just check code
                WriteJson(["success" => $profile->verify2FACode($user, $code)]);
                return;
            }
        }
        WriteJson(["success" => false]);
    }

    // Reset
    public function reset($user)
    {
        $user = IsSysAdmin() ? $user : (Config("FORCE_TWO_FACTOR_AUTHENTICATION") ? null : CurrentUserName());
        if ($user) {
            $profile = Container("profile");
            if ($profile->hasUserSecret($user)) {
                $profile->resetUserSecret($user);
                WriteJson(["success" => true]);
                return;
            }
        }
        WriteJson(["success" => false]);
    }
}
