<?php

namespace Mitral2022\DSN2;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "filing_dokumen" => \DI\create(FilingDokumen::class),
    "log_courier" => \DI\create(LogCourier::class),
    "m_employee" => \DI\create(MEmployee::class),
    "m_gudang" => \DI\create(MGudang::class),
    "m_jenis_dokumen" => \DI\create(MJenisDokumen::class),
    "m_jenis_pengirim" => \DI\create(MJenisPengirim::class),
    "m_kode_department" => \DI\create(MKodeDepartment::class),
    "m_kode_pt" => \DI\create(MKodePt::class),
    "m_notifikasi_expired" => \DI\create(MNotifikasiExpired::class),
    "m_ob" => \DI\create(MOb::class),
    "m_status_penerimaan" => \DI\create(MStatusPenerimaan::class),
    "m_status_penerimaan_keluar" => \DI\create(MStatusPenerimaanKeluar::class),
    "nama_user" => \DI\create(NamaUser::class),
    "penerimaan_paket_keluar" => \DI\create(PenerimaanPaketKeluar::class),
    "penerimaan_paket_masuk" => \DI\create(PenerimaanPaketMasuk::class),
    "reportfilingdokumen" => \DI\create(Reportfilingdokumen::class),
    "reportpaketkeluar2" => \DI\create(Reportpaketkeluar2::class),
    "reportpaketmasuk2" => \DI\create(Reportpaketmasuk2::class),
    "user" => \DI\create(User::class),
    "userlevelpermissions" => \DI\create(Userlevelpermissions::class),
    "userlevels" => \DI\create(Userlevels::class),
    "Report_Paket_Keluar" => \DI\create(ReportPaketKeluar::class),
    "Report_Paket_Masuk" => \DI\create(ReportPaketMasuk::class),
    "Dashboard1" => \DI\create(Dashboard1::class),
    "m_status_sap" => \DI\create(MStatusSap::class),
    "landingpage" => \DI\create(Landingpage::class),

    // User table
    "usertable" => \DI\get("user"),
];
