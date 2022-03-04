<!-- Informações da Atividade -->
<div class="card mt-5 d-none" id="times_and_moviments">
   <div class="card-header label_div">
      Tempos e Movimentos
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-sm-12">
            <label>Refeições?</label>
         </div>
      </div>
      <div class="row">
      <div class="col-sm-12">
             <label class="custom-checkbox" style="display: block; width:100%;">
                    <input id="post[error][TimesMovements]" name="post[error][TimesMovements]" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
             </div>
      </div>
      <div class="row">
         <div class="col-sm-6">
            <div class="row">
               <div class="col-sm-12">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-check form-check-inline">
                           <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[TimesMovements][welcome]" id="inlineCheckbox1" value="Basico">
                           <label class="form-check-label" for="inlineCheckbox1" style="margin-top: 5%;">Almoço</label>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group form-inline">
                              <label>Início</label>
                              <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[TimesMovements][welcomeStart]" value="<?php print( isset( $data["post"]["TimesMovements"]["welcomeStart"] ) ? $data["post"]["TimesMovements"]["welcomeStart"] : "" ) ?>" id="" placeholder="">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group form-inline">
                              <label>Término</label>
                              <input  <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[TimesMovements][welcomeEnd]" value="<?php print( isset( $data["post"]["TimesMovements"]["welcomeEnd"] ) ? $data["post"]["TimesMovements"]["welcomeEnd"] : "" ) ?>" id="" placeholder="">
                        </div>
                     </div>
                  </div>     
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-check form-check-inline">
                           <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[TimesMovements][breakfast]" id="inlineCheckbox1" value="Basico">
                           <label class="form-check-label" for="inlineCheckbox1">Jantar</label>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group form-inline">
                              <label>Início</label>
                              <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[TimesMovements][breakfastStart]" value="<?php print( isset( $data["post"]["TimesMovements"]["breakfastStart"] ) ? $data["post"]["TimesMovements"]["breakfastStart"] : "" ) ?>" id="" placeholder="">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group form-inline">
                              <label>Término</label>
                              <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[TimesMovements][breakfastEnd]" value="<?php print( isset( $data["post"]["TimesMovements"]["breakfastEnd"] ) ? $data["post"]["TimesMovements"]["breakfastEnd"] : "" ) ?>" id="" placeholder="">
                        </div>
                     </div>
                  </div>  
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-check form-check-inline">
                           <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[TimesMovements][snack]" id="inlineCheckbox1" value="Basico">
                           <label class="form-check-label" for="inlineCheckbox1">Happy</label>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group form-inline">
                              <label>Início</label>
                              <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[TimesMovements][snackStart]" value="<?php print( isset( $data["post"]["TimesMovements"]["snackStart"] ) ? $data["post"]["TimesMovements"]["snackStart"] : "" ) ?>" id="" placeholder="">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group form-inline">
                              <label>Término</label>
                              <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[TimesMovements][snackEnd]" value="<?php print( isset( $data["post"]["TimesMovements"]["snackEnd"] ) ? $data["post"]["TimesMovements"]["snackEnd"] : "" ) ?>" id="" placeholder="">
                        </div>
                     </div>
                  </div>      
               </div>
            </div>
         </div>
</div>
<div class="row">
   <div class="col-sm-12">
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
            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[TimesMovements][withCoffeeBreak]" value="Nao" id="male" checked>
            <label for="male" class="switch-label switch-label-off">&nbsp;</label>
            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[TimesMovements][withCoffeeBreak]" value="Sim" id="female">
            <label for="female" class="switch-label switch-label-on">&nbsp;</label>
            <span class="switch-selection"></span>
         </div>
         <span style="font-size: 1rem;" class="open-public-switch">Sim</span>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="form-group form-inline">    
         <label>Início&nbsp;</label>    
         <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[TimesMovements][coffeeStart]" id="" value="<?php print( isset( $data["post"]["TimesMovements"]["coffeeStart"] ) ? $data["post"]["TimesMovements"]["coffeeStart"] : "" ) ?>" placeholder="">
      </div>
   </div>
   <div class="col-sm-3">
   <div class="form-group form-inline">    
         <label>Término&nbsp;</label>    
         <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="time" class="form-control" name="post[TimesMovements][coffeeEnd]" value="<?php print( isset( $data["post"]["TimesMovements"]["coffeeEnd"] ) ? $data["post"]["TimesMovements"]["coffeeEnd"] : "" ) ?>" id="" placeholder="">
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <hr style="padding: 0; margin: 0;">
   </div>
</div>

<?php if(!isset($data['edit']) || !$data['edit']){ ?>
<div class="row">
   <div class="col-sm-12">
      <div class="col-sm-12 mt-5 text-center">
         <button type="button" onClick="display_labels(<?php print($show_times_and_moviments); ?>)" class="btn btn-outline-primary btn-primary btn-sm">Salvar e continuar</button>
      </div>
   </div>
</div>
<?php } ?>
</div>
</div>

<?php if($data['edit']){ ?>
<div class="row row-no-padding d-none" id="times_and_moviments_correct">
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
                        <input type="radio" class="switch-input" name="post[TimesMovements][correct]" value="Não" id="times_and_movements_correct_no">
                        <label for="times_and_movements_correct_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" class="switch-input" name="post[TimesMovements][correct]" value="Sim" id="times_and_movements_correct_yes">
                        <label for="times_and_movements_correct_yes" class="switch-label switch-label-on">&nbsp;</label>
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
