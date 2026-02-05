        <?php require_once 'sidebar.php' ?> 
         <div class="app-content app-content--sidebar">
            <div class="app-content-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="card">
 
                        <!-- HTML кнопки -->
                        
                        <button id="myBtn" class="myBtn"><i class="fa fa-user-plus" aria-hidden="true"></i> Создать аккаунт</button>
                        <div id="myModal" class="modal">
                           <div class="modal-content">
                              <div class="modal-content-head">
                                 <div><p>Добавить юзера</p></div>
                              </div>
                              <div class="modal-content-main">
                                 <div>
                                    <label>Имя юзера</label>
                                    <input type="text">
                                 </div>
                                 <div>
                                    <label>Пароль</label>
                                    <input type="password">
                                 </div>
                                 <div>
                                    <label>Подписка</label>
                                    <input type="text">
                                 </div>
                                 <div>
                                    <label>Срок действия подписки</label>
                                    <input type="datetime-local">
                                 </div>
                              </div>
                              <div class="modal-content-footer">
                                 <div class="modal-content-footer-btn"><p>Создать</p></div>
                              </div>
                           </div>
                        </div>

                  
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <th scope="col" style="width: 14,3%">
                                       Пользователь<br>
                                    </th>
                                    <th scope="col" style="width: 14,3%;">
                                       HWID<br>
                                    </th>
                                    <th scope="col" style="width: 14,3%">
                                       IP адрес<br>
                                    </th>
                                    <th scope="col" style="width: 14,3%">
                                       Дата создания<br>
                                    </th>
                                    <th scope="col" style="width: 14,3%">
                                       Дата последнего входа<br>
                                    </th>
                                    <th scope="col" style="width: 14,3%">
                                       Бан пользователя<br>
                                    </th>
                                    <th scope="col" style="width: 14,3%">
                                       Действие<br>
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $result=mysqli_query($con,'SELECT * FROM qwe_users ORDER BY name DESC LIMIT 0,200');
                                    // берем результаты из каждой строки
                                    while($row=mysqli_fetch_array($result))
                                    
                                    echo '
                                    <tr>
                                    <td>
                                       '.$row['name'].'                                                    
                                    </td>
                                    <td>
                                       '.$row['hwid'].'
                                    </td>
                                    <td>
                                       '.$row['ip_address'].'                                                 
                                    </td>
                                    <td>
                                       '.$row['date_creation'].'
                                    </td>
                                    <td>
                                       '.$row['date_last_join'].'
                                    </td>
                                    <td>
                                       Не забанен
                                    </td>
                                    <td>
                                       <div class="btn btn-tiny" style="background-color: #6b73ff;color: #fff;padding: 3px 42px;">
                                          Действия
                                       </div>
                                    </td>
                                 </tr>';
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		