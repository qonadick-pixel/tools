        <?php 
            require_once 'sidebar.php';

            /*if(!isset($_POST['lines'])) { 
                $_POST['lines'] = '10';
            }*/
        ?>
        <div class="app-content app-content--sidebar">
            <div class="app-content-body">
                <div class="row">
                    <div class="card">
                        <div class="functions__table">
                            <div class="other__table__count" style="flex-basis: 100%">
                                <p>
                                    <?php
                                    $res = $con->query("SELECT count(*) FROM qwe_keys WHERE 1");
                                    $row = $res->fetch_row();
                                    $count = $row[0];
                                    echo 'Всего ключей: '. $count;
                                    ?>
                                </p>
                            </div>
                        </div>


                        <table class="table table-hover" id="filter__table" data-order='[[2,"desc"]]'>
                            <thead>
                                <tr class="tr__uptable">
                                    <th scope="col">
                                        Пользователь
                                    </th>
                                    <th scope="col">
                                        Ключ
                                    </th>
                                    <th scope="col">
                                        Дата создания
                                    </th>
                                    <th scope="col">
                                        IP адрес
                                    </th>
                                    <th scope="col">
                                        Статус
                                    </th>
                                    <th scope="col">
                                        Блокировка
                                    </th>
                                    <th scope="col">
                                        Действие
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*$per_page=$_POST['lines'];
                                // получаем номер страницы
                                if (isset($_POST['page'])) $page=($_POST['page']-1); else $page=0;
                                // вычисляем первый оператор для LIMIT
                                $start=abs($page*$per_page);
                                // составляем запрос и выводим записи
                                // переменную $start используем, как нумератор записей.
                                $result = mysqli_query($con, "SELECT * FROM `qwe_keys` ORDER BY id DESC LIMIT $start,$per_page");
                                while($row = mysqli_fetch_array($result)) {
                                    if($row['activated'] == 1) $activatedd = '<div class="btn__keys bk__active">Активирован</div>';
                                    else $activatedd = '<div class="btn__keys bk__inactive">
                                    Не активирован</div>';
                                
                                
                                    if($row['ban_key'] == 1) $banedd = 'Забанен';
                                    else $banedd = 'Не забанен';
                                    echo '
                                    <tr class="search">
                                        <td>
                                            ' . $row['key'] . '                                                    
                                        </td>
                                        <td>
                                            ' . $row['date_creation'] . '
                                        </td>
                                        <td>
                                            ' . getUserById($row['acc_id'], $con) . '                                                 
                                        </td>
                                        <td style="display: flex; justify-content: center: align-items: center">
                                            <div style="display: flex; justify-content: left; align-items: center !important">
                                                ' . $activatedd .'
                                            </div>
                                        </td>
                                        <td>
                                            '.$banedd.'
                                        </td>
                                        <td>
                                        <li style="list-style-type: none;">
                                                <a class="btn-act" href="#" data-bs-toggle="dropdown">
                                                    Действие
                                                </a>
                                
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item users-dropdown">
                                                        Удалить
                                                    </a>
                                                    <a class="dropdown-item users-dropdown">
                                                        Забанить
                                                    </a>
                                                    <a class="dropdown-item users-dropdown">
                                                        Изменить
                                                    </a>
                                                </div>
                                            </li>
                                        </li>
                                        </td>
                                    </tr>';
                                }*/
                               $result = mysqli_query($con, 'SELECT * FROM qwe_keys ORDER BY id DESC');
                                //берем результаты из каждой строки
                                while ($row = mysqli_fetch_array($result)) {
                                    if($row['activated'] == 1) $activatedd = '<div class="btn__keys bk__active">Активирован</div>';
                                    else $activatedd = '<div class="btn__keys bk__inactive">
                                    Не активирован</div>';


                                    if($row['ban_key'] == 1) $banedd = 'Забанен';
                                    else $banedd = 'Не забанен';
                                    echo '
                                    <tr class="search">
                                        <td>
                                            ' . getUserById($row['acc_id'], $con) . '                                               
                                        </td>
                                        <td>
                                            ' . $row['key'] . '
                                        </td>
                                        <td>
                                            ' . $row['date_creation'] . '                                            
                                        </td>
                                        <td>
                                            ' . $row['ip_address'] . '
                                        </td>
                                        <td style="display: flex; justify-content: center: align-items: center">
                                            <div style="display: flex; justify-content: left; align-items: center !important">
                                                ' . $activatedd .'
                                            </div>
                                        </td>
                                        <td>
                                            '.$banedd.'
                                        </td>
                                
                                        <td>
                                        <li style="list-style-type: none;">
                                                <a class="btn-act" href="#" data-bs-toggle="dropdown">
                                                    Действие
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item users-dropdown">
                                                        Удалить
                                                    </a>
                                                    <a class="dropdown-item users-dropdown">
                                                        Забанить
                                                    </a>
                                                    <a class="dropdown-item users-dropdown">
                                                        Изменить
                                                    </a>
                                                </div>
                                            </li>
                                        </li>
                                        </td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
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
        <?php require_once 'pages/modals/modal_auth.php' ?>
        <!--<script src="/js/tablesort/mytablesort.js"></script>-->
        <script src="/js/tablesort/tablesort.js"></script>

        <script> src="/js/tablesort/tablesort.date.js"</script>
        <script> src="/js/tablesort/tablesort.number.js"</script>
        <script> src="/js/tablesort/tablesort.dotsep.js"</script>
        <script>
            new Tablesort(document.getElementById('filter__table'));
        </script>
        <script>
            $(".classBtn").click(function() {
                if($(".classBtn").css({"color": "#6b73ff"})) {
                    $(".classBtn").css({"color": "#888888"})
                }

                $(this).css({"color": "#6b73ff"})
            })
        </script>