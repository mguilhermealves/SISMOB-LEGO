<!-- Aceite dos Termos -->
<div class="card mt-5 d-none" id="accept_terms">

<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Você não aceitou os termos</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
            </div>
        </div>
    </div>
</div>

<div class="card-header label_div">
    Aceite dos Termos
</div>

<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="form-check">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" name="post[terms]" id="check_term" <?php print( isset($data['post']['terms']) ? ($data['post']['terms']) ? 'checked' : '' : '' ); ?>>
                    <label class="form-check-label" for="check_term">
                        Li e Concordo com os termos descritos no Registro de Atividades
                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-12 mt-5 text-center">
            <button type="" id="save_accept_terms" name="btn_save" class="btn btn-outline-success btn-success btn-sm">Salvar e finalizar</button>
        </div>
    </div>
</div>
</div>
