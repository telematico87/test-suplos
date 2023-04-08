<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Procesos demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="/vue.global.js">
       
    </script>
      <script src="/sweetalert.min.js"></script> 
<script src="/axios.min.js"></script>
  
</head>
  <body>

    <div id="main">
  <h1 class="visually-hidden">Procesos / Eventos {{ message }} </h1>

  <div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom"> {{ titulo }} </h2>
    <div class="row">
          <form>
            
          <!-- Email input -->
          <div class="form-group col-md-6">
            <input type="email" v-model="correo" id="form2Example1" class="form-control" />
            <label class="form-label" v-model="correo" for="form2Example1">Correo</label>
          </div>

          <div class="form-group col-md-6">
          </div>
          <!-- Password input -->
          <div class="form-group col-md-6">
            <input type="password" v-model="password" id="form2Example2" class="form-control" />
            <label class="form-label"  for="form2Example2">Password</label>
          </div>

          <div class="form-group col-md-6">
          </div>

          <!-- 2 column grid layout for inline styling -->
          <div class="row mb-4">
            <div class="col d-flex justify-content-center">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                <label class="form-check-label" for="form2Example31">Recordar</label>
              </div>
            </div>

      
          </div>

          <!-- Submit button -->
          <button @click="login" type="button" class="btn btn-primary btn-block mb-4">Acceder</button>

     
        </form>
        </div>
  </div>


  
 
</div>
    <script src="/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
    
  <script>

    var app=Vue.createApp({
        data() {
        return {
            titulo: 'Procesos / Eventos',
            correo:'',
            password:''
        }
        },
        methods: {
            login() {
              axios.post('loginProceso', {
                correo: this.correo,
                password: this.password,
            
              
              }).then(response => {

                if(response.data.type == 'success'){
                  window.location.href = 'dashboard'; 
                  

                } else {
                  swal("Credencial incorrecta", "", "error");
                }

              })
                
                    }
          

                } 
    }).mount('#main')
</script>


</body>

</html>
