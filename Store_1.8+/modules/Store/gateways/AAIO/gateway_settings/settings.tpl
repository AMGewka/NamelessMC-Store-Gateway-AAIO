<form action="" method="post">
    <div class="card shadow border-left-primary">
        <div class="card-body">
            <h5><i class="icon fa fa-info-circle"></i>{$GATEWAY_NAME}</h5></br>
            {$BANK_CARD}</br>
            {$ONLINE_PAYMENTS}</br>
            {$ONLINE_WALLET}</br>
            {$CRYPTOCURRENCIES}</br></br>
            {$GATEWAY_LINK}</br>
        </div>
    </div>
    <br />
    <div class="card shadow border-left-success">
        <div class="card-body">
            <h5><i class="icon fa-duotone fa-solid fa-file"></i>{$WARINFO1}</h5>
            {$ALERT_URL} <code>{$PINGBACK_URL}</code></br>
            {$SUCCESS_URL} <code>{$SUCC_URL}</code></br>
            {$MORUNE_URL} {$MORUNE_URL_TEMP}</br>
        </div>
    </div>
    <br />
    <div class="card shadow border-left-warning">
        <div class="card-body">
            <h5><i class="icon fa-duotone fa-solid fa-wrench"></i>{$WARINFO2}</h5>
<form action="" method="post"><div class="form-group"><label for="inputAAIOShopId">{$SHOP_ID}</label>
<input class="form-control" type="text" id="inputAAIOShopId" name="shopid_key" value="{$SHOP_ID_VALUE}" placeholder="{$SHOP_ID}">
</div>

<div class="form-group"><label for="inputAAIOApiKey">{$SHOP_KEY1}</label>
<input class="form-control" type="text" id="inputAAIOApiKey" name="secret1_key" value="{$SHOP_API_KEY_VALUE}" placeholder="{$SHOP_KEY1}">
</div>

<div class="form-group"><label for="inputAAIOApiKey2">{$SHOP_KEY2}</label>
<input class="form-control" type="text" id="inputAAIOApiKey2" name="secret2_key" value="{$SHOP_API_KEY_2_VALUE}" placeholder="{$SHOP_KEY2}">
</div>

<div class="form-group"><label for="inputAAIOadminemail">{$ADMIN_EMAIL}</label>
<input class="form-control" type="text" id="inputAAIOadminemail" name="admin_email" value="{$ADMIN_EMAIL_VALUE}" placeholder="{$ADMIN_EMAIL}">
</div>
</div>
</div>
<br />
<div class="form-group custom-control custom-switch">
<input id="inputEnabled" name="enable" type="checkbox" class="custom-control-input"{if $ENABLE_VALUE eq 1} checked{/if} />
<label class="custom-control-label" for="inputEnabled">{$ENABLE_GATEWAY}</label>
</div>
<div class="form-group"><input type="hidden" name="token" value="{$TOKEN}"><input type="submit" value="{$SUBMIT}" class="btn btn-primary">
</div>
</form>