<?php

$token = "a938c42106cbc065189b13c15c2f438f85559bdfeca684e28272771ffeb435671fa2a9bc5542267809c47";
$mes = [
    'вопрос' => 'ответ',
    'привет' => 'Это бот',
    'пока' => 'саси',
    '/help' => 'помощь'
];

for($i = 0; $i < 30; $i++){
    foreach($mes as $key => $value){
        $j = json_decode(file_get_contents("https://api.vk.com/method/messages.get?count=1&out=0&time_offset=30&v=5.62&access_token=".$token),true);
        //print_r($j);
        $text = $j['response']['items'][0]['body'];
    	$read = $j['response']['items'][0]['read_state'];
    	$id = $j['response']['items'][0]['user_id'];
        $mid = $j['response']['items'][0]['id'];
        if($text == $key){
            $rand = mt_rand(20, 99999999);
            $request_params = [
            'user_id' => $id,
            'random_id' => $rand,
            'message' => $value,
            'v' => '5.62',
            'access_token' => $token
            ];
            if($mid !== $rand){
                $url = "https://api.vk.com/method/messages.send?". http_build_query($request_params);
                file_get_contents($url);
            }
        }
    }
}
?>
