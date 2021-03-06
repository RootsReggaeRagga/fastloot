/*
 Автор : ДикиЙ [Islam]
 Дата : 15.06.2016
 Skype : kudo070
 VK : vk.com/kudo070
 Mail : islam7450@yandex.ru
 Все права принадлежат мне , любое копирование без моего разрешение карается римнём по попе .
 */
/* GLOBAL SETTINGS */
socket = io.connect(':7777', {secure: true}); // SOCKET
rooms = ['roulette', 'fast', 'double', 'duel']; // ROOMS
sounds = $.cookie('sounds');
room = $.cookie('room');
timerStatus = true;
ngtimerStatus = true;
var showActivity = function (room, avatar, price) {
    var f = $('.game-selector-item[data-room-name="' + room + '"] .game-selector-item-new-trade');

    f.find(".game-selector-item-new-trade-avatar")
        .css({
            "background-image": 'url("' + avatar + '")'
        }), f.find(".game-selector-item-new-trade-sum")
        .text(price), f.css({
        transition: "transform 0s, opacity 0s"
        , transform: "translate3d(0,0,0)"
        , opacity: 1
    }),
        setTimeout(function () {
            f.css({
                transition: "transform 0.5s, opacity 0.5s"
                , transform: "translate3d(0,-15px,0)"
                , opacity: 0
            })
        }, 500);


}
var reload = function () {

    if (sounds == 'on') {
        $('.sound-sprite').addClass('enable');
    } else {
        $('.sound-sprite').removeClass('enable');
    }
    for (var i = 0; i < rooms.length; i++) {
        if (rooms[i].toString() != room) {
            $('.wrapper .gameinf .left .room li[data-room-name="' + rooms[i].toString() + '"]').removeClass('active');
            $('#' + rooms[i].toString()).hide();
        } else {
            $('.room-name').text(room.charAt(0).toUpperCase() + room.substr(1) + ' game');
            $('.wrapper .gameinf .left .room li[data-room-name="' + room + '"]').addClass('active');
            $('#' + room).show();
            socket.emit('getchat', {room});
        }
    }
}
if ('undefined' == typeof room) {
    rooms = 'roulette';
    $.cookie('room', 'roulette', {expires: 365});
    reload();
}
/* GLOBAL SETTINGS */
/* csrf */
var initAjaxToken = function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        statusCode: {
            500: function () {
                return;
            }
        }
    });
};
initAjaxToken();
/* csrf */
/* PAGE GO */
var mw = ($('html, body').width() - 800) / 2;
if ($('.autowr').css('padding-left', mw + 'px').css('padding-right', mw + 'px')) {
    $('body').show();
    history.pushState({link: location.href}, '', location.href);
}

