<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TransportationController;
use App\Http\Controllers\TravelPackagesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HotelRoomController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { 
    return redirect()->route('v1.frontend.dashboard'); 
});

Route::prefix('v1')->name('v1.')->group(function () { 
    // Auth Backend (tanpa middleware auth)
    Route::prefix('backend')->name('backend.')->group(function () {
        Route::prefix('login')->name('login.')->controller(App\Http\Controllers\LoginController::class)->group(function () {
            Route::get('',  'loginBackend')->name('login');
            Route::post('',  'authenticateBackend')->name('process');
            Route::get('/register', 'registerBackend')->name('register');
            Route::post('/register', 'storeRegister')->name('register.process');
            Route::post('/logout', 'logoutBackend')->name('logout');
        });
    });

     // Semua route backend yang butuh auth — dalam SATU group 
    Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () { 
         // Dashboard
        Route::prefix('dashboard')->name('dashboard.')->controller(App\Http\Controllers\DashboardController::class)->group(function () { 
            Route::get('', 'dashboardBackend')->name('dashboard'); 
            Route::get('/index', 'index')->name('index');
            Route::get('/admin/dashboard', 'dashboardBackend')->name('admin.dashboard');
            Route::get('/staff/dashboard', fn() => view('backend.v_dashboard.staff'))->name('staff.dashboard');
        });

        // User Management
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
            Route::get('', 'index')->name('index'); 
            Route::get('/create', 'create')->name('create'); 
            Route::post('/store', 'store')->name('store'); 
            Route::get('/{id}/edit', 'edit')->name('edit'); 
            Route::put('/{id}', 'update')->name('update'); 
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/report/formuser', 'formUser')->name('report.formuser'); 
            Route::post('/report/printuser', 'printUser')->name('report.printuser');
        });

         // Destination
        Route::prefix('destination')->name('destination.')->controller(DestinationController::class)->group(function () {
            Route::get('/', 'index')->name('index'); 
            Route::get('/create', 'create')->name('create'); 
            Route::post('/store', 'store')->name('store'); 
            Route::get('/{id}/edit', 'edit')->name('edit'); 
            Route::put('/{id}', 'update')->name('update'); 
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

         // Hotel
        Route::prefix('hotel')->name('hotel.')->controller(HotelController::class)->group(function () {
            Route::get('/', 'index')->name('index'); 
            Route::get('/create', 'create')->name('create'); 
            Route::post('/store', 'store')->name('store'); 
            Route::get('/{id}/edit', 'edit')->name('edit'); 
            Route::put('/{id}', 'update')->name('update'); 
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

            // Hotel Room
        Route::prefix('hotel-room')->name('hotel-room.')->controller(HotelRoomController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });


        // Transportation
        Route::prefix('transportation')->name('transportation.')->controller(TransportationController::class)->group(function () {
            Route::get('/', 'index')->name('index'); 
            Route::get('/create', 'create')->name('create'); 
            Route::post('/store', 'store')->name('store'); 
            Route::get('/{id}/edit', 'edit')->name('edit'); 
            Route::put('/{id}', 'update')->name('update'); 
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

         // Travel Packages
        Route::prefix('travel-packages')->name('travel-packages.')->controller(TravelPackagesController::class)->group(function () {
            Route::get('/', 'index')->name('index'); 
            Route::get('/create', 'create')->name('create'); 
            Route::post('/store', 'store')->name('store'); 
            Route::get('/{id}/edit', 'edit')->name('edit'); 
            Route::put('/{id}', 'update')->name('update'); 
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/report/formtravelpackages', 'formTravelPackages')->name('report.formtravelpackages');
            Route::post('/report/printtravelpackages', 'printTravelPackages')->name('report.printtravelpackages');
        });

        // Booking (Backend)
        Route::prefix('booking')->name('booking.')->controller(BookingController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::put('/{id}/status', 'updateStatus')->name('update-status');
            Route::get('/report/formbooking', 'formBooking')->name('report.formbooking');
            Route::post('/report/printbooking', 'printBooking')->name('report.printbooking');
        });
     });

    // Frontend
    Route::prefix('frontend')->name('frontend.')->group(function () { 
         // Auth Frontend (tanpa middleware auth)
        Route::prefix('login')->name('login.')->controller(LoginController::class)->group(function () {
            Route::get('', 'loginFrontend')->name('login');
            Route::post('/process', 'authenticateFrontend')->name('process');
            Route::get('/register', 'registerFrontend')->name('register');
            Route::post('/register', 'storeRegister')->name('register.process');
            Route::post('/logout', 'logoutFrontend')->name('logout');
        });

         // Halaman Publik (tanpa auth)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/about', fn() => view('frontend.v_about.about'))->name('about');
        Route::get('/destination', [DestinationController::class, 'frontendIndex'])->name('destination');
        Route::get('/destination/{id}', [DestinationController::class, 'frontendShow'])->name('destination.show');
        Route::get('/tours', [TravelPackagesController::class, 'frontendIndex'])->name('tours');
        Route::get('/tours/{id}', [TravelPackagesController::class, 'frontendShow'])->name('tours.show');
        Route::get('/hotel', [HotelController::class, 'frontendIndex'])->name('hotel');
        Route::get('/hotel/{id}', [HotelController::class, 'frontendShow'])->name('hotel.show');
        Route::get('/transportation', [TransportationController::class, 'frontendIndex'])->name('transportation');
        Route::get('/transportation/{id}', [TransportationController::class, 'frontendShow'])->name('transportation.show');
    });

     // ── Booking ──────────────────────────────────────────────────────
    Route::middleware('auth')->group(function () {
        Route::prefix('booking')->name('booking.')->controller(BookingController::class)->group(function () {
             Route::get('/',                   'myBookings')       ->name('index');          // Daftar booking saya
            Route::get('/package/{id}/create', 'createPackageForm')->name('package.create'); // Form pesan paket
            Route::get('/hotel/{id}/create',   'createHotelForm')  ->name('hotel.create');    // Form pesan hotel
            Route::get('/transport/{id}/create','createTransportForm')->name('transport.create'); // Form pesan transportasi
            Route::get('/{id}',                'myBookingDetail')  ->name('show');           // Detail booking
            Route::post('/package',            'bookPackage')      ->name('package');        // Pesan paket
            Route::post('/hotel',              'bookHotel')        ->name('hotel');          // Pesan hotel
            Route::post('/transport',          'bookTransport')    ->name('transport');      // Pesan transportasi
            Route::put('/{id}/cancel',         'cancel')           ->name('cancel');         // Batalkan booking
        });

        Route::prefix('payment')->name('payment.')->group(function () {
            Route::post('/', [PaymentController::class, 'store'])->name('store');
            Route::get('/{bookingId}', [PaymentController::class, 'show'])->name('show');
        });
     });

       // ─── Backend admin (butuh auth) ────────────────────────────────────────
    Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () {
 
        Route::prefix('booking')->name('booking.')->controller(BookingController::class)->group(function () {
            Route::get('/',               'index')        ->name('index');
            Route::get('/{id}',           'show')         ->name('show');
            Route::put('/{id}/status',    'updateStatus') ->name('update-status');
        });
    });
 
});

