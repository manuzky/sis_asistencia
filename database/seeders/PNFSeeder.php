<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use App\Models\PNF;
// use App\Models\Materia;

// class PNFSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         // Ejemplo de datos para los PNFs y sus materias
//         $pnfs = [
//             [
//                 'nombre' => 'INICIAL',
//                 'materias' => [
//                     'Idiomas I',
//                     'Yo no sé que vaina bolivariana',
//                     'Arte y patrimonio',
//                     'Algo del socialismo',
//                     'Algo de la patria',
//                     'Algo de la revolución',
//                     'Algo de la independencia',
//                 ],
//             ],
//             [
//                 'nombre' => 'Administración',
//                 'materias' => [
//                     'Fundamentos de Administración',
//                     'Matemática para Administradores',
//                     'Comportamiento Organizacional',
//                     'Gestión de Recursos Humanos',
//                     'Estadística para Negocios',
//                     'Contabilidad Administrativa',
//                     'Planeación Estratégica',
//                     'Mercadotecnia',
//                     'Análisis Financiero',
//                     'Gestión de Operaciones',
//                     'Responsabilidad Social Empresarial',
//                     'Emprendimiento',
//                     'Gestión de Proyectos',
//                     'Comercio Internacional',
//                     'Auditoría Administrativa',
//                 ],
//             ],
//             [
//                 'nombre' => 'Contaduría Pública',
//                 'materias' => [
//                     'Contabilidad General',
//                     'Matemática Financiera',
//                     'Principios de Economía',
//                     'Legislación Tributaria',
//                     'Auditoría I',
//                     'Sistemas Contables',
//                     'Contabilidad de Costos',
//                     'Estadística Aplicada',
//                     'Finanzas Corporativas',
//                     'Ética Profesional',
//                     'Normas Internacionales de Información Financiera (NIIF)',
//                     'Control Interno',
//                     'Contabilidad Avanzada',
//                     'Auditoría II',
//                     'Práctica Profesional',
//                 ],
//             ],
//             [
//                 'nombre' => 'Informática',
//                 'materias' => [
//                     'Matematicas I',
//                     'Proyecto',
//                     'Actividades Acreditables',
//                     'Arquitectura del Computador',
//                     'Formación Crítica I',
//                     'Algoritmos y Programación I',
//                     'Idiomas I',
//                     'Electiva I',
//                     'Formación Critica II',
//                     'Actividades Acreditables II',
//                     'Proyecto II',
//                     'Redes de computadoras',
//                     'Matemática II',
//                     'Programación II',
//                     'Base de Datos',
//                     'Ingeniería de Software',
//                     'Electiva II',
//                     'Ingeniería de Software II',
//                     'Matemática Aplicada',
//                     'Proyecto III',
//                     'Actividades Acreditables III',
//                     'Modelado de Base de Datos',
//                     'Sistemas Operativos',
//                     'Investigación de Operaciones',
//                     'Electiva III',
//                     'Proyecto IV',
//                 ],
//             ],
//             [
//                 'nombre' => 'Educación Inicial',
//                 'materias' => [
//                     'Psicología Evolutiva Infantil',
//                     'Didáctica en Educación Inicial',
//                     'Juego y Aprendizaje',
//                     'Expresión Plástica y Creativa',
//                     'Literatura Infantil',
//                     'Desarrollo Socioemocional en Niños',
//                     'Planificación de la Enseñanza',
//                     'Evaluación del Aprendizaje Infantil',
//                     'Tecnología Educativa',
//                     'Atención a la Diversidad',
//                     'Formación Ética y Ciudadana',
//                     'Legislación Educativa',
//                     'Práctica Docente I',
//                     'Práctica Docente II',
//                     'Seminario de Investigación Educativa',
//                 ],
//             ],
//             [
//                 'nombre' => 'Turismo',
//                 'materias' => [
//                     'Introducción al Turismo',
//                     'Geografía Turística',
//                     'Gestión Hotelera',
//                     'Patrimonio Cultural',
//                     'Mercadotecnia Turística',
//                     'Agencias de Viajes y Operadores',
//                     'Planificación Turística',
//                     'Gestión de Eventos',
//                     'Turismo Sostenible',
//                     'Gestión de Recursos Naturales',
//                     'Estadística para Turismo',
//                     'Legislación Turística',
//                     'Diseño de Productos Turísticos',
//                     'Práctica Profesional I',
//                     'Práctica Profesional II',
//                 ],
//             ],
//             [
//                 'nombre' => 'Industrial',
//                 'materias' => [
//                     'Introducción a la Ingeniería Industrial',
//                     'Estadística Aplicada',
//                     'Procesos de Manufactura',
//                     'Investigación de Operaciones',
//                     'Diseño de Plantas Industriales',
//                     'Ergonomía',
//                     'Gestión de la Calidad',
//                     'Producción Industrial',
//                     'Automatización de Procesos',
//                     'Gestión de Mantenimiento',
//                     'Seguridad Industrial',
//                     'Logística y Distribución',
//                     'Sistemas de Información para la Industria',
//                     'Análisis de Costos Industriales',
//                     'Práctica Profesional',
//                 ],
//             ],
//         ];

//         foreach ($pnfs as $pnfData) {
//             // Crear el PNF
//             $pnf = PNF::create(['nombre' => $pnfData['nombre']]);

//             // Crear las materias asociadas al PNF
//             foreach ($pnfData['materias'] as $materiaNombre) {
//                 Materia::create([
//                     'nombre' => $materiaNombre,
//                     'pnf_id' => $pnf->id,
//                 ]);
//             }
//         }
//     }
// }
