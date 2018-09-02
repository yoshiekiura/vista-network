<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cache_clear',function(){
   Artisan::call('cache:clear');
});

Route::get('/view_clear',function(){
   Artisan::call('view:clear');
});
Route::get('/config_clear',function(){
   Artisan::call('config:cache');
});
Route::get('/route_clear',function(){
   Artisan::call('route:clear');
});


Route::get('/', 'FontendController@fontIndex');
Route::get('/contact', 'FontendController@contactIndex')->name('contact.index');
Route::get('/terms', 'FontendController@termsIndex')->name('terms.index');
Route::get('/policy', 'FontendController@policyIndex')->name('policy.index');
Route::get('/menu/{id}/{any}', 'FontendController@menuIndex')->name('menu.index.pranto');
Route::get('/admin', 'AdminAuth\LoginController@showLoginForm');
Route::post('/message', 'FontendController@sendMessage')->name('contact.us.message');
Route::post('/forgot/password', 'FontendController@forgotPass')->name('forget.password.user');
Route::get('/reset/{token}', 'FontendController@resetLink')->name('reset.passlink');
Route::post('/reset/password', 'FontendController@passwordReset')->name('reset.passw');
Route::get('pagenotfound', 'FontendController@pageNotFound')->name('pagenot.found');
Route::post('/contact-us', 'FontendController@contactUs')->name('contact.submit');

Route::post('/get/ref/id', 'FontendController@getRefId')->name('get.ref.id');
Route::post('/get/position', 'FontendController@getPosition')->name('get.user.position');

//Authorization
Route::get('/authorization', 'FontendController@authorization')->name('authorization');
Route::post('/sendemailver', 'FontendController@sendemailver')->name('sendemailver');
Route::post('/emailverify', 'FontendController@emailverify')->name('emailverify');
Route::post('/sendsmsver', 'FontendController@sendsmsver')->name('sendsmsver');
Route::post('/smsverify', 'FontendController@smsverify')->name('smsverify');
Route::post('/g2fa-verify', 'FontendController@verify2fa')->name('go2fa.verify');
Route::get('/pagenotfound', 'FontendController@pageNotFound')->name('pagenot.found');
Route::get('/ALFAcoins_59a55d76cf07d59a55d76cf0b559a55d76cf0eb.txt', 'FontendController@alfaCoinCheck');
Route::get('/notification.php', 'FontendController@notificationURL');
Route::get('/funds/deposit/success', 'FontendController@fundsSuccess');

