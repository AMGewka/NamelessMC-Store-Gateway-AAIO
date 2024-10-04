<?php
/**
 * AAIO_Gateway class
 *
 * @package Modules\Store
 * @author AMGewka
 * @version 1.8.4
 * @license MIT
 */
class AAIO_Gateway extends GatewayBase {
    public function __construct() {
        $name = 'AAIO';
        $author = '<a href="https://github.com/AMGewka" target="_blank">AMGewka</a>';
        $gateway_version = '1.8.4';
        $store_version = '1.7.1';
        $settings = ROOT_PATH . '/modules/Store/gateways/AAIO/gateway_settings/settings.php';

        parent::__construct($name, $author, $gateway_version, $store_version, $settings);
    }

    public function onCheckoutPageLoad(TemplateBase $template, Customer $customer): void {}

    public function processOrder(Order $order): void {
        $shopId = StoreConfig::get('AAIO.shopid_key');
        $apiKey = StoreConfig::get('AAIO.secret1_key');

        if ($shopId == null || empty($shopId)) {
            $this->addError('Administration have not completed the configuration of this gateway!');
            return;
        }

        $paymentId = $order->data()->id;
        $orderAmount = $order->getAmount()->getTotalCents() / 100;
        $currency = $order->getAmount()->getCurrency();

        $data = [
            'merchant_id' => $shopId,
            'amount' => $orderAmount,
            'order_id' => $paymentId,
            'currency' => $currency,
        ];

        $signString = $shopId . ':' . $orderAmount . ':' . $currency . ':' . $apiKey . ':' . $paymentId;
        $data['sign'] = hash('sha256', $signString);

        $queryString = http_build_query($data);

        header('Location: https://aaio.so/merchant/pay?' . $queryString);
        exit;
    }

    public function handleReturn(): bool {
        if (isset($_GET['do']) && $_GET['do'] == 'success') {
            header("Location: " . URL::getSelfURL(), '/') . URL::build('/store/');
        }

        return false;
    }

    public function handleListener(): void {
        $shopId = StoreConfig::get('AAIO.shopid_key');
        $apiKey = StoreConfig::get('AAIO.secret2_key');

        $allowedIps = array(
            '91.107.204.74',
        );

        if(!in_array($_SERVER['REMOTE_ADDR'], $allowedIps)){
            die("bad ip!");
        }

        $data = $_POST;

        $signString = $data['merchant_id'] . ':' . $data['amount'] . ':' . $data['currency'] . ':' . $apiKey . ':' . $data['order_id'];
        $sign = hash('sha256', $signString);

        if ($sign != $data['sign']) {
            die("bad sign!");
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