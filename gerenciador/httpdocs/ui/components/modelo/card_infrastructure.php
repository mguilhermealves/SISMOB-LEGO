<!-- Infraestrutura -->
<div class="card mt-5 d-none" id="infrastructure">
   <div class="card-header label_div">
      Infraestrutura
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-sm-12">
            <label>Escolha a forma da sala</label>
         </div>
      </div>
   <div class="row">
   <div class="col-sm-12">
             <label class="custom-checkbox" style="display: block; width:100%;">
                    <input id="check_error_infrastructure" name="post[error][Infrastructure]" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
             </div>
   </div>
   <div class="row" style="padding: 0px;">
      <div class="col-sm-1 div-empty"></div>
      <div class="col-sm-2 card-sala">
         <div class="card">
            <h5 class="card-header card-header-sala card-header-color text-center">Sala em V</h5>
            <div class="card-body card-body-sala">
               <p class="card-text">Disposição de mesas e de cadeiras em ângulo, de frente para o orador para que todos possam tomar notas</p>
               <img src="furniture/img/activies-rooms/1.png"" alt="">
               <br>
               <hr>
               <div class="form-check text-center" style="margin-top: 10%; margin-bottom: 15%">
                  <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio"  name="post[Infrastructure][model]" id="inlineCheckbox2"  <?php print( isset($data['post']['Infrastructure']['model']) ? ($data['post']['Infrastructure']['model'] == 'Sala em V') ? 'checked' : '' : '' ); ?> value="Sala em V">
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-2 card-sala">
         <div class="card">
            <h5 class="card-header card-header-sala card-header-color text-center">Teatro</h5>
            <div class="card-body card-body-sala">
               <p class="card-text">Disposição de mesas e de cadeiras em ângulo, de frente para o orador para que todos possam tomar notas</p>
               <img src="furniture/img/activies-rooms/2.png"" alt="">
               <br>
               <hr>
               <div class="form-check text-center" style="margin-top: 10%; margin-bottom: 15%">
                  <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[Infrastructure][model]" id="inlineCheckbox2"  <?php print( isset($data['post']['Infrastructure']['model']) ? ($data['post']['Infrastructure']['model'] == 'Teatro') ? 'checked' : '' : '' ); ?>  value="Teatro">
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-2 card-sala">
         <div class="card">
            <h5 class="card-header card-header-sala card-header-color text-center">Banqueta</h5>
            <div class="card-body card-body-sala">
               <p class="card-text">Disposição de mesas e de cadeiras em ângulo, de frente para o orador para que todos possam tomar notas</p>
               <img src="furniture/img/activies-rooms/3.png"" alt="">
               <br>
               <hr>
               <div class="form-check text-center" style="margin-top: 10%; margin-bottom: 15%">
                  <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[Infrastructure][model]" id="inlineCheckbox2"  <?php print( isset($data['post']['Infrastructure']['model']) ? ($data['post']['Infrastructure']['model'] == 'Banqueta') ? 'checked' : '' : '' ); ?>  value="Banqueta">
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-2 card-sala">
         <div class="card">
            <h5 class="card-header card-header-sala card-header-color text-center">Sala de aula</h5>
            <div class="card-body card-body-sala">
               <p class="card-text">Disposição de mesas e de cadeiras em ângulo, de frente para o orador para que todos possam tomar notas</p>
               <img src="furniture/img/activies-rooms/4.png"" alt="">
               <br>
               <hr>
               <div class="form-check text-center" style="margin-top: 10%; margin-bottom: 15%">
                  <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[Infrastructure][model]" id="inlineCheckbox2"  <?php print( isset($data['post']['Infrastructure']['model']) ? ($data['post']['Infrastructure']['model'] == 'Sala de Aula') ? 'checked' : '' : '' ); ?>  value="Sala de Aula">
               </div>

            </div>
         </div>
      </div>
      <div class="col-sm-2 card-sala text-center">
         <div class="card">
            <h5 class="card-header card-header-sala card-header-color">Espinha de peixe</h5>
            <div class="card-body card-body-sala">
               <p class="card-text">Disposição de mesas e de cadeiras em ângulo, de frente para o orador para que todos possam tomar notas</p>
               <img src="furniture/img/activies-rooms/5.png"" alt="">
               <br>
               <hr>
               <div class="form-check text-center" style="margin-top: 10%; margin-bottom: 15%">
                  <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[Infrastructure][model]" id="inlineCheckbox2"  <?php print( isset($data['post']['Infrastructure']['model']) ? ($data['post']['Infrastructure']['model'] == 'Espinha de peixe') ? 'checked' : '' : '' ); ?>  value="Espinha de peixe">
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-1 div-empty"></div>
   </div>
   
   <div class="row">
   <div class="col-md-12">
   <hr style="padding: 1%; margin: 1%;">
   </div>
