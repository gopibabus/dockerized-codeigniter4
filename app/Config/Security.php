<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Security extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * CSRF Protection Method
     * --------------------------------------------------------------------------
     *
     * Protection Method for Cross Site Request Forgery protection.
     *
     * @var string 'cookie' or 'session'
     */
    public $csrfProtection = 'cookie';

    /**
     * --------------------------------------------------------------------------
     * CSRF Token Randomization
     * --------------------------------------------------------------------------
     *
     * Randomize the CSRF Token for added security.
     *
     * @var bool
     */
    public $tokenRandomize = false;

    /**
     * --------------------------------------------------------------------------
     * CSRF Token Name
     * --------------------------------------------------------------------------
     *
     * Token name for Cross Site Request Forgery protection.
     *
     * @var string
     */
    public $tokenName = 'csrf_test_name';

    /**
     * --------------------------------------------------------------------------
     * CSRF Header Name
     * --------------------------------------------------------------------------
     *
     * Header name for Cross Site Request Forgery protection.
     *
     * @var string
     */
    public $headerName = 'X-CSRF-TOKEN';

    /**
     * --------------------------------------------------------------------------
     * CSRF Cookie Name
     * --------------------------------------------------------------------------
     *
     * Cookie name for Cross Site Request Forgery protection.
     *
     * @var string
     */
    public $cookieName = 'csrf_cookie_name';

    /**
     * --------------------------------------------------------------------------
     * CSRF Expires
     * --------------------------------------------------------------------------
     *
     * Expiration time for Cross Site Request Forgery protection cookie.
     *
     * Defaults to two hours (in seconds).
     *
     * @var int
     */
    public $expires = 7200;

    /**
     * --------------------------------------------------------------------------
     * CSRF Regenerate
     * --------------------------------------------------------------------------
     *
     * Regenerate CSRF Token on every submission.
     *
     * @var bool
     */
    public $regenerate = true;

    /**
     * --------------------------------------------------------------------------
     * CSRF Redirect
     * --------------------------------------------------------------------------
     *
     * Redirect to previous page with error on failure.
     *
     * @var bool
     */
    public $redirect = true;

    /**
     * --------------------------------------------------------------------------
     * CSRF SameSite
     * --------------------------------------------------------------------------
     *
     * Setting for CSRF SameSite cookie token.
     *
     * Allowed values are: None - Lax - Strict - ''.
     *
     * Defaults to `Lax` as recommended in this link:
     *
     * @see https://portswigger.net/web-security/csrf/samesite-cookies
     *
     * @var string
     *
     * @deprecated
     */
    public $samesite = 'Lax';

    public function __construct()
    {
        if (getenv('SECURITY_CSRF_PROTECTION')) {
            $this->csrfProtection = getenv('SECURITY_CSRF_PROTECTION');
        }
        if (getenv('SECURITY_TOKEN_RANDOMIZE')) {
            $this->tokenRandomize = getenv('SECURITY_TOKEN_RANDOMIZE');
        }
        if (getenv('SECURITY_TOKEN_NAME')) {
            $this->tokenName = getenv('SECURITY_TOKEN_NAME');
        }
        if (getenv('SECURITY_HEADER_NAME')) {
            $this->headerName = getenv('SECURITY_HEADER_NAME');
        }
        if (getenv('SECURITY_COOKIE_NAME')) {
            $this->cookieName = getenv('SECURITY_COOKIE_NAME');
        }
        if (getenv('SECURITY_EXPIRES')) {
            $this->expires = getenv('SECURITY_EXPIRES');
        }
        if (getenv('SECURITY_REGENERATE')) {
            $this->regenerate = getenv('SECURITY_REGENERATE');
        }
        if (getenv('SECURITY_REDIRECT')) {
            $this->redirect = getenv('SECURITY_REDIRECT');
        }
        if (getenv('SECURITY_SAME_SITE')) {
            $this->samesite = getenv('SECURITY_SAME_SITE');
        }
    }
}
