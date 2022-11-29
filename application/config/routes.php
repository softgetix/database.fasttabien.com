<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Auth_controller';
$route['404_override'] = 'Auth_controller/error404';
$route['translate_uri_dashes'] = FALSE;

//login

$route['login'] = 'Auth_controller/login';
$route['logout'] = 'Auth_controller/logout';
$route['change_password/(:any)'] = 'Auth_controller/change_password/$1';
$route['forget_password'] = 'Auth_controller/forget_password';


//User and User access

$route['user'] = 'Admin_controller';
$route['userAccess']='Admin_controller/userAccess';
$route['userAccess/edit/(:any)']='Admin_controller/userAccessEdit/$1';
$route['userAccess/update/(:any)']='Admin_controller/userAccessUpdate/$1';

//Special number

$route['specialNumber'] = 'Data_controller/records';
$route['save_records']='Data_controller/save_records';
$route['get_records'] = 'Data_controller/get_records';
$route['get_records_vip'] = 'Data_controller/get_records_vip';
$route['update_records'] = 'Data_controller/update_records';
$route['vip_update_records'] = 'Data_controller/vip_update_records';
$route['import'] = 'Data_controller/import';
$route['checkNumber'] = 'Data_controller/checkNumber';
$route['check_add_number/(:any)/(:any)']='Customer_controller/check_add_number/$1/$2';
$route['get_records_super_special'] = 'Data_controller/get_records_super_special';
$route['super_special_update_records'] = 'Data_controller/super_special_update_records';
$route['check2digit'] = 'Data_controller/check2digit';
$route['export2digit'] = 'Data_controller/export2digit';
$route['check_multi_number'] = 'Data_controller/check_multi_number';
$route['check_bulknumber'] = 'Data_controller/check_bulknumber';
$route['exportbulk'] = 'Data_controller/exportbulk';
$route['checkallnumbers/(:any)'] = 'Data_controller/checkAllNumbers/$1';
$route['export_all_numbers'] = 'Data_controller/export_all_numbers';


//Customer

$route['addCustomer']='Customer_controller/addCustomer';
$route['viewCustomer']='Customer_controller/viewCustomer';
$route['editCustomer/(:any)']='Customer_controller/editCustomer/$1';
$route['viewnumber_list/(:any)']='Customer_controller/viewnumber_list/$1';
$route['get_listnumber/(:any)'] = 'Customer_controller/get_listnumber/$1';
$route['update_numberList'] = 'Customer_controller/update_numberList';
$route['customer_import'] = 'Customer_controller/customer_import';
$route['multiple_delete_number'] = 'Customer_controller/multiple_delete_number';
$route['remove_clm_data'] = 'Customer_controller/remove_clm_data';
$route['newcases']='Customer_controller/newcases';
$route['remove_all_clm_data'] = 'Customer_controller/remove_all_clm_data';
$route['update_multiple_status'] = 'Customer_controller/update_multiple_status';
$route['exportAll'] = 'Customer_controller/exportAll';
$route['copy_customer'] = 'Customer_controller/copy_customer';
$route['import_chatname'] = 'Customer_controller/import_chatname';
$route['get_chatname'] = 'Customer_controller/get_chatname';
$route['change_chatname'] = 'Customer_controller/change_chatname';

//History

$route['viewHistory'] = 'History_controller/viewHistory';
$route['get_history'] = 'History_controller/get_history';
$route['checkrecord'] = 'History_controller/checkRecord';
$route['get_record'] = 'History_controller/get_record';

//WinLoss

$route['viewWinLoss'] = 'WinLoss_controller/index';
$route['winloss_csv'] = 'WinLoss_controller/import_winloss_csv';
$route['get_winloss'] = 'WinLoss_controller/get_winloss';
$route['remove_prob'] = 'WinLoss_controller/remove_prob';

//UserActivity

$route['UserActivity'] = 'UserActivity_controller/index';
$route['viewActivity'] = 'UserActivity_controller/viewActivity';

//Auction

$route['addAuction']='Auction_controller/addAuction';
$route['viewAuction']='Auction_controller/viewAuction';
$route['save_auction']='Auction_controller/save_auction';
$route['get_auction'] = 'Auction_controller/get_auction';
$route['update_auction'] = 'Auction_controller/update_auction';
$route['winning_auction']='Auction_controller/winning_auction';
$route['get_completed_auction']='Auction_controller/get_completed_auction';
$route['editWinAuction/(:any)']='Auction_controller/editWinAuction/$1';
$route['update_WinAuction'] = 'Auction_controller/update_WinAuction';
$route['revenueComplete'] = 'Auction_controller/revenueComplete';
$route['addWinAuction'] = 'Auction_controller/addWinAuction';
$route['search_customer'] = 'Auction_controller/search_customer';
$route['save_WinAuction'] = 'Auction_controller/save_WinAuction';
$route['exportAuction'] = 'Auction_controller/export_Auction';

//modify past data
$route['change_database'] = 'History_controller/change_database';