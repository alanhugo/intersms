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
	<li class="<?php echo ($controller == 'commands')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>commands"><i class="fa fa-files-o"></i> <span
			class="nav-label">Comandos</span>
	</a></li>
	<li class="<?php echo ($controller == 'usuarios')?"active":"";?>"><a href="<?php echo ENV_WEBROOT_FULL_URL?>usuarios"><i class="fa fa-user"></i> <span
			class="nav-label">Usuarios</span>
	</a></li>
</ul>