            <?php 
            require_once 'sidebar.php';

            if(!isset($_POST['lines'])) {
                $_POST['lines'] = '10';
            }
            ?>
            <div class="app-content app-content--sidebar">
                <div class="app-content-body">

                    <div class="row">
                            <div class="card">  
                                <div class="functions__table">
                                    <div class="other__table__count" style="flex-basis: 100%">
                                        <p>
                                            <?php
                                            $sql = "SELECT count(*) FROM qwe_logs";
                                            $res = mysqli_query($con, $sql);
                                            $row = mysqli_fetch_row($res);
                                            $total_rows=$row[0];
                                            echo 'Всего логов: '. $total_rows;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <table class="table table-hover" id="filter__table" data-order='[[1,"desc"]]'>
                                        <thead>
                                            <tr class="tr__uptable">
                                                <th scope="col">
                                                    Пользователь
                                                </th>
                                                <th scope="col">
                                                    Дата
                                                </th>
                                                <th scope="col">
                                                    Действие
                                                </th>
                                                <th scope="col">
                                                    IP адрес
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
                                $result = mysqli_query($con, "SELECT * FROM qwe_logs ORDER BY date DESC LIMIT $start,$per_page");
                                while($row=mysqli_fetch_array($result)) {
                                    echo '<tr class="search">
                                        <td>
                                        '.$row['user'].'                                                 
                                        </td>
                                             <td>
                                            '.$row['date'].'                                                 
                                            </td>
                                            <td>
                                            '.$row['text'].'
                                            </td>
                                            <td>
                                            <div class="table-ip"><strong><code>'.$row['ip_address'].'</code></strong>
                                            </td>
                                            
                                        </td>
                                        </tr>'; */
                                        $result = mysqli_query($con, "SELECT * FROM qwe_logs ORDER BY date DESC");
                                        while($row=mysqli_fetch_array($result)) {
                                            echo '<tr class="search">
                                                <td>
                                                '.$row['user'].'                                                 
                                                </td>
                                                     <td>
                                                    '.$row['date'].'                                                 
                                                    </td>
                                                    <td>
                                                    '.$row['text'].'
                                                    </td>
                                                    <td>
                                                    <div class="table-ip"><strong><code>'.$row['ip_address'].'</code></strong>
                                                    </td>
                                                    
                                                </td>
                                                </tr>'; }
                                                ?>
                                            </tr>
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
                </div>
            </div>
            <?php require_once 'pages/modals/modal_auth.php' ?>