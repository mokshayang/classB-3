<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">

    <div id="abgne-block-20111227">
      <ul class="lists">
      </ul>
      <ul class="controls">
      </ul>
    </div>

  </div>
</div>



<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab" style="width:95%;">

    <div style="display:flex;flex-wrap:wrap">
      <?php
      $today = date("Y-m-d");
      $ondate = date("Y-m-d", strtotime("-2 days")); //開始日期
      $all = $Movie->count(['sh' => 1], " &&  ondate between '$ondate' AND '$today'");
      $div = 4;
      $pages = ceil($all/$div);
      $now = $_GET['p']??1;
      $start = ($now-1)*$div;
      // $rows= $Movie->all(['sh'=>1]," && (ondate >= '$ondate') && (ondate = '$today') order by rank");//顯示與排序
      $rows = $Movie->all(['sh' => 1], " &&  ondate between '$ondate' AND '$today' order by rank limit $start,$div" ); //顯示與排序
      foreach ($rows as $key => $row) {

      ?>
        <div style="width:45%;margin:0.5%;border:1px solid white;border-radius:0.5%;padding: 5px;">
          <div>片名<?= $row['name'] ?></div>
          <div style="display:flex">
            <img src="./upload/<?= $row['poster'] ?>" 
            style="width:60px;height:80px;" 
            onclick="location.href='?do=intro&id=<?= $row['id'] ?>'">
          </div>
          <div>
            <p>分級<img src="./icon/03C0<?= $row['level'] ?>.png" alt=""></p>
            <p>上映日期<?= $row['ondate'] ?></p>
          </div>
          <div>
            <button onclick="location.href='?do=intro&id=<?= $row['id'] ?>'">劇情簡介</button>
            <button onclick="location.href='?do=order&id=<?= $row['id'] ?>'">線上訂票</button>
          </div>
          <div></div>

        </div>
      <?php } ?>

    </div>

    <div class="ct"> </div>
  </div>
</div>