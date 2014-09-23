<?php
/**
 * EyeSecureSession
 * Handles session encryption and decryption using CAST128
 *
 * LICENSE: This source file is subject to the BSD license
 * that is available through the world-wide-web at the following URI:
 * http://www.eyesis.ca/license.txt.  If you did not receive a copy of
 * the BSD License and are unable to obtain it through the web, please
 * send a note to mike@eyesis.ca so I can send you a copy immediately.
 *
 * @author     Micheal Frank <mike@eyesis.ca>
 * @copyright  2008 Eyesis
 * @license    http://www.eyesis.ca/license.txt  BSD License
 * @version    v1.0.1 11/12/2008 5:36:43 PM
 * @link       http://www.eyesis.ca/projects/securesession.html
 */
 
require 'cast128.php';

class EyeSecureSession
{
    const SESSION_PREFIX = 'SESSIONPIXELGO';
    const REGEN_COUNT = 5;
    const COUNT_NAME = '_eyesession_count';

    private $cast;
    private $secret;

    /**
    * Constructor
    * 
    * @param string $secret Private encryption key, set this to whatever just don't leave it blank
    * @return void
    */
    public function __construct($secret = '')
    {
        $this->secret = $secret;

        $lock = md5(uniqid($this->secret));
        foreach ($_COOKIE as $n => $v)
        {
            $len = strlen(self::SESSION_PREFIX);
            if (substr($n, 0, $len) == self::SESSION_PREFIX)
            {
                $lock = substr($n, $len);
                break;
            }
        }

        $this->cast = new cast128();
        $this->cast->setkey($this->secret . $lock);

        session_name(self::SESSION_PREFIX . $lock);
        session_start();

        if (self::REGEN_COUNT != NULL)
        {
            $count = (int) $this->get(self::COUNT_NAME);
            if ($count > 0)
            {
                if ($count >= self::REGEN_COUNT)
                {
                    session_regenerate_id(true);
                    $count = 1;
                }

                $this->set(self::COUNT_NAME, $count + 1);
            } else
                $this->set(self::COUNT_NAME, 1);
        }
    }

    /**
    * Retrieve a session variable
    *
    * @param string $name Name of the variable you are looking for
    * @return mixed
    */
    public function get($name)
    {
    	
       // $name = $this->cast->encrypt($name);
        $name = base64_encode($name);
        if(isset($_SESSION[$name])){
        	
	        $sessao = $_SESSION[$name];
	        
	        $value = base64_decode($sessao);
	        //$value = $this->cast->decrypt($value);
	        
	        
	        $value = unserialize($value);
        }else{
        	$value = false;
        }

        return $value;
    }

    /**
    * Store a session variable
    *
    * @param string $name Name of the variable
    * @param mixed $value Value of the variable; can be string, array, object, etc
    * @return boolean
    */
    public function set($name, $value)
    {
        //$name = $this->cast->encrypt($name);
        $name = base64_encode($name);

        $value = serialize($value);
        //$value = $this->cast->encrypt($value);
        $value = base64_encode($value);

        $_SESSION[$name] = $value;
        
        return true;
    }
}