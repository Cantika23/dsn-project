<?php

namespace Mitral2022\DSN2;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // filing_dokumen
    $app->map(["GET", "POST", "OPTIONS"], '/filingdokumenlist[/{id}]', FilingDokumenController::class . ':list')->add(PermissionMiddleware::class)->setName('filingdokumenlist-filing_dokumen-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/filingdokumenadd[/{id}]', FilingDokumenController::class . ':add')->add(PermissionMiddleware::class)->setName('filingdokumenadd-filing_dokumen-add'); // add
    $app->map(["GET", "OPTIONS"], '/filingdokumenview[/{id}]', FilingDokumenController::class . ':view')->add(PermissionMiddleware::class)->setName('filingdokumenview-filing_dokumen-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/filingdokumenedit[/{id}]', FilingDokumenController::class . ':edit')->add(PermissionMiddleware::class)->setName('filingdokumenedit-filing_dokumen-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/filingdokumendelete[/{id}]', FilingDokumenController::class . ':delete')->add(PermissionMiddleware::class)->setName('filingdokumendelete-filing_dokumen-delete'); // delete
    $app->group(
        '/filing_dokumen',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', FilingDokumenController::class . ':list')->add(PermissionMiddleware::class)->setName('filing_dokumen/list-filing_dokumen-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', FilingDokumenController::class . ':add')->add(PermissionMiddleware::class)->setName('filing_dokumen/add-filing_dokumen-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', FilingDokumenController::class . ':view')->add(PermissionMiddleware::class)->setName('filing_dokumen/view-filing_dokumen-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', FilingDokumenController::class . ':edit')->add(PermissionMiddleware::class)->setName('filing_dokumen/edit-filing_dokumen-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', FilingDokumenController::class . ':delete')->add(PermissionMiddleware::class)->setName('filing_dokumen/delete-filing_dokumen-delete-2'); // delete
        }
    );

    // log_courier
    $app->map(["GET", "POST", "OPTIONS"], '/logcourierlist[/{id}]', LogCourierController::class . ':list')->add(PermissionMiddleware::class)->setName('logcourierlist-log_courier-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/logcourieradd[/{id}]', LogCourierController::class . ':add')->add(PermissionMiddleware::class)->setName('logcourieradd-log_courier-add'); // add
    $app->map(["GET", "OPTIONS"], '/logcourierview[/{id}]', LogCourierController::class . ':view')->add(PermissionMiddleware::class)->setName('logcourierview-log_courier-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/logcourieredit[/{id}]', LogCourierController::class . ':edit')->add(PermissionMiddleware::class)->setName('logcourieredit-log_courier-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/logcourierdelete[/{id}]', LogCourierController::class . ':delete')->add(PermissionMiddleware::class)->setName('logcourierdelete-log_courier-delete'); // delete
    $app->group(
        '/log_courier',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', LogCourierController::class . ':list')->add(PermissionMiddleware::class)->setName('log_courier/list-log_courier-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', LogCourierController::class . ':add')->add(PermissionMiddleware::class)->setName('log_courier/add-log_courier-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', LogCourierController::class . ':view')->add(PermissionMiddleware::class)->setName('log_courier/view-log_courier-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', LogCourierController::class . ':edit')->add(PermissionMiddleware::class)->setName('log_courier/edit-log_courier-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', LogCourierController::class . ':delete')->add(PermissionMiddleware::class)->setName('log_courier/delete-log_courier-delete-2'); // delete
        }
    );

    // m_employee
    $app->map(["GET", "POST", "OPTIONS"], '/memployeelist[/{id}]', MEmployeeController::class . ':list')->add(PermissionMiddleware::class)->setName('memployeelist-m_employee-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/memployeeadd[/{id}]', MEmployeeController::class . ':add')->add(PermissionMiddleware::class)->setName('memployeeadd-m_employee-add'); // add
    $app->map(["GET", "OPTIONS"], '/memployeeview[/{id}]', MEmployeeController::class . ':view')->add(PermissionMiddleware::class)->setName('memployeeview-m_employee-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/memployeeedit[/{id}]', MEmployeeController::class . ':edit')->add(PermissionMiddleware::class)->setName('memployeeedit-m_employee-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/memployeedelete[/{id}]', MEmployeeController::class . ':delete')->add(PermissionMiddleware::class)->setName('memployeedelete-m_employee-delete'); // delete
    $app->group(
        '/m_employee',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MEmployeeController::class . ':list')->add(PermissionMiddleware::class)->setName('m_employee/list-m_employee-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MEmployeeController::class . ':add')->add(PermissionMiddleware::class)->setName('m_employee/add-m_employee-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MEmployeeController::class . ':view')->add(PermissionMiddleware::class)->setName('m_employee/view-m_employee-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MEmployeeController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_employee/edit-m_employee-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MEmployeeController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_employee/delete-m_employee-delete-2'); // delete
        }
    );

    // m_gudang
    $app->map(["GET", "POST", "OPTIONS"], '/mgudanglist[/{id}]', MGudangController::class . ':list')->add(PermissionMiddleware::class)->setName('mgudanglist-m_gudang-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mgudangadd[/{id}]', MGudangController::class . ':add')->add(PermissionMiddleware::class)->setName('mgudangadd-m_gudang-add'); // add
    $app->map(["GET", "OPTIONS"], '/mgudangview[/{id}]', MGudangController::class . ':view')->add(PermissionMiddleware::class)->setName('mgudangview-m_gudang-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mgudangedit[/{id}]', MGudangController::class . ':edit')->add(PermissionMiddleware::class)->setName('mgudangedit-m_gudang-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mgudangdelete[/{id}]', MGudangController::class . ':delete')->add(PermissionMiddleware::class)->setName('mgudangdelete-m_gudang-delete'); // delete
    $app->group(
        '/m_gudang',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MGudangController::class . ':list')->add(PermissionMiddleware::class)->setName('m_gudang/list-m_gudang-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MGudangController::class . ':add')->add(PermissionMiddleware::class)->setName('m_gudang/add-m_gudang-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MGudangController::class . ':view')->add(PermissionMiddleware::class)->setName('m_gudang/view-m_gudang-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MGudangController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_gudang/edit-m_gudang-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MGudangController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_gudang/delete-m_gudang-delete-2'); // delete
        }
    );

    // m_jenis_dokumen
    $app->map(["GET", "POST", "OPTIONS"], '/mjenisdokumenlist[/{id}]', MJenisDokumenController::class . ':list')->add(PermissionMiddleware::class)->setName('mjenisdokumenlist-m_jenis_dokumen-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mjenisdokumenadd[/{id}]', MJenisDokumenController::class . ':add')->add(PermissionMiddleware::class)->setName('mjenisdokumenadd-m_jenis_dokumen-add'); // add
    $app->map(["GET", "OPTIONS"], '/mjenisdokumenview[/{id}]', MJenisDokumenController::class . ':view')->add(PermissionMiddleware::class)->setName('mjenisdokumenview-m_jenis_dokumen-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mjenisdokumenedit[/{id}]', MJenisDokumenController::class . ':edit')->add(PermissionMiddleware::class)->setName('mjenisdokumenedit-m_jenis_dokumen-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mjenisdokumendelete[/{id}]', MJenisDokumenController::class . ':delete')->add(PermissionMiddleware::class)->setName('mjenisdokumendelete-m_jenis_dokumen-delete'); // delete
    $app->group(
        '/m_jenis_dokumen',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MJenisDokumenController::class . ':list')->add(PermissionMiddleware::class)->setName('m_jenis_dokumen/list-m_jenis_dokumen-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MJenisDokumenController::class . ':add')->add(PermissionMiddleware::class)->setName('m_jenis_dokumen/add-m_jenis_dokumen-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MJenisDokumenController::class . ':view')->add(PermissionMiddleware::class)->setName('m_jenis_dokumen/view-m_jenis_dokumen-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MJenisDokumenController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_jenis_dokumen/edit-m_jenis_dokumen-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MJenisDokumenController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_jenis_dokumen/delete-m_jenis_dokumen-delete-2'); // delete
        }
    );

    // m_jenis_pengirim
    $app->map(["GET", "POST", "OPTIONS"], '/mjenispengirimlist[/{id}]', MJenisPengirimController::class . ':list')->add(PermissionMiddleware::class)->setName('mjenispengirimlist-m_jenis_pengirim-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mjenispengirimadd[/{id}]', MJenisPengirimController::class . ':add')->add(PermissionMiddleware::class)->setName('mjenispengirimadd-m_jenis_pengirim-add'); // add
    $app->map(["GET", "OPTIONS"], '/mjenispengirimview[/{id}]', MJenisPengirimController::class . ':view')->add(PermissionMiddleware::class)->setName('mjenispengirimview-m_jenis_pengirim-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mjenispengirimedit[/{id}]', MJenisPengirimController::class . ':edit')->add(PermissionMiddleware::class)->setName('mjenispengirimedit-m_jenis_pengirim-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mjenispengirimdelete[/{id}]', MJenisPengirimController::class . ':delete')->add(PermissionMiddleware::class)->setName('mjenispengirimdelete-m_jenis_pengirim-delete'); // delete
    $app->group(
        '/m_jenis_pengirim',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MJenisPengirimController::class . ':list')->add(PermissionMiddleware::class)->setName('m_jenis_pengirim/list-m_jenis_pengirim-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MJenisPengirimController::class . ':add')->add(PermissionMiddleware::class)->setName('m_jenis_pengirim/add-m_jenis_pengirim-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MJenisPengirimController::class . ':view')->add(PermissionMiddleware::class)->setName('m_jenis_pengirim/view-m_jenis_pengirim-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MJenisPengirimController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_jenis_pengirim/edit-m_jenis_pengirim-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MJenisPengirimController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_jenis_pengirim/delete-m_jenis_pengirim-delete-2'); // delete
        }
    );

    // m_kode_department
    $app->map(["GET", "POST", "OPTIONS"], '/mkodedepartmentlist[/{id}]', MKodeDepartmentController::class . ':list')->add(PermissionMiddleware::class)->setName('mkodedepartmentlist-m_kode_department-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mkodedepartmentadd[/{id}]', MKodeDepartmentController::class . ':add')->add(PermissionMiddleware::class)->setName('mkodedepartmentadd-m_kode_department-add'); // add
    $app->map(["GET", "OPTIONS"], '/mkodedepartmentview[/{id}]', MKodeDepartmentController::class . ':view')->add(PermissionMiddleware::class)->setName('mkodedepartmentview-m_kode_department-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mkodedepartmentedit[/{id}]', MKodeDepartmentController::class . ':edit')->add(PermissionMiddleware::class)->setName('mkodedepartmentedit-m_kode_department-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mkodedepartmentdelete[/{id}]', MKodeDepartmentController::class . ':delete')->add(PermissionMiddleware::class)->setName('mkodedepartmentdelete-m_kode_department-delete'); // delete
    $app->group(
        '/m_kode_department',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MKodeDepartmentController::class . ':list')->add(PermissionMiddleware::class)->setName('m_kode_department/list-m_kode_department-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MKodeDepartmentController::class . ':add')->add(PermissionMiddleware::class)->setName('m_kode_department/add-m_kode_department-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MKodeDepartmentController::class . ':view')->add(PermissionMiddleware::class)->setName('m_kode_department/view-m_kode_department-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MKodeDepartmentController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_kode_department/edit-m_kode_department-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MKodeDepartmentController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_kode_department/delete-m_kode_department-delete-2'); // delete
        }
    );

    // m_kode_pt
    $app->map(["GET", "POST", "OPTIONS"], '/mkodeptlist[/{id}]', MKodePtController::class . ':list')->add(PermissionMiddleware::class)->setName('mkodeptlist-m_kode_pt-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mkodeptadd[/{id}]', MKodePtController::class . ':add')->add(PermissionMiddleware::class)->setName('mkodeptadd-m_kode_pt-add'); // add
    $app->map(["GET", "OPTIONS"], '/mkodeptview[/{id}]', MKodePtController::class . ':view')->add(PermissionMiddleware::class)->setName('mkodeptview-m_kode_pt-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mkodeptedit[/{id}]', MKodePtController::class . ':edit')->add(PermissionMiddleware::class)->setName('mkodeptedit-m_kode_pt-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mkodeptdelete[/{id}]', MKodePtController::class . ':delete')->add(PermissionMiddleware::class)->setName('mkodeptdelete-m_kode_pt-delete'); // delete
    $app->group(
        '/m_kode_pt',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MKodePtController::class . ':list')->add(PermissionMiddleware::class)->setName('m_kode_pt/list-m_kode_pt-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MKodePtController::class . ':add')->add(PermissionMiddleware::class)->setName('m_kode_pt/add-m_kode_pt-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MKodePtController::class . ':view')->add(PermissionMiddleware::class)->setName('m_kode_pt/view-m_kode_pt-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MKodePtController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_kode_pt/edit-m_kode_pt-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MKodePtController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_kode_pt/delete-m_kode_pt-delete-2'); // delete
        }
    );

    // m_notifikasi_expired
    $app->map(["GET", "POST", "OPTIONS"], '/mnotifikasiexpiredlist[/{id}]', MNotifikasiExpiredController::class . ':list')->add(PermissionMiddleware::class)->setName('mnotifikasiexpiredlist-m_notifikasi_expired-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mnotifikasiexpiredadd[/{id}]', MNotifikasiExpiredController::class . ':add')->add(PermissionMiddleware::class)->setName('mnotifikasiexpiredadd-m_notifikasi_expired-add'); // add
    $app->map(["GET", "OPTIONS"], '/mnotifikasiexpiredview[/{id}]', MNotifikasiExpiredController::class . ':view')->add(PermissionMiddleware::class)->setName('mnotifikasiexpiredview-m_notifikasi_expired-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mnotifikasiexpirededit[/{id}]', MNotifikasiExpiredController::class . ':edit')->add(PermissionMiddleware::class)->setName('mnotifikasiexpirededit-m_notifikasi_expired-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mnotifikasiexpireddelete[/{id}]', MNotifikasiExpiredController::class . ':delete')->add(PermissionMiddleware::class)->setName('mnotifikasiexpireddelete-m_notifikasi_expired-delete'); // delete
    $app->group(
        '/m_notifikasi_expired',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MNotifikasiExpiredController::class . ':list')->add(PermissionMiddleware::class)->setName('m_notifikasi_expired/list-m_notifikasi_expired-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MNotifikasiExpiredController::class . ':add')->add(PermissionMiddleware::class)->setName('m_notifikasi_expired/add-m_notifikasi_expired-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MNotifikasiExpiredController::class . ':view')->add(PermissionMiddleware::class)->setName('m_notifikasi_expired/view-m_notifikasi_expired-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MNotifikasiExpiredController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_notifikasi_expired/edit-m_notifikasi_expired-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MNotifikasiExpiredController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_notifikasi_expired/delete-m_notifikasi_expired-delete-2'); // delete
        }
    );

    // m_status_penerimaan
    $app->map(["GET", "POST", "OPTIONS"], '/mstatuspenerimaanlist[/{id}]', MStatusPenerimaanController::class . ':list')->add(PermissionMiddleware::class)->setName('mstatuspenerimaanlist-m_status_penerimaan-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mstatuspenerimaanadd[/{id}]', MStatusPenerimaanController::class . ':add')->add(PermissionMiddleware::class)->setName('mstatuspenerimaanadd-m_status_penerimaan-add'); // add
    $app->map(["GET", "OPTIONS"], '/mstatuspenerimaanview[/{id}]', MStatusPenerimaanController::class . ':view')->add(PermissionMiddleware::class)->setName('mstatuspenerimaanview-m_status_penerimaan-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mstatuspenerimaanedit[/{id}]', MStatusPenerimaanController::class . ':edit')->add(PermissionMiddleware::class)->setName('mstatuspenerimaanedit-m_status_penerimaan-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mstatuspenerimaandelete[/{id}]', MStatusPenerimaanController::class . ':delete')->add(PermissionMiddleware::class)->setName('mstatuspenerimaandelete-m_status_penerimaan-delete'); // delete
    $app->group(
        '/m_status_penerimaan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MStatusPenerimaanController::class . ':list')->add(PermissionMiddleware::class)->setName('m_status_penerimaan/list-m_status_penerimaan-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MStatusPenerimaanController::class . ':add')->add(PermissionMiddleware::class)->setName('m_status_penerimaan/add-m_status_penerimaan-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MStatusPenerimaanController::class . ':view')->add(PermissionMiddleware::class)->setName('m_status_penerimaan/view-m_status_penerimaan-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MStatusPenerimaanController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_status_penerimaan/edit-m_status_penerimaan-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MStatusPenerimaanController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_status_penerimaan/delete-m_status_penerimaan-delete-2'); // delete
        }
    );

    // m_status_penerimaan_keluar
    $app->map(["GET", "POST", "OPTIONS"], '/mstatuspenerimaankeluarlist[/{id}]', MStatusPenerimaanKeluarController::class . ':list')->add(PermissionMiddleware::class)->setName('mstatuspenerimaankeluarlist-m_status_penerimaan_keluar-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mstatuspenerimaankeluaradd[/{id}]', MStatusPenerimaanKeluarController::class . ':add')->add(PermissionMiddleware::class)->setName('mstatuspenerimaankeluaradd-m_status_penerimaan_keluar-add'); // add
    $app->map(["GET", "OPTIONS"], '/mstatuspenerimaankeluarview[/{id}]', MStatusPenerimaanKeluarController::class . ':view')->add(PermissionMiddleware::class)->setName('mstatuspenerimaankeluarview-m_status_penerimaan_keluar-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mstatuspenerimaankeluaredit[/{id}]', MStatusPenerimaanKeluarController::class . ':edit')->add(PermissionMiddleware::class)->setName('mstatuspenerimaankeluaredit-m_status_penerimaan_keluar-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mstatuspenerimaankeluardelete[/{id}]', MStatusPenerimaanKeluarController::class . ':delete')->add(PermissionMiddleware::class)->setName('mstatuspenerimaankeluardelete-m_status_penerimaan_keluar-delete'); // delete
    $app->group(
        '/m_status_penerimaan_keluar',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MStatusPenerimaanKeluarController::class . ':list')->add(PermissionMiddleware::class)->setName('m_status_penerimaan_keluar/list-m_status_penerimaan_keluar-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MStatusPenerimaanKeluarController::class . ':add')->add(PermissionMiddleware::class)->setName('m_status_penerimaan_keluar/add-m_status_penerimaan_keluar-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MStatusPenerimaanKeluarController::class . ':view')->add(PermissionMiddleware::class)->setName('m_status_penerimaan_keluar/view-m_status_penerimaan_keluar-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MStatusPenerimaanKeluarController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_status_penerimaan_keluar/edit-m_status_penerimaan_keluar-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MStatusPenerimaanKeluarController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_status_penerimaan_keluar/delete-m_status_penerimaan_keluar-delete-2'); // delete
        }
    );

    // nama_user
    $app->map(["GET", "POST", "OPTIONS"], '/namauserlist[/{id}]', NamaUserController::class . ':list')->add(PermissionMiddleware::class)->setName('namauserlist-nama_user-list'); // list
    $app->group(
        '/nama_user',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', NamaUserController::class . ':list')->add(PermissionMiddleware::class)->setName('nama_user/list-nama_user-list-2'); // list
        }
    );

    // penerimaan_paket_keluar
    $app->map(["GET", "POST", "OPTIONS"], '/penerimaanpaketkeluarlist[/{id}]', PenerimaanPaketKeluarController::class . ':list')->add(PermissionMiddleware::class)->setName('penerimaanpaketkeluarlist-penerimaan_paket_keluar-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/penerimaanpaketkeluaradd[/{id}]', PenerimaanPaketKeluarController::class . ':add')->add(PermissionMiddleware::class)->setName('penerimaanpaketkeluaradd-penerimaan_paket_keluar-add'); // add
    $app->map(["GET", "OPTIONS"], '/penerimaanpaketkeluarview[/{id}]', PenerimaanPaketKeluarController::class . ':view')->add(PermissionMiddleware::class)->setName('penerimaanpaketkeluarview-penerimaan_paket_keluar-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/penerimaanpaketkeluaredit[/{id}]', PenerimaanPaketKeluarController::class . ':edit')->add(PermissionMiddleware::class)->setName('penerimaanpaketkeluaredit-penerimaan_paket_keluar-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/penerimaanpaketkeluardelete[/{id}]', PenerimaanPaketKeluarController::class . ':delete')->add(PermissionMiddleware::class)->setName('penerimaanpaketkeluardelete-penerimaan_paket_keluar-delete'); // delete
    $app->group(
        '/penerimaan_paket_keluar',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PenerimaanPaketKeluarController::class . ':list')->add(PermissionMiddleware::class)->setName('penerimaan_paket_keluar/list-penerimaan_paket_keluar-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PenerimaanPaketKeluarController::class . ':add')->add(PermissionMiddleware::class)->setName('penerimaan_paket_keluar/add-penerimaan_paket_keluar-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PenerimaanPaketKeluarController::class . ':view')->add(PermissionMiddleware::class)->setName('penerimaan_paket_keluar/view-penerimaan_paket_keluar-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PenerimaanPaketKeluarController::class . ':edit')->add(PermissionMiddleware::class)->setName('penerimaan_paket_keluar/edit-penerimaan_paket_keluar-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PenerimaanPaketKeluarController::class . ':delete')->add(PermissionMiddleware::class)->setName('penerimaan_paket_keluar/delete-penerimaan_paket_keluar-delete-2'); // delete
        }
    );

    // penerimaan_paket_masuk
    $app->map(["GET", "POST", "OPTIONS"], '/penerimaanpaketmasuklist[/{id}]', PenerimaanPaketMasukController::class . ':list')->add(PermissionMiddleware::class)->setName('penerimaanpaketmasuklist-penerimaan_paket_masuk-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/penerimaanpaketmasukadd[/{id}]', PenerimaanPaketMasukController::class . ':add')->add(PermissionMiddleware::class)->setName('penerimaanpaketmasukadd-penerimaan_paket_masuk-add'); // add
    $app->map(["GET", "OPTIONS"], '/penerimaanpaketmasukview[/{id}]', PenerimaanPaketMasukController::class . ':view')->add(PermissionMiddleware::class)->setName('penerimaanpaketmasukview-penerimaan_paket_masuk-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/penerimaanpaketmasukedit[/{id}]', PenerimaanPaketMasukController::class . ':edit')->add(PermissionMiddleware::class)->setName('penerimaanpaketmasukedit-penerimaan_paket_masuk-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/penerimaanpaketmasukdelete[/{id}]', PenerimaanPaketMasukController::class . ':delete')->add(PermissionMiddleware::class)->setName('penerimaanpaketmasukdelete-penerimaan_paket_masuk-delete'); // delete
    $app->group(
        '/penerimaan_paket_masuk',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PenerimaanPaketMasukController::class . ':list')->add(PermissionMiddleware::class)->setName('penerimaan_paket_masuk/list-penerimaan_paket_masuk-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PenerimaanPaketMasukController::class . ':add')->add(PermissionMiddleware::class)->setName('penerimaan_paket_masuk/add-penerimaan_paket_masuk-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PenerimaanPaketMasukController::class . ':view')->add(PermissionMiddleware::class)->setName('penerimaan_paket_masuk/view-penerimaan_paket_masuk-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PenerimaanPaketMasukController::class . ':edit')->add(PermissionMiddleware::class)->setName('penerimaan_paket_masuk/edit-penerimaan_paket_masuk-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PenerimaanPaketMasukController::class . ':delete')->add(PermissionMiddleware::class)->setName('penerimaan_paket_masuk/delete-penerimaan_paket_masuk-delete-2'); // delete
        }
    );

    // reportfilingdokumen
    $app->map(["GET", "POST", "OPTIONS"], '/reportfilingdokumenlist', ReportfilingdokumenController::class . ':list')->add(PermissionMiddleware::class)->setName('reportfilingdokumenlist-reportfilingdokumen-list'); // list
    $app->group(
        '/reportfilingdokumen',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '', ReportfilingdokumenController::class . ':list')->add(PermissionMiddleware::class)->setName('reportfilingdokumen/list-reportfilingdokumen-list-2'); // list
        }
    );

    // reportpaketkeluar2
    $app->map(["GET", "POST", "OPTIONS"], '/reportpaketkeluar2list', Reportpaketkeluar2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('reportpaketkeluar2list-reportpaketkeluar2-list'); // list
    $app->group(
        '/reportpaketkeluar2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '', Reportpaketkeluar2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('reportpaketkeluar2/list-reportpaketkeluar2-list-2'); // list
        }
    );

    // reportpaketmasuk2
    $app->map(["GET", "POST", "OPTIONS"], '/reportpaketmasuk2list', Reportpaketmasuk2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('reportpaketmasuk2list-reportpaketmasuk2-list'); // list
    $app->group(
        '/reportpaketmasuk2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '', Reportpaketmasuk2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('reportpaketmasuk2/list-reportpaketmasuk2-list-2'); // list
        }
    );

    // user
    $app->map(["GET", "POST", "OPTIONS"], '/userlist[/{id}]', UserController::class . ':list')->add(PermissionMiddleware::class)->setName('userlist-user-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/useradd[/{id}]', UserController::class . ':add')->add(PermissionMiddleware::class)->setName('useradd-user-add'); // add
    $app->map(["GET", "OPTIONS"], '/userview[/{id}]', UserController::class . ':view')->add(PermissionMiddleware::class)->setName('userview-user-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/useredit[/{id}]', UserController::class . ':edit')->add(PermissionMiddleware::class)->setName('useredit-user-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/userdelete[/{id}]', UserController::class . ':delete')->add(PermissionMiddleware::class)->setName('userdelete-user-delete'); // delete
    $app->group(
        '/user',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', UserController::class . ':list')->add(PermissionMiddleware::class)->setName('user/list-user-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', UserController::class . ':add')->add(PermissionMiddleware::class)->setName('user/add-user-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', UserController::class . ':view')->add(PermissionMiddleware::class)->setName('user/view-user-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', UserController::class . ':edit')->add(PermissionMiddleware::class)->setName('user/edit-user-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', UserController::class . ':delete')->add(PermissionMiddleware::class)->setName('user/delete-user-delete-2'); // delete
        }
    );

    // userlevels
    $app->map(["GET", "POST", "OPTIONS"], '/userlevelslist[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelslist-userlevels-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/userlevelsadd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelsadd-userlevels-add'); // add
    $app->map(["GET", "OPTIONS"], '/userlevelsview[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelsview-userlevels-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/userlevelsedit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelsedit-userlevels-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/userlevelsdelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelsdelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // Report_Paket_Keluar
    $app->map(["GET", "POST", "OPTIONS"], '/reportpaketkeluar', ReportPaketKeluarController::class)->add(PermissionMiddleware::class)->setName('reportpaketkeluar-Report_Paket_Keluar-summary'); // summary

    // Report_Paket_Masuk
    $app->map(["GET", "POST", "OPTIONS"], '/reportpaketmasuk', ReportPaketMasukController::class)->add(PermissionMiddleware::class)->setName('reportpaketmasuk-Report_Paket_Masuk-summary'); // summary

    // Dashboard1
    $app->map(["GET", "POST", "OPTIONS"], '/dashboard1', Dashboard1Controller::class)->add(PermissionMiddleware::class)->setName('dashboard1-Dashboard1-dashboard'); // dashboard

    // m_status_sap
    $app->map(["GET", "POST", "OPTIONS"], '/mstatussaplist[/{id}]', MStatusSapController::class . ':list')->add(PermissionMiddleware::class)->setName('mstatussaplist-m_status_sap-list'); // list
    $app->map(["GET", "POST", "OPTIONS"], '/mstatussapadd[/{id}]', MStatusSapController::class . ':add')->add(PermissionMiddleware::class)->setName('mstatussapadd-m_status_sap-add'); // add
    $app->map(["GET", "OPTIONS"], '/mstatussapview[/{id}]', MStatusSapController::class . ':view')->add(PermissionMiddleware::class)->setName('mstatussapview-m_status_sap-view'); // view
    $app->map(["GET", "POST", "OPTIONS"], '/mstatussapedit[/{id}]', MStatusSapController::class . ':edit')->add(PermissionMiddleware::class)->setName('mstatussapedit-m_status_sap-edit'); // edit
    $app->map(["GET", "POST", "OPTIONS"], '/mstatussapdelete[/{id}]', MStatusSapController::class . ':delete')->add(PermissionMiddleware::class)->setName('mstatussapdelete-m_status_sap-delete'); // delete
    $app->group(
        '/m_status_sap',
        function (RouteCollectorProxy $group) {
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MStatusSapController::class . ':list')->add(PermissionMiddleware::class)->setName('m_status_sap/list-m_status_sap-list-2'); // list
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MStatusSapController::class . ':add')->add(PermissionMiddleware::class)->setName('m_status_sap/add-m_status_sap-add-2'); // add
            $group->map(["GET", "OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MStatusSapController::class . ':view')->add(PermissionMiddleware::class)->setName('m_status_sap/view-m_status_sap-view-2'); // view
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MStatusSapController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_status_sap/edit-m_status_sap-edit-2'); // edit
            $group->map(["GET", "POST", "OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MStatusSapController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_status_sap/delete-m_status_sap-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET", "POST", "OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->map(["GET", "POST", "OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET", "POST", "OPTIONS"], '/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // userpriv
    $app->map(["GET", "POST", "OPTIONS"], '/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->map(["GET", "POST", "OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');
    
    // landingpage 14012025
    $app->map(["GET", "POST", "OPTIONS"], '/landingpage[/{params:.*}]', LandingpageController::class)->add(PermissionMiddleware::class)->setName('landingpage-landingpage-custom'); // custom

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
