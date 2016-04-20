<?php if(isset($mas_una_recibido) && $mas_una_recibido==1){?>
<div class="row">
	<label class="col-sm-4 control-label" style="padding-top: 8px;">&Aacute;rea
		Destino</label>
	<div class="col-sm-8">
		<select class="form-control m-b" id="modalTramiteAreaId"
			name="data[Tramite][area_id]">
			<option value="">Selecionar</option>
			<?php foreach ($arr_areas as $key => $area){?>
			<option value="<?php echo $area->getID()?>"
			<?php echo (isset($obj_tramite) && $obj_tramite->getAttr('area_id')==$area->getID())?"selected = 'selected'":""?>>
				<?php echo utf8_encode($area->getAttr('nombre'))?>
			</option>
			<?php }?>
		</select>
	</div>
</div>
<?php }?>

<div class="row">
	<label class="col-sm-4 control-label" style="padding-top: 8px;"> <input
		type="checkbox" class="i-checks marcarCopia">Enviar Copia
	</label>
	<div class="container-select">
		<div class="col-sm-6">
			<select class="modalTramiteCopiaAreaId chosen-select form-control m-b hide" id="modalTramiteCopiaAreaId"
				name="data[Tramite][area_id]">
				<option value="">Selecionar</option>
				<?php foreach ($arr_areas as $key => $area){?>
				<option value="<?php echo $area->getID()?>">
					<?php echo utf8_encode($area->getAttr('nombre'))?>
				</option>
				<?php }?>
			</select>
		</div>
		<div class="col-sm-2">
			<button class="btn btn-more-area-copy hide">+</button>
		</div>
	</div>
</div>