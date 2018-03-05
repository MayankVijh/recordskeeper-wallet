<?php
$net = $_POST['net'];
if ($net == 'TestNetwork'){
$config = include('config.php');}
else {
  $config = include('connection.php');
}
$chain = $config['chain'];
$curl = curl_init();
$tx_hex = $_POST['from'];
$priv = $_POST['key'];
curl_setopt_array($curl, array(
  CURLOPT_PORT => $config['rk_port'],
  CURLOPT_URL => $config['rk_host'],
  CURLOPT_USERPWD => $config['rk_user'].":".$config['rk_pass'],
  CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"method\":\"signrawtransaction\",\"params\":[\"$tx_hex\",[],[\"$priv\"]],\"id\":\"curltext\",\"chain_name\":\"$chain\"}",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Content-Type: application/json",
    "Postman-Token: 543000e0-8593-1e4c-05b3-b8461896794d"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

