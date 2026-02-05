<?php 
            require_once 'sidebar.php';

            /*-if(!isset($_POST['lines'])) { 
                $_POST['lines'] = '10';
            }*/
        ?>
        <div class="app-content app-content--sidebar">
            <div class="app-content-body">
                <div class="row">
                    <div class="card">
                        <div class="functions__table">
                            <div class="block__button">
                                <button class="btn__choose" onclick="openModalChangePassword()">
                                    <i class="fa-solid fa-key"></i> Изменить пароль
                                </button>
                                <button class="btn__choose btn_margin__left" onclick="openModalChangeEmail()">
                                    <i class="fa-solid fa-envelope"></i> Изменить почту
                                </button>
                                <button class="btn__choose btn_margin__left" onclick="openModalAccesResetHWID()">
                                    <i class="fa-solid fa-broom" aria-hidden="true"></i> Запросить сброс HWID ключа
                                </button>
                                <!--<button class="btn__choose btn_margin__left" onclick="openModalAccesResetIP()" style="background-color: #666 !important;">
                                    <i class="fa-solid fa-broom" aria-hidden="true"></i> Запросить сброс IP адреса ключа
                                </button>-->
                            </div>
                            <div class="other__table__count">
                                <p>
                                    <?php
                                    $res = $con->query("SELECT count(*) FROM qwe_joinlogs WHERE `userid`='".$_SESSION['ID']."'");
                                    $row = $res->fetch_row();
                                    $count = $row[0];
                                    echo 'Всего заходов: '. $count;
                                    ?>
                                </p>
                            </div>
                        </div>


                        <div class="scroll-table">
                            <table class="table table-hover"id="filter__table" data-order='[[3,"desc"]]'>
                                <thead>
                                    <tr class="tr__uptable">
                                        <th scope="col">
                                            Браузер
                                        </th>
                                        <th scope="col">
                                            Устройство
                                        </th>
                                        <th scope="col">
                                            Локация
                                        </th>
                                        <th scope="col">
                                            Последняя активность
                                        </th>
                                        <th scope="col">
                                            IP адрес
                                        </th>
                                        <th scope="col">
                                            Действие
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query($con, "SELECT * FROM `qwe_joinlogs` WHERE `userid`='".$_SESSION['ID']."' ORDER BY date DESC");
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '
                                        <tr class="search">
                                            <td>
                                                '.$row['browser'].'                                        
                                            </td>
                                            <td>
                                                '.$row['device'].'
                                            </td>
                                            <td style="display: flex; justify-content: center: align-items: center">
                                                <div style="display: flex; justify-content: left; align-items: center !important">
                                                    ' . $row['mesto'] .'
                                                </div>
                                            </td>
                                            <td>
                                                ' . $row['date'] . ' 
                                            </td>  
                                            <td>
                                                Регистрационный: '. $row['reg_ip'].'</br>Последний: '. $row['last_ip'].'
                                            </td>
                                            <td>
                                                <button class="btn__choose" onclick="endsession()" style="background-color: #666 !important;">
                                                    Завершить сессию
                                                </button>
                                            </td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!--<div class="table__list">
                        <?php
                                /*$sql = "SELECT count(*) FROM qwe_keys WHERE `activated`='1'";
                                $res = mysqli_query($con, $sql);
                                $row = mysqli_fetch_row($res);
                                $total_rows=$row[0];
                                
                                $num_pages=ceil($total_rows/$per_page);
                                
                                for($i=1;$i<=$num_pages;$i++) {
                                    if ($i-1 == $page) {
                                    echo '<a class="number">'.$i."</a>";
                                    } else {
                                    echo '<a class="number" href="/keyusers">'.$i."</a>";
                                    }
                                }*/
                            ?>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <script>
        function endsession() {
            new Notify ({
                title: 'Ошибка',
                text: 'Временно недоступно',
                status: 'warning', 
                autoclose: true,
                autotimeout: 2000                    
            }) 
            play()
        }
        </script>
        <?php require_once 'pages/modals/modal_auth.php' ?>
        <?php require_once 'pages/modals/change_password.php' ?>
        <?php require_once 'pages/modals/change_email.php' ?>
        <?php require_once 'pages/modals/acces_reset_hwid.php' ?>
        <?php require_once 'pages/modals/acces_reset_ip.php' ?>