<?php

/*
 *  Made by AMGewka
 *  https://github.com/AMGewka
 *
 *  License: MIT
 *
 *  Store module
 */
require_once(ROOT_PATH . '/modules/Store/classes/StoreConfig.php');
$aaio_language = new Language(ROOT_PATH . '/modules/Store/gateways/AAIO/language', LANGUAGE);
$page_title = $aaio_language->get('gateways', 'aaio');

if (Input::exists()) {
	if (Token::check()) {
		if (isset($_POST['shopid_key']) && isset($_POST['secret1_key']) && isset($_POST['secret2_key']) && isset($_POST['admin_email']) && strlen($_POST['shopid_key']) && strlen($_POST['secret1_key']) && strlen($_POST['secret2_key']) && strlen($_POST['admin_email'])) {
			StoreConfig::set('AAIO.shopid_key', $_POST['shopid_key']);
			StoreConfig::set('AAIO.secret1_key', $_POST['secret1_key']);
			StoreConfig::set('AAIO.secret2_key', $_POST['secret2_key']);
			StoreConfig::set('AAIO.admin_email', $_POST['admin_email']);
		}

        // Is this gateway enabled
		if (isset($_POST['enable']) && $_POST['enable'] == 'on') $enabled = 1;
		else $enabled = 0;

		DB::getInstance()->update(
			'store_gateways',
			$gateway->getId(),
			[
				'enabled' => $enabled
			]
		);

		Session::flash('gateways_success', $language->get('admin', 'successfully_updated'));
	} else $errors = [$language->get('general', 'invalid_token')];
}

$smarty->assign(
	[
		'SETTINGS_TEMPLATE' => ROOT_PATH . '/modules/Store/gateways/AAIO/gateway_settings/settings.tpl',
		'ENABLE_VALUE' => ((isset($enabled)) ? $enabled : $gateway->isEnabled()),
		'SHOP_ID_VALUE' => ((isset($_POST['shopid_key']) && $_POST['shopid_key']) ? Output::getClean(Input::get('shopid_key')) : StoreConfig::get('AAIO.shopid_key')),
		'SHOP_API_KEY_VALUE' => ((isset($_POST['secret1_key']) && $_POST['secret1_key']) ? Output::getClean(Input::get('secret1_key')) : StoreConfig::get('AAIO.secret1_key')),
		'SHOP_API_KEY_2_VALUE' => ((isset($_POST['secret2_key']) && $_POST['secret2_key']) ? Output::getClean(Input::get('secret2_key')) : StoreConfig::get('AAIO.secret2_key')),
		'ADMIN_EMAIL_VALUE' => ((isset($_POST['admin_email']) && $_POST['admin_email']) ? Output::getClean(Input::get('admin_email')) : StoreConfig::get('AAIO.admin_email')),
		'ADMIN_EMAIL' => $aaio_language->get('adminemail'),
		'SHOP_ID' => $aaio_language->get('shopid'),
		'SHOP_KEY1' => $aaio_language->get('key1'),
		'SHOP_KEY2' => $aaio_language->get('key2'),
		'ENABLE_GATEWAY' => $aaio_language->get('enablegateway'),
		'GATEWAY_NAME' => $aaio_language->get('gatewayname'),
		'BANK_CARD' => $aaio_language->get('bankcard'),
		'ONLINE_PAYMENTS' => $aaio_language->get('onlinepay'),
		'ONLINE_WALLET' => $aaio_language->get('onlinewal'),
		'CRYPTOCURRENCIES' => $aaio_language->get('crypto'),
		'GATEWAY_LINK' => $aaio_language->get('gatewaylink'),
		'GATEWAY_TESTED' => $aaio_language->get('gatewaytest'),
		'ALERT_URL' => $aaio_language->get('alerturl'),
		'SUCCESS_URL' => $aaio_language->get('sucurl'),
		'PINGBACK_URL' => rtrim(URL::getSelfURL(), '/') . URL::build('/store/listener', 'gateway=AAIO'),
		'SUCC_URL' => rtrim(URL::getSelfURL(), '/') . URL::build('/store/checkout', 'do=complete'),
		'ACC_CUR' => $aaio_language->get('acc_currency'),
		'WARINFO1' => $aaio_language->get('warinfo1'),
		'WARINFO2' => $aaio_language->get('warinfo2')
	]
);
