<?php
define("USERNAMEAPI", "destinyoperadora");
define("TOKENAPI", "c41a71dec75b4ce2e898f2ffbbc74b978e35837f");
define("URLAPI", "http://www.goianiaemails.com.br/xml.php");

class Email {
	//$result = $objUteis->addEmailALista($email,"destinyoperadora","5998183b4f0d36ea5fafa45830f8140acc94b244",$lista,"http://www.gynmarketing.com.br/xml.php");
	function addEmail($email, $lista) {

		$xml = '
    <xmlrequest>
    <username>' . USERNAMEAPI . '</username>
    <usertoken>' . TOKENAPI . '</usertoken>
    <requesttype>subscribers</requesttype>
    <requestmethod>AddSubscriberToList</requestmethod>
    <details>
    <emailaddress>' . $email . '</emailaddress>
    <mailinglist>' . $lista . '</mailinglist>
    <format>html</format>
    <confirmed>yes</confirmed>
    </details>
    </xmlrequest>
    ';
		$ch = curl_init(URLAPI);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		$result = @curl_exec($ch);

		if ($result) {
			return true;
		}
	}

	function getAllList($limite = null) {
		if ($limite) {
			$limit = $limite;
		} else {
			$limit = 1000000;
		}
		$xml_data = '
		<xmlrequest>
			<username>' . USERNAMEAPI . '</username>
			<usertoken>' . TOKENAPI . '</usertoken>
			<requesttype>lists</requesttype>
			<requestmethod>GetLists</requestmethod>
			<details>
				<start>0</start>
				<perpage>' . $limit . '</perpage>
			</details>
		</xmlrequest>
		';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URLAPI);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_POST, true);
		if (!ini_get('safe_mode') && ini_get('open_basedir') == '') {
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		}
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		curl_setopt($ch, CURLOPT_POSTFIELDS, 'xml=' . $xml_data);

		$pageData = curl_exec($ch);

		if (!$pageData) {
			return false;
		}
		curl_close($ch);
		$result = simplexml_load_string($pageData);

		$tamanho = count($result -> data -> item);
		$arrayDados = array();

		for ($i = 0; $i < $tamanho; $i++) {
			$arrayDados[] = $result -> data -> item[$i];
		}
		return $arrayDados;
	}

	function deleteUser($email, $lista) {
		$xml = '<xmlrequest>
		 <username>' . USERNAMEAPI . '</username>
		 <usertoken>' . TOKENAPI . '</usertoken>
		 <requesttype>subscribers</requesttype>
		 <requestmethod>DeleteSubscriber</requestmethod>
		 <details>
		 <emailaddress>'.$email.'</emailaddress>
		 <list>'.$lista.'</list>
		 </details>
		 </xmlrequest>';

		$ch = curl_init(URLAPI);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		$result = @curl_exec($ch);
		if ($result === false) {
			return false;
		} else {
			$xml_doc = simplexml_load_string($result);
			if ($xml_doc -> status == 'SUCCESS') {
				return true;
			} else {
				return false;
			}
		}
	}

}
