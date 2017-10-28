<?php
/* JSONPathHelper 0.0.1 - XPath for JSON Helper
 *
 * Copyright (c) 2017 Muhammad Tri Wibowo
 * Licensed under the MIT (MIT-LICENSE.txt) licence.
 */
namespace Bitsolution\Utils;


class JsonPathHelper{
	// API function 
	public static function jsonPath($obj, $expr, $args=null) {
	   $jsonpath = new JsonPath();
	   $jsonpath->resultType = ($args ? $args['resultType'] : "VALUE");
	   $x = $jsonpath->normalize($expr);
	   $jsonpath->obj = $obj;
	   if ($expr && $obj && ($jsonpath->resultType == "VALUE" || $jsonpath->resultType == "PATH")) {
		  $jsonpath->trace(preg_replace("/^\\$;/", "", $x), $obj, "$");
		  if (count($jsonpath->result))
			 return $jsonpath->result;
		  else
			 return false;
	   }
	}
	
	public static function getJsonStringPathByUrl($url,$expr){
		$json = JsonPathHelper::curlGet($url);
		$obj = json_decode($json,true);
		return json_encode(JsonPathHelper::jsonPath($obj, $expr , array("resultType" => "PATH")));
	}
	
	public static function getJsonStringValueByUrl($url,$expr){
		$json = JsonPathHelper::curlGet($url);
		$obj = json_decode($json,true);
		return json_encode(JsonPathHelper::jsonPath($obj, $expr , array("resultType" => "VALUE")));
	}
	
	public static function getJsonPathByUrl($url,$expr){
		$json = JsonPathHelper::curlGet($url);
		$obj = json_decode($json,true);
		return JsonPathHelper::jsonPath($obj, $expr , array("resultType" => "PATH"));
	}
	
	public static function getJsonValueByUrl($url,$expr){
		$json = JsonPathHelper::curlGet($url);
		$obj = json_decode($json,true);
		return JsonPathHelper::jsonPath($obj, $expr , array("resultType" => "VALUE"));
	}
	
	public static function getJsonStringPath($obj,$expr){
		return json_encode(JsonPathHelper::jsonPath($obj, $expr , array("resultType" => "PATH")));
	}
	
	public static function getJsonStringValue($obj,$expr){
		return json_encode(JsonPathHelper::jsonPath($obj, $expr , array("resultType" => "VALUE")));
	}
	
	public static function getJsonPath($obj,$expr){
		return JsonPathHelper::jsonPath($obj, $expr , array("resultType" => "PATH"));
	}
	
	public static function getJsonValue($obj,$expr){
		return JsonPathHelper::jsonPath($obj, $expr , array("resultType" => "VALUE"));
	}
	
	public static function curlGet($url){
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		
		return $result;
	}
	
}

?>