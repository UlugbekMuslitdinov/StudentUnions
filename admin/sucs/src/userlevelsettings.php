<?php
/**
 * PHPMaker 2021 user level settings
 */
namespace PHPMaker2021\project4;

// User level info
$USER_LEVELS = [["-2","Anonymous"]];
// User level priv info
$USER_LEVEL_PRIVS = [["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}building_access_request_access","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}building_access_request_locations","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}building_access_requests","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}computer_access_requests","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}departmental_access_request_account","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}departmental_access_requests","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}departmental_account_requests","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}exch_departments","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}groups","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}kronos_managers","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}memberships","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}nutrition_class","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}permissions","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}phone_requests","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}pos_access_requests","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}print_logs","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}resources","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}users","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}web_support","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}web_support_files","-2","0"],
    ["{EA1E0752-F1A9-46E9-BF39-79E2A556C299}workstation_access_requests","-2","0"]];
// User level table info
$USER_LEVEL_TABLES = [["building_access_request_access","building_access_request_access","building access request access",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","BuildingAccessRequestAccessList"],
    ["building_access_request_locations","building_access_request_locations","building access request locations",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","BuildingAccessRequestLocationsList"],
    ["building_access_requests","building_access_requests","building access requests",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","BuildingAccessRequestsList"],
    ["computer_access_requests","computer_access_requests","computer access requests",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","ComputerAccessRequestsList"],
    ["departmental_access_request_account","departmental_access_request_account","departmental access request account",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","DepartmentalAccessRequestAccountList"],
    ["departmental_access_requests","departmental_access_requests","departmental access requests",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","DepartmentalAccessRequestsList"],
    ["departmental_account_requests","departmental_account_requests","departmental account requests",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","DepartmentalAccountRequestsList"],
    ["exch_departments","exch_departments","exch departments",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","ExchDepartmentsList"],
    ["groups","groups","groups",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","GroupsList"],
    ["kronos_managers","kronos_managers","kronos managers",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","KronosManagersList"],
    ["memberships","memberships","memberships",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","MembershipsList"],
    ["nutrition_class","nutrition_class","nutrition class",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","NutritionClassList"],
    ["permissions","permissions2","permissions",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","Permissions2List"],
    ["phone_requests","phone_requests","phone requests",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","PhoneRequestsList"],
    ["pos_access_requests","pos_access_requests","pos access requests",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","PosAccessRequestsList"],
    ["print_logs","print_logs","print logs",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","PrintLogsList"],
    ["resources","resources","resources",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","ResourcesList"],
    ["users","users","users",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","UsersList"],
    ["web_support","web_support","web support",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","WebSupportList"],
    ["web_support_files","web_support_files","web support files",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","WebSupportFilesList"],
    ["workstation_access_requests","workstation_access_requests","workstation access requests",true,"{EA1E0752-F1A9-46E9-BF39-79E2A556C299}","WorkstationAccessRequestsList"]];
