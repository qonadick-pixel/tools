<?php 
    require_once 'sidebar.php';
    
    if (isset($_GET['calendar'])) {
        $calendar = $_GET['calendar'];
        switch($calendar) {
            case 'Сегодня': $calendar = date('Y-m-d'); break;
            case 'Вчера': $calendar = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); break;
            default: $calendar = $_GET['calendar']; break;
        }
    } else {
        $calendar = date('Y-m-d');
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
                            $sql = $con->query("SELECT * FROM `qwe_stats` WHERE `date`='{$calendar}'");
        
                            while($r = mysqli_fetch_assoc($sql)) {
                                $total_rows = $r['unique_activations'];
                            }
                            echo 'Авторизовалось пользователей: '. $total_rows;
                            ?>
                        </p>
                    </div>
                    <form id="form_calendar">
                        <input type="date" name="calendar" value="<? echo $calendar ?>">
                        <input type="submit" value="применить">
                    </form>
                    <form id="select_date">
                        <input type="submit" name="calendar" value="Сегодня">
                        <input type="submit" name="calendar" value="Вчера">
                        <input type="submit" name="calendar" value="Текущий месяц">
                        <input type="submit" name="calendar" value="Прошлый месяц">
                    </form>
                    <div class="label__table">
                        <p>Кол-во людей авторизовавшихся в скрипт</p>
                    </div>
                </div>
                <canvas id="myChart" style="width: 100%; height: 40vh"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    
    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            url: '/engine/core/getstats.php',
            data: $('#form_calendar').serialize(),
            cache: false,
            success: function(response)
            {
                console.log($("#form_calendar").serialize());
                if (response.search('<script>') != -1) {
                    console.log(response)
                }
                var jsonData = JSON.parse(response);
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'],
                        datasets: [{
                            label: 'Кол-во людей авторизовавшихся в скрипт',
                            data: jsonData,
                            borderWidth: 1,
                            borderColor: '#7CFC00',
                        }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                });
            }
        });
    });
</script>
<?php require_once 'pages/modals/modal_auth.php' ?>