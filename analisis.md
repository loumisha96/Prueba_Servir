# Escenario de Analisis

## Diseño propuesto para la funcionalidad

### Suposiciones

1. Cada centro de trabajo cuenta con un lector de huellas
2. La asistencia de los trabajadores se registra diariamente entrada y salida
3. Si visitaran 2 centros de trabajo en un dia la asistencia sería en ambos centros
4. Los encargados pueden llegar a tener varios centros de trabajo a su cargo
5. Tienen un registro de la planificación mensual
### Consultas
1. Qué reportes necesitaría para facilitar el control?
2. Qué información necesita que se incluya en los reportes?
3. Qué proceso realiza hasta el momento?
4. Qué proceso cree que le ayudaría a mejorar el control de asistencias?
5. Maneja estados en caso de ausencias de los empleados(vaciones, suspendido), etc?
6. En que formato necesita los reportes?


### Proceso Propuesto

1. El empleado al presentarse o retirarse del centro de trabajo debe marcar su entrada o salida por medio de huella
2. Pantalla de inicio de sesion donde el encargado pueda ingresar sus credenciales
3. En el sistema una pantalla de reportes de asistencia de todos los empleados, donde pueda filtrar por estados, rango de fecha, empleados y centros de trabajo
4. Reporte donde pueda comparar los centros de trabajo que asistieron con los que estaban en su planificación

### Tablas de almacenamiento

1. Centros_de_trabajo(id, nombre, ubicación, encargado)
2. Estado (id, nombre)
2. Empleados (id, nombre completo, teléfono,  idEstado)
3. Empleados_CentroTrabajo (idEmpleado, idCentroTrabajo)
4. Asistencias(id, fecha, hora, idEmpleado, idCentroTrabajo, idEstado)
5. Planificacion (id, fecha, horaIngreso, horaSalida, idCentroTrabajo, idEmpleado)



