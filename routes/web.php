<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RecoverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

###################### ROTAS PÚBLICAS ##########################
Route::group([], function () {
    /**
     * Root route
     * Rota raiz, carrega o formulário de login do sistema
     */
    Route::get('/', [LoginController::class, 'index'])->name('login.index');

    /**
     * Login page route
     * Realiza o processamento do login dos operadores do sistema
     */
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    ################## ROTAS DE RECUPERAÇÃO DE SENHA###############
    Route::group([], function () {
        /**
         * Recover root route
         * Rota raiz para recuperação, carrega o formulário de recuperação de senha
         */
        Route::get('/recuperar-senha', [RecoverController::class, 'index'])->name('recover.index');

        /**
         * Send mail route
         * Rota responsável por disparar o e-mail de recuperação
         */
        Route::post('/recover', [RecoverController::class, 'process'])->name('recover.process');

        /**
         * Token route
         * Rota responsável por utilizar o token para redirecionar para formulário de alteração de senha
         */
        Route::get('/recover/{token}/{email}', [RecoverController::class, 'reset'])->name('password.reset');

        /**
         * Change password route
         * Rota que carrega o formulário de alteração de senha e faz o processamento da mesma
         */
        Route::post('/change-password', [RecoverController::class, 'update'])->name('change-password');
    });
});


###################### ROTAS PROTEGIDAS ########################
Route::group(['middleware' => 'web'], function () {
    Route::get('/install', [InstallController::class, 'index'])->name('install.index');
    Route::post('/install', [InstallController::class, 'store'])->name('install.store');
});

