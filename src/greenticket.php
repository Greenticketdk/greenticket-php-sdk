<?php
	class Greenticket {
		private $app_id, $app_secret;
        const GET = "GET";
        const POST = "POST";

		function __construct ($app_id, $app_secret) {
			$this -> app_id = $app_id;
			$this -> app_secret = $app_secret;
		}

		public function api($path, $params = array(), $action = self::GET) {
			if (!$params)
                $params = array();
			$params["app_id"] = $this -> app_id;
            $path = "/" . $path;
			$hmacStr = $path;
			$hmacStr .= implode("", $params);
			$hmacStr .= $this -> app_secret;
			$hmac = hash("sha256", $hmacStr);
            $params["hmac"] = $hmac;
            $url = "https://www.greenticket.dk/api" . $path;
			if ($action === self::GET)
                $result = $this -> httpGet($url, $params);
            if ($action === self::POST)
                $result = $this -> httpPost($url, $params);
			if (json_decode($result))
				return json_decode($result, true);
			return array(
				"success" => false,
				"message" => $result
			);
		}

        private function httpGet($url, $params = array()) {
            $paramStr = http_build_query($params);
            $url = $url . "?" . $paramStr;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }

        private function httpPost($url, $params) {
            $postData = http_build_query($params);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER,  false);
            curl_setopt($ch, CURLOPT_POST, count($postData));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }
	}
?>