Route::group(['prefix' => 'admin'], function () {

	Route::get('/home', 'AdminController@adminIndex')->middleware('admin');
    Route::resource('product', 'ProductController')->middleware('admin');
    Route::put('product/update/{id}', 'ProductController@update')->name('product.update.pranto')->middleware('admin');
    Route::post('image/delete', 'AdminController@imageDelete')->name('image.delete')->middleware('admin');

    Route::get('hash-power', 'AdminController@hashpowerIndex')->name('hashpower.index')->middleware('admin');
    Route::post('hash-power', 'AdminController@hashpowerStore')->name('hashpower.store')->middleware('admin');
    Route::get('hash-power/{id}/edit', 'AdminController@hashpowerEdit')->name('hashpower.edit')->middleware('admin');
    Route::put('hash-power', 'AdminController@hashpowerUpdate')->name('hashpower.update')->middleware('admin');
    Route::delete('hash-power/{hashpower}', 'AdminController@hashpowerDelete')->name('hashpower.delete')->middleware('admin');
    Route::get('/hash-power/purchase/list', 'AdminController@hashpowerTransactions')->name('hashpower.purchase.list')->middleware('admin');
    Route::get('hash-power/users/balance', 'AdminController@hashpowerBalances')->name('hashpower.users.balance')->middleware('admin');

    Route::get('shipment', 'AdminController@shipmentIndex')->name('shipment.index')->middleware('admin');
    Route::get('shipment/complete', 'AdminController@shipmentComplete')->name('shipment.success.index')->middleware('admin');
    Route::get('shipment/detail/{id}/{order}', 'AdminController@shipmentDetail')->name('shipping.detail')->middleware('admin');
    Route::post('shipment/detail/{id}', 'AdminController@shipmentProcess')->name('shipment.process')->middleware('admin');
    Route::get('shipment/reject', 'AdminController@shipmentReject')->name('shipment.reject')->middleware('admin');

    Route::get('background/images', 'GeneralController@backgroundImage')->name('background.image.index')->middleware('admin');
    Route::put('background/images/update', 'GeneralController@backgroundImageUpdate')->name('image.background.update')->middleware('admin');

    Route::get('referral/view', 'AdminController@refView')->name('ref.amount.total')->middleware('admin');
    Route::get('subtract/admin', 'AdminController@subtractAdmin')->name('admin.subtract.view')->middleware('admin');
    Route::get('generate/admin', 'AdminController@generateAdmin')->name('admin.generate.view')->middleware('admin');
    Route::get('send/money/{id}', 'AdminController@sendMoneyView')->name('user.total.send.money')->middleware('admin');
    Route::get('withdraw/view/{id}', 'AdminController@withDrawView')->name('user.total.withdraw')->middleware('admin');
    Route::get('add/fund/view/{id}', 'AdminController@depositView')->name('user.total.deposit')->middleware('admin');
    Route::get('transaction/view/{id}', 'AdminController@transView')->name('user.total.trans')->middleware('admin');
    Route::get('transfer/balance', 'AdminController@transBalanceLog')->name('index.transfer.user')->middleware('admin');
    Route::get('deposit/funds/user', 'AdminController@depositLog')->name('index.deposit.user')->middleware('admin');
    Route::get('deactive/user', 'AdminController@deactiveUser')->name('index.deactive.user')->middleware('admin');
    Route::get('paid/user', 'AdminController@paidUser')->name('paid.user.index')->middleware('admin');
    Route::get('free/user', 'AdminController@freeUser')->name('free.user.index')->middleware('admin');

    Route::GET('user/search', 'AdminController@userSearch')->name('username.search')->middleware('admin');
    Route::GET('user/search/email', 'AdminController@userSearchEmail')->name('email.search')->middleware('admin');
    Route::GET('user/search/customer', 'AdminController@userSearchCustomer')->name('customer.search')->middleware('admin');

    Route::post('generate/matching', 'AdminController@matchGenerate')->name('generate.match')->middleware('admin');
    Route::get('match', 'AdminController@matchIndex')->name('match.index')->middleware('admin');

    Route::post('/users/amount/{id}', 'AdminController@indexBalanceUpdate')->name('user.balance.update')->middleware('admin');
    Route::get('/users/send/mail/{id}', 'AdminController@userSendMail')->name('user.mail.send')->middleware('admin');
    Route::get('/users/send/notification/{id}', 'AdminController@userSendNotification')->name('user.notification.send')->middleware('admin');
    Route::post('/send/mail/{id}', 'AdminController@userSendMailUser')->name('send.mail.user')->middleware('admin');
    Route::post('/send/notification/{id}', 'AdminController@userSendNotificationUser')->name('send.notification.user')->middleware('admin');
    Route::get('/users/balance/{id}', 'AdminController@indexUserBalance')->name('add.subs.index')->middleware('admin');
    Route::get('/users/coins/balance/{id}', 'AdminController@indexUserCoinBalance')->name('add.subs.coins.index')->middleware('admin');
    Route::post('/users/coins/balance/{id}', 'AdminController@coinsBalanceUpdate')->name('user.coins.balance.update')->middleware('admin');
    Route::get('/users/detail/{id}', 'AdminController@indexUserDetail')->name('user.view')->middleware('admin');
    Route::get('/users/notification/{id}', 'AdminController@indexUserNotification')->name('user.notification.view')->middleware('admin');
    Route::put('/users/update/{id}', 'AdminController@userUpdate')->name('user.detail.update')->middleware('admin');

    Route::get('/tree/image', 'GeneralController@indexTreeImage')->name('user.tree.image')->middleware('admin');
    Route::put('/tree/image/update', 'GeneralController@updateTreeImage')->name('tree.image.update')->middleware('admin');

    Route::get('/template', 'AdminController@indexEmail')->name('email.index.admin')->middleware('admin');
    Route::post('/template-update', 'AdminController@updateEmail')->name('template.update')->middleware('admin');

    //Sms Api
    Route::get('/sms-api', 'AdminController@smsApi')->name('sms.index.admin')->middleware('admin');
    Route::post('/sms-update', 'AdminController@smsUpdate')->name('sms.update')->middleware('admin');

    Route::get('/withdraw/method', 'AdminController@indexWithdraw')->name('add.withdraw.method')->middleware('admin');
    Route::post('/withdraw/store', 'AdminController@storeWithdraw')->name('store.withdraw.method')->middleware('admin');
    Route::put('/withdraw/update/{id}', 'AdminController@updateWithdraw')->name('update.method')->middleware('admin');

    Route::get('/withdraw/requests', 'AdminController@requestWithdraw')->name('withdraw.request.index')->middleware('admin');
    Route::get('/withdraw/details/{id}', 'AdminController@detailWithdraw')->name('withdraw.detail.user')->middleware('admin');
    Route::post('/withdraw/update/{id}', 'AdminController@repondWithdraw')->name('withdraw.process')->middleware('admin');

    Route::get('/withdraw/log', 'AdminController@showWithdrawLog')->name('withdraw.viewlog.admin')->middleware('admin');

    Route::get('/coins', 'AdminController@indexCoins')->name('coins.admin.index')->middleware('admin');
    Route::post('/coins/store', 'AdminController@storeCoins')->name('store.admin.coins')->middleware('admin');
    Route::put('/coins/update/{id}', 'AdminController@updateCoins')->name('update.admin.coins')->middleware('admin');
    Route::get('/coins/purchase/list', 'AdminController@requestCoins')->name('coins.purchase.list')->middleware('admin');
    Route::get('/coins/withdraw/list', 'AdminController@requestCoinWithdraw')->name('coins.withdraw.list')->middleware('admin');
    Route::get('/coins/log', 'AdminController@showCoinsLog')->name('coins.viewlog.admin')->middleware('admin');
    Route::get('/coins/balance', 'AdminController@coinsBalance')->name('coins.balance')->middleware('admin');

    Route::get('/orders/list', 'AdminController@ordersList')->name('orders.list')->middleware('admin');
    Route::get('/orders/list/installments', 'AdminController@ordersInstallment')->name('orders.installment')->middleware('admin');
    Route::get('/orders/installment/pay/{order}', 'AdminController@viewInstallmentDetails')->name('installment.details')->middleware('admin');
    Route::put('/orders/installment/pay/{id}', 'AdminController@payInstallment')->name('pay.installment')->middleware('admin');
    Route::get('/orders/commissions', 'AdminController@viewReferralCommissions')->name('commission')->middleware('admin');
    Route::get('/orders/commissions/details/{order}', 'AdminController@viewCommissionDetails')->name('commission.details')->middleware('admin');

    Route::get('/supports', 'TicketController@indexSupport')->name('support.admin.index')->middleware('admin');
    Route::get('/support/reply/{ticket}', 'TicketController@adminSupport')->name('ticket.admin.reply')->middleware('admin');
    Route::post('/reply/{ticket}', 'TicketController@adminReply')->name('store.admin.reply')->middleware('admin');

    Route::get('users', 'AdminController@usersIndex')->name('user.manage')->middleware('admin');
    Route::get('/downloadUsersList', 'ExcelController@downloadUsersList')->name('export.users.list')->middleware('admin');
    Route::post('/users-import', 'ExcelController@usersImport')->name('import.users.list')->middleware('admin');

  //  Route::get('footer', 'FooterController@footerIndex')->name('footer.content')->middleware('admin');    
 //   Route::put('footer_update/{id}', 'FooterController@footerUpdate')->name('footer.update')->middleware('admin');

    Route::get('/footer', "GeneralController@indexFooter")->name('footer.index.admin')->middleware('admin');
    Route::put('/footer/update', "GeneralController@updateFooter")->name('footer.update')->middleware('admin');

    Route::get('/social/index', "GeneralController@indexSocial")->name('social.admin.index')->middleware('admin');
    Route::post('/social/store', "GeneralController@storeSocial")->name('store.social')->middleware('admin');
    Route::get('/social/delete/{id}', "GeneralController@deleteSocialSocial")->name('social.delete')->middleware('admin');
    Route::put('/social/update/{id}', "GeneralController@updateSocial")->name('update.social')->middleware('admin');

    Route::get('/contact', "GeneralController@indexContact")->name('contact.admin.index')->middleware('admin');
    Route::put('/contact/update', "GeneralController@updateContact")->name('contact.admin.update')->middleware('admin');

    Route::get('/about', "GeneralController@indexAbout")->name('about.admin.index')->middleware('admin');
    Route::put('/about/update/{id}', "GeneralController@updateAbout")->name('about.admin.update')->middleware('admin');

    Route::get('/general', "GeneralController@index")->name('general.index')->middleware('admin');
    Route::put('/general-update/{id}', "GeneralController@update")->name('general.update')->middleware('admin');

    Route::get('/terms', "GeneralController@indexTerms")->name('terms.polices')->middleware('admin');
    Route::put('/terms/update/{id}', "GeneralController@updateTerms")->name('terms.update')->middleware('admin');

    Route::get('/charge/commission', "GeneralController@indexCommision")->name('charge.commission')->middleware('admin');
    Route::put('/charge/commission/{id}', "GeneralController@UpdateCommision")->name('commission.update')->middleware('admin');

    Route::get('menu', 'MenuController@menuIndex')->name('menu.index')->middleware('admin');
    Route::get('menu/create', 'MenuController@menuCreate')->name('menu.create.admin')->middleware('admin');
    Route::post('menu_store', 'MenuController@menuStore')->name('menu.post.admin')->middleware('admin');
    Route::get('menu_delete/{id}', 'MenuController@menuDelete')->name('menu.delete')->middleware('admin');
    Route::get('menu_edit/{id}', 'MenuController@menuEdit')->name('edit.menu.admin')->middleware('admin');
    Route::put('menu_update/{id}', 'MenuController@menuUpdate')->name('menu.update.admin')->middleware('admin');

    Route::get('logo/icon', 'LogoController@logoIndex')->name('logo.icon')->middleware('admin');
    Route::put('logo_update', 'LogoController@updateLogo')->name('logo.update')->middleware('admin');
    Route::put('icon_update', 'LogoController@updateIcon')->name('icon.update')->middleware('admin');

    Route::get('slider', 'SilderController@slideIndex')->name('slide.settings')->middleware('admin');
    Route::post('slider/store', 'SilderController@slideStore')->name('slider.store.pranto')->middleware('admin');
    Route::get('slider/delete/{id}', 'SilderController@slideDelete')->name('slide.delete')->middleware('admin');
    Route::put('slider/update/{id}', 'SilderController@slideUpdate')->name('slider.update.pranto')->middleware('admin');

    Route::get('service', 'ServiceController@serviceIndex')->name('service.index')->middleware('admin');
    Route::get('service_create', 'ServiceController@serviceCreate')->name('service.create')->middleware('admin');
    Route::post('service/store', 'ServiceController@serviceStore')->name('store.service')->middleware('admin');
    Route::put('service_update/{id}', 'ServiceController@serviceUpdate')->name('service.update')->middleware('admin');
    Route::get('service/delete/{id}', 'ServiceController@serviceDelete')->name('service.delete')->middleware('admin');
    Route::get('service/edit/{id}', 'ServiceController@serviceEdit')->name('service.edit')->middleware('admin');

    Route::get('testimonial', 'TestimonalController@testIndex')->name('testimonial.index')->middleware('admin');
    Route::post('testimonial_store', 'TestimonalController@testStore')->name('testimonial.store'); //->middleware('admin');
    Route::get('testimonial_delete/{id}', 'TestimonalController@testDelete')->name('testimonial.delete')->middleware('admin');
    Route::get('testimonial_edit/{id}', 'TestimonalController@testEdit')->name('test.edit')->middleware('admin');
    Route::put('testimonial_update/{id}', 'TestimonalController@testUpdate')->name('test.update');

    Route::get('team', 'TeamController@teamIndex')->name('team.index')->middleware('admin');
    Route::post('team/store', 'TeamController@teamStore')->name('team.store')->middleware('admin');
    Route::get('team/delete/{id}', 'TeamController@teamDelete')->name('team.delete.delete')->middleware('admin');
    Route::put('team/update/{id}', 'TeamController@teamUpdateUpdate')->name('team.update.update')->middleware('admin');

	Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'AdminAuth\LoginController@login');
	Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
	Route::post('change-password', 'AdminController@saveResetPassword')->name('change.password');

    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'AdminAuth\RegisterController@register');

    Route::get('/cron', 'PaymentController@cron');
    //Gateway
    Route::resource('gateway', 'GatewayController', ['except' => [
        'create', 'show','edit'
    ]])->middleware('admin');

    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