Route::group(['middleware' => 'auth'], function () {

    /** Logout page route */
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.process');

    /** Dashboard route */
    Route::get('/inicio', [HomeController::class, 'index'])->name('home.index');

    ###################### ROTAS DE OPERADORES ########################
    Route::group(['prefix' => 'operadores', 'as' => 'user.'], function () {

        // Middleware para rotas específicas
        Route::middleware('permission:user-create')->group(function () {
            Route::get('/novo', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
        });

        Route::middleware('permission:user-edit')->group(function () {
            Route::get('/{user}/editar', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
        });

        Route::middleware('permission:user-delete')->group(function () {
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::resource('/', UserController::class)->parameters(['' => 'user']);
        Route::get('/{user}/buscar', [UserController::class, 'search'])->name('search');
    });

    /** Rotas do perfil */
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');

    /** Rotas dos níveis de acesso */
    Route::get('/niveis-acesso/busca', [RoleController::class, 'search'])->name('role.search');
    Route::resource('/niveis-acesso', RoleController::class)->names('role')->parameters([
        'niveis-acesso' => 'role',
    ]);

    /** Rotas das permissões */
    Route::get('/permissoes/{role}', [RolePermissionController::class, 'index'])->name('role-permission.index')->middleware('permission:role-index');
    Route::post('/permissoes/{role}/{permission}', [RolePermissionController::class, 'update'])->name('role-permission.update')->middleware('permission:role-update');
    Route::get('/permissoes/{role}/buscar', [RolePermissionController::class, 'search'])->name('role-permission.search');

    /** Rotas das categorias de cursos */
    Route::group(['prefix' => 'categorias', 'as' => 'category.'], function () {

        Route::get('/', [CategoryController::class, 'index'])
            ->name('index');

        Route::middleware('permission:category-create')->group(function () {
            Route::get('/novo', [CategoryController::class, 'create'])
                ->name('create');

            Route::post('/', [CategoryController::class, 'store'])
                ->name('store');
        });

        Route::middleware('permission:category-edit')->group(function () {
            Route::get('/{category}/editar', [CategoryController::class, 'edit'])
                ->name('edit');

            Route::put('/{category}', [CategoryController::class, 'update'])
                ->name('update');
        });

        Route::middleware('permission:category-destroy')->group(function () {
            Route::delete('/{category}', [CategoryController::class, 'destroy'])
                ->name('destroy');
        });
    });

    /** Rotas das subcategorias de cursos */
    Route::group([
        'prefix' => 'subcategorias',
        'as' => 'subcategory.'
    ], function () {

        Route::get('/', [SubcategoryController::class, 'index'])
            ->name('index');

        Route::middleware('permission:subcategory-create')->group(function () {

            Route::get('/novo', [SubcategoryController::class, 'create'])
                ->name('create');

            Route::post('/', [SubcategoryController::class, 'store'])
                ->name('store');
        });

        Route::middleware('permission:subcategory-edit')->group(function () {

            Route::get('/{subcategory}/editar', [SubcategoryController::class, 'edit'])
                ->name('edit');

            Route::put('/{subcategory}', [SubcategoryController::class, 'update'])
                ->name('update');
        });

        Route::middleware('permission:subcategory-destroy')->group(function () {

            Route::delete('/{subcategory}', [SubcategoryController::class, 'destroy'])
                ->name('destroy');
        });
    });

    /** Rotas dos cursos */
    Route::group([
        'prefix' => 'cursos',
        'as' => 'course.'
    ], function () {

        Route::get('/', [CourseController::class, 'index'])
            ->name('index');

        Route::middleware('permission:course-create')->group(function () {

            Route::get('/novo', [CourseController::class, 'create'])
                ->name('create');

            Route::post('/', [CourseController::class, 'store'])
                ->name('store');
        });

        Route::middleware('permission:course-edit')->group(function () {

            Route::get('/{course}/editar', [CourseController::class, 'edit'])
                ->name('edit');

            Route::put('/{course}', [CourseController::class, 'update'])
                ->name('update');
        });

        Route::middleware('permission:course-destroy')->group(function () {

            Route::delete('/{course}', [CourseController::class, 'destroy'])
                ->name('destroy');
        });

        Route::get('/{course}', [CourseController::class, 'show'])
            ->name('show');
    });

    /** Rotas dos módulos */
    Route::group([
        'prefix' => 'modulos',
        'as' => 'module.'
    ], function () {

        Route::get('/', [ModuleController::class, 'index'])
            ->name('index');

        Route::middleware('permission:module-create')->group(function () {

            Route::get('/novo/{course}', [ModuleController::class, 'create'])
                ->name('create');

            Route::post('/{course}', [ModuleController::class, 'store'])
                ->name('store');
        });

        Route::middleware('permission:module-edit')->group(function () {

            Route::get('/{module}/editar', [ModuleController::class, 'edit'])
                ->name('edit');

            Route::put('/{module}', [ModuleController::class, 'update'])
                ->name('update');
        });

        Route::middleware('permission:module-destroy')->group(function () {

            Route::delete('/{module}', [ModuleController::class, 'destroy'])
                ->name('destroy');
        });
    });

    /** Rotas das aulas (AMD)*/
    /*Route::group([
        'prefix' => 'aulas',
        'as' => 'lesson.'
    ], function () {

        Route::get('/', [LessonController::class, 'index'])
            ->name('index');

        Route::middleware('permission:lesson-create')->group(function () {

            Route::get('/novo', [LessonController::class, 'create'])
                ->name('create');

            Route::post('/', [LessonController::class, 'store'])
                ->name('store');
        });

        Route::middleware('permission:lesson-edit')->group(function () {

            Route::get('/{lesson}/editar', [LessonController::class, 'edit'])
                ->name('edit');

            Route::put('/{lesson}', [LessonController::class, 'update'])
                ->name('update');
        });

        Route::middleware('permission:lesson-destroy')->group(function () {

            Route::delete('/{lesson}', [LessonController::class, 'destroy'])
                ->name('destroy');
        });
    });*/

    /** Rotas das aulas */
    Route::group([
        'prefix' => 'modulos/{module}/aulas',
        'as' => 'lesson.'
    ], function () {

        Route::get('/', [LessonController::class, 'index'])
            ->name('index');

        Route::middleware('permission:lesson-create')->group(function () {

            Route::get('/novo', [LessonController::class, 'create'])
                ->name('create');

            Route::post('/', [LessonController::class, 'store'])
                ->name('store');
        });

        Route::middleware('permission:lesson-edit')->group(function () {

            Route::get('/{lesson}/editar', [LessonController::class, 'edit'])
                ->name('edit');

            Route::put('/{lesson}', [LessonController::class, 'update'])
                ->name('update');
        });

        Route::middleware('permission:lesson-destroy')->group(function () {

            Route::delete('/{lesson}', [LessonController::class, 'destroy'])
                ->name('destroy');
        });
    });
});
