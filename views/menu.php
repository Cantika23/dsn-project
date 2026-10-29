<?php

namespace Mitral2022\DSN2;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(24, "mi_Dashboard1", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "dashboard1", -1, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}Dashboard1'), false, false, "fas fa-home", "", false, true);
$sideMenu->addMenuItem(25, "mci_Aplikasi_Penerimaan_dan_Pengiriman_Paket/Surat", $MenuLanguage->MenuPhrase("25", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fas fa-box", "", false, true);
$sideMenu->addMenuItem(15, "mi_penerimaan_paket_masuk", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "penerimaanpaketmasuklist", 25, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}penerimaan_paket_masuk'), false, false, "fas fa-indent", "", false, true);
$sideMenu->addMenuItem(14, "mi_penerimaan_paket_keluar", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "penerimaanpaketkeluarlist", 25, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}penerimaan_paket_keluar'), false, false, "fas fa-outdent", "", false, true);
$sideMenu->addMenuItem(26, "mci_Master", $MenuLanguage->MenuPhrase("26", "MenuText"), "", 25, "", IsLoggedIn(), false, true, "fas fa-database", "", false, true);
$sideMenu->addMenuItem(5, "mi_m_jenis_dokumen", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "mjenisdokumenlist", 26, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_jenis_dokumen'), false, false, "fas fa-archive", "", false, true);
$sideMenu->addMenuItem(6, "mi_m_jenis_pengirim", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "mjenispengirimlist", 26, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_jenis_pengirim'), false, false, "fas fa-paper-plane", "", false, true);
$sideMenu->addMenuItem(11, "mi_m_status_penerimaan", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "mstatuspenerimaanlist", 26, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_status_penerimaan'), false, false, "fas fa-check", "", false, true);
$sideMenu->addMenuItem(12, "mi_m_status_penerimaan_keluar", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "mstatuspenerimaankeluarlist", 26, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_status_penerimaan_keluar'), false, false, "fas fa-check", "", false, true);
$sideMenu->addMenuItem(30, "mi_m_status_sap", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "mstatussaplist", 26, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_status_sap'), false, false, "fas fa-check-circle", "", false, true);
$sideMenu->addMenuItem(3, "mi_m_employee", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "memployeelist", 26, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_employee'), false, false, "fas fa-male", "", false, true);
$sideMenu->addMenuItem(27, "mci_Aplikasi_Kearsipan/Filing", $MenuLanguage->MenuPhrase("27", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fas fa-th", "", false, true);
$sideMenu->addMenuItem(1, "mi_filing_dokumen", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "filingdokumenlist", 27, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}filing_dokumen'), false, false, "fas fa-file", "", false, true);
$sideMenu->addMenuItem(28, "mci_Master", $MenuLanguage->MenuPhrase("28", "MenuText"), "", 27, "", IsLoggedIn(), false, true, "fas fa-database", "", false, true);
$sideMenu->addMenuItem(7, "mi_m_kode_department", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "mkodedepartmentlist", 28, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_kode_department'), false, false, "fas fa-university", "", false, true);
$sideMenu->addMenuItem(8, "mi_m_kode_pt", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "mkodeptlist", 28, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_kode_pt'), false, false, "fas fa-building", "", false, true);
$sideMenu->addMenuItem(4, "mi_m_gudang", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "mgudanglist", 28, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_gudang'), false, false, "fas fa-cubes", "", false, true);
$sideMenu->addMenuItem(9, "mi_m_notifikasi_expired", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "mnotifikasiexpiredlist", 28, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}m_notifikasi_expired'), false, false, "fa fa-calendar", "", false, true);
$sideMenu->addMenuItem(29, "mci_User_Management", $MenuLanguage->MenuPhrase("29", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fas fa-users", "", false, true);
$sideMenu->addMenuItem(19, "mi_user", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "userlist", 29, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}user'), false, false, "fas fa-user", "", false, true);
$sideMenu->addMenuItem(21, "mi_userlevels", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "userlevelslist", 29, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}userlevels'), false, false, "fas fa-user-plus", "", false, true);
$sideMenu->addMenuItem(2, "mi_log_courier", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "logcourierlist", -1, "", AllowListMenu('{CC33C9DE-C719-486E-A8F0-CA02755F0C2F}log_courier'), false, false, "fas fa-tools", "", false, true);
echo $sideMenu->toScript();
