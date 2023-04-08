<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Procesos / Eventos</title>
    <script src="/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script src="/bootstrap-datetimepicker.min.js"></script>
    <script src="/vue.global.js"></script>
    <script src="/axios.min.js"></script>
</head>
  <body>

 
    <div class="container" id="proceso">


      <nav style="margin-bottom:50px">
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">información basica</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Cronograma</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Documentacion peticion oferta</button>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active"  id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      
      <div class="row" style="margin-top:20px;margin-bottom:20px">
          <div class="form-group col-md-4" >
                  <button @click="gotoDashboard" class="btn btn-primary align-right">Atras</button>
                    
                  </div>

              <div class="form-group col-md-8" >
              
              </div>


              </div>

      <h5 class="pb-2 pt-6 border-bottom"> Informacion basica </h5>
        
      <form @submit.prevent="guardarProceso" method="post">
        <div class="row">
        <div class="form-group col-md-6">
          <label for="idobjeto"> Objeto (*)</label>
          <input type="text" v-model="objeto" class="form-control" id="idobjeto" placeholder="">
        </div>

        
          <div class="form-group col-md-6">
          <label for="idactividad" class="form-label">Actividad (*)</label>
            <input class="form-control"  v-on:input="addProducto(actividad)" v-model="actividad" list="datalistOptions" id="idactividad" placeholder="busqueda de la actividad">
            <datalist id="datalistOptions" v-model="actividad1">
            <option v-for="data in actividades" :value="data.producto" :key="data.id">{{data.producto}}</option>

            </datalist>

          </div>
        </div>
        <div class="form-group">
          <label for="iddescripcion">Descripcion /Alcance</label>
          <textarea type="text" v-model="descripcion" class="form-control" id="iddescripcion" ></textarea>
        </div>
       
        <div class="row pb-6">
         
          <div class="form-group col-md-4">
            <label for="idMoneda">Moneda (*)</label>
            <select id="idMoneda" v-model="moneda"  class="form-control">
              <option value="COP">COP</option>
              <option value="USD">USD</option>
              <option value="EUR">EUR</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label for="idpresupuesto">Presupuesto (*)</label>
            <input step="0.01" type="number" v-model="presupuesto"  class="form-control" id="idpresupuesto">
          </div>
       
        </div>

   
        <div class="row" style="margin-top:30px;margin-bottom:30px">
          
         
            <div class="form-group col-md-3"  >
                <button type="submit" class="btn btn-primary ">Guardar</button>
            </div>

           
            <div class="form-group col-md-5" >
          
            
          </div>

          
          </div>
      </form>

        

      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

            <h5 class="pb-2 pt-6 border-bottom"> Cronograma </h5>

            <div class="row">
              <div class="form-group col-md-3">
              <label for="startDate">Fecha Inicio(*)</label>
                <input id="startDate" v-model="fecha_inicio"  class="form-control" type="date" />
              </div>

              <div class="form-group col-md-3">
              
              <div class="cs-form">
              <label for="startDate">Hora Inicio(*)</label>
                <input type="time" v-model="hora_inicio"  class="form-control" value="10:05 AM" />
              </div>
              </div>

              <div class="form-group col-md-3">
              <label for="startDate">Fecha Cierre(*)</label>
                <input id="startDate" v-model="fecha_cierre"  class="form-control" type="date" />
              </div>

              <div class="form-group col-md-3">
              
              <div class="cs-form">
              <label for="startDate">Hora Cierre(*)</label>
                <input type="time" v-model="hora_cierre"  class="form-control" value="10:05 AM" />
              </div>
              </div>

          </div>

   
      </div>
      
      
      
      
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
      <div class="card-body px-0 pb-0">
						
      <div id="app" >
                <div>
                  <h2>Agregar Contenido</h2>
                  <input multiple v-model="file" type="file"  class="btn btn-primary " accept="application/pdf"  @change="onFileChange">
                </div>
                <div v-if="images">
                  <div v-for="(image, index) in images">

                  <div class="row" style="margin-top:40px">
              <div class="form-group col-md-2">
              <svg style="width:3em;height:3em;margin: auto;display: block;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-file-pdf-fill" viewBox="0 0 16 16">
                      <path d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>
                      <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.64 11.64 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.707 19.707 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z"/>
                    </svg>
              </div>

              <div class="form-group col-md-7">
              <span style="width: 30%;margin: auto;display: block;margin-bottom: 10px;">{{ image   }}</span>
              
              </div>

              <div class="form-group col-md-3">
              <svg  @click="removeImage(index)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                  </svg>

              </div>

                     
                   
                  
              
                  </div>
                </div>
              </div>    

				
					</div>
      
   </div>
    </div>






  <div class="b-example-divider"></div>

  


  </div>
 

    <script src="/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
    
  <script>


  const { createApp } = Vue

  createApp({
    data() {
      return {
        images: [],
        titulo: 'Procesos / Eventos',
        // For Form
        presupuesto: '0.00',
        moneda: 'COP',
        descripcion:'',
        actividad:'',
        objeto:'',
        fecha_inicio:'',
        fecha_cierre:'',
        hora_cierre:'',
        hora_inicio:'',
        actividades: <?= $key;?>,
        selected_actividad:0,
        file:null,
        documentos: []
      
      }
    },methods: {
      onFileChange(e) {
        
        var files = e.target.files || e.dataTransfer.files;
        console.log();
        if (!files.length) return;
        this.createImage(files);
      },
      createImage(files) {
        var vm = this;
        for (var index = 0; index < files.length; index++) {
          var reader = new FileReader();
          reader.onload = function(event) {
            const imageUrl = event.target.result;
            vm.images.push(files[0].name);
          }
          reader.readAsDataURL(files[index]);
        }
      },
      removeImage(index) {
        this.images.splice(index, 1)
      },
      addProducto(username) {
        
      
      
      const act = this.actividades.find(u => u.producto === username)
      this.selected_actividad=act.id;
    }, gotoDashboard() {
            window.location.href = 'dashboard'; 
        }, resetForm() {
               this.presupuesto='0.00';
                this.moneda='COP';
                 this.descripcion='';
                 this.selected_actividad=0;
                 this.actividad='';
                this.objeto='';
                this.fecha_inicio='';
                 this.fecha_cierre='';
               this.hora_cierre='';
                this.hora_inicio='';
                this.images=[];
                this.file='';
        },

				guardarProceso() {

          if(this.objeto!='' && this.presupuesto!='' && this.actividad!='' && this.fecha_inicio!='' && this.fecha_cierre!='' && this.hora_cierre!='' && this.hora_cierre!='' && this.hora_inicio!=''){
              axios.post('guardarProceso', {
                presupuesto: this.presupuesto,
                moneda: this.moneda,
                descripcion: this.descripcion,
                actividad: this.selected_actividad,
                objeto: this.objeto,
                fecha_inicio: this.fecha_inicio,
                fecha_cierre: this.fecha_cierre,
                hora_cierre: this.hora_cierre,
                hora_inicio: this.hora_inicio,
                documentos:this.images
              
              }).then(response => {

                if(response.data.type == 'success'){
                  swal("Se guardo Correctamente", "", "success");
                  this.resetForm();

                } else {
                
                }

              })
          }else {
                swal("Complete los campos obligatorios (*)", "", "warning");
          }
				},
                },
			mounted () {
       
			}
  }).mount('#proceso')
</script>
</body>

</html>
