@extends('layout')

@section('content')

    <div class="content">
        <div class="faq">
            <div class="titlemain">
                О сайте
            </div>
            <div class="faq-content">
                <article class="faq-article">
                    <h4 class="">ЧТО ЖЕ ТАКОЕ FASTLOOT.ME?</h4>
                    <p class="faq-description">Проект FASTLOOT.ME – интернет сервис для поклонников игры
                        Counter-Strike:
                        Global Offensive, в котором каждый желающий может испытать удачу и получить крутые скины</p>

                    <ol class="accordion-container">
                        <li id="article-general" class="accordion">
                            <h2 class="accordion-title">1. ОБЩИЕ ПРАВИЛА И ВОПРОСЫ ПО ИГРЕ</h2>
                            <div class="accordion-items-container">
                                <ol class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.1</span> Какие режимы игры
                                            есть на проекте?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    <p><strong><a href="#faq/classic">Classic game</a></strong> - режим
                                                        для тех, кто любит играть
                                                        по-крупному! Желающие испытать удачу вносят ставки на общий
                                                        депозит,
                                                        который разыгрывается среди участников в конце раунда</p>
                                                    <p><a href="#faq/fast"><strong>Fast game</strong></a> - отличный
                                                        способ мгновенно испытать
                                                        удачу. В раунде этого режима участвует всего 3 игрока с
                                                        ограничением
                                                        максимальной ставки. Победитель получит депозит троих игроков
                                                    </p>
                                                    <p><a href="#faq/double"><strong>Double game</strong></a> - режим
                                                        игры, в котором Вы можете заработать монеты
                                                        (валюта сервиса) и обменять их на скины из <a
                                                                href="#bonus-shop">Магазина</a>. Угадайте победный цвет
                                                        и верните свою ставку в 2х или 14ти кратном размере</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.2</span> Как принять участие в
                                            игре?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    <ol>
                                                        <li>Авторизируйтесь на сайте</li>
                                                        <li>Укажите актуальную ссылку для обменов в разделе <a
                                                                    href="#settings">Настройки</a> (взять
                                                            её можно <a
                                                                    href="https://steamcommunity.com/id/id/tradeoffers/privacy#trade_offer_access_url">тут</a>)
                                                        </li>
                                                        <li>Откройте инвентарь в профиле Steam. Сделать это можно <a
                                                                    href="https://steamcommunity.com/id/id/edit/settings">тут</a>
                                                        </li>
                                                        <li>Выберите игру, сделайте ставку и испытайте удачу!
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.3</span> Как сделать ставку?
                                        </h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    <strong>Для Classic Game и Fast Game:</strong>
                                                    Выберите режим игры и нажмите кнопку <strong>Вложить ещё</strong>
                                                    или <strong>Сделать ставку</strong>.
                                                    Выберите скины из своего инвентаря, которые хотите отправить в виде
                                                    ставки.<br> Нажмите кнопку <strong>Предложить обмен</strong>. Бот
                                                    примет Вашу ставку и поместит её в игру<br>
                                                    <p></p>
                                                    <strong>Для Double Game:</strong> Введите желаемое количество монет
                                                    для ставки и нажмите на кнопку с цветом
                                                    сектора, который, по Вашему мнению, победит в раунде. Ставка на
                                                    выбранный цвет будет сделана автоматически
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.4</span> Что принимается в
                                            виде ставки?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    <strong>Для Classic Game и Fast Game:</strong>
                                                    Бот принимает скины только из Counter-Strike: Global Offensive.
                                                    Торговые предложения с предметами из других игр или содержащие
                                                    сувенирные предметы (кроме сувенирных наборов), будут автоматически
                                                    отклонены
                                                    <p></p>
                                                    <strong>Для Double Game:</strong> В этой игре в виде ставок
                                                    принимаются монеты. О спобах получения монет читайте <a
                                                            href="#faq/double/2">тут</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.5</span> Какая минимальная и
                                            максимальная ставки?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Ограничения для суммы ставки указаны в комнате с выбранным режимом
                                                    игры.<br>Ставки, которые не подходят под указанные параметры будут
                                                    отклонены
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.6</span> Сколько скинов
                                            принимается в одной ставке?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Допустимое количество скинов в одной ставке для Classic Game и Fast
                                                    Game указано в комнате с
                                                    выбранным режимом игры<br>Ставки, которые не подходят под указанные
                                                    параметры, будут автоматически отклонены
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.7</span> Сколько ставок можно
                                            делать в одном
                                            раунде?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Количество принимаемых ставок в одном раунде отличается для каждого
                                                    режима игры. Ознакомьтесь с ограничениями по количеству ставок в
                                                    раунде для <a href="#faq/classic/3">Classic Game</a>,
                                                    <a href="#faq/fast/3">Fast Game</a> и <a href="#faq/double/4">Double
                                                        Game</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.8</span> Какое максимальное
                                            количество скинов в
                                            раунде?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Максимальное количество скинов на депозите раунда в Classic Game и
                                                    Fast Game (если оно
                                                    предусмотрено) указано в комнате с выбранным режимом игры.
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.9</span> Какая длительность
                                            раунда?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Длительность раунда (если она предусмотрена) указана в комнате с
                                                    выбранным режимом игры
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.10</span> Как формируются цены
                                            на скины?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Цены на скины регулярно обновляются в соответствии с ценами
                                                    маркетов и устанавливаются как среднее значение за определенный
                                                    интервал времени. Цены скинов на сайте могут отличаться от цен на
                                                    торговой площадке Steam
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.11</span> Что такое система
                                            билетов?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Когда участники делают ставки, они получают виртуальные билеты,
                                                    один из которых станет победнымЗа каждый внесенный скин стоимостью
                                                    $1 Вы
                                                    получите 100 билетов. За скин, стоимостью $10, Вы получите 1000
                                                    билетов
                                                    и так далее. При игре в рублях Вы получаете количество билетов
                                                    эквивалентно установленному курсу
                                                </div>
                                                <div class="faq-notify">
                                                    Чем больше и выше Ваши ставки, тем больше билетов вы получите.<br>
                                                    Чем больше билетов, тем больше шанс получить выигрышный и стать
                                                    победителем!
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.12</span> Что такое честная
                                            игра?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    <p>В начале каждого раунда сервис генерирует случайное длинное число
                                                        от 0 до 1 (например, 0.282796734) и шифрует его через алгоритм
                                                        <a href="https://ru.wikipedia.org/wiki/SHA-2" target="_blank">sha224</a>.
                                                        Результат шифрования виден в начале раунда</p>
                                                    <p>В конце раунда сервис умножает зашифрованное ранее число на общую
                                                        сумму билетов, получая номер выигрышного билета</p>
                                                    <p>Пример: В конце раунда общий депозит составил 1000$ (100000
                                                        билетов в игре), а заданным числом было 0.282796734. Сервис
                                                        умножает
                                                        число 0.282796734 на 100000 и получает число 28279. Это и будет
                                                        номер выигрышного билета, который будет показан в момент
                                                        розыгрыша</p>
                                                    <p>Принцип работы честной игры в том, что мы не можем знать сколько
                                                        билетов будет в конце раунда, а случайное число для умножения
                                                        задается в самом начале игры. Именно поэтому у нас нет
                                                        возможности влиять на результаты розыгрыша</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.13</span> Как определяется
                                            победитель раунда?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Способы определения победителя для каждого режима игры отличаются.
                                                    Ознакомьтесь с условиями определения
                                                    победителей для <a href="#faq/classic/2">Classic Game</a>, <a
                                                            href="#faq/fast/2">Fast Game</a> и <a href="#faq/double/3">Double
                                                        Game</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.14</span> Что получает
                                            победитель раунда?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Победитель Classic Game и Fast Game забирает все внесенные в раунд
                                                    скины за вычетом комиссии
                                                    сервиса. Ознакомьтесь с условиями комиссии для <a
                                                            href="#faq/classic/6">Classic Game</a> и <a
                                                            href="#faq/fast/6">Fast Game</a>
                                                    <p></p>
                                                    Если в Double Game выпадает черный или красный сектор, то ставки
                                                    всех игроков возращаются им в 2х кратном размере.
                                                    Зеленый сектор возвращает 14ти кратную сумму ставки
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.15</span> Какая комиссия
                                            сервиса?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Комиссия зависит от выбранного режима игры и общего депозита раунда.
                                                    Ознакомьтесь с условиями комиссии для <a href="#faq/classic/6">Classic
                                                        Game</a> и <a href="#faq/fast/6">Fast Game</a>.
                                                    Режим Double Game не предусматривает какие либо виды комиссии
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.16</span> Как повысить шанс на
                                            победу?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Чем больше и выше ставка в Classic Game и Fast Game, тем больше шанс
                                                    стать победителем<br>
                                                    Максимальная ставка не гарантирует выигрыш, но значительно
                                                    увеличивает шанс победить<br>
                                                    В режиме Double Game всё зависит от Вашей удачи и способности
                                                    угадать победный сектор раунда<p></p>
                                                    Примите участие в понравившейся игре и испытайте свою удачу!
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.17</span> Когда будет выбран
                                            победитель игры?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    С данной информацией Вы можете ознакомиться в соответствующих
                                                    разделах для
                                                    <a href="#faq/classic/6">Classic Game</a>, <a href="#faq/classic/5">Fast
                                                        Game</a> и <a href="#faq/double/6">Double Game</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.18</span> Как получить
                                            выигрыш?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    <p>Выдача выигрыша в Classic Game и Fast Game производится в
                                                        автоматическом режиме нашими ботами</p>
                                                    <p>В случае победы Вы увидите всплывающее окно с поздравлением и
                                                        выигранной суммой</p>
                                                    <p>В срок от 5 до 30 минут по указанной в <a href="#settings">настройках</a>
                                                        ссылке будет отправлено торговое предложение, которое необходимо
                                                        принять</p>
                                                    <p>В редких случаях отправка выигрыша может занимать больше времени
                                                        из-за задержек Steam или трудностей с мобильными
                                                        подтверждениями</p>
                                                    <p>Если у Вас появились трудности с получением приза, обратитесь к
                                                        разделу «Получение выигрыша» или в службу круглосуточной
                                                        технической поддержки: <a href="mailto:csgofast.com@gmail.com">csgofast.com@gmail
                                                            .com</a>
                                                    </p>
                                                    <p>При победе в Double Game выигранные монеты автоматически
                                                        начисляются на Ваш баланс</p>
                                                </div>
                                                <div class="faq-notify">
                                                    Остерегайтесь мошенников! Мы никогда не добавим Вас первыми в Steam
                                                    или
                                                    социальных сетях под видом модераторов и админов, не предложим
                                                    помощь в
                                                    получении легкого выигрыша и никогда не потребуем скины назад. Мы
                                                    осуществляем поддержку только через почтовый адрес <a
                                                            href="mailto:csgofast.com@gmail.com">csgofast.com@gmail
                                                        .com</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.19</span> Могу ли я принять
                                            выигрыш позже?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Выигрыш необходимо принять сразу, как только Вы получите
                                                    предложение обмена от нашего бота<br>
                                                    Выигрыш, который не был принят в течении часа, будет аннулирован.
                                                    Это необходимо для того, чтобы инвентари ботов не забивались и
                                                    работа сервиса не приостанавливалась
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.20</span> Как получить бонус к
                                            выигрышу?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Добавьте в любое место Вашего ника приписку <a
                                                            href="#">CSGOFAST.COM</a> и получите 5% к выигрышу. Приписка
                                                    должна быть указана слитно. Данный бонус действует только для
                                                    Classic Game и Fast Game

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.21</span> Что такое партнерка?
                                        </h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    На нашем проекте работает партнерская программа. За каждого
                                                    привеченного
                                                    игрока и его игры Вы будете получать монеты, которые можно обменять
                                                    на
                                                    скины в <a href="#bonus-shop">Магазине</a>. Подробная информация
                                                    находится в разделе <a href="#referral">Партнерская программа</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.22</span> У меня проблема.
                                            Куда обращаться?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Мы всегда рады помочь в случае возникновения трудностей с нашим
                                                    сервисом. Для этого, напишите нам письмо в службу поддержки:
                                                    <a href="mailto:csgofast.com@gmail.com">csgofast.com@gmail.com</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">1.23</span> Как работает служба
                                            поддержки? Как долго ждать
                                            ответ?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Наша служба поддержки работает круглосуточно. Если Вам нужна помощь
                                                    –
                                                    напишите нам о своей проблеме по адресу <a
                                                            href="mailto:csgofast.com@gmail.com">csgofast.com@gmail
                                                        .com</a>. Как
                                                    правило, мы отвечаем в течении 60 минут, но возможны более
                                                    длительные
                                                    сроки из-за большой очереди обращений, выходных или праздничных дней
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                                <div class="faq-notify bottom">
                                    Остерегайтесь мошенников! Мы никогда не добавим Вас первыми в Steam или
                                    социальных сетях под видом модераторов и админов, не предложим помощь в
                                    получении легкого выигрыша и никогда не потребуем скины назад. Мы
                                    осуществляем поддержку только через почтовый адрес <a
                                            href="mailto:csgofast.com@gmail.com">csgofast.com@gmail.com</a>
                                </div>
                            </div>
                        </li>
                        <li id="article-bets" class="accordion">
                            <h2 class="accordion-title">2. ВОПРОСЫ ПО СТАВКАМ</h2>
                            <div class="accordion-items-container">
                                <ul class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">2.1</span> Почему бот отклоняет
                                            мою ставку?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Убедитесь в том, что:<br>
                                                    <ol>
                                                        <li>Вы отправляете скины из Counter-Strike: Global Offensive, в
                                                            обмене нет сувенирных предметов или скинов из других игр
                                                        </li>
                                                        <li>Количество скинов в ставке соответствует правилам выбранного
                                                            режима игры
                                                        </li>
                                                        <li>Сумма ставки соответствует правилам выбранного режима игры
                                                        </li>
                                                        <li>Ваш аккаунт привязан к мобильному аутентификатору
                                                            Steam Guard не менее 7 дней
                                                        </li>
                                                        <li>При обмене Вы не должны запрашивать скины у бота</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">2.2</span> Что такое Escrow?
                                        </h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Escrow – новый вид Steam Guard, который защищает пользовательские
                                                    аккаунты от несанкционированного доступа. Начиная с 09.12.15 все
                                                    обмены
                                                    в системе Steam необходимо подтверждать с помощью мобильного
                                                    аутентификатора Steam, который привязан к аккаунту не менее 7 дней.
                                                    В
                                                    противном случае обмены «замораживаются» на 72 часа для безопасности
                                                    пользователей. Наш бот принимает только те обмены, которые
                                                    подтверждены
                                                    с помощью мобильного аутентификатора Steam
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">2.3</span> Мои скины попали в
                                            другую игру</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Время входа ставки в раунд зависит от нагрузки на серверы Steam и
                                                    может
                                                    варьироваться от 2 до 180 секунд. В редких случаях вещи могут
                                                    добавляться дольше из-за экстремальной нагрузки на Steam<br>
                                                    Если вы делаете ставку перед завершением текущего раунда, она может
                                                    попасть в следующую игру. Мы не несем ответственность за подобные
                                                    ситуации, которые случаются из-за задержек Steam
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">2.4</span> Мои скины не попали
                                            ни в одну из игр </h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    <ol>
                                                        <li>Убедитесь, что Вы подтвердили ставку через мобильный
                                                            аутентификатор Steam Guard
                                                        </li>
                                                        <li>Проверьте статус обмена с нашим ботом</li>
                                                        <li>Если обмен был принят, но ставка не участвовала ни в одной
                                                            из
                                                            игр, обратитесь в службу технической поддержки:
                                                            <a href="mailto:csgofast.com@gmail.com">csgofast.com@gmail
                                                                .com</a>
                                                            с темой письма «Ставка не попала в игру»
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">2.5</span> Я отменил обмен, но
                                            ставка всё равно вошла</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Наши боты принимают входящие обмены с минимальной задержкой, после
                                                    чего отправляют скины в игру, потому отменить сделанную ставку не
                                                    всегда возможно<br>
                                                    Если Вы отменяли ставку и получили сообщение об успехе, но скины
                                                    появились в раунде, то это означает, что отмена была произведена
                                                    слишком поздно, а сообщение об успехе Вы получили из-за ошибки Steam<br>
                                                    Мы не сможем вернуть скины, которые участвовали в игре и были
                                                    разыграны
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">2.6</span> Я сделал ставку
                                            случайно, как вернуть
                                            скины?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Мы работаем только с системой обменов Steam. Каждая ставка
                                                    подтверждается с помощью мобильного аутентификатора Steam. Таким
                                                    образом, ситуации, когда вещи попали в игру без Вашего подтверждения
                                                    или
                                                    случайно исключены. Мы не сможем вернуть скины, которые участвовали
                                                    в
                                                    игре и были разыграны
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="faq-notify bottom">
                                    Остерегайтесь мошенников! Мы никогда не добавим Вас первыми в Steam или
                                    социальных сетях под видом модераторов и админов, не предложим помощь в
                                    получении легкого выигрыша и никогда не потребуем скины назад. Мы
                                    осуществляем поддержку только через почтовый адрес <a
                                            href="mailto:csgofast.com@gmail.com">csgofast.com@gmail.com</a>
                                </div>
                            </div>
                        </li>
                        <li id="article-prize" class="accordion">
                            <h2 class="accordion-title">3. ПОЛУЧЕНИЕ ВЫИГРЫША</h2>
                            <div class="accordion-items-container">
                                <ul class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">3.1</span> В какие сроки
                                            приходит выигрыш?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Выигрыш высылается автоматически одним из наших ботов в срок от 5 до
                                                    30
                                                    минут. В редких случаях отправка выигрыша может занимать больше
                                                    времени
                                                    из-за проблем в работе Steam или трудностей с мобильными
                                                    подтверждениями
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">3.2</span> Я не получил выигрыш
                                            в указанные сервисом
                                            сроки</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Если Вы не получили выигрыш в указанные сроки, проверьте
                                                    следующее:<br>
                                                    <ol>
                                                        <li>Правильность указанной ссылки в разделе <a href="#settings">Настройки</a>
                                                            (взять правильную ссылку можно <a
                                                                    href="https://steamcommunity.com/id/id/tradeoffers/privacy#trade_offer_access_url">тут</a>)
                                                        </li>
                                                        <li>В инвентаре должно быть достаточно места для принятия
                                                            выигрыша
                                                            (менее 1000 скинов для CS:GO)
                                                        </li>
                                                        <li>Ваш инвентарь должен быть открыт и публично доступен для
                                                            просмотра (проверить это можно <a
                                                                    href="https://steamcommunity.com/id/id/edit/settings">тут</a>)
                                                        </li>
                                                    </ol>
                                                    <p>Если в указанных пунктах были ошибки, и вы их устранили, то бот
                                                        автоматически отправит обмен повторно в течении 5 - 60 минут в
                                                        зависимости от нагрузки на сервера Steam</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">3.3</span> Мне пришел выигрыш,
                                            но некоторые скины
                                            недоступны для обмена</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Если вы получили торговое предложение с недоступными к обмену
                                                    скинами,
                                                    обратитесь, в службу поддержки <a
                                                            href="mailto:csgofast.com@gmail.com">csgofast.com@gmail
                                                        .com</a>
                                                    с темой письма «Не получил выигрыш»
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">3.4</span> Я случайно отменил
                                            обмен с выигрышем</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Если вы отменили торговое предложение, обратитесь в службу поддержки
                                                    <a href="mailto:csgofast.com@gmail.com">csgofast.com@gmail.com</a> с
                                                    темой
                                                    письма «Не получил выигрыш»
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">3.5</span> Как получить выигрыш,
                                            если я не получил его по
                                            какой-либо причине</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Если Вы не получили свой выигрыш по какой-либо из причин, то после
                                                    обращения в службу поддержки <a
                                                            href="mailto:csgofast.com@gmail.com">csgofast.com@gmail
                                                        .com</a>
                                                    и короткой проверки
                                                    необходимых данных мы отправим выигрыш вручную. В данной ситуации мы
                                                    оставляем за собой право выслать выигрыш случайными скинами
                                                    эквивалентно
                                                    выигранной сумме
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">3.6</span> Я получил трейд-бан,
                                            хочу выигрыш на свой
                                            второй аккаунт или на аккаунт друга</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Мы не высылаем выигрыш на другие аккаунты. <br>
                                                    Во избежание случаев мошенничества мы отправляем выигрыш только на
                                                    тот
                                                    аккаунт, который победил в игре
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="faq-notify bottom">
                                    Остерегайтесь мошенников! Мы никогда не добавим Вас первыми в Steam или
                                    социальных сетях под видом модераторов и админов, не предложим помощь в
                                    получении легкого выигрыша и никогда не потребуем скины назад. Мы
                                    осуществляем поддержку только через почтовый адрес <a
                                            href="mailto:csgofast.com@gmail.com">csgofast.com@gmail.com</a>
                                </div>
                            </div>
                        </li>
                        <li id="article-partner" class="accordion">
                            <h2 class="accordion-title">4. ПАРТНЕРСКАЯ ПРОГРАММА</h2>
                            <div class="accordion-items-container">
                                <ul class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.1</span> Что это такое?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Партнерская (реферальная программа) – система поощрения
                                                    пользователей,
                                                    которые привлекают новых игроков (рефералов) на проект. За каждого
                                                    привлеченного реферала и его игры Вы будете получать "монеты"
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.2</span> Кто считается моим
                                            рефералом?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Рефералом считается новый участник проекта, который пришел по Вашей
                                                    партнерской ссылке или ввел Ваш персональный код. Если привлеченный
                                                    игрок ранее авторизировался на проекте – реферальная программа его
                                                    не
                                                    засчитает
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.3</span> Сколько начисляется
                                            монет?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Количество монет, которое Вы получите за привлечение и игры
                                                    рефералов
                                                    указано в разделе <a href="#referral">Партнерка</a> на сайте
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.4</span> На что можно
                                            потратить монеты?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Накопленные монеты можно обменять на скины в разделе <a
                                                            href="#bonus-shop">Магазин</a>. В
                                                    нем указана стоимость скинов в монетах
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.5</span> Когда будут начислены
                                            мои монеты за приглашенных
                                            рефералов?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Начисление монеты осуществляется после первой игры приглашенного
                                                    реферала
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.6</span> Где посмотреть
                                            количество моих монет?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Количество накопленных монеты указано на главной странице сайта
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.7</span> Как обменять
                                            накопленные монеты на скины?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Обмен монет на скины осуществляется в разделе <a href="#bonus-shop">Магазин</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.8</span> Куда должны вводить
                                            мой код?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Ввод кода для новых участников проекта доступен в разделе <a
                                                            href="#referral">Партнерка</a>.
                                                    Рефералам нужно ввести код в течении 72 часов с момента первой
                                                    авторизации
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">4.9</span> Какие бонусы получает
                                            приглашенный игрок?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Каждый, кто станет Вашим рефералом, получит фиксированное количество
                                                    монеты на свой счет
                                                </div>
                                                <div class="faq-notify">
                                                    Условиями работы партнерской программы запрещено привлечение
                                                    рефералов с
                                                    помощью спама, а так же использование собственных или специально
                                                    зарегистрированных аккаунтов. Нарушители будут оштрафованы или
                                                    забанены
                                                    на проекте
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li id="article-classic" class="accordion">
                            <h2 class="accordion-title">5. ОСОБЕННОСТИ CLASSIC GAME</h2>
                            <div class="accordion-items-container">
                                <ul class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">5.1</span> В чем особенность
                                            данного режима?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Classic game - режим для тех, кто любит играть по-крупному!
                                                    Желающие испытать удачу вносят ставки на общий депозит, который
                                                    разыгрывается среди участников в конце раунда
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">5.2</span> Как определяется
                                            победитель раунда?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    В режиме Classic game победитель определяется с помощью <a
                                                            href="#faq/general/11">системы
                                                        билетов</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">5.3</span> Сколько ставок можно
                                            делать в раунде?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    В данном режиме можно делать несколько ставок в течении одного
                                                    раунда
                                                    игры
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">5.4</span> Как узнать шансы на
                                            победу?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Шансы на победу в текущем раунде указаны в процентах под аватарами
                                                    участников раунда
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">5.5</span> Когда будет выбран
                                            победитель раунда?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Победитель определится в конце времени раунда или при достижении
                                                    максимального количества скинов на депозите
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">5.6</span> Какая комиссия в
                                            данном режиме игры?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Комиссия сервиса составляет от 0-10%, в зависимости от величины
                                                    выигрыша<br>
                                                    В качестве комиссии берутся случайные скины из всего банка раунда
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li id="article-fast" class="accordion">
                            <h2 class="accordion-title">6. ОСОБЕННОСТИ FAST GAME</h2>
                            <div class="accordion-items-container">
                                <ul class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">6.1</span> В чем особенность
                                            данного режима?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Три игрока - отличный способ мгновенно испытать удачу. В раунде
                                                    этого
                                                    режима участвует всего 3 игрока с ограничением максимальной ставки.
                                                    Победитель получит депозит троих игроков
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">6.2</span> Как определяется
                                            победитель раунда?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Победитель определяется случайным образом, но чем больше ставка, тем
                                                    выше шанс победить
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">6.3</span> Сколько ставок можно
                                            делать в раунде?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    В данном режиме от каждого участника принимается одна ставка для
                                                    одного
                                                    раунда игры
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">6.4</span> Как узнать шансы на
                                            победу в раунде?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Шансы на победу в раунде указаны в процентах и находятся рядом с
                                                    суммой
                                                    ставки участников раунда (справа от аватаров и списка вложенных в
                                                    игру
                                                    скинов)
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">6.5</span> Когда будет выбран
                                            победитель игры?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Победитель определится, когда трое игроков внесут ставки в текущий
                                                    раунд
                                                    игры
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">6.6</span> Какая комиссия в
                                            данном режиме игры?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Комиссия составляет 0-15%, в зависимости от величины выигрыша<br>
                                                    В качестве комиссии берутся случайные скины из всего банка раунда
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">6.7</span> Что такое количество
                                            попыток в режиме Три
                                            игрока?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Каждые 12 часов Вам начисляется 9 попыток принять участие в игре.
                                                    Чтобы
                                                    моментально получить дополнительные попытки, сделайте ставку в
                                                    Classic game. Количество попыток не может быть больше девяти
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li id="article-double" class="accordion">
                            <h2 class="accordion-title">7. Особенности Double Game</h2>
                            <div class="accordion-items-container">
                                <ul class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">7.1</span> В чем особенность
                                            данного режима?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Double Game - режим игры, в котором игроки делают ставки на победу
                                                    черного, красного или зеленого сектора. Для ставок в данном режиме
                                                    игры используются монеты. В конце раунда будет определен цвет
                                                    победного сектора<br><br>
                                                    Если результатом розыгрыша будет красный или чёрный цвет сектора, то
                                                    сумма ставки возвращается игроку в 2х кратном размере.<br><br>
                                                    Зеленый сектор возвращает 14ти кратную сумму ставки.<br><br>
                                                    Ставки можно делать на один, два или три сектора сразу. Сумма ставки
                                                    на каждый сектор может быть разной
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">7.2</span> Как получить монеты?
                                        </h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    1. Участвуйте в партнерской программе. Приглашайте игроков
                                                    (рефералов) на проект с помощью реферальной ссылки или кода. За
                                                    каждого привлеченного реферала и его игры Вы будете получать монеты.<br><br>
                                                    2. Обменяйте свои скины стоимостью от 78 рублей на монеты. За каждые
                                                    78 копеек стоимости скинов Вы получите 1 монету. Можно отправлять до
                                                    30 предметов за раз. Для оценки стоимости рекомендуем использовать
                                                    <a href="https://chrome.google.com/webstore/detail/steam-inventory-helper/cmeakgjggjdlcpncigglobpjbkabhmjl"
                                                       target="_blank">Steam Inventory Helper</a><br>
                                                    <div class="faq-notify">
                                                        Пример: Вы отправляете нашему боту <strong>Ключ от
                                                            хромированного кейса 2</strong>, стоимостью 208,74 рублей и
                                                        <strong>Glock-18 | Дух воды (Немного поношенное)</strong>,
                                                        стоимостью 305 рублей. Общая сумма отправленных скинов
                                                        составляет 513,74 рублей. Делим число 51374 на 78 и получаем
                                                        658,64. При таком обмене Вы получите 658 монет.<br>
                                                        Стоимость одной монеты может незначительно меняться и зависит от
                                                        текущего курса. Для оценки своих скинов рекомендуем использовать
                                                        Steam Inventory Helper
                                                    </div>
                                                    3. Пополните баланс с помощью платежной системы. Выберите удобный
                                                    способ оплаты и получите необходимое количество монет на свой
                                                    аккаунт
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">7.3</span> Как определяется
                                            победный сектор (честная игра)?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    В начале каждого раунда сервис генерирует случайное длинное число от
                                                    0 до 1 (например, 0.223088) и шифрует его через алгоритм <a
                                                            href="https://ru.wikipedia.org/wiki/SHA-2" target="_blank">sha224</a>.
                                                    Результат шифрования виден в начале раунда. В конце раунда сервис
                                                    умножает зашифрованное ранее число на 15, получая номер победного
                                                    сектора.<br><br>
                                                    <span style="font-style: italic">Пример: В начале раунда было зашифровано число 0.223088232334703230728. Сервис умножает число 0.223088232334703230728 на 15 и получает число 3,34632348495. Целым числом результата умножения получилось число 3 (красный сектор). В данном раунде победят игроки, которые делали ставки на победу красного сектора</span><br><br>
                                                    Вы можете самостоятельно проверить правильность определения
                                                    победного сектора. Для этого в конце раунда возьмите число, которое
                                                    было зашифровано и повторно закодируйте его с помощью любого из
                                                    онлайн сервисов, например <a
                                                            href="http://www.miniwebtool.com/sha224-hash-generator/"
                                                            target="_blank">http://www.miniwebtool.com/sha224-hash-generator/</a>.
                                                    Вы увидите то же значение hash, что и в начале раунда. Это означает
                                                    что результат игры не был подстроен.<br><br>
                                                    <b>Поскольку система определяет победный сектор ещё до начала игры и
                                                        любой игрок может проконтролировать отсутствие его изменений -
                                                        вмешательство в игру для нас теряет смысл. Поэтому эта система
                                                        является гарантом честности наших игр.</b>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">7.4</span> Сколько ставок можно
                                            делать в раунде?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Вы можете увеличивать свои ставки неограниченное количество раз до
                                                    начала розыгрыша. Ставки можно делать на один, два или три сектора
                                                    сразу. Сумма ставки на каждый сектор может быть разной
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">7.5</span> Какие ограничения
                                            есть для ставок?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    На один цвет Вы можете поставить не более 1500000 монет
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">7.6</span> Когда начнется выбор
                                            победного сектора?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Победный сектор определится в конце времени раунда
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">7.7</span> Есть ли комиссия в
                                            данном режиме игры?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Данный режим игры не предусматривает какие либо виды комиссии
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li id="article-duel" class="accordion">
                            <h2 class="accordion-title">8. ОСОБЕННОСТИ DUEL GAME</h2>
                            <div class="accordion-items-container">
                                <ul class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">8.1</span> В чем особенность
                                            данного режима?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Камень-ножницы-бумага - игра для двоих участников, победитель
                                                    которой определяется с помощью одной из трех фигур вытянутой руки.
                                                    Игра Duel имеет схожий принцип. Проверьте свою интуицию и
                                                    заработайте Монеты!
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">8.2</span> Как победить в Duel
                                            Game?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Выберите оружие и сразитесь в дуэли с другим участником. <strong>KNIFE
                                                        побеждает AWP, AWP побеждает AK-47, AK-47 побеждает
                                                        KNIFE</strong>. Если оба дуэлянта выбрали одинаковое оружие -
                                                    дуэль не состоялась, монеты за ставку возвращаются в полном объеме
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">8.3</span> Как принять участие в
                                            игре?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-text">
                                                <div class="accordion-item-description">
                                                    <strong>Создайте игру</strong>: Укажите количество Монет, которое
                                                    хотите поставить на кон и выберите оружие, с которым будете
                                                    участвовать в дуэли. К вам подключится ближайший игрок, который
                                                    готов поставить такую же сумму на кон<br><br>
                                                    <strong>Примите вызов</strong>: Выберите в списке игр соперника,
                                                    который создал игру и ждет оппонента. Нажмите кнопку <strong>Принять
                                                        вызов</strong>. Принимая вызов вы ставите на кон ту же ставку
                                                    что и создатель дуэли
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">8.4</span> Когда начнется дуэль?
                                        </h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-text">
                                                <div class="accordion-item-description">
                                                    <strong>Если вы создали игру</strong>: Дождитесь пока к Вам
                                                    подключится соперник, который готов поставить на кон такое же
                                                    количество Монет. После этого противнику необходимо выбрать оружие,
                                                    а Вам изменить или подтверить свой выбор оружия, нажав кнопку
                                                    <strong>Готов</strong>. Исход дуэли отобразится когда оба игрока
                                                    выберут оружие<br><br>
                                                    <strong>Если вы подключились к игре</strong>: После подключения к
                                                    игре Вам необходимо выбрать оружие с которым Вы будете участвовать в
                                                    дуэли. После выбора оружия нажмите кнопку <strong>Готов</strong>.
                                                    Исход дуэли отобразится когда оба игрока выберут оружие
                                                    <div class="faq-notify">
                                                        Если во время дуэли один из игроков не выбрал оружие за
                                                        отведенное для этого время, то оно будет случайно выбрано
                                                        автоматически.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">8.5</span> Что получает
                                            победитель дуэли?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-text">
                                                <div class="accordion-item-description">
                                                    Победитель дуэли получает количество монет, которое указано в окне
                                                    <strong>На кону</strong>.<br><br>
                                                    <span class="faq-italic">Например: Если оба игрока делают ставку в 1000 Монет, то победитель дуэли получит 1900 Монет.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">8.6</span> Возможно ли
                                            участвовать в нескольких дуэлях одновременно?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-text">
                                                <div class="accordion-item-description">
                                                    Нет, одновременно можно участвовать только в одной дуэли
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li id="article-commission" class="accordion">
                            <h2 class="accordion-title">10. КОМИССИЯ СЕРВИСА</h2>
                            <div class="accordion-items-container">
                                <ul class="accordion-items-list">
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">10.1</span> Какая комиссия
                                            сервиса?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    Комиссия зависит от выбранного режима игры и общего депозита раунда.
                                                    Ознакомьтесь с условиями комиссии для <a href="#faq/classic/6">Classic
                                                        Game</a> и <a href="#faq/fast/6">Fast Game</a>.
                                                    Режим Double Game не предусматривает какие либо виды комиссии
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">10.2</span> В комиссию ушли мои
                                            скины. Как получить их
                                            назад или обменять на другие?</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-description">
                                                <div class="accordion-item-text">
                                                    В качестве комиссии берутся случайные скины из депозита раунда<br>
                                                    У нас нет возможности вернуть взятые в виде комиссии скины или
                                                    обменять
                                                    их на другие
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion-item">
                                        <h2 class="accordion-item-title"><span
                                                    class="accordion-item-title-number">10.3</span> Сервис взял большую
                                            комиссию</h2>
                                        <div class="accordion-item-text-container">
                                            <div class="accordion-item-text">
                                                <div class="accordion-item-description">
                                                    Если сервис удержал комиссию, которая больше заявленной данными
                                                    правилами, обратитесь в службу поддержки: <a
                                                            href="mailto:csgofast.com@gmail.com">csgofast.com@gmail
                                                        .com</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li id="article-chat-rules" class="accordion">
                            <h2 class="accordion-title">11. ПРАВИЛА ЧАТА</h2>
                            <div class="accordion-only-text">
                                <div class="accordion-text">
                                    <strong>В чате запрещено:</strong>
                                    <ol>
                                        <li>Оскорблять, унижать и угрожать другим участникам проекта</li>
                                        <li>Просить скины, заниматься попрошайничеством</li>
                                        <li>Размещать любые ссылки, которые не относятся к работе сервиса</li>
                                        <li>Размещать рекламные ссылки, рекламировать и упоминать сторонние сервисы и
                                            сообщества по CS:GO
                                        </li>
                                        <li>Спамить и флудить</li>
                                        <li>Постить реферальные ссылки и коды</li>
                                        <li>Выдавать себя за администратора или модератора сервиса</li>
                                        <li>Имитировать ник или аватар системных сообщений</li>
                                        <li>Предлагать покупку, продажу скинов и игровых ценностей в обход магазина
                                            сервиса
                                        </li>
                                        <li>Предлагать покупку, продажу и буст аккаунтов</li>
                                        <li>Отправлять в чат номера телефонов, месенджеров, электронных кошельков</li>
                                        <li>Устраивать конфликтные ситуации в другом языковом чате</li>
                                        <li>Общаться на политические или религиозные темы</li>
                                        <li>Проявлять признаки расизма и национализма</li>
                                        <li>Пропагандировать наркотики, алкоголь, насилие</li>
                                        <li>Оскорблять и угрожать администрации сервиса</li>
                                    </ol>

                                    <div class="faq-notify faq-chat-rules-notify">
                                        Нарушители будут заблокированы на всех каналах чата на срок от 10 минут до
                                        пожизненной блокировки.<br>
                                        Модерирование чата происходит в ручном и автоматическом режимах.<br>
                                        Срок действия повторных блокировок увеличивается по времени автоматически.<br>
                                        Обжалование полученного бана на срок от одной недели осуществляется через тех.
                                        поддержку.<br>
                                        Модераторы имеют право удалять сообщения или забанить участника чата без
                                        объяснения причин.
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ol>
                </article>
            </div>
        </div>

    </div>

@endsection