<form action="" method="post">
    <div class="card shadow border-left-primary">
        <div class="card-body">
            <h5><i class="icon fa fa-info-circle"></i> Платежная система <a href="https://aaio.so?referral=434b7ffe10d8" target="_blank">AAIO</a></h5></br>
            - <b>Электронные платежи</b>: <b>Карты РФ</b>, <b>Карты Украины</b>, <b>СБП</b>, <b>Perfect Money</b>, <b>Volet</b> и <b>Оплата скинами Steam</b></br>
            - <b>Криптовалюты</b>: <b>Bitcoin</b>, <b>Bitcoin Cash</b>, <b>Ethereum (ETH)</b>, <b>Tether (TRC-20)</b>, <b>Tether (ERC-20)</b>, <b>Tether (BSC)</b>, <b>Tether (Polygon)</b>, <b>Tether (TON)</b>, <b>Binance Coin (BSC)</b>, <b>Notcoin</b>, <b>TRON</b>, <b>Litecoin</b>, <b>Dogecoin</b>, <b>TON</b> и <b>DASH</b></br></br>
            - Для регистрации в AAIO используйте <a href="https://aaio.so?referral=434b7ffe10d8" target="_blank">эту ссылку</a>.</br>
            - Модуль прошел тесты и работает на версиях магазина 1.7.1 - 1.8.0.
        </div>
    </div>

    <br />


<form action="" method="post"><div class="form-group"><label for="inputAAIOId">ID магазина</label>
<input class="form-control" type="text" id="inputAAIOShopId" name="shopid_key" value="{$SHOP_ID_VALUE}" placeholder="ID магазина">
</div>

<div class="form-group"><label for="inputAAIOApiKey">Секретный ключ 1</label>
<input class="form-control" type="text" id="inputAAIOApiKey" name="secret1_key" value="{$SHOP_API_KEY_VALUE}" placeholder="Секретный ключ 1">
</div>

<div class="form-group"><label for="inputAAIOApiKey2">Секретный ключ 2</label>
<input class="form-control" type="text" id="inputAAIOApiKey2" name="secret2_key" value="{$SHOP_API_KEY_2_VALUE}" placeholder="Секретный ключ 2">
</div>

<div class="form-group custom-control custom-switch">
<input id="inputEnabled" name="enable" type="checkbox" class="custom-control-input"{if $ENABLE_VALUE eq 1} checked{/if} />
<label class="custom-control-label" for="inputEnabled">Включить способ оплаты</label>
</div>

<div class="form-group"><input type="hidden" name="token" value="{$TOKEN}"><input type="submit" value="{$SUBMIT}" class="btn btn-primary">
</div>
</form>