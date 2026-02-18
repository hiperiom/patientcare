const mix = require('laravel-mix');
const packageJson = require('./package.json');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
// Habilitar nombres de chunks personalizados



mix.js('public/class_js/app_gestion_medicos.js', 'public/js')
mix.js('public/class_js/app_seguimiento_paciente.js', 'public/js')
mix.js('public/class_js/app_resumen_clinico.js', 'public/js')
mix.js('public/class_js/app_registro_paciente_interno.js', 'public/js')

mix.js('resources/js/components/PlanificacionGuardias/app_planificacion_guardias.js', 'public/js')
mix.js('resources/js/components/Reportes/IngresosCmdlt/app_ingresos_cmdlt.js', 'public/js')
mix.js('resources/js/components/Reportes/EgresosCmdlt/app_egresos_cmdlt.js', 'public/js')
mix.js('resources/js/components/Reportes/EE/PadelFest2024/app_evento_especial_3.js', 'public/js')
mix.js('resources/js/components/Reportes/EE/PadelFest/app_evento_especial_1.js', 'public/js')
mix.js('resources/js/components/Reportes/EE/FabricePastorCup/app_evento_especial_2.js', 'public/js')
mix.js('resources/js/components/AreaQuirurgica/TableroAreaQx/app_tablero_area_quirurgica.js', 'public/js')
mix.js('resources/js/components/AreaQuirurgica/GestionDeQxAmb/app_area_quirurgica2.js', 'public/js')
mix.js('resources/js/components/AreaQuirurgica/GestionDeQx/app_area_quirurgica.js', 'public/js')
mix.js('resources/js/components/AreaQuirurgica/GestionDeQxEnfermeria/app_area_quirurgica_enfermeria.js', 'public/js')
mix.js('resources/js/components/AreaQuirurgica/VistaPlanQxTelevisorMAPM/app_area_quirurgica_externa2.js', 'public/js')
mix.js('resources/js/components/AreaQuirurgica/VistaPlanQxTelevisor/app_area_quirurgica_externa.js', 'public/js')
mix.js('resources/js/components/AreaHospitalizacion/VistaPantallaPisos/app_pantalla_pisos.js', 'public/js')
mix.js('resources/js/components/AreaUti/VistaPantallaUti/app_pantalla_uti.js', 'public/js')
mix.js('resources/js/components/Medico/app_medico.js', 'public/js')
mix.js('resources/js/components/Administrador/app_admin.js', 'public/js')
mix.js('resources/js/components/ConsultaExterna/app_consultaexterna.js', 'public/js')
mix.js('resources/js/components/Auth/app_auth.js', 'public/js')
mix.js('resources/js/app.js', 'public/js');
mix.setPublicPath('public')
mix.sass('resources/sass/app.scss', 'public/css')
   mix.webpackConfig({
    output: {
        //filename: '[name].js?[chunkhash]',
        chunkFilename: `js/chunks/[name].[chunkhash].${packageJson.version}.js`,
    },
    optimization: {
        splitChunks: {
            //chunks: 'all',
            cacheGroups: {
                /* vendors: {
                    test: /[\\/]node_modules[\\/]/,
                    name: 'vendor',
                    chunks: 'all',
                }, */
                default: {
                    minChunks: 2,
                    priority: -20,
                    reuseExistingChunk: true,
                },
            },
        },
    },
})
.version();
