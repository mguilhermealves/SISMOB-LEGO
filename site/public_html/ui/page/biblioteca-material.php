<div class="container-fluid biblioteca-categ" style="background-color: rgb(17, 17, 17);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-9 py-3">
                <p style="color: rgb(232, 232, 232); font-size: 20px;" >Biblioteca > <?php print( $data["libarysections_attach"][0]["name"] ); ?></p>
                <p style="font-size: 36px; font-weight: 600; color: rgb(232, 232, 232);" class="pb-3"><?php print( $data["name"] ); ?></p>
                <?php
                foreach( $data["libaryfiles_attach"] as $k => $v ){
                    print('<p class="libaryname">' . $v["name"] . '</p>');
                    switch( $v["type"] ){
                        case "PDF":
                            print( '<embed src="/furniture/upload/' . $v["url"] .'#scrollbar=0&toolbar=0&navpanes=0" width="100%" height="500" alt="pdf" ></embed>'); 
                            //print( '<embed src="https://static-premier.hsollearn.com.br/' . $v["url"] .'#scrollbar=0&toolbar=0&navpanes=0" width="100%" height="500" alt="pdf" >'); 
                        break;
                        case "Imagem":
                            print( '<img src="/furniture/upload/' . $v["url"] .'" class="img-fluid" width="100%" alt="img" >'); 
                        break;
                        case 'Excel':
                        case 'Word':
                            print('<embed src="https://view.officeapps.live.com/op/embed.aspx?src=https://static-premier.hsollearn.com.br/' . $v["url"] . '" width="100%" height="500"></embed>');
                        break;
                    }
                }
                ?>
                
            </div>
            <div class="col-xs-12 col-md-12 col-lg-3">
                <h1>sidebar</h1>
            </div>
        </div>
    </div>
</div>
<style>
    pre{ color: #FFF;}
    .libaryname{ color: #e8e8e8;
        font-size: 1.75rem;
        font-weight: 600;
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
        line-height: 1.5;
        letter-spacing: 0.00938em;
        margin-top: 2rem;
    }
</style>
