<header class="header">
                <img class="header__logo" src="./view/web/image/Logo.png"/>
                <h1  class="header__word"> Save every detail. Check building safety.</h1> 
                <section class="header__link">
                    <a class="link__item" href=" ">會員登入</a>
                    <a class="link__item" href=" ">關於我們</a>
                    <a class="link__item" href=" ">設計理念</a>
                </section>
</header>
<article class="test" id="information__building">
    <main class="building" id=<?php echo "building__".$this->buildingDetail['buildingId']?>>
        <img class="building__title" src="./view/web/image/title2.png"/>
        <button id="pdf-download">PDF 下載</button>
        <section class="building__info">
            <p class="first_info">地址: </p>     <p class="first1_info"> <?php echo $this->buildingDetail['address'] ?></p> 
            <p class="second1_info">屋主姓名: </p>  <p class="second11_info"> <?php echo $this->buildingDetail['name'] ?></p>
            <p class="second2_info">屋主電話: </p>  <p class="second21_info"> <?php echo $this->buildingDetail['phone']?></p>
            <p class="third1_info">建築種類: </p> <p class="third11_info"> <?php echo $this->buildingDetail['type'] ?></p>
            <p class="third2_info">建築用途: </p>  <p class="third21_info"> <?php echo $this->buildingDetail['usage'] ?></p>
            <p class="third3_info">建築結構: </p> <p class="third31_info"> <?php echo $this->buildingDetail['structure'] ?></p>
            <p class="fourth_info">建築規模: </p> <p class="fourth1_info"> 地上 <?php echo $this->buildingDetail['floorUpper']?>
                            地下 <?php echo $this->buildingDetail['floorDown']?></p>
        </section>
        <img class="building__image" alt = 'building_picture' src = <?php echo $this->buildingDetail['image'] ?> >
    </main>
    <main class="detail">
        <section class="floor__info">
            <article class="info__floor-plan">
                <h2 class="footer__pictureinfo">平面圖</h2> 
                <p class="floor-plan__title" >地下一樓</p>
                <img class="floor-plan__image"/>
            </article>
            <article class="info__deterioration">
                <h2 class="footer__deteriortitle">建築劣化資料</h2>
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
</article>

