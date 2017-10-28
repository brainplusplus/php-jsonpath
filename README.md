# php-jsonpath

fork from https://code.google.com/archive/p/jsonpath

and add JsonPathHelper class

how to use :

$url = "https://api-ssl.bitly.com/v3/link/referrers?access_token=xxxxx&link=http://bit.ly/xxxxx";

for example json in that url is :

{"status_code": 200, "data": {"units": -1, "unit_reference_ts": null, "tz_offset": -4, "unit": "day", "referrers": [{"referrer": "https://t.co/", "clicks": 111}, {"referrer": "direct", "clicks": 99}, {"referrer": "android-app://com.twitter.android", "clicks": 81}, {"referrer": "/android-app://com.twitter.android", "clicks": 2}]}, "status_txt": "OK"}

$expr = "$..referrers.*";

echo "<h2>Contoh ambil json string value</h2>";
$result = JsonPathHelper::getJsonStringValueByUrl($url,$expr);
echo $result;

echo "<h2>Contoh ambil json string path</h2>";
$result = JsonPathHelper::getJsonStringPathByUrl($url,$expr);
echo $result;

echo "<h2>Contoh ambil json object</h2>";
$result = JsonPathHelper::getJsonValueByUrl($url,$expr);
var_dump($result);
