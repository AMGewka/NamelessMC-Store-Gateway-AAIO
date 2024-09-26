<form action="" method="post">
    <div class="card shadow border-left-primary">
        <div class="card-body">
            <h5><i class="icon fa fa-info-circle"></i> Payment system <a href="https://aaio.so?referral=434b7ffe10d8" target="_blank">AAIO</a></h5></br>
            - <b>Bank cards</b>: <b>Bank Cards of the Russian Federation</b> и <b>Bank Cards of Ukraine</b></br>
            - <b>Electronic payments</b>: <b>Payment with skins (Steam)</b> и <b>SBP</b></br>
            - <b>Electronic wallets</b>: <b>Perfect Money</b> и <b>Volet</b></br>
            - <b>Cryptocurrencies</b>: <b>Bitcoin</b>, <b>Bitcoin Cash</b>, <b>Ethereum (ETH)</b>, <b>Tether (TRC-20)</b>, <b>Tether (ERC-20)</b>, <b>Tether (BSC)</b>, <b>Tether (Polygon)</b>, <b>Tether (Polygon)</b>, <b>Tether (TON)</b>, <b>Binance Coin (BSC)</b>, <b>Notcoin</b>, <b>TRON</b>, <b>Litecoin</b>, <b>Dogecoin</b>, <b>TON</b> и <b>DASH</b></br></br>
            - To register with <b>AAIO</b> use <a href="https://aaio.so?referral=434b7ffe10d8" target="_blank">this link</a>.</br>
            - The module has been tested and works on store versions 1.7.1 and higher.</br>
            - <b>Alert URL:</b> https://YOUR_DOMAIN/store/listener/?gateway=AAIO</br>
            - <b>Successful payment URL:</b> https://YOUR_DOMAIN/store/checkout/?do=complete</br>
            - <b>Failed payment URL:</b> Your choice :)
        </div>
    </div>

    <br />


<form action="" method="post"><div class="form-group"><label for="inputAAIOId">Shop ID</label>
<input class="form-control" type="text" id="inputAAIOShopId" name="shopid_key" value="{$SHOP_ID_VALUE}" placeholder="Shop ID<">
</div>

<div class="form-group"><label for="inputAAIOApiKey">Secret Key 1</label>
<input class="form-control" type="text" id="inputAAIOApiKey" name="secret1_key" value="{$SHOP_API_KEY_VALUE}" placeholder="Secret Key 1">
</div>

<div class="form-group"><label for="inputAAIOApiKey2">Secret Key 2</label>
<input class="form-control" type="text" id="inputAAIOApiKey2" name="secret2_key" value="{$SHOP_API_KEY_2_VALUE}" placeholder="Secret Key 2">
</div>

<div class="form-group custom-control custom-switch">
<input id="inputEnabled" name="enable" type="checkbox" class="custom-control-input"{if $ENABLE_VALUE eq 1} checked{/if} />
<label class="custom-control-label" for="inputEnabled">Enable payment method</label>
</div>

<div class="form-group"><input type="hidden" name="token" value="{$TOKEN}"><input type="submit" value="{$SUBMIT}" class="btn btn-primary">
</div>
</form>