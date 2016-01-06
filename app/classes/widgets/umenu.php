<?php
namespace APP\WIDGETS;

class LANGUAGE {
	public static function SWITCHER($user=false){
		$lang=\CORE::init()->lang;
		$result='';
		if($user){

			if($lang=='ru'){
				$result='<ul class="nav navbar-nav">
				<li class="dropdown">
	              <a href="#" title="Русский" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				  <small><i class="langflag langflag-ru"></i></small>&nbsp; RU
	              <span class="caret"></span></a>
	              <ul class="dropdown-menu">
	                <li>
	                	<a href="./?lang=tj">
	                		<small><i class="langflag langflag-tj"></i></small>&nbsp; TJ
	                	</a>
	                </li>
	              </ul>
	            </li>
		    </ul>
	        ';
			} else {
				$result='<ul class="nav navbar-nav">
				<li class="dropdown">
	              <a href="#" title="Тоҷикӣ" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				  <small><i class="langflag langflag-tj"></i></small>&nbsp; TJ
	              <span class="caret"></span></a>
	              <ul class="dropdown-menu">
	                <li>
	                	<a href="./?lang=ru">
	                		<small><i class="langflag langflag-ru"></i></small>&nbsp; RU
	                	</a>
	                </li>
	              </ul>
	            </li>
		    </ul>
	        ';
			}

		} else {

			if($lang=='ru'){
				$result='<div class="form-group">
	            <div class="dropdown">
	              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
	                <i class="langflag langflag-ru"></i>&nbsp;<small>RU</small>
	                <span class="caret"></span>
	              </button>
	              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
	                    <li role="usermenu">
	                        <a role="menuitem" tabindex="-1" href="./?lang=tj">
	                        <i class="langflag langflag-tj"></i>&nbsp;<small>TJ</small>
	                        </a>
	                    </li>                    
	              </ul>
	            </div>
	        </div>
	        ';
			} else {
				$result='<div class="form-group">
	            <div class="dropdown">
	              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
	                <i class="langflag langflag-tj"></i>&nbsp;<small>TJ</small>
	                <span class="caret"></span>
	              </button>
	              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
	                    <li role="usermenu">
	                        <a role="menuitem" tabindex="-1" href="./?lang=ru">
	                        <i class="langflag langflag-ru"></i>&nbsp;<small>RU</small>
	                        </a>
	                    </li>                    
	              </ul>
	            </div>
	        </div>
	        ';
			}

		}
		return $result;
	}
}

class UMENU {
	public function show(){
		$UI=\CORE\UI::init();
		$USER=\CORE\USER::init();
		if($USER->auth()){
			// for admins
			if($USER->get('gid')==1){
			$UI->pos['mainmenu'].='<li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	              '.\CORE::init()->lang('foradmins','Администраторам').' <span class="caret"></span></a>
	              <ul class="dropdown-menu">
	                <li><a href="./?c=users">'.\CORE::init()->lang('users','Пользователи').'</a></li>
	                <li><a href="./?c=group">'.\CORE::init()->lang('groups','Группы').'</a></li>
	                <!--<li><a href="./?c=acl">'.\CORE::init()->lang('acl','Управление доступом').'</a></li>-->
	              </ul>
	            </li>
			';
			$UI->pos['mainmenu'].='
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              '.\CORE::init()->lang('forms','Формы').' <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="./?c=frm&act=km1">Форма KM-1</a></li>
              </ul>
            </li>
			';
			}
			
			// for users
			$UI->pos['user1'].='
			<ul class="nav navbar-nav">
				'.LANGUAGE::SWITCHER(true).'
				<li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				  <small><i class="glyphicon glyphicon-cog"></i>&nbsp;</small>
				  '.$USER->get('username').'
	              <span class="caret"></span></a>
	              <ul class="dropdown-menu">
	                <!--<li>
	                	<a href="./?c=user&act=profile">
	                		<small><i class="glyphicon glyphicon-user"></i>&nbsp;</small> 
				    		<span class="text">'.\CORE::init()->lang('profile','Профиль').'</span>
	                	</a>
	                </li>-->
	                <!--<li>
	                	<a href="./?c=user&act=change_password">
	                		<small><i class="glyphicon glyphicon-pencil"></i>&nbsp;</small> 
				    		<span class="text">'.\CORE::init()->lang('cpasswd','Сменить пароль').'</span>
	                	</a>
	                </li>
	                -->
	                <li class="divider"></li>
	                <li>
	                	<a href="./?c=user&act=logout">
	                		<small><i class="glyphicon glyphicon-off"></i>&nbsp;</small> 
				    		<span class="text">'.\CORE::init()->lang('logout','Logout').'</span>
	                	</a>
	                </li>
	              </ul>
	            </li>
		    </ul>
			';
		} else {
			$UI->pos['user1'].='<form action="./?c=user&act=login" method="post" class="navbar-form">
			'.LANGUAGE::SWITCHER();
			$UI->pos['user1'].='<div class="form-group">
					<input type="text" name="login" placeholder="'.\CORE::init()->lang('login','Login').'" value="'.\COOKIE::get('lastuser').'" class="form-control" style="width:150px;">
				</div>
				<div class="form-group">
					<input type="password" name="password" placeholder="'.\CORE::init()->lang('password','Password').'" class="form-control" style="width:150px;">
				</div>
				<button type="submit" class="btn btn-warning">'.\CORE::init()->lang('login','Login').'</button>
			';
			$UI->pos['user1'].='</form>
			';
		}
		$UI->pos['mainmenu'].='
			<li><a href="./?c=map">'.\CORE::init()->lang('map','Карта').'</a></li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              '.\CORE::init()->lang('opendata','Открытые данные').' <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="./?c=od&act=about">'.\CORE::init()->lang('about_opendata','Об открытых данных').'</a></li>
                <li><a href="./?c=od">'.\CORE::init()->lang('opendata','Открытые данные').'</a></li>
                <li><a href="./?c=vs">'.\CORE::init()->lang('visualization','Визуализация').'</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              '.\CORE::init()->lang('zayavleniya','Заявления').' <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="./?c=app&act=reg">'.\CORE::init()->lang('reg_form','Форма регистрации').'</a></li>
                <li><a href="./?c=app&act=check">'.\CORE::init()->lang('check_app','Проверить статус заявки').'</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              '.\CORE::init()->lang('about','О проекте').' <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="./?c=page&act=about">'.\CORE::init()->lang('about_project','Описание проекта').'</a></li>
                <li><a href="./?c=page&act=team">'.\CORE::init()->lang('team','Команда проекта').'</a></li>
              </ul>
            </li>
		';
	}
}