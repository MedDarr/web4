<!DOCTYPE html>
  <html lang="ru">
    <head>
      <title>My website</title>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <header>
  <div class="form">
       <h1 id="p3">Форма:</h1>
      <div class="form-decor">
        <form action="index.php" method="POST">
  
          <label> Имя:<br>
          <input type="text"  name="name"  placeholder="Введите имя">
          </label>
        
          <label><br>E-mail:<br>
          <input type="email"  name="email"  placeholder="Введите  email">
          </label>
          
          <label><br>ГОД:<br>
            <select id="year" name="year">
            <?php
                for ($i = 1922; $i <= 2022; $i++) {
                printf('<option value="%d">%d год</option>', $i, $i);
                }
            ?>
            </select>
          </label><br>
          
            <label><br>Пол:<br>
          <input type="radio" name="pol" value="w" >Женский</label>
          <label><input type="radio" name="pol" value="m" >Мужской</label>
          
             <label><br>Количество конечностей:<br>
            <input type="radio"  name="kolvo" value="2" >2</label>
            <label><input type="radio" name="kolvo" value="3" >3</label>
            <label><input type="radio" name="kolvo" value="4" >4</label>
          <label>
            <br>Сверхспособности:<br>
            <select name="sposobn[]" multiple="multiple">
            <option value="immortal">бессмертие</option>
            <option value="throughwalls" >прохождение сквозь стены</option>
             <option value="levitation" >левитация</option>
           </select>
          </label>
          <label>
          <br>Биография:<br>
          <textarea name="bio" placeholder="Расскажите о себе"></textarea>
          </label><br>
          
          <label><input type="checkbox" name="info"><strong>C контрактом ознакомлен(а)</strong></label><br>
          <input type="submit" value="Отправить">
  
         </form>
      </div>
      </div>
      </body>
  </html>
