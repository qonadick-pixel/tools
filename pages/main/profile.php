<?php require_once 'sidebar.php' ?>
<div class="main-container">
    <div class="main-container-header">
        <div class="mch-card">
            <div class="mch-card-main">
                <div class="mch-card-main-photo">
                    <input type="file" id="upload-file" hidden="hidden">
                    <button class="upload-button" id="upload-button" onclick="upload()">
                        <span><i class="fa-solid fa-upload"></i></span>
                    </button>
                </div>
                <div class="card-user-info">
                    <div class="mchcmd-status"><a>
                        <?php 
                        if($user['status'] == 'user') {
                            echo '<span class="badge badge-secondary">Пользователь</span>';
                        } else if($user['status'] == 'admin') {
                            echo '<span class="badge badge-secondary" style="background: #73b461;">Администратор</span>';
                        } else if($user['status'] == 'dev') {
                            echo '<span class="badge badge-secondary" style="background: #be2d2d;">Разработчик</span>';
                        } else if($user['status'] == 'support') {
                            echo '<span class="badge badge-secondary" style="background: #80BFFF;">Поддержка</span>';
                        }
                        ?>
                    </a></div>
                    <div class="mch-card-main-name">
                        <?php echo $user['name'] ?></a>
                    </div>
                </div>
                <div class="mch-card-main-data">
                    <div class="mchcmd-days"><p href="#"> <?php 
                    $sql = "SELECT DATEDIFF(now(), '".$user['date_creation']."')";
                    $res = mysqli_query($con, $sql);
                    $row = mysqli_fetch_row($res);
                    echo 'Зарегистрирован '.$row[0].' дней<br>Номер аккаунта: #'.$user['id'].'<br>Ваша почта: '.$user['email'];
                    ?>
                    </p></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const uploadFile = document.getElementById("upload-file");

    function upload() {
        uploadFile.click();
    }
</script>
<?php require_once 'pages/modals/modal_auth.php' ?>