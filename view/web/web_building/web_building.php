<header>
    <!--和前一頁基本上一模一樣-->
</header>
<main class="building">
    <section class="building__info">
        <p>地址</p>     <p> <?php echo $this->buildingDetail['address'] ?></p> 
        <br/>
        <p>屋主姓名</p>  <p> <?php echo $this->buildingDetail['name'] ?></p>
        <p>屋主電話</p>  <p> <?php echo $this->buildingDetail['phone']?></p>
        <br/>
        <p>建築物種類</p> <p> <?php echo $this->buildingDetail['type'] ?></p>
        <p>建築用途</p> <p> <?php echo $this->buildingDetail['usage']?></p>
        <p>建築結構</p> <p> <?php echo $this->buildingDetail['structure']?></p>
        <p>建築規模</p> <p> 地上 <?php echo $this->buildingDetail['floorUpper']?>
                           地下 <?php echo $this->buildingDetail['floorDown']?></p>
    </section>
    <img class="building__image" src = <?php echo $this->buildingDetail['image']?> >
</main>