</div>
<div class="row">
<div class="col-sm-2">
      <label>Coffee full time</label>
   </div>
   <div class="col-sm-2">
      <div class="form-group">
         <span style="font-size: 1rem;" class="in-company-switch">Não</span>
         <div class="switch-gender">
            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[Infrastructure][withCoffeeBreak]" <?php print( isset($data['post']['Infrastructure']['withCoffeeBreak']) ? ($data['post']['Infrastructure']['withCoffeeBreak'] == 'Não') ? 'checked' : '' : 'checked' ); ?> value="Não" id="male" checked>
            <label for="male" class="switch-label switch-label-off">&nbsp;</label>
            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[Infrastructure][withCoffeeBreak]"  <?php print( isset($data['post']['Infrastructure']['withCoffeeBreak']) ? ($data['post']['Infrastructure']['withCoffeeBreak'] == 'Sim') ? 'checked' : '' : '' ); ?> value="Sim" id="female">
            <label for="female" class="switch-label switch-label-on">&nbsp;</label>
            <span class="switch-selection"></span>
         </div>
         <span style="font-size: 1rem;" class="open-public-switch">Sim</span>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group form-inline">    
         <label>Início&nbsp;</label>    
         <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[Infrastructure][coffeeStart]" value="<?php print( isset( $data["post"]["Infrastructure"]["coffeeStart"] ) ? $data["post"]["Infrastructure"]["coffeeStart"] : "" ) ?>" id="" placeholder="">
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group form-inline">    
            <label>Término&nbsp;</label>    
            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[Infrastructure][coffeeEnd]" value="<?php print( isset( $data["post"]["Infrastructure"]["coffeeEnd"] ) ? $data["post"]["Infrastructure"]["coffeeEnd"] : "" ) ?>" id="" placeholder="">
         </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
   <hr style="padding: 1%; margin: 1%;">
   </div>
</div>


<?php if(!isset($data['edit']) || !$data['edit']){ ?>
   <div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12 mt-5 text-center">
            <button type="button" onClick="display_labels(<?php print($show_infrastructure); ?>)" class="btn btn-outline-primary btn-primary btn-sm">Salvar e continuar</button>
        </div>
    </div>
</div>
<?php } ?>
</div>
</div>


<?php if($data['edit']){ ?>
<div class="row row-no-padding d-none" id="infrastructure_correct">
   <div class="col-md-1"></div>
   <div class="col-md-10">
      <div class="card mt-5">
         <div class="card-header label_div">
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-sm-12">
                  <label>Informações estão corretas?</label>
                  <br>
                  <div class="middle">
                     <span style="font-size: 1rem;" class="recurring-course-switch">Não</span>
                     <div class="switch-gender">
                        <input type="radio" class="switch-input" name="post[Infrastructure][correct]" value="Não" id="infrastructure_correct_no">
                        <label for="infrastructure_correct_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" class="switch-input" name="post[Infrastructure][correct]" value="Sim" id="infrastructure_correct_yes">
                        <label for="infrastructure_correct_yes" class="switch-label switch-label-on">&nbsp;</label>
                        <span class="switch-selection"></span>
                     </div>
                     <span style="font-size: 1rem;" class="single-course-switch">Sim</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-1"></div>
</div>
<?php } ?>


<div id="message_error_infrastructure"></div>
