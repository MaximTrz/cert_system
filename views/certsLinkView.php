<br>
<div class="col-md-12 block"> 
    <table class="table table-striped table-bordered table-condensed table-responsive">
    <thead class="thead-default">
    <tr>
    <td>Имя сертификата</td>
    <td>Владелец</td>
    <td>Имя файла</td>
    <td>Имя образа файла</td>
    <td>Дата начала действия</td>
    <td>Дата окончания действия</td>
    </tr>
    </thead>
    <tbody>
    <? $mainList = $GLOBALS['mainList'] ?>
    <? foreach ($mainList as $cert):?>
        <tr>
                <td><?= $cert['cert_name']?></td>
                <td><?= $cert['owner_name']?></td>
                <td><?= $cert['file_name']?></td>
                <td><?= $cert['image_file_name']?></td>
                <td><?= $cert['active_from']?></td>
                <td><?= $cert['active_to']?></td>
        </tr>
    <? endforeach ?>
    </tbody>
</table>
</div>
<form class="container" role="form" enctype="multipart/form-data" method="post" action="">
    <div class="row">
        <div class="form-group col-md-12 block table-responsive">
            <label>Пользователи</label>
            <select multiple class="form-control" name="owner_id">
                <option disabled>Выберите пользователя</option>
                <? $usersList = $GLOBALS['usersList'] ?>
                <? foreach ($usersList as $user):?>
                        <option> <?= $user['user_id'].' '.$user['user_name']?></option>
                <? endforeach ?>
            </select>
        </div>
        <div class="clearfix visible-xs"></div>
        <div class="col-md-6 block ">
            <input type="hidden" name="action" value="addCertsLinkUsers"><button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </div>
</form>
<form class="container" role="form" enctype="multipart/form-data" method="post" action="">
    <div class="row">
        <div class="form-group col-md-12">
            <label>Системы</label>
            <select multiple class="form-control" name="system_name">
                    <option disabled>Выберите систему</option>
                    <? $systemsList = $GLOBALS['systemsList'] ?>
                    <? foreach ($systemsList as $system):?>
                            <option> <?= $system['system_id'].' '.$system['system_name']?></option>
                    <? endforeach ?>
            </select>
        </div>
        <div class="col-md-6 block">
            <input type="hidden" name="action" value="addCertsLinkSystems"><button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </div>

</form>




                    <br>
                    <br>
                    <div class="container">
                        <div class="col-md-6 block table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-responsive">
                                            <thead class="thead-default">   
                                            <tr>
                                                        <td>Подключенные пользователи</td>
                                                </tr>

                                            </thead>
                                            <tbody>

                                                <? foreach ($mainList as $linkUsers):?>
                                                        <tr>
                                                                <td> <?= $linkUsers['user_id'].' '.$linkUsers['user_name']?></td>
                                                        </tr>
                                                <? endforeach ?>
                                            </tbody>
                                        </table>

                    </div>
                    <div class="col-md-6 block table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-responsive">
                                          <thead class="thead-default">
                                            <tr>
                                                        <td>Подключенные системы</td>
                                                </tr>

                                          </thead>
                                          <tbody>

                                                <? foreach ($mainList as $linkSystems):?>
                                                        <tr>
                                                                <td> <?= $linkSystems['system_id'].' '.$linkSystems['system_name']?></td>
                                                        </tr>
                                                <? endforeach ?>
                                          </tbody>
                                        </table>
                    </div>
                    </div>