<br>
            <form class="container" role="form" enctype="multipart/form-data" method="post" action="">
			<div class="form-group">
			
				<label>Имя сертификата</label>
                                <input id="name" type="text" class="form-control" name="cert_name" placeholder="Введите название" required>
			</div>
			<div class="form-group">
				<label>Владелец</label>
                                <select id="owner_id" multiple class="form-control" name="owner_id" required>
					<option disabled>Выберите владельца</option>
					<? $usersList = $GLOBALS['usersList'] ?>
                                        <? foreach ($usersList as $user):?>
						<option> <?= $user['user_id'].' '.$user['user_name']?></option>
					<? endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label>Имя файла</label>
                                <input id="file_name" type="file" name="file_name" required>
			</div>
			<div class="form-group">
				<label>Имя образа файла</label>
                                <input id="image_file_name" type="file" name="image_file_name">
			</div>
			<div class="form-group">
				<label>Дата начала действия</label>
                                <input id="active_from" type="date" name="active_from" required>
			</div>
			<div class="form-group">
				<label>Дата окончания действия</label>
                                <input id="active_to" type="date" name="active_to" required>
			</div>
                    <a class="btn btn-outline-outline-primary" href="<?=$_SERVER['SCRIPT_NAME']?>">Назад</a>
                    <input type="hidden" name="action" value="addCert"> <button id="submit" type="submit"  class="btn btn-primary">Отправить</button>
		</form>
<div id="form-value"></div>