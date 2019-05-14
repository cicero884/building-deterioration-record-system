<div class="index">
    <header class="header">
        <img class="header__logo" src="view/web/image/logo.png" >
        <h1  class="header__title"> Save every detail. Check building safety.</h1> 
        <section class="header__link">
            <a id="link__login" class="link__item" href=" ">會員登入</a>
            <a id="link__about" class="link__item" href=" ">關於我們</a>
            <a id="link__design" class="link__item" href=" ">設計理念</a>
        </section>
    </header>

    <main class="main">
        <section class="content">
            <img class="content__logo" src="view/app/image/logos/login.png"/>
            <form id="app__login" method="post">
                <section class="login__session">
                    <img class="session__logo" src="view/app/image/icons/account.png"/>
                    <input class="session__input" type="text" name="account" id="login__account" placeholder="帳號">
                </section>
                <section class="login__session">
                    <img class="session__logo" src="view/app/image/icons/password.png"/>
                    <input class="session__input" type="password" name="password" id="login__password" placeholder="密碼">
                </section>
                <button class="login__button" type="button" id="login__button"> 立即登入</button>
            </form>
            <button class="content__signup" type="button">立即註冊</button>
            <p class="content__errMsg" id="errMsg"></p>
        </section>
        <img class="main__building" src="view/app/image/logos/house.png">
    </main>
</div>
