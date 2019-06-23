<header>
    <!--和前一頁基本上一模一樣-->
</header>
<main class="building" id=<?php echo "building__".$this->buildingDetail['buildingId']?>>
    <section class="building__info">
        <p>地址</p>     <p> <?php echo $this->buildingDetail['address'] ?></p> 
        <br/>
        <p>屋主姓名</p>  <p> <?php echo $this->buildingDetail['name'] ?></p>
        <p>屋主電話</p>  <p> <?php echo $this->buildingDetail['phone']?></p>
        <br/>
        <p>建築物種類</p> <p> <?php echo $this->buildingDetail['type'] ?></p>
        <p>建築用途</p> <p> <?php echo $this->buildingDetail['usage'] ?></p>
        <p>建築結構</p> <p> <?php echo $this->buildingDetail['structure'] ?></p>
        <p>建築規模</p> <p> 地上 <?php echo $this->buildingDetail['floorUpper']?>
                           地下 <?php echo $this->buildingDetail['floorDown']?></p>
    </section>
    <img class="building__image" alt = 'building_picture' src = <?php echo $this->buildingDetail['image'] ?> >
</main>
<main class="detail">
    <section class="floor__info">
        <article class="info__floor-plan">
            <p class="floor-plan__title" >地下一樓</p>
            <img class="floor-plan__image"/>
        </article>
        <article class="info__deterioration">
            <p class="deterioration__tite"></p>
            <table class="deterioration__table">
                <tr>
                    <th>編號</th>
                    <th>劣化位置</th>
                    <th>剝落</th>
                    <th>裂縫</th>
                    <th>鋼筋外露</th>
                    <th>加蓋處</th>
                    <th>圖片</th>
                </tr>
            </table>
        </article>
    </section>
</main>
<button id="pdf-download">PDF 下載</button>