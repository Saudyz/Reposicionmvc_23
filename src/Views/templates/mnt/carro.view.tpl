<h1>{{modedsc}}</h1>
<section class="row">
  <form action="index.php?page=Mnt_Carro&mode={{mode}}&id={{id}}"
    method="POST"
    class="col-6 col-3-offset"
  >
    <section class="row">
    <label for="id" class="col-4">Código</label>
    <input type="hidden" id="id" name="id" value="{{id}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
    <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
    <input type="text" readonly name="iddummy" value="{{id}}"/>
    </section>

    <section class="row">
      <label for="bin" class="col-4">Bin</label>
      <input type="text" {{readonly}} name="bin" value="{{bin}}" maxlength="45" placeholder="Placa"/>
      {{if bin_error}}
        <span class="error col-12">{{bin_error}}</span>
      {{endif bin_error}}
    </section>

    <section class="row">
      <label for="placaCarro" class="col-4">Placa</label>
      <input type="text" {{readonly}} name="placaCarro" value="{{placaCarro}}" maxlength="45" placeholder="Placa"/>
      {{if placaCarro_error}}
        <span class="error col-12">{{placaCarro_error}}</span>
      {{endif placaCarro_error}}
    </section>

    <section class="row">
      <label for="modeloCarro" class="col-4">Placa</label>
      <input type="text" {{readonly}} name="modeloCarro" value="{{modeloCarro}}" maxlength="45" placeholder="Placa"/>
      {{if modeloCarro_error}}
        <span class="error col-12">{{modeloCarro_error}}</span>
      {{endif modeloCarro_error}}
    </section>

    <section class="row">
      <label for="anoCarro" class="col-4">A;o Del Carro</label>
      <input type="text" {{readonly}} name="anoCarro" value="{{anoCarro}}" maxlength="45" placeholder="Placa"/>
      {{if anoCarro_error}}
        <span class="error col-12">{{anoCarro_error}}</span>
      {{endif anoCarro_error}}
    </section>

    
    {{if has_errors}}
        <section>
          <ul>
            {{foreach general_errors}}
                <li>{{this}}</li>
            {{endfor general_errors}}
          </ul>
        </section>
    {{endif has_errors}}
    <section>
      {{if show_action}}
      <button type="submit" name="btnGuardar" value="G">Guardar</button>
      {{endif show_action}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=Mnt_Carros");
      });
  });
</script>