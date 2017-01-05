<?php
// 天気情報をLivedoor 天気から取得、整形
$base_url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=130010";
$SERVER_INFO = getenv('SERVER_INFO');

// ローカルじゃなかったら
if ($SERVER_INFO != 'dev') {
	// プロキシ設定部分を有効にする
	$aContext = array (
			'http' => array (
					'proxy' => 'tcp://192.168.30.130:80/',
					'request_fulluri' => true
			)
	);
	stream_context_set_default ( $aContext );
}

$json = file_get_contents ( $base_url, false );
$obj = json_decode ( $json );
$title = $obj->title;
$img = $obj->forecasts [0]->image->url;
$description = $obj->description->text;
$img_width = $obj->forecasts [0]->image->width;
$img_height = $obj->forecasts [0]->image->height;
$max = (! isset ( $obj->forecasts [0]->temperature->max->celsius ) || is_null ( $obj->forecasts [0]->temperature->max->celsius )) ? '-' : $obj->forecasts [0]->temperature->max->celsius;
$min = (! isset ( $obj->forecasts [0]->temperature->min->celsius ) || is_null ( $obj->forecasts [0]->temperature->min->celsius )) ? '-' : $obj->forecasts [0]->temperature->min->celsius;
print <<< DOC_END
<br/>
<p>$title</p>
<img id="forecast-image" src=$img border="0" hegiht="$img_height" width="$img_width"><br>
$max / $min
<br>
DOC_END;
?>