$(window).scroll(function () {
    if ($(document).scrollTop() > ($(window).height() / 2))
        $('.scroll_fix_bg').fadeIn(200);
    else
        $('.scroll_fix_bg').fadeOut(200);
});
window.onload = function () {
    window.setTimeout(function () {
            window.addEventListener('popstate', function (e) {
                    e.preventDefault();
                    if (e.state && e.state.link) Page.Go(e.state.link, {no_change_link: 1});
                },
                false);
        },
        1);
}
var Page = {
    Go: function (h) {
        initAjaxToken();
        history.pushState({link: h}, null, h);
        $.get(h, function (data) {
            $('#main').html(data);
            reload();
            timerStatus = true;
            ngtimerStatus = true;
            $('.tooltip').tooltipster({'multiple': true});
        });
    },
    Prev: function (h) {
        initAjaxToken();
        $.get(h, function (data) {
            $('#main').html(data);
            reload();
            timerStatus = true;
            ngtimerStatus = true;
            $('.tooltip').tooltipster({'multiple': true});
        });
    }
}
/* PAGE GO */
$('body').ready(function () {

    $('.tooltip').tooltipster({'multiple': true});
    $('body').on('click', '.modal-content .inventory  .deposit span:nth-child(1)', function (e) {
        if (parseInt($('.modal-content .inventory .info span.countitem').text()) == 0) {
            return showmessages('error', 'Вы не выбрали вещей!');

        }
        var items = [];
        $('.modal-content .inventory .items .itm.active').each(function () {
            items.push($(this).attr("data-id"));
        });
        $.post('/newdeposit', {items: JSON.stringify(items)}, function (data) {
            if (data.errors) {
                showmessages('error', data.errors);
            }
            $('.modal-content .inventory .itm').removeClass('active');
            $('.modal-content .inventory .info span.countitem').text(0);
            $('.modal-content .inventory .info span.price').text(0);
        });
    });


    $('body').on('click', '.wrapper .inventory .deposit span:nth-child(2)', function (e) {
        if (parseInt($('.wrapper .inventory .info span.countitem').text()) == 0) {
            return showmessages('error', 'Вы не выбрали вещей!');

        }
        var items = [];
        $('.wrapper .inventory .items .itm.active').each(function () {
            items.push($(this).attr("data-id"));
        });
        $.post('/newbet', {items: JSON.stringify(items)}, function (data) {
            if (data.errors) {
                showmessages('error', data.errors);
            } else if (data.success) {
                items.forEach(function (i) {
                    $('.wrapper .inventory .items .itm[data-id=' + i + ']').remove();
                });
                $('.wrapper .inventory .items .itm').removeClass('active');
                $('.wrapper .inventory .info span.countitem').text(0);
                $('.wrapper .inventory .info span.price').text(0);

            }

        });
    });

    $('body').on('click', '.wrapper .inventory .deposit span:nth-child(3)', function (e) {
        if (parseInt($('.wrapper .inventory .info span.countitem').text()) == 0) {
            return showmessages('error', 'Вы не выбрали вещей!');

        }
        var items = [];
        $('.wrapper .inventory .items .itm.active').each(function () {
            items.push($(this).attr("data-id"));
        });
        $.post('/without', {items: JSON.stringify(items)}, function (data) {
            if (data.errors) {
                showmessages('error', data.errors);
            } else if (data.success) {
                items.forEach(function (i) {
                    $('.wrapper .inventory .items .itm[data-id=' + i + ']').remove();
                });
                $('.wrapper .inventory .items .itm').removeClass('active');
                $('.wrapper .inventory .info span.countitem').text(0);
                $('.wrapper .inventory .info span.price').text(0);
                my_inventory();
                my_inventory_tosite();
            }

        });
    });


    $('body').on('click', '.modal-content .inventory .items .itm', function (e) {
        $(e.currentTarget).toggleClass("active");
        if ($(this).hasClass('active')) {
            $('.modal-content .inventory .info span.countitem').text(parseInt($('.modal-content .inventory .info span.countitem').text()) + 1);
            $('.modal-content .inventory .info span.price').text(parseInt($('.modal-content .inventory .info span.price').text()) + parseInt($(this).find('.price').text()));
        } else {
            $('.modal-content .inventory .info span.price').text(parseInt($('.modal-content .inventory .info span.price').text()) - parseInt($(this).find('.price').text()));
            $('.modal-content .inventory .info span.countitem').text(parseInt($('.modal-content .inventory .info span.countitem').text()) - 1);
        }
    });

    $('body').on('click', '.wrapper .inventory .items .itm', function (e) {
        $(e.currentTarget).toggleClass("active");
        if ($(this).hasClass('active')) {
            $('.wrapper .inventory .info span.countitem').text(parseInt($('.wrapper .inventory .info span.countitem').text()) + 1);
            $('.wrapper .inventory .info span.price').text(parseInt($('.wrapper .inventory .info span.price').text()) + parseInt($(this).find('.price').text()));
        } else {
            $('.wrapper .inventory .info span.countitem').text(parseInt($('.wrapper .inventory .info span.countitem').text()) - 1);
            $('.wrapper .inventory .info span.price').text(parseInt($('.wrapper .inventory .info span.price').text()) - parseInt($(this).find('.price').text()));
        }
    });
    /* DUEL */

    $('body').on('click', '.duel-room .room-header .bet-block .duel-weapons-container .duel-weapons .duel-weapon', function (e) {
        if ($('.duel-room .room-header .bet-block .duel-weapons-container').hasClass('available') && !$('.duel-room .room-header .bet-block .duel-weapons-container .duel-weapons .duel-weapon').hasClass('active')) {
            $(this).addClass("active");
            $('.duel-room .room-header .bet-block .bet-button').addClass('available').removeClass('disabled');
        } else if ($(this).hasClass('active')) {
            $(this).removeClass("active");
            $('.duel-room .room-header .bet-block .bet-button').addClass('disabled').removeClass('available');
        }
        //  .duel-room .room-header .bet-block .duel-weapons-container .duel-weapons .duel-weapon

    });
    $('body').on('input', '.duel-room .room-header .bet-block .bet-value-container .input-container .bet-value-input', function () {
        var val = $(this).val();
        if (parseInt(val) > 0) {
            $('.duel-room .room-header .bet-block .duel-weapons-container').addClass('available');
        } else {
            $('.duel-room .room-header .bet-block .duel-weapons-container').removeClass('available');
        }
    });

    $('body').on('click', '.duel-room .room-header .description .description-item .description-text #inf', function (e) {
        $(e.currentTarget).toggleClass("more").next("description-item-tutorial");
        if ($(this).hasClass('more')) {
            $(this).text('Подробнее >').removeClass('roll-up').addClass('more').css({display: 'inline'});
            $('.description-item-tutorial').addClass('hidden');
        } else {
            $(this).text('Свернуть').removeClass('more').addClass('roll-up').css({display: 'block'});
            $('.description-item-tutorial').removeClass('hidden');
        }
    });
    /* DUEL */
    /* HISTORY */
    $('body').on({
        mouseenter: function () {
            var cur = $(this);
            var cur_image = cur.attr('data-image');
            var cur_title = cur.attr('data-title');
            var cur_price = cur.attr('data-price');
            var cur_avatar = cur.attr('data-player-avatar');
            var cur_color = cur.attr('data-color');
            $('body').append('<div class="history-item-prize-drop">' +
                '<div class="history-item-prize-drop-top">' +
                '<div class="history-item-prize-drop-left" style="background: ' + cur_color + '">' +
                '<div class="history-item-prize-drop-image">' +
                '<img src="' + cur_image + '" alt="image">' +
                '</div></div>' +
                '<div class="history-item-avatar-container" style="">' +
                '<img class="history-item-avatar" src="' + cur_avatar + '" alt="image">' +
                '</div>' +
                '<div class="history-item-prize-drop-top-inner">' +
                '<div class="history-item-prize-drop-title">' + cur_title + '</div>' +
                '<div class="history-item-prize-drop-price">' + cur_price + '</div></div></div></div>');
            var el = $('.history-item-prize-drop');
            el.css({
                top: cur.offset().top - el.height() - 10,
                left: cur.offset().left - el.width() / 2 + cur.width() / 2,
                visibility: "visible"
            }).fadeIn(200);

        },
        mouseleave: function () {
            $('.history-item-prize-drop').remove();
        }
    }, '.history-item-prize');
    /* HISTORY */
    /* FAQ */
    $('body').on('click', '.accordion-item-title', function (e) {
        $(e.currentTarget).parent().toggleClass("open", 30).next("accordion-item-text-container").slideToggle(300);
        if ($(this).parent().hasClass('open')) {
            $(this).parent().find('.accordion-item-text-container').css({height: 'auto'}).fadeIn(300);
        } else {
            $(this).parent().find('.accordion-item-text-container').css({height: '0px'}).fadeOut(300);
        }
    });
    $('body').on('click', '.checkbox-toggle', function (e) {
        $(e.currentTarget).toggleClass("up", 30).next("checkbox-group-list");
        if ($(this).hasClass('up')) {
            $(this).parent().parent().find('.checkbox-group-list').css({height: '156px'});
        } else {
            $(this).parent().parent().find('.checkbox-group-list').css({height: '0px'});
        }
    });
    $('body').on('click', '.accordion-title', function (e) {
        $(e.currentTarget).parent().toggleClass("open", 30).next("accordion-items-container").slideToggle(300);
        if ($(this).parent().hasClass('open')) {
            $(this).parent().find('.accordion-items-container').css({height: 'auto',}).fadeIn(300);
            $(this).parent().find('.accordion-only-text').css({height: 'auto'}).fadeIn(300);
        } else {
            $(this).parent().find('.accordion-items-container').css({height: '0px'}).fadeOut(300);
            $(this).parent().find('.accordion-only-text').css({height: '0px'}).fadeOut(300);

        }
    });
    /* FAQ */
    /* CHAT */
    $('.new-message-input').bind("enterKey", function (e) {
        var input = $(this);
        var msg = input.val();
        if (msg != '') {
            $.post('/chat', {messages: msg, room: room}, function (data) {
                if (data) {
                    if (!data.success) {
                        showmessages('error', data.errors);
                    } else {
                        showmessages('success', data.success);
                        input.val('');
                    }

                }
                else
                    audio('/template/audio/chat-message-send.mp3', 0.4)
                input.val('');
            });
        }
    });
    // $('.new-message-input').keyup(function (e) {
    //  if (e.keyCode == 13) {
    //     $(this).trigger("enterKey");
    //  }
    // });
    $('body').on('click', '.chat #common-messages .message-item .user-name', function (event) {
        var name = $(this).text();
        name = name.replace(':', ',');
        $('.chat .chat-footer .new-message-input').val(name);
    });
    $('.send-message').on('click', function (event) {
        $('.new-message-input').trigger("enterKey");
    });
    $('body').on('click', '.chat-header', function (e) {
        $(e.currentTarget).toggleClass("open").next("lang-dropdown");
        if ($(this).hasClass('open')) {
            $(this).parent().css({bottom: '0px'});
            $('body').removeClass('chat-hidden');
        } else {
            $('body').addClass('chat-hidden');
            $(this).parent().css({bottom: '-250px'});
        }
    });
    /* CHAT */
    /* SETTINGS */
    $('body').on('click', '.lang-selected', function (e) {
        $(e.currentTarget).parent().parent().toggleClass("open").next("lang-dropdown");
        if ($(this).hasClass('open')) {
            $(this).parent().parent().find('.checkbox-group-list').css({height: '156px'});
        } else {
            $(this).parent().parent().find('.checkbox-group-list').css({height: '0px'});
        }
    });
    $('body').on('click', '.sound-toggle', function (e) {
        $(e.currentTarget).toggleClass("enable");
        if ($(this).hasClass('enable')) {
            sounds = 'on';
            $.cookie('sounds', 'on', {expires: 365});
        } else {
            sounds = 'off';
            $.cookie('sounds', 'off', {expires: 365});
        }

    });
    $('body').on('click', 'header .profile_trade .save_trade span', function (e) {

        $.ajax({
            url: '/save_link',
            type: 'POST',
            dataType: 'json',
            data: {
                trade_link: $('#par2').val()
            },
            success: function (data) {
                if (data.status == 'success') {
                    showmessages('success', 'Do not forget to open inventory to get the win!');

                }
                else {
                    showmessages('error', 'Enter the normal link and try again!');
                }
            },
            error: function () {
                showmessages('error', 'Enter the normal link and try again!');
            }
        })
    });
    /* SETTINGS */
    /* HISTORY */
    $('body').on('click', '.history-check-box-container .checkbox-label', function (e) {
        $(e.currentTarget).toggleClass("enable");
        if ($(this).hasClass('enable')) {
            $.post('/myhistory', function (data) {
                $('.history-wrap').html(data);
            });
        } else {
            Page.Go('/history');
        }
    });
    /* HISTORY */
    /* ROOM */
    reload();
    $('body').on('click', '.wrapper .gameinf .left .room li', function (e) {
        for (var i = 0; i < rooms.length; i++) {
            if (rooms[i].toString() != $(this).data('room-name')) {
                $('.wrapper .gameinf .left .room li[data-room-name="' + rooms[i].toString() + '"]').removeClass('active');
                $('#' + rooms[i].toString()).hide();
            } else {
                $(this).addClass('active');
                $('#' + $(this).data('room-name')).show();
                $.cookie('room', $(this).data('room-name'), {expires: 365});
                room = $.cookie('room');
                socket.emit('getchat', {room});
                $('.room-name').text(room.charAt(0).toUpperCase() + room.substr(1) + ' game');
            }
        }

    });
    /* ROOM */
    /* SOCKET */
    var declineTimeout;
    socket
        .on('connect', function () {
            $('#loader').hide();
        })
        .on('online', function (data) {
            $('#online').text(data);
        })
        .on('stats', function (data) {
            data = JSON.parse(data);
            $('#gametoday').text(data.gametoday);
            $('#usertoday').text(data.usertoday);
            $('#maxwin').text(data.maxwin);

        })
        .on('message', function (data) {
            data = JSON.parse(data);
            if ('undefined' != typeof USER_ID && data.user == USER_ID) {
                showmessages(data.type, data.message);
                my_inventory_tosite();
            }
        })
        .on('getchat', function (data) {
            $('#common-messages').html(data);
            $(".chat-body").scrollTop(1e7);
        })
        .on('new.msg', function (data) {
            data = JSON.parse(data);
            if (data.room == room) {
                if ($(data.msg).find('.user-name').text() != $('.user-menu-name').text()) {
                    audio('/template/audio/chat-message-add-' + Math.round(getRandomArbitary(1, 3)) + '.mp3', 0.4)
                }
                $('#common-messages').append(data.msg);
                $(".chat-body").scrollTop(1e7);
            }
            $("#common-messages").scrollTop(0);
        })
        .on('lastwinner', function (data) {
            var a = $('.last-winener').css("transform") != "matrix(1, 0, 0, 1, 0, 0)" ? 0 : 360;
            $('.last-winener').css({transform: 'rotateX(' + a + 'deg)'});
            $('.wrapper .gameinf .left .last-winener .name').text(data.username);
            $('.wrapper .gameinf .left .last-winener .price span').text(data.price + 'р');
            $('.wrapper .gameinf .left .last-winener img.avatar').attr('src', data.avatar);
            $('.wrapper .gameinf .left .last-winener li.chance span').text(data.percent);
        })

        .on('slider', function (data) {
            if (ngtimerStatus) {

                $('.wrapper .gameinf .timgm .numitem').html('Новая игра через');
                $('.game-end .wininfo').removeClass('hidden');
                ngtimerStatus = false;

                var users = data.users;
                var itemsTape = [];
                users.forEach(function (user) {
                    var img_src = user.avatar;
                    var chance = user.chance;
                    for (var i = 0; i <= chance; i++) {
                        itemsTape.push(img_src);
                    }
                });
                function shuffle(o) {
                    for (var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
                    return o;
                }

                itemsTape = shuffle(itemsTape);
                itemsTape.splice(110, itemsTape.length - 110);
                if (itemsTape.length < 110) {
                    var differ = 110 - itemsTape.length;
                    for (var i = 0; i < differ; i++) {
                        itemsTape.push(itemsTape[0]);
                    }
                }
                itemsTape[5] = data.winner.avatar;
                itemsTape[103] = data.winner.avatar;
                html = '';
                itemsTape.forEach(function (avatar) {
                    html += '<li><img src="' + avatar + '"></li>';
                });
                $('.timer').empty().countdown({seconds: data.time});
                $('.all-players-list').html(html);
                $('.game-end .wininfo span.price').text(data.game.price + 'р');
                $('.game-active-container .game-active').addClass('animated-out');
                $('.game-end').removeClass('hidden').removeClass('animated-out').addClass('animated-in');

                setTimeout(function () {
                    $('.game-active-container .game-active').removeClass('animated-out').addClass('not-visible');
                }, 2000);

                $('.game-end .timer .countdownHolder').empty().countdown({seconds: data.time});

                $('.game-end .timer .countdownHol4der').html('Внести депозит первым');
                $('.game-selector-item[data-room-name="roulette"]').find('.game-selector-item-info-state').text('Розыгрыш');
                $('.game-selector-item[data-room-name="roulette"]').find('.game-selector-item-info-prize').text(data.game.price + ' руб.');
                var timeout = data.showSlider ? 15 : 0;
                if (data.showSlider) {
                    setTimeout(function () {
                        audio('/template/audio/roulette-start-' + Math.round(getRandomArbitary(1, 3)) + '.mp3', 0.4)
                        var k = 6660 + Math.round(getRandomArbitary(1, 57));
                        $('.all-players-list').css({
                            transform: 'translate3d(-' + k + 'px, 0px, 0px)',
                            transition: 1000 * timeout + 'ms cubic-bezier(0.32, 0.64, 0.45, 1)'
                        });

                        var m = 10, p = 0;
                        rouletteInterval = setInterval(function () {
                            if (location.pathname == '/') {
                                p = _getTransformOffset($('.all-players-list')), m - p >= 74 && (m = p, audio('/template/audio/click.mp3', 0.1));
                            }
                        }, 80);
                        setTimeout(function () {
                            clearInterval(rouletteInterval);
                        }, 1000 * timeout);
                    }, 500);
                }

                setTimeout(function () {
                    /* var k = 0+ Math.round(getRandomArbitary(1, 67));
                     $('.all-players-list').css({
                     transform: 'translate3d(-'+k+'px, 0px, 0px)'
                     });
                     transform: 'translate3d(-'+k+'px, 0px, 0px)',
                     */
                    $('#randNum').text(data.round_number);
                    $('.gameEnd.current-round').removeClass('msgs-not-visible');
                    $('.win-weapon').addClass('shown');
                    $('#randNum').addClass('shown');
                    $('.gameover').show();
                    $('.game-end .winning-ticket').text('#' + data.ticket);
                    var winitem = JSON.parse(data.winitem);
                    var ticketwin = JSON.parse(data.ticketwin);
                    $('.game-end .wininfo span.itemwin').html(winitem.name);
                    $('.game-end .wininfo span.name').html(data.winner.username);
                    $('.game-end .wininfo span.chance').text(data.chance + '%');
                    $('.win-weapon .win-weapon-img').attr('src', 'https://steamcommunity-a.akamaihd.net/economy/image/class/730/' + winitem.classid + '/85fx70f');
                    $('.win-weapon .win-weapon-tickets').html('#' + ticketwin.from + ' - #' + ticketwin.to);


                    if ('undefined' != typeof USER_ID) {
                        $.post('/getBalance', function (data) {
                            $('.update_balance').text(data);
                        });
                        my_inventory_tosite();
                    }

                }, 1000 * timeout);
            }

        })
        .on('disconnect', function () {
            $('#loader').show();
        }).on('timer', function (time) {
        if (timerStatus) {
            // console.log(time);
            timerStatus = false;

            $('.timgm .timer').empty().removeClass('not-active').countdown({seconds: time});


        }
    }).on('newGame', function (data) {
        if ('undefined' != typeof USER_ID) {
            $.post('/getBalance', function (data) {
                $('.update_balance').text(data);
            });
            my_inventory_tosite();
        }
        $('.game-end .wininfo').addClass('hidden');
        $('.wrapper .gameinf .timgm .numitem').html('<span>0/50</span>Предметов в игре');
        $('.game-end .winning-ticket').text('???');
        $('.game-end .winning-player').text('???');
        $('.game-end .wininfo span.itemwin').text('???');
        $('.game-end .wininfo span.name').text('???');
        $('.game-end .wininfo span.chance').text('???');
        $('.all-players-list').html('');
        $('.all-players-list').removeAttr('style')
        $('.game-active-container .game-active').addClass('animated-in').removeClass('not-visible');
        $('.players-tape').html('');
        $('.win-weapon').removeClass('shown');
        $('.gameover').hide();
        $('#animate_items_container').css({
            transition: "500ms ease",
            transform: 'translateY(-' + ($('#animate_items_container').height() - 100) + 'px)'
        });
        $('.players-container').addClass('hidden');
        $('.game-end').addClass('animated-out').addClass('hidden');
        //   setTimeout(function () {
        $('#items-container').html('');
        $('#animate_items_container').css({transform: 'translateY(0px)'});
        // }, 1000);

        // setTimeout(function () {
        $('.game-active-container .game-active').removeClass('animated-in').removeClass('not-visible');
        $('.game-end').removeClass('animated-in').removeClass('animated-out').addClass('not-visible');
        // }, 2000);
        $('#game-chances').addClass('hidden');
        $('#myItems').text(0);
        $('#items-container').html();
        $('#myChance').text(0);
        $('.game-num').text(data.id);
        $('#roundBank').text('0 руб.');
        $('.game-price-content #roundBank').text('0 руб.');
        $('#roundHash').text(data.hash);
        $('.wrapper .gameinf .timgm .numitem span').text('0/50');
        items_circle.animate(0);
        timerStatus = true;
        ngtimerStatus = true;
    }).on('depositDecline', function (data) {
        data = JSON.parse(data);
        if ('undefined' != typeof USER_ID && data.user == USER_ID) {
            showmessages('error', data.msg);

        }

    }).on('newDeposit', function (data) {
        $('.game-active-container .game-active').removeClass('animated-in').removeClass('not-visible');
        data = JSON.parse(data);
        var el = $(data.html);
        showActivity('roulette', el.find('img').attr("src"), el.find('#price').html());
        el.css({transform: 'translate3d(0,-100px,0)'});

        // $('.animate_items_container')
        $('#items-container').prepend(el);
        setTimeout(function () {
            el.css({transform: 'translate3d(0,0px,0)'});
        }, 10);
        var username = $('#bet_' + data.id + ' .short .user .username').text();
        $('#bet_' + data.id + ' .short .user .username').text(username);
        $('#roundBank').text(Math.round(data.gamePrice) + ' руб.');
        $('.game-price-content #roundBank').text(Math.round(data.gamePrice) + ' руб.');
        $('.wrapper .gameinf .timgm .numitem span').text(data.itemsCount + '/50');
        skins_count = +data.itemsCount > 50 ? 50 : +data.itemsCount;
        items_circle.animate(skins_count / 50);
        html_chances = '';
        data.chances = sortByChance(data.chances);
        data.chances.forEach(function (info) {
            if (USER_ID == info.steamid64) {
                $('#myItems').text(info.items);
                $('#myChance').text(info.chance);
            }
            $('.chance_' + info.steamid64).text(info.chance + '%');
            html_chances += '<li><img src="' + info.avatar + '"><span>' + info.chance + '%</span></li>';
        });
        $('.game-end').removeClass('hidden')
        $('.players-container').removeClass('hidden');
        $('.content .all-players .all-players-list').html(html_chances);
        $('.leftbar .main-game .short .top ul li a').each(function () {
            $(this).text(replaceLogin($(this).text()));
        });


        audio('/template/audio/bet-' + Math.round(getRandomArbitary(1, 3)) + '.mp3', 0.4);
        $('.tooltip').tooltipster({'multiple': true});
        initAjaxToken();
    })
    /* SOCKET */
    $('body').on('click', '.players-percent .players-right', function (e) {
        $('.players-tape').css({width: '960px', transform: 'translate3d(-99px, 0px, 0px)', transition: '0.7s'});

    });
    $('body').on('click', '.players-percent .players-left', function (e) {
        $('.players-tape').css({width: '960px', transform: 'translate3d(0px, 0px, 0px)', transition: '0.7s'});

    });


});


/* OTHER */


function mergeWithDescriptions(items, descriptions) {
    return Object.keys(items).map(function (id) {
        var item = items[id];
        var description = descriptions[item.classid + '_' + (item.instanceid || '0')];
        for (var key in description) {
            item[key] = description[key];

            delete item['icon_url'];
            delete item['icon_drag_url'];
            delete item['icon_url_large'];
        }
        return item;
    })
}


function sortByChance(arrayPtr) {
    var temp = [],
        item = 0;
    for (var counter = 0; counter < arrayPtr.length; counter++) {
        temp = arrayPtr[counter];
        item = counter - 1;
        while (item >= 0 && arrayPtr[item].chance < temp.chance) {
            arrayPtr[item + 1] = arrayPtr[item];
            arrayPtr[item] = temp;
            item--;
        }
    }
    return arrayPtr;
}

function _getTransformOffset(e) {
    var t = e.css("transform").split(",");
    return 6 === t.length ? parseInt(t[4]) : 16 === t.length ? parseInt(t[12]) : 0
}
function audio(audio, vol) {
    if (sounds == 'on') {
        var newgames = new Audio();
        newgames.src = audio;
        newgames.volume = vol;
        newgames.play();
    }
}


function getRandomArbitary(min, max) {
    return Math.random() * (max - min) + min;
}

function my_inventory_tosite() {

    $.post('/my_inventory_tosite', function (data) {
        $('.wrapper .inventory .items').html('');
        if (data == 'false') {
            $('.wrapper .inventory .items').html('<span class="null">Ваш инвентарь пуст</span>');
        } else {
            var count = 0;
            data.forEach(function (i) {
                $('.wrapper .inventory .items').append('<div class="itm" data-id="' + i.id + '"> ' +
                    '<div class="price">' + i.price + 'Р</div><img src="https://steamcommunity-a.akamaihd.net/economy/image/class/730/' + i.classid + '/60fx60f" alt="" title="">' +
                    ' </div>');
                count += 1;
            });
            $('.wrapper .inventory .info span:nth-child(2)').html(count);
        }

    });

}

function my_inventory() {

    $.post('/my_inventory', function (data) {
        $('.modal-content .inventory .items').html('');
        if (data == 'false') {
            $('.modal-content .inventory .items').html('<span class="null">Ваш инвентарь пуст</span>');
        } else {
            var count = 0;
            data.forEach(function (i) {
                $('.modal-content .inventory .items').append('<div class="itm" data-classid="' + i.classid + '" data-id="' + i.id + '"> ' +
                    '<div class="price">' + i.price + 'Р</div><img src="https://steamcommunity-a.akamaihd.net/economy/image/class/730/' + i.classid + '/60fx60f" alt="" title="">' +
                    ' </div>');
                count += 1;
            });
            $('.modal-content .inventory .info span:nth-child(2)').html(count);
        }

    });

}


function showmessages(type, message) {
    var title = 'Ошибка!';
    if (type == 'success') {
        var title = 'Успешно!';
    }

    noty({
        text: '<div><div><strong>' + title + '</strong><br>' + message + '</div></div>',
        layout: 'topRight',
        type: type,
        theme: 'relax',
        timeout: 8000,
        closeWith: ['click'],
        animation: {
            open: 'animated flipInX',
            close: 'animated flipOutX'
        }
    });

}


/* OTHER */