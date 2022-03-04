<div class="container-fluid">
  <div class="meu-cadastro">


    <form action="<?php print($GLOBALS["meu_cadastro_url"]) ?>" method="POST" enctype="multipart/form-data">

      <div class="row">
        <div class="col-12">
          <p class="item-title">Meu Cadastro</p>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-11"></div>
        <div class="col-lg-1">
          <div class="uploader">
            <input type="file" id="file-upload" name="image">

            <label for="file-upload" id="file-drag">
              <img id="file-image"  src="<?php echo constant("cFrontend") . ( isset($user->data[0]["image"]) ? $user->data[0]["image"] : ""); ?>" alt="Preview" class="<?php isset($user->data[0]["image"]) ? "" : "hidden" ?>" onerror="this.src='<?php echo constant("cFurniture") . "/images/img-default.png" ?>';">
              <div id="start">

                <div id="notimage" class="hidden"></div>
                <span id="file-upload-btn">


                  <span class="MuiButton-label"><svg class="usuario-foto maquina-foto" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                      <path d="M3 4V1h2v3h3v2H5v3H3V6H0V4h3zm3 6V7h3V4h7l1.83 2H21c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V10h3zm7 9c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-3.2-5c0 1.77 1.43 3.2 3.2 3.2s3.2-1.43 3.2-3.2-1.43-3.2-3.2-3.2-3.2 1.43-3.2 3.2z"></path>
                    </svg>
                    <input type="file" hidden="" accept=".png, .jpg, .jpeg">
                  </span>
                  <span class="MuiTouchRipple-root"></span>


                </span>
              </div>
              <div id="response" class="hidden">
                <div id="messages"></div>
              </div>
            </label>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-5">
          <div class="form-cadastro">
            <label for="first_name">Nome</label>
            <input type="text" value="<?php print(isset($user->data[0]["first_name"]) ? $user->data[0]["first_name"] : "") ?>" class="form-control" id="first_name" aria-describedby="first_name" name="first_name" placeholder="">
          </div>
        </div>
        <div class="col-5">
          <div class="form-cadastro">
            <label for="last_name">Sobrenome</label>
            <input type="text" value="<?php print(isset($user->data[0]["last_name"]) ? $user->data[0]["last_name"] : "") ?>" class="form-control" id="last_name" aria-describedby="sobreNomeCadastro" name="last_name" placeholder="">
          </div>
        </div>
        <div class="col-2">
          <div class="form-cadastro telefone">
            <label for="telefone">Telefone</label>
            <input type="text" value="<?php print(isset($user->data[0]["phone"]) ? $user->data[0]["phone"] : "") ?>" class="form-control" id="telefone" aria-describedby="nomeCadastro" name="phone" placeholder="(xx) xxxx-xxxxx">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-4">
          <div class="form-cadastro">
            <label for="grupodeacesso">Grupo de Acesso</label>
            <input type="text" class="form-control" id="grupodeacesso" aria-describedby="grupodeacesso" value="<?php print(isset($user->data[0]["profiles_attach"][0]) ? $user->data[0]["profiles_attach"][0]["name"] : "") ?>" disabled>
          </div>
        </div>
        <div class="col-4">
          <div class="form-cadastro">
            <label for="email">E-mail</label>
            <input type="email" value="<?php print(isset($user->data[0]["mail"]) ? $user->data[0]["mail"] : "") ?>" class="form-control" id="cadastro" aria-describedby="emailCadastro" name="mail" placeholder="" disabled>
          </div>
        </div>
        <div class="col-4">
          <div class="form-cadastro">
            <label for="gestor">Gestor</label>
            <input type="text" class="form-control" id="gestor" aria-describedby="gestorCadastro" placeholder="Nome do Gestor" disabled>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-2">
          <div class="form-cadastro cep">
            <label for="postalcode">CEP</label>
            <input type="text" name="postalcode" value="<?php print(isset($user->data[0]["postalcode"]) ? $user->data[0]["postalcode"] : "") ?>" class="form-control" id="postalcode" aria-describedby="CEPCadastro" placeholder="xxxxx-xxx">
          </div>
        </div>
        <div class="col-6">
          <div class="form-cadastro logradouro">
            <label for="address">Logradouro</label>
            <input type="text" name="address" value="<?php print(isset($user->data[0]["address"]) ? $user->data[0]["address"] : "") ?>" class="form-control" id="address" aria-describedby="logradouroCadastro" placeholder="Logradouro">
          </div>
        </div>
        <div class="col-1">
          <div class="form-cadastro">
            <label for="number">Número</label>
            <input type="text" name="number" value="<?php print(isset($user->data[0]["number"]) ? $user->data[0]["number"] : "") ?>" class="form-control" id="number" aria-describedby="numeroCadastro" placeholder="Número">
          </div>
        </div>
        <div class="col-3">
          <div class="form-cadastro">
            <label for="complement">Complemento</label>
            <input type="text" name="complement" value="<?php print(isset($user->data[0]["complement"]) ? $user->data[0]["complement"] : "") ?>" class="form-control" id="complement" aria-describedby="complementoCadastro" placeholder="Complemento">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-3">
          <div class="form-cadastro bairro">
            <label for="district">Bairro</label>
            <input type="text" name="district" value="<?php print(isset($user->data[0]["district"]) ? $user->data[0]["district"] : "") ?>" class="form-control" id="district" aria-describedby="bairroCadastro" placeholder="Bairro">
          </div>
        </div>
        <div class="col-5">
          <div class="form-cadastro cidade">
            <label for="city">Cidade</label>
            <input type="text" name="city" value="<?php print(isset($user->data[0]["city"]) ? $user->data[0]["city"] : "") ?>" class="form-control" id="city" aria-describedby="cidadeCadastro" placeholder="Cidade">
          </div>
        </div>
        <div class="col-2">
          <div class="form-cadastro uf">
            <label for="uf">Estado</label>
            <input type="text" name="uf" value="<?php print(isset($user->data[0]["uf"]) ? $user->data[0]["uf"] : "") ?>" class="form-control" id="uf" aria-describedby="estadoCadastro" placeholder="Estado">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="form-cadastro">
            <button class="btn" type="submit">Salvar</button>
          </div>
        </div>
      </div>

    </form>
  </div>


