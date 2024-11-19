<?php
/**
 * AAIO_Gateway class
 *
 * @package Modules\Store
 * @author AMGewka
 * @version 1.8.7
 * @license MIT
 */
class AAIO_Gateway extends GatewayBase
{
	public function __construct()
	{
		$name = 'AAIO';
		$author = '<a href="https://github.com/AMGewka" target="_blank">AMGewka</a>';
		$gateway_version = '1.8.7';
		$store_version = '1.7.1';
		$settings = ROOT_PATH . '/modules/Store/gateways/AAIO/gateway_settings/settings.php';

		parent::__construct($name, $author, $gateway_version, $store_version, $settings);
	}

	public function onCheckoutPageLoad(TemplateBase $template, Customer $customer) : void {}

	public function processOrder(Order $order) : void
	{
		$merchant_id = StoreConfig::get('AAIO.shopid_key');
		$amount = $order->getAmount()->getTotalCents() / 100;
		$currency = $order->getAmount()->getCurrency();
		$secret = StoreConfig::get('AAIO.secret1_key');
		$order_id = $order->data()->id;
		$referral = '434b7ffe10d8';
		$desc = 'Buying products: ' . $order->getDescription() . ' on ' . $order->customer()->getUser()->data()->username . ' account';
		$email = $order->customer()->getUser()->data()->email;

		if (empty($email)) {
			$email = StoreConfig::get('AAIO.admin_email');
		}
		$sign = hash('sha256', implode(':', [$merchant_id, $amount, $currency, $secret, $order_id]));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://aaio.so/merchant/get_pay_url');
		curl_setopt(
			$ch,
			CURLOPT_HTTPHEADER,
			[
				'Accept: application/json'
			]
		);
		curl_setopt(
			$ch,
			CURLOPT_POSTFIELDS,
			http_build_query(
				[
					'merchant_id' => $merchant_id,
					'amount' => $amount,
					'currency' => $currency,
					'order_id' => $order_id,
					'email' => $email,
					'desc' => $desc,
					'referral' => $referral,
					'sign' => $sign,
				]
			)
		);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);

		$result = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

		if (curl_errno($ch)) {
			die('Connect error:' . curl_error($ch));
		}
		curl_close($ch);

		if (!in_array($http_code, [200, 400, 401])) {
			die('Response code: ' . $http_code);
		}

		$decoded = json_decode($result, true);

		if (json_last_error() !== JSON_ERROR_NONE) {
			die('Error: Failed to parse response');
		}

		if ($decoded['type'] == 'success') {
			if (isset($decoded['url'])) {
				header("Location: " . $decoded['url']);
				exit;
			} else {
				die('Error: Payment URL not found');
			}
		} else {
			die('Error: ' . $decoded['message']);
		}
	}

	public function handleReturn() : bool
	{
		if (isset($decoded['url'])) {
			header("Location: " . $decoded['url']);
			exit;
		}

		return false;
	}

	public function handleListener() : void
	{
		$shopId = StoreConfig::get('AAIO.shopid_key');
		$apiKey = StoreConfig::get('AAIO.secret2_key');

		$allowedIps = array(
			'91.107.204.74',
		);

		if (!in_array($_SERVER['REMOTE_ADDR'], $allowedIps)) {
			die("Error: Untrusted IP address");
		}

		$data = $_POST;

		$signString = $data['merchant_id'] . ':' . $data['amount'] . ':' . $data['currency'] . ':' . $apiKey . ':' . $data['order_id'];
		$sign = hash('sha256', $signString);

		if ($sign != $data['sign']) {
			die("Error: Invalid signature");
		}

		$paymentId = $data['order_id'];
		$orderAmount = $data['amount'];
		$currency = $data['currency'];

		$payment = new Payment($paymentId, 'transaction');
		$paymentData = [
			'order_id' => $paymentId,
			'gateway_id' => $this->getId(),
			'transaction' => $paymentId,
			'amount_cents' => Store::toCents($orderAmount),
			'currency' => $currency,
			'fee_cents' => '0'
		];
		$payment->handlePaymentEvent(Payment::COMPLETED, $paymentData);
	}
}

$gateway = new AAIO_Gateway();
