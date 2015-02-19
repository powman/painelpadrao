<?php


/** This file is part of KCFinder project
  *
  *      @desc Browser calling script
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */
include_once "../../classes/session/class.eyesecuresession.inc.php";
$objSession2 = new EyeSecureSession('session123');

if($objSession2->get('tlAdmLoginId')):
    require "core/bootstrap.php";
    $browser = "kcfinder\\browser"; // To execute core/bootstrap.php on older
    $browser = new $browser();      // PHP versions (even PHP 4)
    $browser->action();
endif;

?>