</div>


<style>
  #messages strong {
    display: none;
  }

  .uploader {
    display: block;
    clear: both;
    margin: 0 auto;
    width: 112px;
  }

  .uploader label {
    float: left;
    clear: both;
    width: 112px;
    height: 112px;
    padding: 0;
    text-align: center;
    border-radius: 100%;
    overflow: hidden;
  }

  /* .uploader label.hover #start i.fa {
    transform: scale(0.8);
    opacity: 0.3;
  } */
  .uploader #start {
    float: left;
    clear: both;
    width: 100%;
  }

  .uploader #start.hidden {
    display: none;
  }

  .uploader #start i.fa {
    font-size: 50px;
    margin-bottom: 1rem;
    transition: all 0.2s ease-in-out;
  }

  .uploader #response {
    float: left;
    clear: both;
    width: 100%;
  }

  .uploader #response.hidden {
    display: none;
  }

  .uploader #response #messages {
    margin-bottom: 0.5rem;
  }

  .uploader #file-image {
    /* display: inline;
    margin: 0 auto 0.5rem auto;
    width: auto;
    height: auto;
    max-width: 234px; */
    position: relative;
    top: 50%;
    -ms-transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    left: 50%;
    width: auto;
    height: 112px;
  }

  .uploader #file-image.hidden {
    display: none;
  }

  .uploader #notimage {
    display: block;
    float: left;
    clear: both;
    width: 100%;
  }

  .uploader #notimage.hidden {
    display: none;
  }

  .uploader progress,
  .uploader .progress {
    display: inline;
    clear: both;
    margin: 0 auto;
    width: 100%;
    max-width: 180px;
    height: 8px;
    border: 0;
    border-radius: 4px;
    background-color: #eee;
    overflow: hidden;
  }

  .uploader .progress[value]::-webkit-progress-bar {
    border-radius: 4px;
    background-color: #eee;
  }

  .uploader .progress[value]::-webkit-progress-value {
    background: linear-gradient(to right, #393f90 0%, #454cad 50%);
    border-radius: 4px;
  }

  .uploader .progress[value]::-moz-progress-bar {
    background: linear-gradient(to right, #393f90 0%, #454cad 50%);
    border-radius: 4px;
  }

  .uploader input[type=file] {
    display: none;
  }

  .uploader div {
    margin: 0 0 0.5rem 0;
    color: #5f6982;
  }

  .uploader .btn {
    display: inline-block;
    margin: 0.5rem 0.5rem 1rem 0.5rem;
    clear: both;
    font-family: inherit;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    text-transform: initial;
    border: none;
    border-radius: 0.2rem;
    outline: none;
    padding: 0 1rem;
    height: 36px;
    line-height: 36px;
    color: #fff;
    transition: all 0.2s ease-in-out;
    box-sizing: border-box;
    background: #454cad;
    border-color: #454cad;
    cursor: pointer;
  }

  .quote-imgs-thumbs {
    background: #eee;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    margin: 1.5rem 0;
    padding: 0.75rem;
    float: left;
    width: 100%;
  }

  .quote-imgs-thumbs--hidden {
    display: none;
  }

  .img-preview-thumb {
    background: #fff;
    border: 1px solid #777;
    border-radius: 0.25rem;
    box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
    margin-right: 1rem;
    max-width: 140px;
    padding: 0.25rem;
  }

  .show-for-sr,
  .show-on-focus {
    position: absolute !important;
    width: 1px;
    height: 1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    -webkit-clip-path: inset(50%);
    clip-path: inset(50%);
    border: 0;
  }
</style>