<?php
//login.php

//to prevent error.warning messages on page
error_reporting(0);

$client_id = 'tpbt0hvgmkijljvl0zn62j74kn87o6';
$client_secret = 'w7jgh0mcafi7ejb0qsszrctzbzkf5j';
$redirect_uri = 'https://crotched-runway.000webhostapp.com/';

if ($_GET['code']) {
    $token_url = 'https://api.twitch.tv/kraken/oauth2/token';
    $data = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'authorization_code',
        'redirect_uri' => $redirect_uri,
        'code' => $_GET['code']
    );

    $curl = curl_init($token_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    $result = curl_exec($curl);
    $i = curl_getinfo($curl);
    curl_close($curl);

    if ($i['http_code'] == 200) {
        $result = json_decode($result, true);

        // get
        $curl = curl_init('https://api.twitch.tv/kraken/user');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/vnd.twitchtv.v3+json',
            'Client-ID: ' . $client_id,
            'Authorization: OAuth ' . $result['access_token']
        ));
        $user = curl_exec($curl);
        $i = curl_getinfo($curl);
        curl_close($curl);

        if ($i['http_code'] == 200) {
			// THE USER IS LOGGED IN
            $user = json_decode($user);
			
			session_start();
			$_SESSION['username'] = $user->display_name;
			$getFavStreamer_link = htmlspecialchars("getFavStreamer.php");
			header("Location: getFavStreamer.php");

            echo '<div style="background-color: #6441A4; margin-top: 50px; height:250px; padding-top: 190px;" align="center">'.
			'<p style="color: cyan; font-size: 35px; font-weight: bold; ">Welcome User ' . $_SESSION['username'] . ' </p>'.
			'<p><a href="' .$getFavStreamer_link. '" style="color: cyan; font-size: 25px; font-weight: bold; ">Please Click this Link to Proceed</a></p>'.
			'</div>';

            
        } else {
            echo '<p>An error occured, please <a href="/">click here and try again</a></p>';
        }
    } else {
        echo '<p>An error occured, please <a href="/">click here and try again</a></p>';
    }
} else {
    $scopes = array(
        'user_read' => 1,
    );

    $req_scope = '';
    foreach ($scopes as $scope => $allow) {
        if ($allow) {
            $req_scope .= $scope . '+';
        }
    }
    $req_scope = substr($req_scope, 0, -1);

    $auth_url = 'https://api.twitch.tv/kraken/oauth2/authorize?response_type=code';
    $auth_url .= '&client_id=' . $client_id;
    $auth_url .= '&redirect_uri=' . $redirect_uri;
    $auth_url .= '&scope=' . $req_scope;
    $auth_url .= '&force_verify=true';

    echo '<div style="background-color: #6441A4; margin-top: 40px; height:430px; padding-top: 150px;" align="center">'.
	'<a href="' . $auth_url . '" style="color: cyan; font-size: 35px; font-weight: bold; ">Please Click this Link to Authenticate with Twitch</a></div>'.
	'</div>';
}
?>
