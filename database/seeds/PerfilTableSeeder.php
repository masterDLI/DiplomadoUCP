<?php

use App\Aplicacion;
use App\Aplicacion_perfil;
use App\Perfil;
use App\User;
use Illuminate\Database\Seeder;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$perfil = new Perfil;
		$perfil->perfil = 'Admin';
		$perfil->save();

		$user=new User;
		$user->name = 'Roque';
		$user->email = 'grr@mail.com';
		$user->perfil_id = $perfil->id;
		$user->password = bcrypt('444444');
		$user->save();

		$aplicaciones = ['Usuarios', 'Perfiles', 'Aplicaciones', 'Encuestas', 'Formatos Respuestas', 'Cuestionarios'];

		foreach ($aplicaciones as $aplicacion) {

				$apl = new Aplicacion;
				$apl->aplicacion = $aplicacion;
				$url=strtolower($aplicacion);
				$url=str_replace(' ', '_', $url);
				$apl->url ='/'.$url;
				$apl->save();

				$aplicacion_perfil = new Aplicacion_perfil;
				$aplicacion_perfil->perfil_id=$perfil->id;
				$aplicacion_perfil->aplicacion_id = $apl->id;
				$aplicacion_perfil->save();
		}

    }
}
