<?php

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

Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contato', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/contato', [\App\Http\Controllers\HomeController::class, 'send_contact'])->name('contact');
Route::get('/admin', [\App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

Route::get('/redirect', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('redirect');
Route::get('/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('callback');

Route::get('/conta/dados-pessoais', [\App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::post('/conta/dados-pessoais', [\App\Http\Controllers\UsersController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/conta/alterar-senha', [\App\Http\Controllers\UsersController::class, 'edit_password'])->name('users.edit_password')->middleware('auth');
Route::post('/conta/alterar-senha', [\App\Http\Controllers\UsersController::class, 'update_password'])->name('users.update_password')->middleware('auth');

Route::get('/states/cities/{state}', [\App\Http\Controllers\StatesController::class, 'cities'])->name('states.cities');

Route::resource('paginas', \App\Http\Controllers\PagesController::class, [
    'names' => [
        'show' => 'pages.show'
    ]
])->only([
    'index', 'show'
]);

Route::resource('/pets', \App\Http\Controllers\PetsController::class)->middleware('auth');
Route::post('/pets/update_status/{pet}', [\App\Http\Controllers\PetsController::class, 'update_status'])->name('pets.update_status');

Route::resource('/pets.imagens', \App\Http\Controllers\PetImagesController::class, [
    'names' => [
        'index' => 'pets.pet_images.index',
        'create' => 'pets.pet_images.create',
        'store' => 'pets.pet_images.store',
        'edit' => 'pets.pet_images.edit',
        'update' => 'pets.pet_images.update',
        'destroy' => 'pets.pet_images.destroy'
    ]
])->except([
    'show'
]);
Route::post('/pet_images/update_featured/{pet_image}', [\App\Http\Controllers\PetImagesController::class, 'update_featured'])->name('pet_images.update_featured');

Route::resource('/pets.pet_comments', \App\Http\Controllers\PetCommentsController::class)->only([
    'index', 'store'
]);

Route::resource('/depoimentos', \App\Http\Controllers\TestimonialsController::class, [
    'names' => [
        'index' => 'testimonials.index',
        'create' => 'testimonials.create',
        'store' => 'testimonials.store',
        'edit' => 'testimonials.edit',
        'update' => 'testimonials.update',
        'destroy' => 'testimonials.destroy'
    ]
])->except([
    'show'
]);

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function() {
    Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::get('/overview', [\App\Http\Controllers\Admin\HomeController::class, 'overview'])->name('overview');
    Route::get('/reports/visits', [\App\Http\Controllers\Admin\HomeController::class, 'visits'])->name('reports.visits');
    Route::get('/reports/users', [\App\Http\Controllers\Admin\HomeController::class, 'users'])->name('reports.users');
    Route::get('/reports/pets', [\App\Http\Controllers\Admin\HomeController::class, 'pets'])->name('reports.pets');
    Route::get('/reports/testimonials', [\App\Http\Controllers\Admin\HomeController::class, 'testimonials'])->name('reports.testimonials');
    Route::get('/reports/pdf', [\App\Http\Controllers\Admin\HomeController::class, 'pdf'])->name('reports.pdf');
    
    Route::post('/summernote/upload', [\App\Http\Controllers\Admin\HomeController::class, 'summernote_upload'])->name('summernote_upload');
    Route::resource('/info', \App\Http\Controllers\Admin\InfoController::class)->only([
        'edit', 'update'
    ]);
    Route::resource('/pages', \App\Http\Controllers\Admin\PagesController::class);
    Route::post('/pages/update_status/{page}', [\App\Http\Controllers\Admin\PagesController::class, 'update_status'])->name('pages.update_status');
    Route::resource('/pet_categories', \App\Http\Controllers\Admin\PetCategoriesController::class);
    Route::resource('/pets', \App\Http\Controllers\Admin\PetCategoriesController::class)->only([
        'index', 'show'
    ]);
    Route::resource('/testimonials', \App\Http\Controllers\Admin\TestimonialsController::class)->only([
        'index', 'show', 'destroy'
    ]);
    Route::post('/testimonials/update_status/{testimonial}', [\App\Http\Controllers\Admin\TestimonialsController::class, 'update_status'])->name('testimonials.update_status');
    Route::resource('/roles', \App\Http\Controllers\Admin\RolesController::class);
    Route::resource('/users', \App\Http\Controllers\Admin\UsersController::class);
    Route::get('/users/pdf/{user}', [\App\Http\Controllers\Admin\UsersController::class, 'pdf'])->name('users.pdf');
});
