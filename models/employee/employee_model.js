var employee = new Vue({
    el: '#formulario',
    data:{
        empleados:[{

            codigoEmpleado:"",
            nombres:"",
            apellidos:"",
            fechaNacimiento:"",
            departamento:""
        }],
        departamentos:[
            {
                idDepartamento:"",
                nombre:""
            }
        ],
        fecha:"",
        empleado:{

            codigoEmpleado:"",
            nombres:"",
            apellidos:"",
            fechaNacimiento:"",
            idDepartamento:""
        },
        succes:false,
        error:false,
        sms:""
        
    },
    methods: {
        administrar(){
            
            administrar_()
        },
        savedEmployee(){
            savedEmployee_()
        },
        search(){
           getEmployeeByID()
        },
        deleteEmployee(){
            deleteEmployee_()
        }
    },
    async created() {
        getDepartamentos()
        getEmployees()
    },
})

var myModal = new bootstrap.Modal(document.getElementById('modal1'),{
    keyboard:false
  })
async function administrar_(){
    
    this.employee.succes=false
    this.employee.error =false
    myModal.toggle()
}

async function getDepartamentos(){
    await fetch('http://localhost/Servir_Examen/controllers/depto/depto_controller.php?action=getDepartments')
    .then(response => response.json())
    .then(data =>{
        this.employee.departamentos= data;
        
    })
    .catch(error=> console.log(error))
}

async function getEmployees(){
    await fetch('http://localhost/Servir_Examen/controllers/employee/employee_controller.php?action=getEmployee')
    .then(response => response.json())
    .then(data =>{
        this.employee.empleados= data;
        console.log(data)
    })
    .catch(error=> console.log(error))
}

async function getEmployeeByID(){
    await fetch('http://localhost/Servir_Examen/controllers/employee/employee_controller.php?action=getEmployeeByID&id='+this.employee.empleado.codigoEmpleado)
    .then(response => response.json())
    .then(data =>{
        var arreglo = data[0].fechaNacimiento.split("-")
        
        this.employee.empleado= data[0];
        this.employee.fecha = arreglo[2]+"/"+arreglo[1]+"/"+arreglo[0]
        const selectElement = document.getElementById('selectDepartment');

        selectElement.value = '1';
        selectElement.selectedIndex = selectElement.selectedIndex;
        document.getElementById('txtCodigo').readOnly=true;
        })
    .catch(error=> console.log(error))
}

function convertDate(){
    if(employee.fecha!=""){

        var arreglo = employee.fecha.split("/")
        this.employee.empleado.fechaNacimiento = arreglo[2]+"-"+arreglo[1]+"-"+arreglo[0]
    }else
        this.employee.empleado.fechaNacimiento=""
}



async function savedEmployee_(){
    if(this.employee.empleado.nombres!="" && this.employee.empleado.apellidos!="" && this.employee.empleado.idDepartamento!=""){
        convertDate()
        var url = 'http://localhost/Servir_Examen/controllers/employee/employee_controller.php?action=update';

        if(this.employee.empleado.codigoEmpleado=="")
            url = 'http://localhost/Servir_Examen/controllers/employee/employee_controller.php?action=insert'
        await fetch(url,{
            method:'POST',
            body: JSON.stringify(this.employee.empleado)
        })
        .then(response => response.json())
        .then(data =>{
            if(data.codigo!="error"){
                this.employee.succes=true
                this.employee.error =false
                this.employee.sms = data.sms
                getEmployees()
            }else{
                this.employee.sms = data.sms
                this.employee.succes=false
                this.employee.error =true
            }
            
            this.employee.empleado.codigoEmpleado=""
            this.employee.empleado.nombres=""
            this.employee.empleado.apellidos=""
            this.employee.fecha=""
            document.getElementById('txtCodigo').readOnly=false;
        })
        .catch( error =>{
            this.employee.sms = error
            this.employee.succes=false
            this.employee.error =true
        })
    
    }else{
        this.employee.sms = "Campos Vacíos!"
        this.employee.succes=false
        this.employee.error =true
    }
    
}

async function deleteEmployee_(){
    if(this.employee.empleado.codigoEmpleado!=""){
        await fetch('http://localhost/Servir_Examen/controllers/employee/employee_controller.php?action=delete',{
            method:'POST',
            body: JSON.stringify(this.employee.empleado)
        })
        .then(response => response.json())
        .then(data =>{
            if(data.codigo!="error"){
                this.employee.succes=true
                this.employee.error =false
                this.employee.sms = data.sms
                
                getEmployees()
            }else{
                this.employee.sms = data.sms
                this.employee.succes=false
                this.employee.error =true
            }
            
            this.employee.empleado.codigoEmpleado=""
            this.employee.empleado.nombres=""
            this.employee.empleado.apellidos=""
            this.employee.fecha=""
            document.getElementById('txtCodigo').readOnly=false;
        })
        .catch( error =>{
            this.employee.sms = error
            this.employee.succes=false
            this.employee.error =true
        })
    }
    

}



