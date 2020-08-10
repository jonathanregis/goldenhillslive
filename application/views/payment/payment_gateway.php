<?php
use Expay\SDK\MerchantApi as ExpressPayMerchantApi;
$total_price_of_checking_out = $this->session->userdata('total_price_of_checking_out');
$user = $this->user_model->get_user($this->session->userdata("user_id"))->row_array();
$order_id = $user['id'] . "0" . rand(1000,9999);
$merchant_id = "446310613152";
$merchant_key = "eJmsG7J60QzeEDGNPYzed-zmLJmvC0xaFjQaR2DmIF-UfHXfJcO2ZH9BO3QbNBt-uNvP8BJDg2wYYGGrn8Y";
$environment = "sandbox";
$description = "Golden Hills Online course enrolment";
$redirect_url = site_url("home/exp_payment");
$account_number = $user['id'] . "245";
$email = $user['email'];
$first_name = $user['first_name'];
$last_name = $user['last_name'];

/**
 * $this->merchant_id = Your expressPay merchant id
 * $this->merchant_key = Your expressPay merchant api key
 * $this->environment = Your preferred environment, allowed params ('sandbox' or 'production')
 */
$merchantApi = new ExpressPayMerchantApi($merchant_id, $merchant_key, $environment);

/**
 * submit
 *
 * string $currency
 * float $amount
 * string $order_id
 * string $order_desc
 * string $redirect_url
 * string $account_number
 * string | null $order_img_url
 * string | null $first_name
 * string | null $last_name
 * string | null $phone_number
 * string | null $email
 */
$response = $merchantApi->submit(
  "GHS",
  $total_price_of_checking_out,
  $order_id,
  $description,
  $redirect_url,
  $account_number,
  "https://goldenhills.monteuch.com/uploads/system/logo-dark.png",
  $first_name,
  $last_name,
  null,
  $email
);
if($response){
	if($response['status'] == 1){
		echo "<script>window.location.replace('".$merchantApi->checkout($response['token'])."')</script>";
	}
}

print("Please wait, redirecting to expresspay for payment...<br/>");
print_r($response);
?>