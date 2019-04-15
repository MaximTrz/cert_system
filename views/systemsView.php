			<div class="row"><div class="col-md-2 col-md-offset-5"><h4>Системы</h4></div></div>
                        <form class="form" role="form" method="post" action="">
			  <div class="form-group">
				<label class="sr-only">Системы</label>
				<input type="text" class="form-control" name="systems_name" placeholder="Введите наименование системы">
                                <input name="action" type="hidden" value="addSystems">
                          </div>
				<button type="submit" class="btn btn-default">Добавить</button>
			</form>
                        <br>
                        <div class="row">
				<div class="col-md-12 block table-responsive"> 
					<table class="table table-striped table-bordered table-condensed table-responsive">
					<thead class="thead-default">
                                            <tr>
							<td>Наименование системы</td>
							<td>Сертификат</td>
							<td>Пользователи</td>
							<td></td>
						</tr>
                                        </thead>
                                        <tbody>
                                                <? $systemsList = $GLOBALS['systemsList'] ?>
						<? foreach ($systemsList as $system):?>
							<tr>
								<td> <?= $system['system_id'].' '.$system['system_name']?></td>
								<td><?=$system['cert_name']?></td>
								<td><?=$system['user_name']?></td>
                                                                <td align="middle"><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=deleteSystem&system_id=<?=$system['system_id']?> " class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></a></td>
                                                        </tr>
						<? endforeach ?>
                                        </tbody>
					</table>
				</div>
			</div>