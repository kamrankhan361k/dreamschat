<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['login'] = 'home/login';
$route['usersignup'] = 'home/usersignup';
$route['forgotpassword'] = 'home/forgotpassword';
$route['fpchangepassword'] = 'home/fpchangepassword';
$route['users'] = 'home/users';
$route['group'] = 'home/group';
$route['status'] = 'home/status';
$route['call'] = 'home/call';
$route['firesession'] = 'home/firesession';
$route['logout'] = 'home/logout';
$route['joingroup'] = 'home/joingroup';
$route['single_chat/(:any)'] = 'home/single_chat/$1';
//admin
$route['admin-dashboard'] = 'admin/dashboard';
$route['admin-users'] = 'admin/users';
$route['admin-blocked-users'] = 'admin/blockedusers';
$route['admin-report-users'] = 'admin/reportusers';
$route['admin-invite-users'] = 'admin/inviteusers';
$route['admin-chats'] = 'admin/chats';
$route['admin-chatview'] = 'admin/chatview';
$route['admin-stories'] = 'admin/stories';
$route['admin-group-chats'] = 'admin/groupchats';
$route['admin-calls'] = 'admin/calls';
$route['profile-settings'] = 'admin/profile_settings';
$route['system-settings'] = 'admin/system_settings';
$route['notification-settings'] = 'admin/notification_settings';
$route['localization-settings'] = 'admin/localization_settings';
$route['appearance-settings'] = 'admin/appearance_settings';
$route['social-auth-settings'] = 'admin/social_auth_settings';
$route['email-settings'] = 'admin/email_settings';
$route['sms-settings'] = 'admin/sms_settings';
$route['otp-settings'] = 'admin/otp_settings';
$route['authentication-settings'] = 'admin/authentication_settings';
$route['storage-settings'] = 'admin/storage_settings';
$route['ban-address'] = 'admin/ban_address';
$route['gdpr-settings'] = 'admin/gdpr_settings';
$route['language-settings'] = 'admin/language_settings';
$route['language-keyword'] = 'admin/language_keyword';
$route['language-keywords-list'] = 'admin/languageKeywordsList';
$route['language-translate'] = 'admin/language_translate';
$route['admin-general'] = 'admin/general';
$route['admin-firebase'] = 'admin/firebase';
$route['admin-agora'] = 'admin/agora';
$route['admin-website'] = 'admin/website';
$route['admin-language'] = 'admin/language';
$route['terms_conditions'] = 'admin/terms_conditions';
$route['privacy_policy'] = 'admin/privacy_policy';
$route['abuse_message'] = 'admin/abuse_message';
$route['userdatatable'] = 'admin/userdatatable';
$route['datatable'] = 'admin/datatable';
$route['admin'] = 'admin/index';
//call
$route['call_first'] = 'home/call_first';
$route['precallpage'] = 'home/precallpage';
$route['meetingpage'] = 'home/meetingpage';
$route['call_old'] = 'home/call_old';
$route['calls_new'] = 'home/calls_new';
$route['privacy-policy'] = 'home/privacy_policy';
$route['video-call'] = 'home/videoCall';
$route['audio-call'] = 'home/audioCall';
$route['group-call'] = 'home/groupCall';
$route['group-video-call'] = 'home/groupVideoCall';
$route['contacts'] = 'home/contacts';
$route['settings'] = 'home/settings';
$route['register'] = 'home/register';
$route['email-login'] = 'home/emailLogin';
$route['phone-login'] = 'home/phoneLogin';
$route['forgot-password'] = 'home/forgetPassword';
$route['reset-password'] = 'home/resetPassword';
$route['reset-password-success'] = 'home/resetPasswordSuccess';
$route['mobile-otp'] = 'home/mobileOtp';

$route['send-call-notification']='admin/sendNotification';
$route['send-call-notification-dev']='admin/sendIOSNotificationDev';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
