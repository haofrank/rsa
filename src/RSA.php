<?php

namespace HaoFrank\Rsa;
require_once __DIR__ . '/../vendor/autoload.php';
use phpseclib\Crypt\RSA as RSALib;

/**
 *
 */
class RSA
{
    /**
     * use the phpseclib RSA lib
     *
     * @var  [type]
     */
    protected $rsaLib;

    /**
     * the key's password
     *
     * @var  [type]
     */
    protected $password;

    /**
     * the key's save path
     *
     * @var  [type]
     */
    protected $keyPath;


    public function __construct()
    {
        $this->rsaLib = new RSALib();
    }


    public function createKey(int $bits = 2048)
    {
        $this->rsaLib->setPrivateKeyFormat($this->rsaLib::PRIVATE_FORMAT_PKCS1);
        $this->rsaLib->setPublicKeyFormat($this->rsaLib::PUBLIC_FORMAT_PKCS1);

        $password = $this->getPassword();

        if (!is_null($password)&&is_string($password)&&!empty($password)) {
            $this->rsaLib->setPassword($password);
        }

        $keys = $this->rsaLib->createKey($bits);
        return $keys;
    }

    public function loadKey($file)
    {
        if (!file_exists($file)) {
            throw new \Exception("The Path Do Not Have A Key.");

        }
        $key = file_get_contents($file);
        $this->rsaLib->load($key);
    }


    /**
     * Set the password
     *
     * @param  mix  $password
     */
    public function setPassword($password = false)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the password
     *
     * @return  $this
     */
    public function getPassword()
    {
        return $this->password;
         // ?? config('rsa.key_password')
    }

    /**
     * Set the storage location of the encryption keys.
     *
     * @param  string  $path
     * @return  void
     */
    public function setKeysPath($path)
    {
        $this->keyPath = $path;
    }

    /**
     * Get the storage location of the encryption keys.
     *
     * @param  string  $path
     * @return  string
     */
    public function getKeysPath($path)
    {
        $path = ltrim($path, '/\\');

        return $this->keyPath
            ? rtrim($this->keyPath, '/\\').DIRECTORY_SEPARATOR.$path
            : storage_path($path);
    }

    /**
     * Encryption
     *
     * @param  string  $plaintext
     * @return  string
     */
    public function encrypt($plaintext)
    {
        $publicKeyPath = "";
        $this->loadKey($publicKeyPath);

        $ciphertext = $this->rsaLib->encrypt($plaintext);
        $ciphertext = urldecode($ciphertext);

        return $ciphertext;
    }

    /**
     * Decryption
     *
     * @param  string  $ciphertext
     * @return  string
     */
    public function decrypt($ciphertext)
    {
        $privateKeyPath = "";
        $this->loadKey($privateKeyPath);

        $ciphertext = urldecode($ciphertext);
        $plaintext = $this->rsaLib->decrypt($plaintext);

        return $plaintext;
    }

}

$rea = new RSA();
// $rea->setPassword('123456')->createKey();
var_dump($rea->createKey());
