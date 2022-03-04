<div class="card mt-5" id="error_information_activitie">
    <div class="card-header label_div_orange">
        Caixa de Mensagens
    </div>
    <div class="card-body">
        <div class="row">
        <div class="col-sm-12">
            <label for="">Curador</label>
            <textarea class="form-control" name="post[ActivityInformation][resources]" id="" rows="5" placeholder="Escreva aqui as suas considerações" style="resize: none;"><?php print( isset( $data["post"]["ActivityInformation"]["resources"] ) ? $data["post"]["ActivityInformation"]["resources"] : "" ) ?></textarea>
        </div>
    </div>
</div>
