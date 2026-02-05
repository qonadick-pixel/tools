        <?php 
            require_once 'sidebar.php';
        ?>
<div class="app-content app-content--sidebar">
    <div class="app-content-body">
        <div class="row">
            <div class="card">
                <div class="functions__table">
                    <div class="other__table__count" style="flex-basis: 100%">
                        <p>
                            <?php
                                $res = $con->query("SELECT count(*) FROM qwe_requests WHERE `type`=0 AND `active`=1");
                                $row = $res->fetch_row();
                                $count = $row[0];
                                echo 'Всего запросов на сброс HWID: '. $count;
                            ?>
                        </p>
                    </div>
                </div>
                <table class="table table-hover" id="filter__table">
                    <thead>
                        <tr class="tr__uptable">
                            <th scope="col">
                                Никнейм
                            </th>
                            <th scope="col">
                                Дата
                            </th>
                            <th scope="col">
                                Причина
                            </th>
                            <th scope="col">
                                Действие
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($con, 'SELECT * FROM qwe_requests WHERE `type`="0" AND `active`=1 ORDER BY id DESC');
                        // берем результаты из каждой строки
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['reason'] == '') $reason = '<a style="color: #FF0000;">Не указана</a>';
                            else $reason = $row['reason'];
                            echo '
                                 <tr class="search">
                                 <td id="username">'.getUserById($row['userid'], $con).'</td>
                                 <td>
                                    ' . $row['date'] . '                                                    
                                 </td>
                                 <td style="text-align: center; width: 95%">
                                    ' . $reason . '                                                 
                                 </td>
                                 <td style="display: flex; justify-content: space-around; font-size: 20px">
                                    <i onclick="resethwid('. $row['id'] .')" id="yes_reset_hwid" class="fa-solid fa-check" style="color: green; cursor: pointer"></i>
                                    <i onclick="unresethwid('. $row['id'] .')" id="no_reset_hwid" class="fa-solid fa-xmark" style="color: red; cursor: pointer"></i>
                                 </td>
                              </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    /*$(document).ready(function(){
        username = $('#filter__table').find('#username').html();
        $('#yes_reset_hwid').click(function(){
            $.ajax({
                type: 'GET',
                url: '/pages/sendrequest.php?type=yesresethwid&name='+username,
                success: function(data) {
                    if(data.search('#yes') != -1) {
                        data = data.replace('#yes', ''); 
                        new Notify ({
                            title: 'Успешно',
                            text: data,
                            status: 'success',
                            autoclose: true,
                            autotimeout: 2000                    
                        })
                        setInterval(() => {
                            window.location = "/hwidrequests"
                        }, 500);
                        play()
                    } else if (data.search('#error') != -1) {
                        data = data.replace('#error', ''); 
                        new Notify ({
                            title: 'Ошибка',
                            text: data,
                            status: 'error',
                            autoclose: true,
                            autotimeout: 2000                    
                        })

                        play()
                    } else {
                        new Notify ({
                            title: 'Ошибка',
                            text: 'Ошибка на стороне сервера, срочно отпишите администрации!',
                            status: 'warning',
                            autoclose: true,
                            autotimeout: 2000                    
                        })

                        play()
                    }
                }
            });
        });
        $('#no_reset_hwid').click(function(){
            $.ajax({
                type: 'GET',
                url: '/pages/sendrequest.php?type=noresethwid&name='+username,
                success: function(data) {
                    if(data.search('#yes') != -1) {
                        data = data.replace('#yes', ''); 
                        new Notify ({
                            title: 'Успешно',
                            text: data,
                            status: 'success',
                            autoclose: true,
                            autotimeout: 2000                    
                        })
                        setInterval(() => {
                            window.location = "/hwidrequests"
                        }, 500);
                        play()
                    } else if (data.search('#error') != -1) {
                        data = data.replace('#error', ''); 
                        new Notify ({
                            title: 'Ошибка',
                            text: data,
                            status: 'error',
                            autoclose: true,
                            autotimeout: 2000                    
                        })

                        play()
                    } else {
                        new Notify ({
                            title: 'Ошибка',
                            text: 'Ошибка на стороне сервера, срочно отпишите администрации!',
                            status: 'warning',
                            autoclose: true,
                            autotimeout: 2000                    
                        })

                        play()
                    }
                }
            });
        });
    });*/
    function resethwid(reqid) {
        $.get('/pages/sendrequest.php', {requestid: reqid, type: "yesresethwid"}, function(data) { 
            if (data.search('#yes') != -1) {
                data = data.replace('#yes', '');
                new Notify ({
                    title: 'Успешно',
                    text: data,
                    status: 'success',
                    autoclose: true,
                    autotimeout: 2000                    
                })
                play();
                setInterval(() => {
                    window.location = "/hwidrequests"
                }, 500);
            } else if (data.search('#error') != -1) {
                data = data.replace('#error', '');
                new Notify ({
                    title: 'Ошибка',
                    text: data,
                    status: 'error',
                    autoclose: true,
                    autotimeout: 2000                    
                })
                play();
                setInterval(() => {
                    window.location = "/hwidrequests"
                }, 500);
            }
        })
    }
    function unresethwid(reqid) {
        $.get('/pages/sendrequest.php', {requestid: reqid, type: "noresethwid"}, function(data) { 
            if (data.search('#yes') != -1) {
                data = data.replace('#yes', '');
                new Notify ({
                    title: 'Успешно',
                    text: data,
                    status: 'success',
                    autoclose: true,
                    autotimeout: 2000                    
                })
                play();
                setInterval(() => {
                    window.location = "/hwidrequests"
                }, 500);
            } else if (data.search('#error') != -1) {
                data = data.replace('#error', '');
                new Notify ({
                    title: 'Ошибка',
                    text: data,
                    status: 'error',
                    autoclose: true,
                    autotimeout: 2000                    
                })
                play();
                setInterval(() => {
                    window.location = "/hwidrequests"
                }, 500);
            }
        })
    }
</script>
<?php require_once 'pages/modals/modal_auth.php' ?>
<?php require_once 'pages/modals/request_reset_hwid.php' ?>
<?php require_once 'pages/modals/request_reset_ip.php' ?>