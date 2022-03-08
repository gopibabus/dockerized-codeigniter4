<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use DateTimeInterface;

class Cookie extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Cookie Prefix
     * --------------------------------------------------------------------------
     *
     * Set a cookie name prefix if you need to avoid collisions.
     *
     * @var string
     */
    public $prefix = '';

    /**
     * --------------------------------------------------------------------------
     * Cookie Expires Timestamp
     * --------------------------------------------------------------------------
     *
     * Default expires timestamp for cookies. Setting this to `0` will mean the
     * cookie will not have the `Expires` attribute and will behave as a session
     * cookie.
     *
     * @var DateTimeInterface|int|string
     */
    public $expires = 0;

    /**
     * --------------------------------------------------------------------------
     * Cookie Path
     * --------------------------------------------------------------------------
     *
     * Typically will be a forward slash.
     *
     * @var string
     */
    public $path = '/';

    /**
     * --------------------------------------------------------------------------
     * Cookie Domain
     * --------------------------------------------------------------------------
     *
     * Set to `.your-domain.com` for site-wide cookies.
     *
     * @var string
     */
    public $domain = '';

    /**
     * --------------------------------------------------------------------------
     * Cookie Secure
     * --------------------------------------------------------------------------
     *
     * Cookie will only be set if a secure HTTPS connection exists.
     *
     * @var bool
     */
    public $secure = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie HTTPOnly
     * --------------------------------------------------------------------------
     *
     * Cookie will only be accessible via HTTP(S) (no JavaScript).
     *
     * @var bool
     */
    public $httponly = true;

    /**
     * --------------------------------------------------------------------------
     * Cookie SameSite
     * --------------------------------------------------------------------------
     *
     * Configure cookie SameSite setting. Allowed values are:
     * - None
     * - Lax
     * - Strict
     * - ''
     *
     * Alternatively, you can use the constant names:
     * - `Cookie::SAMESITE_NONE`
     * - `Cookie::SAMESITE_LAX`
     * - `Cookie::SAMESITE_STRICT`
     *
     * Defaults to `Lax` for compatibility with modern browsers. Setting `''`
     * (empty string) means default SameSite attribute set by browsers (`Lax`)
     * will be set on cookies. If set to `None`, `$secure` must also be set.
     *
     * @var string
     */
    public $samesite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Cookie Raw
     * --------------------------------------------------------------------------
     *
     * This flag allows setting a "raw" cookie, i.e., its name and value are
     * not URL encoded using `rawurlencode()`.
     *
     * If this is set to `true`, cookie names should be compliant of RFC 2616's
     * list of allowed characters.
     *
     * @var bool
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#attributes
     * @see https://tools.ietf.org/html/rfc2616#section-2.2
     */
    public $raw = false;

    public function __construct()
    {
        if (getenv('COOKIE_PREFIX')) {
            $this->prefix = getenv('COOKIE_PREFIX');
        }
        if (getenv('COOKIE_EXPIRES')) {
            $this->expires = getenv('COOKIE_EXPIRES');
        }
        if (getenv('COOKIE_PATH')) {
            $this->path = getenv('COOKIE_PATH');
        }
        if (getenv('COOKIE_DOMAIN')) {
            $this->domain = getenv('COOKIE_DOMAIN');
        }
        if (getenv('COOKIE_SECURE')) {
            $this->secure = getenv('COOKIE_SECURE');
        }
        if (getenv('COOKIE_HTTP_ONLY')) {
            $this->httponly = getenv('COOKIE_HTTP_ONLY');
        }
        if (getenv('COOKIE_SAME_SITE')) {
            $this->samesite = getenv('COOKIE_SAME_SITE');
        }
        if (getenv('COOKIE_RAW')) {
            $this->raw = getenv('COOKIE_RAW');
        }
    }
}
