<?php

use App\Http\Controllers\AJAX\DashboardController as AJAXDashboardController;
use App\Http\Controllers\AJAX\PromotionMessageController as AJAXPromotionMessageController;
use App\Http\Controllers\AJAX\SearchRollController as AJAXSearchRollController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PromotionMessageController;
use App\Http\Controllers\RestockController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\RegistrationCredentialController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RollTransactionController;
use App\Http\Controllers\SearchRollController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\Test;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\WhatsappMessagingController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view("welcome");
});



Route::middleware("guest")
    ->group(function () {
        Route::controller(RegistrationController::class)
            ->name("registration.")
            ->prefix("/registration")
            ->group(
                function () {
                        Route::get("/", "index")->name("index");
                        Route::post("/", "store")->name("store");
                    }
            );

        Route::controller(ForgotPasswordController::class)
            ->prefix("/forgot-password")
            ->name("forgot.password.")
            ->group(
                function () {
                        Route::get("/", "forgot")->name("forgot");
                        Route::get("/reset/{token}/{email}", "reset")->name("reset");
                        Route::post("/", "sendResetLink")->name("sendResetLink");
                        Route::post("/reset-password", "resetPassword")->name("resetPassword");
                    }
            );

        Route::controller(AuthController::class)
            ->name("auth.")
            ->group(
                function () {
                        Route::get("/login", "login")->name("login");
                        Route::post("/authenticate", "authenticate")->name("authenticate");
                        Route::post("/logout", "logout")->name("logout")->middleware("auth")->withoutMiddleware("guest");
                    }
            );
    });


Route::controller(VerificationController::class)
    ->name("verification.")
    ->prefix("/email")
    ->group(function () {
        Route::get("/verify", "show")->name("notice")->middleware("auth");
        Route::get("/verify/{id}/{hash}", "verify")->name("verify");
        Route::post("/resend", "resend")->name("resend")->middleware("auth");
    });


Route::middleware(["auth", "verified"])
    ->group(function () {
        Route::controller(SearchRollController::class)
            ->name("search-roll.")
            ->prefix("/search-roll")
            ->group(
                function () {
                        Route::get("/", "index")->name("index");
                    }
            );
        Route::controller(AJAXSearchRollController::class)
            ->name("ajax.search.roll")
            ->prefix("/ajax/search-roll")
            ->group(
                function () {
                        Route::get("/{id}", "show")->name("show");
                    }
            );


        Route::middleware("role:superadmin,admin,warehouse keeper")->group(
            function () {
                    Route::controller(RollTransactionController::class)
                        ->name("roll.transactions.")
                        ->prefix("/roll-transactions")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/put-away", "putAway")->name("putAway");
                                            Route::post("/put-away", "putAwayTransaction")->name("putAwayTransaction");
                                        }
                        );

                    Route::controller(RestockController::class)
                        ->name("restock.")
                        ->prefix("/restock")
                        ->group(
                            function () {
                                            Route::get("/create", "create")->name("create");
                                            Route::post("/", "store")->name("store");
                                        }
                        );
                }
        );


        Route::middleware("role:superadmin,admin,cashier")->group(
            function () {
                    Route::controller(ShoppingController::class)
                        ->name("shopping.")
                        ->prefix("/shopping")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::post("/purchase", "purchase")->name("purchase");
                                        }
                        );

                    Route::controller(InvoiceController::class)
                        ->name("invoices.")
                        ->prefix("/invoices")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/{type}/{id}", "invoicPdf")->name("invoicPdf");
                                        }
                        );

                    Route::controller(PaymentController::class)
                        ->name("payments.")
                        ->prefix("/payments")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/create/{id}", "createByInvoiceId")->name("createByInvoiceId");
                                            Route::get("/create", "create")->name("create");
                                            Route::post("/", "store")->name("store");
                                        }
                        );

                    Route::controller(CustomerController::class)
                        ->name("customers.")
                        ->prefix("/customers")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/create", "create")->name("create");
                                            Route::get("/edit/{id}", "edit")->name("edit");
                                            Route::post("/", "store")->name("store");
                                            Route::patch("/{id}", "update")->name("update");
                                            Route::delete("/{id}", "destroy")->name("destroy");
                                        }
                        );
                }
        );

        Route::middleware("role:superadmin,admin")->group(
            function () {
                    Route::controller(DashboardController::class)
                        ->name("dashboard.")
                        ->prefix("/dashboard")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                        }
                        );

                    Route::controller(AJAXDashboardController::class)
                        ->name("ajax.dashboard.")
                        ->prefix("/ajax/dashboard")
                        ->group(
                            function () {
                                            Route::get("/sales-summary", "salesSummary")->name("sales.summary");
                                        }
                        );


                    Route::controller(WhatsappMessagingController::class)
                        ->name("whatsapp.messaging.")
                        ->prefix("/whatsapp-messaging")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::post("/", "store")->name("store");
                                        }
                        );

                    Route::controller(PromotionMessageController::class)
                        ->name("promotion.messages.")
                        ->prefix("/promotion-messages")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/create", "create")->name("create");
                                            Route::post("/", "store")->name("store");
                                        }
                        );

                    Route::controller(AJAXPromotionMessageController::class)
                        ->name("ajax.promotion.messages.")
                        ->prefix("/ajax/promotion-messages")
                        ->group(
                            function () {
                                            Route::get("/{id}", "show")->name("show");
                                        }
                        );

                    Route::controller(ReportController::class)
                        ->name("reports.")
                        ->prefix("/reports")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::post("/download", "download")->name("download");
                                        }
                        );

                    Route::controller(RoleController::class)
                        ->name("roles.")
                        ->prefix("/roles")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                        }
                        );

                    Route::controller(UnitController::class)
                        ->name("units.")
                        ->prefix("/units")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/edit/{id}", "edit")->name("edit");
                                            Route::get("/create", "create")->name("create");
                                            Route::patch("/{id}", "update")->name("update");
                                            Route::post("/", "store")->name("store");
                                            Route::delete("/{id}", "destroy")->name("destroy");
                                        }
                        );

                    Route::controller(RollController::class)
                        ->name("rolls.")
                        ->prefix("/rolls")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/create", "create")->name("create");
                                            Route::post("/", "store")->name("store");
                                            Route::get("/edit/{id}", "edit")->name("edit");
                                            Route::patch("/{id}", "update")->name("update");
                                            Route::get("/download/{qrcode}", "downloadQrcode")->name("downloadQrcode");
                                            Route::post("/print", "printQrcode")->name("printQrcode");
                                        }
                        );
                }
        );

        Route::middleware("role:superadmin")->group(
            function () {
                    Route::controller(UserManagementController::class)
                        ->name("users.")
                        ->prefix("/users")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/create", "create")->name("create");
                                            Route::post("/", "store")->name("store");
                                            Route::get("/edit/{id}", "edit")->name("edit");
                                            Route::patch("/{id}", "update")->name("update");
                                            Route::delete("/{id}", "suspend")->name("suspend");
                                        }
                        );

                    Route::controller(RegistrationCredentialController::class)
                        ->name("registration.credentials.")
                        ->prefix("/registration-credentials")
                        ->group(
                            function () {
                                            Route::get("/", "index")->name("index");
                                            Route::get("/create", "create")->name("create");
                                            Route::post("/", "store")->name("store");
                                            Route::delete("/{id}", "destroy")->name("destroy");
                                            Route::put("/{id}", "update")->name("update");
                                        }
                        );
                }
        );

    });
