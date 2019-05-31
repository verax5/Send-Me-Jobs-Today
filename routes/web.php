<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('search', 'HomeController@searchJobs')->name('search.jobs');

Route::get('job-details', 'HomeController@jobDetails')->name('job.details');

Route::get('create-alert', 'CreateJobAlertController@index')->name('create.alert');
Route::post('create-alert', 'CreateJobAlertController@create')->name('create.alert');

Route::get('email-send', 'EmailsTestController@send');

Route::get('unsubscribe-user', 'UnsubController@index')->name('unsubForm');
Route::get('unsubscribe', 'UnsubController@unsub')->name('unsubscribe');

Route::get('confirm/{token}', 'EmailConfirmController@confirm')->name('confirm');
Route::post('send-reconfirmation', 'EmailConfirmController@sendReconfirmation')->name('send.reconfirmation');

Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact', 'ContactController@send')->name('contact');


Route::get('jobs-in-email-preview', 'MailTemplatesPreviewController@jobsInEmail');
Route::get('confirmation-preview', 'MailTemplatesPreviewController@confirmation');
Route::get('contact-preview', 'MailTemplatesPreviewController@contact');


Route::get('redirect', 'RedirectUserController@redirect')->name('redirect');

Route::get('direct-login', 'UserLoginController@directLoginIndex')->name('direct.login.view');
Route::post('force-password-set', 'UserLoginController@directLoginPasswordSet')->name('direct.login');

Route::get('basic-login', 'UserLoginController@basicLoginIndex')->name('basic.login');
Route::post('basic-login', 'UserLoginController@basicLogin')->name('basic.login');

Route::get('edit-preferences', 'EditPreferencesController@index')->name('edit.preferences');
Route::post('edit-preferences', 'EditPreferencesController@save')->name('edit.preferences');

Route::get('logout', 'UserLoginController@logout')->name('logout');

Route::post('mailgun/webhook', 'WebhookController@mailgunProceed');

Route::get('privacy-policy', 'HomeController@privacyPolicy')->name('privacy.policy');

Route::get('set-password', 'UserLoginController@normalPasswordSetView')->name('normal.password.set');
Route::post('set-password', 'UserLoginController@normalPasswordSet')->name('normal.password.set');

Route::get('password-set-by-email', 'UserLoginController@normalPasswordSetAskEmailView')->name('normal.password.set.ask.email');
Route::post('password-set-by-email', 'UserLoginController@normalPasswordSetAskEmailSubmit')->name('normal.password.set.ask.email');
