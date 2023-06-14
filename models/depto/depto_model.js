var department = new Vue({
    el:'#formulario',
    data:{
        departamentos:[{
            idDepartamento:"",
            codigoDepto:"",
            nombre:"",
            descripcion:""
        }],
        departamento:{
            codigoDepto:"",
            nombre:"",
            descripcion:""
        },
        succes:false,
        error:false,
        sms:""
    },
    methods: {
        administrar(){
            administrar_()
        },
        savedDepartment(){
            savedDepartment_()
        },
        search(){
            getDepartmentByID()
         },
         deleteDepartment(){
            deleteDepartment_()
         },
         cancelar(){
            cancelar_()
         }
    },
    async created() {
        getDepartamentos()
    },
})
var myModal = new bootstrap.Modal(document.getElementById('modal1'),{
    keyboard:false
  })
async function administrar_(){
    
    this.department.succes=false
    this.department.error =false
    myModal.toggle()
}
function cancelar_(){
    this.department.departamento.codigoDepto=""
    this.department.departamento.nombre=""
    this.department.departamento.descripcion=""
    
    document.getElementById('txtCodigo').readOnly=false;
}
async function getDepartmentByID(){
    await fetch('http://localhost/Servir_Examen/controllers/depto/depto_controller.php?action=getDepartmentByID&id='+this.department.departamento.codigoDepto)
    .then(response => response.json())
    .then(data =>{
        this.department.departamento = data[0];
        document.getElementById('txtCodigo').readOnly=true;
        })
    .catch(error=> console.log(error))
}

async function getDepartamentos(){
    await fetch('http://localhost/Servir_Examen/controllers/depto/depto_controller.php?action=getDepartments')
    .then(response => response.json())
    .then(data =>{
        this.department.departamentos= data;

    })
    .catch(error=> console.log(error))
}

async function savedDepartment_(){
    console.log(JSON.stringify(this.department.departamento))
    if(this.department.departamento.nombre!=""){
        var url = 'http://localhost/Servir_Examen/controllers/depto/depto_controller.php?action=update';
        if(this.department.departamento.codigoDepto=="")
            url = 'http://localhost/Servir_Examen/controllers/depto/depto_controller.php?action=insert'
    
            await fetch(url,{
                method:'POST',
                body: JSON.stringify(this.department.departamento)
            })
            .then(response => response.json())
            .then(data =>{
                if(data.codigo!="error"){
                    this.department.succes=true
                    this.department.error =false
                    this.department.sms = data.sms
                    getDepartamentos()
                }else{
                    this.department.sms = data.sms
                    this.department.succes=false
                    this.department.error =true
                }
                
                this.department.departamento.codigoDepto=""
                this.department.departamento.nombre=""
                this.department.departamento.descripcion=""
                
                document.getElementById('txtCodigo').readOnly=false;
            })
            .catch( error =>{
                this.department.sms = error
                this.department.succes=false
                this.department.error =true
            })
        
    }else{
        this.department.sms = "Campos vacios!"
        this.department.succes=false
        this.department.error =true
    }
}


async function deleteDepartment_(){
    if(this.department.departamento.codigoDepto!=""){
        await fetch('http://localhost/Servir_Examen/controllers/depto/depto_controller.php?action=delete',{
            method:'POST',
            body: JSON.stringify(this.department.departamento)
        })
        .then(response => response.json())
        .then(data =>{
            if(data.codigo!="error"){
                this.department.succes=true
                this.department.error =false
                this.department.sms = data.sms
                
                getDepartamentos()
            }else{
                this.department.sms = data.sms
                this.department.succes=false
                this.department.error =true
            }
            
            this.department.departamento.codigoDepto=""
            this.department.departamento.nombre=""
            this.department.departamento.descripcion=""
            
            document.getElementById('txtCodigo').readOnly=false;
        })
        .catch( error =>{
            this.department.sms = error
            this.department.succes=false
            this.department.error =true
        })
    }
    

}