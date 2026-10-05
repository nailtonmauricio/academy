<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'home-index',
                'description' => 'Carrega a dashboard contendo as informações iniciais do sistema de acordo com o nível de acesso do operador',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'profile-edit',
                'description' => 'Carrega as informações do operador logado, sendo utilizada para atualizações do perfil',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'role-index',
                'description' => 'Lista dos níveis de acesso registradas na base de dados',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'role-update',
                'description' => 'Realiza os bloqueios e liberações das rotas',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-index',
                'description' => 'Lista de operadores cadastrados',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-create',
                'description' => 'Formulário de registro para novos operadores',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-show',
                'description' => 'Apresentação das informações do registro de um operador',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-edit',
                'description' => 'Formulário para edição de informações do operador',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'user-destroy',
                'description' => 'Remover registro de operador',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'category-index',
                'description' => 'Lista de categorias cadastrados',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'category-create',
                'description' => 'Formulário de registro para novas categorias',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'category-show',
                'description' => 'Apresentação das informações do registro de uma categoria',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'category-edit',
                'description' => 'Formulário para edição de informações da categoria',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'category-destroy',
                'description' => 'Remover registro de categoria',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'subcategory-index',
                'description' => 'Lista de subcategorias cadastradas',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'subcategory-create',
                'description' => 'Formulário de registro para novas subcategorias',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'subcategory-show',
                'description' => 'Apresentação das informações do registro de uma subcategoria',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'subcategory-edit',
                'description' => 'Formulário para edição de informações da subcategoria',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'subcategory-destroy',
                'description' => 'Remover registro de subcategoria',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'course-index',
                'description' => 'Lista de cursos cadastrados',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'course-create',
                'description' => 'Formulário de registro para novos cursos',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'course-show',
                'description' => 'Apresentação das informações do registro de um curso',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'course-edit',
                'description' => 'Formulário para edição de informações do curso',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'course-destroy',
                'description' => 'Remover registro de curso',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'module-index',
                'description' => 'Lista de cursos cadastrados',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'module-create',
                'description' => 'Formulário de registro para novos cursos',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'module-show',
                'description' => 'Apresentação das informações do registro de um curso',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'module-edit',
                'description' => 'Formulário para edição de informações do curso',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'module-destroy',
                'description' => 'Remover registro de curso',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'lesson-index',
                'description' => 'Lista de cursos cadastrados',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'lesson-create',
                'description' => 'Formulário de registro para novos cursos',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'lesson-show',
                'description' => 'Apresentação das informações do registro de um curso',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'lesson-edit',
                'description' => 'Formulário para edição de informações do curso',
                'guard_name'=> 'web',
            ],
            [
                'name' => 'lesson-destroy',
                'description' => 'Remover registro de curso',
                'guard_name'=> 'web',
            ],
        ];

        foreach ($permissions as $permission) {
            $existingPermission = Permission::where('name', $permission['name'])->first();

            if (!$existingPermission) {
                Permission::create([
                    'name' => $permission['name'],
                    'description' => $permission['description'],
                    'guard_name' => $permission['guard_name'],
                ]);
            }
        }
    }
}
