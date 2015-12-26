<?php
/**
 * PHPMailer POP-Before-SMTP Authentication Class.
 * PHP Version 5
 * @package PHPMailer
 * @link https://github.com/PHPMailer/PHPMailer/
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 * @copyright 2012 - 2014 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * PHPMailer POP-Before-SMTP Authentication Class.
 * Specifically for PHPMailer to use for RFC1939 POP-before-SMTP authentication.
 * Does not support APOP.
 * @package PHPMailer
 * @author Richard Davey (original author) <rich@corephp.co.uk>
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @mods StudioJunkyard for Libr8. (devel) <https://github.com/StudioJunkyard/Libr8>
 */class POP3{public$POP3_PORT=110;public$POP3_TIMEOUT=30;public$CRLF="\r\n";public$do_debug=2;public$host;public$port;public$tval;public$username;public$password;public$Version='5.2.6';private$pop_conn;private$connected;private$error;public function __construct(){$this->pop_conn=0;$this->connected=false;$this->error=null;}public function Authorise($host,$port=false,$tval=false,$username,$password,$debug_level=0){$this->host=$host;if($port==false){$this->port=$this->POP3_PORT;}else{$this->port=$port;}if($tval==false){$this->tval=$this->POP3_TIMEOUT;}else{$this->tval=$tval;}$this->do_debug=$debug_level;$this->username=$username;$this->password=$password;$this->error=null;$result=$this->Connect($this->host,$this->port,$this->tval);if($result){$login_result=$this->Login($this->username,$this->password);if($login_result){$this->Disconnect();return true;}}$this->Disconnect();return false;}public function Connect($host,$port=false,$tval=30){if($this->connected){return true;}set_error_handler(array(&$this,'catchWarning'));$this->pop_conn=fsockopen($host,$port,$errno,$errstr,$tval);restore_error_handler();if($this->error&&$this->do_debug>=1){$this->displayErrors();}if($this->pop_conn==false){$this->error=array('error'=>"Failed to connect to server $host on port $port",'errno'=>$errno,'errstr'=>$errstr);if($this->do_debug>=1){$this->displayErrors();}return false;}if(version_compare(phpversion(),'5.0.0','ge')){stream_set_timeout($this->pop_conn,$tval,0);}else{if(substr(PHP_OS,0,3)!=='WIN'){socket_set_timeout($this->pop_conn,$tval,0);}}$pop3_response=$this->getResponse();if($this->checkResponse($pop3_response)){$this->connected=true;return true;}return false;}public function Login($username='',$password=''){if($this->connected==false){$this->error='Not connected to POP3 server';if($this->do_debug>=1){$this->displayErrors();}}if(empty($username)){$username=$this->username;}if(empty($password)){$password=$this->password;}$pop_username="USER $username".$this->CRLF;$pop_password="PASS $password".$this->CRLF;$this->sendString($pop_username);$pop3_response=$this->getResponse();if($this->checkResponse($pop3_response)){$this->sendString($pop_password);$pop3_response=$this->getResponse();if($this->checkResponse($pop3_response)){return true;}}return false;}public function Disconnect(){$this->sendString('QUIT');fclose($this->pop_conn);}private function getResponse($size=128){$pop3_response=fgets($this->pop_conn,$size);return$pop3_response;}private function sendString($string){$bytes_sent=fwrite($this->pop_conn,$string,strlen($string));return$bytes_sent;}private function checkResponse($string){if(substr($string,0,3)!=='+OK'){$this->error=array('error'=>"Server reported error:$string",'errno'=>0,'errstr'=>'');if($this->do_debug>=1){$this->displayErrors();}return false;}else{return true;}}private function displayErrors(){echo'<pre>';foreach($this->error as$single_error){print_r($single_error);}echo'</pre>';}private function catchWarning($errno,$errstr,$errfile,$errline){$this->error[]=array('error'=>"Connecting to POP3 server raised a PHP warning:",'errno'=>$errno,'errstr'=>$errstr);}}