//Auth::routes();
Route::group(['middleware' => 'prevent-back-history'],function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => 'web'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/hash-power-task-progress', 'HomeController@getHPTaskProgress');
	Route::get('/profile', 'HomeController@profileIndex')->name('profile.index');
	Route::put('/profile/update', 'HomeController@updateProfile')->name('profile.update');
	Route::get('/shipping', 'HomeController@shippingIndex')->name('shipping.index');
	Route::put('/shipping/update', 'HomeController@updateShipping')->name('update.shipping');
	Route::get('/password', 'HomeController@securityIndex')->name('security.index');
	Route::post('/password/update', 'HomeController@changePassword')->name('change.password.user');
	
	Route::get('/products', 'HomeController@shoopingIndex')->name('shopping.user.index');
	Route::post('/product/buy', 'HomeController@buyProduct')->name('buy.product');
	Route::get('/product/{id}/view', 'HomeController@shoopingView')->name('view.detail');
	Route::get('/product/purchase/history', 'HomeController@shoppingHistory')->name('user.shopping.history');

    Route::get('/notification', 'HomeController@viewNotifications')->name('notification');

	Route::post('/get/user', 'HomeController@confirmUserAjax')->name('get.user');
	Route::post('/get/charge', 'HomeController@getChargeAjax')->name('get.total.charge');

	Route::get('/coins', 'CoinsController@index')->name('coins.index');
	Route::post('/coins/buy', 'CoinsController@coinsPurchase')->name('coins.purchase');
	Route::post('/coins/sell', 'CoinsController@coinsWithdraw')->name('coins.withdraw');
	Route::post('/coins/transfer', 'CoinsController@transferCoins')->name('store.transfer.coin');
	Route::get('/coins/transactions', 'CoinsController@coinTransactions')->name('coins.transactions');
 //   Route::get('/coin/transaction/details/{id}', 'CoinsController@coinTransactionDetails');

	Route::get('/hash-power', 'HashpowerController@index')->name('hp.user.index');
	Route::post('/hash-power/deposit', 'HashpowerController@buyProduct')->name('buy.hplp.product');
	Route::get('/hash-power/transactions', 'HashpowerController@hpHistory')->name('hp.history');

	Route::get('/product/commission', 'HomeController@productCommsisionIndex')->name('product.commision.index');
	Route::get('/binary/commission', 'HomeController@binaryCommsisionlIndex')->name('bin.commision.index');
	Route::get('/hp/commission', 'HomeController@hpCommsisionlIndex')->name('hp.commision.index');
    Route::get('/referral/commission', 'HomeController@refCommsisionIndex')->name('ref.commision.index');

	Route::get('/tree', 'HomeController@treeIndex')->name('tree.index');
	Route::get('/tree/search', 'HomeController@searchTreeIndex')->name('tree.username.search');
	Route::get('/referral', 'HomeController@referralIndex')->name('referral.index');
	Route::get('/binary/summary', 'HomeController@binarySummeryindex')->name('binary.summery.index');
    Route::get('/my-tree-chart', 'HomeController@getTreeData');
    Route::get('/tree-searchable', 'HomeController@getSearchableTreeData');

	Route::get('/funds', 'HomeController@fundIndex')->name('add.fund.index');
	Route::get('/fund/transfer', 'HomeController@transferFundIndex')->name('fund.transfer.index');
	Route::post('/fund/transfer', 'HomeController@transferFund')->name('store.transfer.fund');
	Route::get('/fund/transactions', 'HomeController@transacHistory')->name('transaction.history');
    Route::get('/fund/deposit/{id}/preview', 'HomeController@fundDepositPreview')->name('fund.deposit.preview');
    Route::get('/fund/deposit/data/{gateway}/{amount}', 'HomeController@getGatewayData');
    Route::post('/fund/deposit/pay', 'PaymentController@gatewayDataPay')->name('fund.deposit.pay');
//	Route::post('/deposit/store', 'HomeController@storeDeposit')->name('deposit.preview');
//  Route::get('/deposit/confirm', 'PaymentController@buyConfirm')->name('buy.confirm');
    Route::get('/fund/withdraw/{id}/preview', 'HomeController@fundWithdrawPreview')->name('fund.withdraw.preview');
    Route::get('/fund/withdraw/data/{gateway}/{amount}', 'HomeController@getWithdrawData');
	Route::post('/fund/withdraw/pay', 'HomeController@storeWithdraw')->name('fund.withdraw.pay');
    Route::get('/fund/stripe/{trx}', 'HomeController@stripeIndex')->name('stripe.index');
    Route::get('/withdraw', 'HomeController@withdrawIndex')->name('request.users_management.index');
//	Route::post('/withdraw/preview', 'HomeController@withdrawPreview')->name('withdraw.preview.user');
//	Route::post('/withdraw/confirm', 'HomeController@storeWithdraw')->name('confirm.withdraw.store');
	Route::get('/wallet', 'HomeController@wallet')->name('wallet');
    Route::get('/upgrade/premium/account', 'HomeController@updatePremium')->name('upgrade.premium');

	//Payment IPN
    Route::post('ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
    Route::post('ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
    Route::get('/ipnbtc', 'PaymentController@ipnbtc')->name('ipn.btc');
    Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
    Route::post('ipncoin', 'PaymentController@ipncoin')->name('ipn.coinPay');
    Route::post('ipncoin-gate', 'PaymentController@coinGateIPN')->name('ipn.coinGate');
    Route::get('/coin-gate/{trx}', 'PaymentController@coingatePayment')->name('coinGate');
    Route::post('ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
    Route::get('/ipnblock', 'PaymentController@blockIpn')->name('ipn.block');

    Route::get('/security/two/step', 'HomeController@twoFactorIndex')->name('two.factor.index');
    Route::post('/g2fa-create', 'HomeController@create2fa')->name('go2fa.create');
    Route::post('/g2fa-disable', 'HomeController@disable2fa')->name('disable.2fa');

    Route::get('/support', 'TicketController@ticketIndex')->name('support.index.customer');
    Route::get('/support/ticket', 'TicketController@ticketCreate')->name('add.new.ticket');
    Route::post('/support/ticket', 'TicketController@ticketStore')->name('ticket.store');
    Route::get('/comment/close/{ticket}', 'TicketController@ticketClose')->name('ticket.close');
    Route::get('/comment/reopen/{ticket}', 'TicketController@ticketReopen')->name('ticket.reopen');
    Route::get('/support/reply/{ticket}', 'TicketController@ticketReply')->name('ticket.customer.reply');
    Route::post('/support/store/{ticket}', 'TicketController@ticketReplyStore')->name('store.customer.reply');

});
