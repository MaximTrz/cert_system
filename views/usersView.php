			<div class="row"><div class="col-md-2 col-md-offset-5"><h4>Пользователи</h4></div></div>
			<form class="form" role="form" method="post" action="">
			  <div class="form-group">
				<label class="sr-only">ФИО</label>
				<input type="text" class="form-control" name="users_name" placeholder="Введите ФИО пользователя">
                                
                          </div>
                                <input name="action" type="hidden" value="addUsers"><button type="submit" class="btn btn-default">Добавить</button>
			</form>
                        <br>
                        <div class="row">
				<div class="col-md-12 block table-responsive"> 
					<table class="table table-striped table-bordered table-condensed table-responsive">
					<thead class="thead-default">	
                                            <tr>
							<td>ФИО</td>
							<td>Сертификаты</td>
							<td></td>
						</tr>
                                        </thead>
                                        <tbody>
                                               
                                                <? $usersList = $GLOBALS['usersList'] ?>
						<? foreach ($usersList as $user):?>
							<tr>
								<td> <?=$user['user_id'].' '.$user['user_name']?></td>
								<td><?=$user['cert_name']?></td>
                                                                <td align="middle"><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=deleteUser&user_id=<?=$user['user_id']?> " class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></a></td>
                                                        </tr>
						<? endforeach ?>
                                        </tbody>
					</table>
				</div>	
			</div>