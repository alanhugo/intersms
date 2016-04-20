<?php $controller = $this->request->params['controller'];?>
<?php $action = $this->request->params['action'];?>
<ul class="nav metismenu" id="side-menu">
	<li class="nav-header">
		<div class="dropdown profile-element">
			<span> <img alt="image" class="img-circle" width="48px"
				src="<?php echo ENV_WEBROOT_FULL_URL.'files/fotos_usuario/'.$obj_logged_user->getAttr('foto'); ?>" />
			</span> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span
				class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo ucwords($this->Session->read('Auth.User.nombre'))?>
					</strong>
				</span> <span class="text-muted text-xs block">
						<b class="caret"></b>
				</span>
			</span>
			</a>
			<ul class="dropdown-menu animated fadeInRight m-t-xs">
				<!-- <li><a href="profile.html">Perfil</a>
				</li> -->
				<li class="divider"></li>
				<li><a href="<?php echo ENV_WEBROOT_FULL_URL?>usuarios/logout">Salir</a>
				</li>
			</ul>
		</div>
		<div class="logo-element">IS+</div>
	</li>
	<li class="<?php echo ($controller == 'dashboard')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>dashboard"><i class="fa fa-th-large"></i> <span
			class="nav-label">Dashboards</span>
	</a></li>
	<li class="<?php echo ($controller == 'tramites' && $action != 'buscar_tramite' && $action != 'monitoreo')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>tramites"><i class="fa fa-files-o"></i> <span
			class="nav-label">Tramites</span>
	</a></li>
	<li class="<?php echo ($controller == 'tramites' && $action == 'buscar_tramite')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>tramites/buscar_tramite"><i class="fa fa-search"></i> <span
			class="nav-label">Buscar Tramite</span>
	</a></li>
	<li class="<?php echo ($controller == 'tramites' && $action == 'monitoreo')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>tramites/monitoreo"><i class="fa fa-desktop"></i> <span
			class="nav-label">Buscar Tramite</span>
	</a></li>
	<?php if($obj_logged_user->getAttr('tipo_usuario_id') == 1 || $obj_logged_user->getAttr('tipo_usuario_id') == 3) { ?>
		<li class="<?php echo ($controller == 'usuarios')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>usuarios"><i class="fa fa-user"></i> <span
				class="nav-label">Usuarios</span>
		</a></li>
		<li class="<?php echo ($controller == 'acciones')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>acciones"><i class="fa fa-share-alt"></i> <span
				class="nav-label">Acciones</span>
		</a></li>
		<li class="<?php echo ($controller == 'areas')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>areas"><i class="fa fa-delicious"></i> <span
				class="nav-label">&Aacute;reas</span>
		</a></li>
		<li class="<?php echo ($controller == 'tipo_documentos')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>tipo_documentos"><i class="fa fa-file"></i> <span
				class="nav-label">Tipo Documentos</span>
		</a></li>
		<li class="<?php echo ($controller == 'configurations')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>configurations/backup_database"><i class="fa fa-database"></i> <span
				class="nav-label">Backup de Base de Datos</span>
		</a></li>
		<li class="<?php echo ($controller == 'bitacoras')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>bitacoras"><i class="fa fa-eye"></i> <span
				class="nav-label">Bitacoras de Tr&aacute;mites</span>
		</a></li>
	<?php } ?>
	<!-- <li class="<?php echo ($controller == 'personas')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>personas"><i class="fa fa-male"></i> <span
			class="nav-label">Personas</span>
	</a></li>-->
</ul>