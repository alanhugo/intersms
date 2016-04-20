<div id="content-consult">

<div class="lock-word animated fadeInDown">
    <!-- <span class="first-word">LOCKED</span><span>SCREEN</span> -->
</div>
<div class="middle-box text-center lockscreen animated fadeInDown" id="form-consul-exter">
        <div>
            <div class="m-b-md">
            <img alt="image" class="img-circle circle-border" src="<?= ENV_WEBROOT_FULL_URL; ?>img/usuario.png">
            </div>
            <h3>Bienvenido</h3>
            <p>Ingresa tu n&uacute;mero de expediente para poder darle seguimiento a tu trámite.</p>
            <form class="m-t skin-1" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" data-mask="99-9999-9999" name="data[Tramite][nro_tramite]" id="txt-nro-tramite" required="">
                </div>
                <span class="help-block"><strong>05-0001-2015</strong> DEPG-UDCH</span>
                <input type="hidden" id="hidden-tipo-tramite" value="E" style="display:none;">
                <a type="button" class="btn btn-primary block full-width btn-consultar-trigger">Aceptar</a>
            </form>
        </div>
</div>
<div id="result-consul-exter"></div>

</div>