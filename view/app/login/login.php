<header class="header">
    <img class="header__logo" src="view/web/image/logo.png" >
    <h1  class="header__title"> Save every detail. Check building safety.</h1> 
    <section class="header__link">
        <a id="link__login" class="link__item" href=" ">會員登入</a>
        <a id="link__about" class="link__item" href=" ">關於我們</a>
        <a id="link__design" class="link__item" href=" ">設計理念</a>
    </section>
</header>

<main class="content">
    <img class="content__logo" src="view/app/image/logos/login.png"/>
    <form id="app__login" method="post">
        <section class="login__session">
            <img class="session__logo" src="view/app/image/icons/account.png"/>
            <input class="session__input" type="text" name="account" id="login__account">
        </section>
        <section class="login__session">
            <img class="session__logo" src="view/app/image/icons/password.png"/>
            <input type="password" name="password" id="login__password">
        </section>
        <button type="button" id="login__button">Login</button>
        <p id="errMsg"></p>
    </form>
    <button type="button">立即註冊</button>
</main>
