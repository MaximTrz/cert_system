<? $status_cert = $_GET['action']?>        
<?switch($status_cert):case 'oldCerts':?><div class="row"><div class="col-md-3 col-md-offset-4"><h4>Просроченные сертификаты</h4></div></div><?break;?><?default:?><div class="row"><div class="col-md-2 col-md-offset-5"><h4>Сертификаты</h4></div></div><?endswitch;?>

        <div class="row">
                <div class="col-md-12 block table-responsive"> 
                <table class="table table-bordered table-condensed table-responsive">
                <thead class="thead-default">
                <tr>
                <td>Имя сертификата</td>
                <td>Системы</td>
                <td>Владелец</td>
                <td>Имя файла</td>
                <td>Имя образа файла</td>
                <td>Дата начала действия</td>
                <td>Дата окончания действия</td>
                <? $status_cert = $_GET['action']?>
                <? switch($status_cert):
                case 'oldCerts':?>
                <td></td>
                <?break;?>
                <? default:?>
                <td></td>
                <td></td>
                <?endswitch;?>
                
                </tr>
                </thead>
                <tbody>
                <? $mainList = $GLOBALS['mainList'] ?>
                <? $systemList = $GLOBALS['systemList'] ?>
                <? foreach ($mainList as $cert):?>
                <? switch($status_cert):
                case 'oldCerts':?>
                <?break;?>
                <? default:?>
                <? $datetime1= date("Y-m-d")?>
                            <? $datetime2= $cert['active_to']?>
                            <? $datetime1 = new DateTime("$datetime1")?>
                            <? $datetime2 = new DateTime("$datetime2")?>
                            <? $interval = $datetime1->diff($datetime2)?>
                            <?$time = $interval->format('%a')?>
                        <? if ($time<=30):?>
                        <? if($time<=14):?> 
                        <tr bgcolor=#FF9999>
                        <?else:?>
                        <tr bgcolor=#FFCC99>
                        <? endif; ?>
                        <?else:?>
                        <tr>
                        <? endif; ?> 
                        <?endswitch;?>
                                        <td><?= $cert['cert_name']?></td>
                                        <td><?= $cert['system_name']?></td>
                                        <td><?= $cert['owner_name']?></td>
                                        <td> <a href="UpFiles/<?=$cert['cert_id'].'/'.$cert['file_name']?> ">   <?= $cert['file_name']?> </a>  </td>
                                        <td>
                                            <?if(isset($cert['image_file_name'])):?>
                                            <a href="UpFiles/<?=$cert['cert_id'].'/'.$cert['image_file_name']?> ">
                                            <?= $cert['image_file_name']?>
                                            </a>
                                            <?else:?> 
                                            <?="Отсутствует"?>
                                            <?endif;?></td>
                                        <td><?= $cert['active_from']?></td>
                                        <td><?= $cert['active_to']?></td>
                                        <? switch($status_cert):
                                        case 'oldCerts':?>
                                        <td><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=oldCerts&delete=y&cert_id=<?=$cert['cert_id']?> " class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></a></td>
                                        <?break;?>
                                        <? default:?>
                                        <td><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=certsLink&cert_id=<?=$cert['cert_id']?> " class="btn btn-primary"> <span class="glyphicon glyphicon-plus"></span></a></td>
                                        <td><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=deleteCerts&cert_id=<?=$cert['cert_id']?> " class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></a></td>
                                        <?endswitch;?>
                        </tr>
                        <? endforeach ?>
                </tbody>
                </table>
                </div>


</div>