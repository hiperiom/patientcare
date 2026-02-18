<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(CatUserMedicoPacienteSeeder::class);
        $this->call(CatEncuestaTableSeeder::class);
        $this->call(CatUserTypeTableSeeder::class);
        $this->call(CatUserFamilyTableSeeder::class);
        $this->call(CatEstadoTableSeeder::class);
        $this->call(CatMunicipioTableSeeder::class);
        $this->call(CatEspecialidadTableSeeder::class);
        $this->call(CatUserCuestionarioTableSeeder::class);
        $this->call(CatUserEquipoSaludTableSeeder::class);
        $this->call(CatUserHistorialTableSeeder::class);
        $this->call(CatUserUbicacionTableSeeder::class);
        $this->call(CatUserPadTableSeeder::class);
        $this->call(CatUserAntecedenteSeeder::class);
        $this->call(CatUserSintomaTableSeeder::class);
        $this->call(CatUserLaboratorioTableSeeder::class);
        $this->call(CatSystemIncidenciaTypeSeeder::class);
        $this->call(CatUserMedicoPosicionSeeder::class);
        $this->call(CatGrupoCentroSaludSeeder::class);
        $this->call(CatUserCitaStatusTableSeeder::class);

        $this->call(UserTableSeeder::class);
        $this->call(UserProfileTableSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        $this->call(UserEspecialidadTableSeeder::class);
        $this->call(UserEquipoSaludSeeder::class);
        $this->call(UserMedicoPosicionSeeder::class);

        $this->call(UserCuestEpisodeTableSeeder::class);
        $this->call(UserCuestUbicacionTableSeeder::class);
        $this->call(CentroSaludSeeder::class);
        $this->call(UserCentroSaludSeeder::class);
        $this->call(CentroSaludEspecialidadesSeeder::class);
        $this->call(UserMedicoAgendaTableSeeder::class);
        

    }
}
