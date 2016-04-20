<button type="button" class="close" data-dismiss="modal">
	<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
</button>
<i class="fa fa-times-circle modal-icon"></i>
<h3 class="modal-title">
	&iquest;Estas seguro de querer Devolver el Documento <span id="num-doc"></span>?
</h3>
<br>
<div align="left"><strong>Si tiene alguna observaci&oacute;n puede escribirla aqu&iacute;:</strong></div>
<textarea name="data[SeguimientoTramite][obs_rechazado]" id="TramiteObservacionRechazado" class="form-control"></textarea>
<div class="row">
	<br>
	<label class="col-sm-4 control-label" style="padding-top: 8px;"> <input
		type="checkbox" class="i-checks marcarAreaRechazar">Derivar documento rechazado a otra &Aacute;rea
	</label>
	<div class="col-sm-8">
		<select class="form-control m-b hide" id="modalTramiteRechazarAreaId"
			name="data[Tramite][area_id]">
			<option value="" selected = "selected">Selecionar</option>
			<?php foreach ($arr_areas_derivar as $key => $area){?>
			<option value="<?php echo $area->getID()?>">
				<?php echo $area->getAttr('nombre');?>
			</option>
			<?php }?>
		</select>
	</div>
</div>