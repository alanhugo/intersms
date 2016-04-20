<div class="col-sm-4"></div>
<div class="container-select">
	<div class="col-sm-6">
		<select class="modalTramiteCopiaAreaId chosen-select form-control m-b" id="modalTramiteCopiaAreaId"
			name="data[Tramite][area_id]">
			<option value="">Selecionar</option>
			<?php foreach ($arr_areas as $key => $area){?>
			<option value="<?php echo $area->getID()?>">
				<?php echo utf8_encode($area->getAttr('nombre'))?>
			</option>
			<?php }?>
		</select>
	</div>
</div>
<div class="col-sm-2"></div>