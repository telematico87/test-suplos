<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Procesos / Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script src="/bootstrap-datetimepicker.min.js"></script>
    <script src="/vue.global.js"></script>
    <script src="/axios.min.js"></script>
</head>
  <body>

 
    <div class="container" id="proceso" style="margin-top:30px">   
    <div class="row" style="margin-top:20px;margin-bottom:20px">
          <div class="form-group col-md-4" >
                  <button @click="gotoDashboard" class="btn btn-primary align-right">Atras</button>
                    
                  </div>

              <div class="form-group col-md-8" >
              
              </div>


              </div>
      <h3 class="pb-2 pt-6 border-bottom"> Procesos / Eventos participacion cerrada </h3>

    
      <form @submit.prevent="buscarProceso" method="post">
        <div class="row">
          <div class="form-group col-md-4">
            <label for="idproceso"> Id Proceso / Evento</label>
            <input type="text" v-model="id" class="form-control" id="idproceso" placeholder="">
          </div>

          <div class="form-group col-md-4">
          <label for="iddescripcion">Objeto/Descripcion</label>
          <input type="text" v-model="objetodescripcion" class="form-control" id="iddescripcion" placeholder="">
          </div>

          <div class="form-group col-md-4">
            <label for="idcomprado"> Comprador</label>
            <input type="text" v-model="comprador" class="form-control" id="idcomprado" placeholder="">
          </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4">
            <label for="idMoneda">Estado</label>
            <select id="idMoneda" v-model="estado"  class="form-control">
              <option value="0" selected>TODOS</option>
              <option value="1">ACTIVO</option>
              <option value="2">PUBLICADO</option>
              <option value="3">EVALUACION</option>
            </select>
          </div>

          </div>
       
          <div class="row" style="margin-top:30px;margin-bottom:30px">
          <div class="form-group col-md-6" >
          
            
          </div>
         

          <div class="form-group col-md-2" >
            <button type="submit" class="btn btn-primary align-right">Buscar</button>
            
          </div>
            <div class="form-group col-md-4" >
            <button type="submit" @click="imprimirProceso" class="btn btn-success align-right">Generar Excel</button>
              
            </div>

          
          </div>

       
   
       
      </form>
    
      <div class="card-body px-0 pb-0">
						
						<div class="table-responsive">
							<table class="table align-items-center">
								<thead>
									<tr>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7">Id</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Ronda</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Objeto</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Descripcion</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Fecha Inicio</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Fecha Cierre</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Estado</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Responsable de Evento</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Acciones</th>
                  </tr>
								</thead>
								<tbody>
									<tr v-for="(item, index) in rows()">
										<td class="px-4 text-xs font-weight-bold" width="20%">{{ item.id }}</td>
										<td width="15%"><span class="text-xs font-weight-bold">{{  }}</span></td>
										<td width="15%"><span class="text-xs font-weight-bold">{{ item.objeto}}</span></td>
										<td width="15%"><span class="text-xs font-weight-bold">{{ item.descripcion }}</span></td>
										<td><span class="text-xs font-weight-bold">{{ item.fecha_inicio}}</span></td>
                    <td><span class="text-xs font-weight-bold">{{ item.fecha_cierre}}</span></td>
                    <td v-if="item.estado === 1"><span class="text-xs font-weight-bold">Activo</span></td>
                    <td v-if="item.estado === 2"><span class="text-xs font-weight-bold">Publicado</span></td>
                    <td v-if="item.estado === 3"><span class="text-xs font-weight-bold">Evaluar</span></td>

                    <td><span class="text-xs font-weight-bold">{{}}</span></td>
										<td class="text-lg" width="6%">
                      
										<div class="d-grid gap-2 d-md-flex justify-content-md-end">

										
												
												<button type="submit" @click="publicarProceso(item.id)"  class="btn btn-warning align-right">Publicar</button>
                        <button type="submit" @click="evaluarProceso(item.id)"  class="btn btn-info align-right">Evaluar</button>
                        </div>
										</td>
									</tr>
								</tbody>
							</table>
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
        titulo: 'Procesos / Eventos',
        // For Form
        presupuesto: '0.00',
        estado: '0',
        objetodescripcion:'',
        comprador:'',
        id:'',
        descripcion:'',
        actividad:'',
        objeto:'',
        fecha_inicio:'',
        fecha_cierre:'',
        hora_cierre:'',
        hora_inicio:'',
        procesos: <?= $key;?>,
        selected_actividad:0,
        range: 5,
    		page: 1,
        search: '',
      
      }
    },methods: {

      rows() {
        console.log(this.procesos);
					values = (this.procesos).filter(item => {
						let props= Object.values(item);
						return props.some(prop => prop==null ? null : prop.toString().toLowerCase().includes(this.search.toLowerCase()))
					})

					range = this.range
					offset = range * (this.page - 1)
					this.before = Math.ceil(values.length / range)
			
					return values.slice(offset, Number(range) + Number(offset))
   				},
      
      addProducto(username) {
      
      
      const act = this.actividades.find(u => u.producto === username)
      this.selected_actividad=act.id;
    },buscarProceso(){
					axios.post('getListadoFiltro', {
						id: this.id,
						objeto_descripcion: this.objetodescripcion,
						estado: this.estado,
						comprador: this.comprador
					
					}).then(response => {
           

						if(response.data.type == 'success'){
             
                this.procesos=response.data.data

						} else {
						
						}

					})

						
    },imprimirProceso(){
      
      window.location.href = 'imprimirProceso?id='+this.id+'&objeto_descripcion='+this.objetodescripcion+'&estado='+this.estado+'&comprador='+this.comprador; 
						
    },publicarProceso(id){
       

					axios.post('publicarProceso', {
						id: id,
            objeto_descripcion: this.objetodescripcion,
						estado: this.estado,
						comprador: this.comprador
					
					}).then(response => {

						if(response.data.type == 'success'){

              this.procesos=response.data.data;

						} else {
						
						}

					})        
    },evaluarProceso(id){
       

       axios.post('evaluarProceso', {
         id: id,
            objeto_descripcion: this.objetodescripcion,
						estado: this.estado,
						comprador: this.comprador
       
       }).then(response => {

         if(response.data.type == 'success'){

           this.procesos=response.data.data;

         } else {
         
         }

       })        
 }, gotoDashboard() {
            window.location.href = 'dashboard'; 
        },



				guardarProceso() {

     

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
					
					}).then(response => {

						if(response.data.type == 'success'){

              

						} else {
						
						}

					})
				},
                },
			mounted () {
       
			}
  }).mount('#proceso')
</script>
</body>

</html>
