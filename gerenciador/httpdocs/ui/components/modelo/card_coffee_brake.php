<!-- Informações da Atividade -->
<div class="card mt-5 d-none" id="coffee_brake">
   <div class="card-header label_div">
      Coffee Brake
   </div>
   <div class="card-body">
      <div class="row">
      <div class="col-sm-12">
             <label class="custom-checkbox" style="display: block; width:100%;">
                    <input id="check_error_course_coffee_brake" name="post[error][CoffeeBreak]" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
             </div>
         <div class="col-sm-12">
            <label>Com Coffee Brake?</label>
            <div class="form-group">
               <span style="font-size: 1rem;" class="in-company-switch">Não</span>
               <div class="switch-gender">
                  <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[CoffeeBreak][withCoffeeBreak]" value="Sem coffe brake" <?php print( isset($data['post']['CoffeeBreak']['withCoffeeBreak']) ? ($data['post']['CoffeeBreak']['withCoffeeBreak'] == 'Sem coffe brake') ? 'checked' : '' : 'checked' ); ?>  id="without_coffe_brake" >
                  <label for="without_coffe_brake" class="switch-label switch-label-off">&nbsp;</label>
                  <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[CoffeeBreak][withCoffeeBreak]" value="Com coffee brake"  <?php print( isset($data['post']['CoffeeBreak']['withCoffeeBreak']) ? ($data['post']['CoffeeBreak']['withCoffeeBreak'] == 'Com coffe brake') ? 'checked' : '' : '' ); ?>  id="with_coffe_brake">
                  <label for="with_coffe_brake" class="switch-label switch-label-on">&nbsp;</label>
                  <span class="switch-selection"></span>
               </div>
               <span style="font-size: 1rem;" class="open-public-switch">Sim</span>
            </div>
         </div>
         <div class="col-sm-12">
            <hr>
         </div>
         <div class="col-sm-12">
            <label>Selecione o tipo do Coffee Brake</label>
            <br>
            <div class="form-check form-check-inline">
               <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[CoffeeBreak][target][type]" id="coffee_brake_type" value="Basico" <?php print( isset($data['post']['CoffeeBreak']['target']['type']) ? ($data['post']['CoffeeBreak']['target']['type'] == 'Basico') ? 'checked' : '' : '' ); ?>>
               <label class="form-check-label" for="inlineCheckbox1">Coffee Brake Básico</label>
            </div>
            <br>
            <div class="form-check form-check-inline">
               <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?> class="form-check-input" type="radio" name="post[CoffeeBreak][target][type]" id="coffee_brake_type" value="Standard" <?php print( isset($data['post']['CoffeeBreak']['target']['type']) ? ($data['post']['CoffeeBreak']['target']['type'] == 'Standard') ? 'checked' : '' : '' ); ?>>
               <label class="form-check-label" for="inlineCheckbox2">Coffee Brake Standard</label>
            </div>
            <br>
            <div class="form-check form-check-inline">
               <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[CoffeeBreak][target][type]" id="coffee_brake_type" value="Premium" <?php print( isset($data['post']['CoffeeBreak']['target']['type']) ? ($data['post']['CoffeeBreak']['target']['type'] == 'Premium') ? 'checked' : '' : '' ); ?>>
               <label class="form-check-label" for="inlineCheckbox3">Coffee Brake Premium</label>
            </div>
            <br>
            <div class="form-check form-check-inline">
               <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[CoffeeBreak][target][type]" id="coffee_brake_type" value="Super Premium" <?php print( isset($data['post']['CoffeeBreak']['target']['type']) ? ($data['post']['CoffeeBreak']['target']['type'] == 'Super Premium') ? 'checked' : '' : '' ); ?>>
               <label class="form-check-label" for="inlineCheckbox4">Coffee Brake Super Premium</label>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <hr>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4">
            <label>Algum participante com restrição alimentar?</label>
         </div>
         <div class="col-sm-8">


         <div class="form-group">
                  <span style="font-size: 1rem;" class="in-company-switch">Não</span>
                  <div class="switch-gender">
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?> type="radio" class="switch-input" name="post[CoffeeBreak][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['alimentarRestriction'] == 'Sem restrição alimentar') ? 'checked' : '' : 'checked' ); ?> value="Sem restrição alimentar" id="without_alimentar_restriction">
                     <label for="without_alimentar_restriction" class="switch-label switch-label-off">&nbsp;</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>   type="radio" class="switch-input" name="post[CoffeeBreak][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['alimentarRestriction'] == 'Com restrição alimentar') ? 'checked' : '' : '' ); ?> value="Com restrição alimentar" id="with_alimentar_restriction">
                     <label for="with_alimentar_restriction" class="switch-label switch-label-on">&nbsp;</label>
                     <span class="switch-selection"></span>
                  </div>
                  <span style="font-size: 1rem;" class="open-public-switch">Sim</span>
               </div>
         </div>
      </div>
        <div class="row">
        <div class="col-sm-12">
          <hr>
      </div>
      <div class="col-sm-6">
          <div class="row">
              <div class="col-sm-4">
              <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Glúten') ? 'checked' : '' : '' ); ?> id="alimentar_restriction_gluten" value="Glúten">
                    <label class="form-check-label" for="alimentar_restriction_gluten">Glúten</label>
                </div>
                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Lactose') ? 'checked' : '' : '' ); ?>  id="alimentar_restriction_lactose" value="Lactose">
                    <label class="form-check-label" for="alimentar_restriction_lactose">Lactose</label>
                </div>

                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Açucar') ? 'checked' : '' : '' ); ?>  id="alimentar_restriction_suggar" value="Açucar">
                    <label class="form-check-label" for="alimentar_restriction_suggar">Açucar</label>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Soja') ? 'checked' : '' : '' ); ?>  id="alimentar_restriction_soy" value="Soja">
                    <label class="form-check-label" for="alimentar_restriction_soy">Soja</label>
                </div>
                <br>

                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Ovos') ? 'checked' : '' : '' ); ?>  id="alimentar_restriction_eggs" value="Ovos">
                    <label class="form-check-label" for="alimentar_restriction_eggs">Ovos</label>
                </div>
                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Vegetariano') ? 'checked' : '' : '' ); ?>  id="alimentar_restriction_vegetarian" value="Vegetariano">
                    <label class="form-check-label" for="alimentar_restriction_vegetarian">Vegetariano</label>
                </div>
              </div>
              <div class="col-sm-4">
              <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Frutos do Mar') ? 'checked' : '' : '' ); ?>  id="alimentar_restriction_seafood" value="Frutos do Mar">
                    <label class="form-check-label" for="alimentar_restriction_seafood">Frutos do Mar</label>
                </div>
                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Sal/Sódio') ? 'checked' : '' : '' ); ?>  id="alimentar_restriction_salt_sodium" value="Sal/Sódio">
                    <label class="form-check-label" for="alimentar_restriction_salt_sodium">Sal/Sódio</label>
                </div>

                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[CoffeeBreak][target][alimentarRestriction]" <?php print( isset($data['post']['CoffeeBreak']['target']['alimentarRestriction']) ? ($data['post']['CoffeeBreak']['target']['alimentarRestriction'] == 'Vegano') ? 'checked' : '' : '' ); ?>  id="alimentar_restriction_vegan" value="Vegano">
                    <label class="form-check-label" for="alimentar_restriction_vegan">Vegano</label>
                </div>
              </div>
          </div>
      </div>
      <div class="col-sm-6">
        <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[CoffeeBreak][activityObjective]" id="" rows="5" placeholder="Explique aqui quais são as outras restrições" style="resize: none;"><?php print( isset( $data["post"]["CoffeeBreak"]["activityObjective"] ) ? $data["post"]["CoffeeBreak"]["activityObjective"] : "" ) ?></textarea>
      </div>
   </div>
   <?php if(!isset($data['edit']) || !$data['edit']){ ?>
   <div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12 mt-5 text-center">
            <button type="button" onClick="display_labels(<?php print($show_coffee_brake); ?>)" class="btn btn-outline-primary btn-primary btn-sm">Salvar e continuar</button>
        </div>
    </div>
   </div>
   <?php } ?>
</div>
</div>

<?php if($data['edit']){ ?>
<div class="row row-no-padding d-none" id="coffee_brake_correct">
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
                        <input type="radio" class="switch-input" name="post[CoffeeBrake][correct]" value="Não" id="coffee_brake_correct_no">
                        <label for="coffee_brake_correct_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" class="switch-input" name="post[CoffeeBrake][correct]" value="Sim" id="coffee_brake_correct_yes">
                        <label for="coffee_brake_correct_yes" class="switch-label switch-label-on">&nbsp;</label>
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
<div id="message_error_coffee_brake"></div>