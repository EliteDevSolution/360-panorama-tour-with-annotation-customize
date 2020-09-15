<?php
if(isset($_GET['param'])){
	switch($_GET['param']){
		case "fetch":
            $search = $_GET['search'];
            $url = "https://store.uwood.com.br/index.php/rest/V1/products?searchCriteria[filter_groups][0][filters][0][field]=name&searchCriteria[filter_groups][0][filters][0][value]=%$search%&searchCriteria[filter_groups][0][filters][0][condition_type]=like";
            $authorization = "Authorization: Bearer m1xz9g6c8ou7fz86k40eukfigmsuxuxd";
            $res = getCurlResponse($url, $authorization);
            echo json_encode($res['items']);
		break;
				default:
			echo 'not valid';
		break;
	}
}else{
	echo 'failed';
}

function getCurlResponse($url, $authorization)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array("Content-Type: application/json", $authorization),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}
?>